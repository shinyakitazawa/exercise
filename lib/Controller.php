<?php

namespace MyApp;

class Controller {

    private $_message;
    private $_value;

    function __construct() {
        if (!isset($_SESSION['token'])) {
            $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(16));
        }
        $this->_value = new \stdClass();
    }

    // protected function IsLoggedIn() {
    public function IsLoggedIn() {
        return isset($_SESSION['me']) && !empty($_SESSION['me']);
    }

    protected function setValue($key, $value) {
        $this->_value->$key = $value;
    }

    public function getValue() {
        return $this->_value;
    }
    protected function setMessage($key, $value) {
        $this->_message = new \stdClass();
        $this->_message->$key = $value;
    }

    public function getMessage($key) {
        return isset($this->_message->$key) ?  $this->_message->$key : '';
    }
    
}

?>
