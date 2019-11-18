<?php

namespace MyApp\Controller;

class Index extends \MyApp\Controller  {
    public function run() {
        if (!$this->IsLoggedIn()) {
            header('Location: ' . SITE_URL . '/login.php');
        }
    }
}

?>