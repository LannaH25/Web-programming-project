<?php
require_once __DIR__ . '/../dao/UsersDao.php';

class UsersService {
    private $dao;

    public function __construct() {
        $this->dao = new UsersDao();
    }

    public function getAllUsers(): array {
    $users = $this->dao->getAllUsers();

    foreach ($users as &$user) {
        unset($user['password']);
    }

    return $users;
}


    public function getById($id) {
        $user = $this->dao->getById($id);
        if ($user) unset($user['password']);
        return $user;
    }


    public function addUser($data) {
        if (!isset($data['Full_name']) || !isset($data['Email']) || !isset($data['password'])) {
    throw new Exception('Full name, email, and password are required');
}
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

        $created = $this->dao->add($data);
        if ($created) unset($created['password']);
        return $created;
    }


    public function updateUser($id, $data) {
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }
        $success = $this->dao->updateUser($id, $data);
if (!$success) return false;
$user = $this->dao->getById($id);
unset($user['password']);
return $user;

    }

    public function deleteUser($id) {
        return $this->dao->delete($id);
    }
}
