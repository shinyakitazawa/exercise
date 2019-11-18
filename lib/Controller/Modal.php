<?php

namespace MyApp\Controller;

class Modal extends \MyApp\Controller  {

    public function run() {
        $model = new \MyApp\Model\Documents();
        
        $names = $model->GetCategory();
        $this->setValue('names', $names);
    }
}

?>