<?php
require_once 'BaseDao.php';

class FavoritesDao extends BaseDao {
    public function __construct() {
        parent::__construct("favorites");
    }

     public function get_by_id($id){
        return $this->getById($id);
    }


}
?>
