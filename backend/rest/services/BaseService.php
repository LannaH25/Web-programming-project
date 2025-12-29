<?php
    require_once __DIR__ . '/../dao/BaseDao.php';
    
    class BaseService {
        protected $dao;

        public function __construct($dao) {
            $this->dao = $dao;
        }

        public function getAll() {
            return $this->dao->getAll();
        }

        public function getById($id) {
            return $this->dao->getById($id);
        }

        public function create($data) {
            $newId = $this->dao->insert($data);
            $data[$this->dao->pk] = (int)$newId;
            return $data;
        }

        public function update($id, $data) {
            return $this->dao->update($id, $data);
        }

        public function delete($id) {
            return $this->dao->delete($id);
        }
    

        public function add($entity) {

        $newId = $this->dao->insert($entity);
        $entity[$this->dao->pk]= (int)$newId;

        return $entity;
        }
        
    }
?>
