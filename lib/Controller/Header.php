<?php

namespace MyApp\Controller;

class Header {

    public function GetDisable() {
        if (!isset($_SESSION['me']) && empty($_SESSION['me'])) {
            return 'disabled';
        }
    }
}

?>