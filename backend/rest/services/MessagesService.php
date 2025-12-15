<?php
require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/MessagesDao.php';

class MessagesService extends BaseService {

    public function __construct() {
        parent::__construct(new MessagesDao());
    }
}
?>
