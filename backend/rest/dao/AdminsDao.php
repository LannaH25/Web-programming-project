<?php
require_once 'BaseDao.php';

class AdminsDao extends BaseDao {
    public function __construct() {
        parent::__construct("admins", 'Admin_ID');
    }

     public function get_by_id($id){
        return $this->getById($id);
    }


}
?>
