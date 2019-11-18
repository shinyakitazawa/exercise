<?php

namespace MyApp\Controller\MasterMente;

class MasterMente extends \MyApp\Controller {

    public function run() {

        if (!$this->isLoggedIn()) {
            header('Location: ' . SITE_URL);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            switch ($_POST['kind']) {
                case 'names':
                    require_once(__DIR__ . '/NamesTable.php');
                    break;
                case 'users':
                    require_once(__DIR__ . '/UsersTable.php');
                    break;
            }

  
        }

    }
}


?>