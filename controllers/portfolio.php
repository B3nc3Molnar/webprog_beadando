<?php

class Portfolio_Controller
{
    public $baseName = 'portfolio'; //oldal meghatározása
    public function main(array $vars)
    {
        $view = new View_Loader($this->baseName."_main"); //nézet betöltése
    }
}

?>