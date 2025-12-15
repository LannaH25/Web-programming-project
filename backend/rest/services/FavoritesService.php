<?php
require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/FavoritesDao.php';

class FavoritesService extends BaseService {

    public function __construct() {
        parent::__construct(new FavoritesDao());
    }
}
?>
