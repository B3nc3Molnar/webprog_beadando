<?php

class Error_Controller
{
public $basename = '404';
public function main(array $vars)
    {
        $view = new View_Loader($this->basename);
        $view->assign('type', $vars[0]);
        $view->assign('message', $vars[1]);
    }
}

?>