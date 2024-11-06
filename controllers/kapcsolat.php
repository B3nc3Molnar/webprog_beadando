<?php

class Kapcsolat_Controller
{
    public $baseName = 'kapcsolat'; //oldal meghatározása
    public function main(array $vars)
    {
        $view = new View_Loader($this->baseName."_main"); //nézet betöltése
    }
}

?>