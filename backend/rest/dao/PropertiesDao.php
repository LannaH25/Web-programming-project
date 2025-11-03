<?php
require_once 'BaseDao.php';

class PropertiesDao extends BaseDao {
    public function __construct() {
        parent::__construct("properties");
    }

     public function get_by_id($id){
        return $this->getById($id);
    }


}
?>
