<?php
require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/PropertiesDao.php';

class PropertiesService extends BaseService {

    public function __construct() {
        parent::__construct(new PropertiesDao());
    }
}
?>
