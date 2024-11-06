<?php

class Registration_Controller{
    public $baseName="registration";

    public function main(array $vars){
        $view = new View_Loader($this->baseName."_main");
    }
}

?>