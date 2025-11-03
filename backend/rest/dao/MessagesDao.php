<?php
require_once 'BaseDao.php';

class MessagesDao extends BaseDao {
    public function __construct() {
        parent::__construct("messages");
    }

     public function get_by_id($id){
        return $this->getById($id);
    }


}
?>
