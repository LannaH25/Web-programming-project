<?php
require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/AdminsDao.php';

class AdminsService extends BaseService {

    public function __construct() {
        parent::__construct(new AdminsDao());
    }
}
?>
