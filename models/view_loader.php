<?php

class View_Loader
{
    private $data = array();
    private $render = FALSE;
    private $selectedItems = FALSE;
    private $style = FALSE;

    public function __construct($viewName)//Konstruktor
    //A konstruktor akkor fut le, amikor egy új példány jön létre a View_Loader osztályból, és a nézet nevét paraméterként kapja meg.
    {
        $file = SERVER_ROOT . 'views/' . strtolower($viewName) . '.php';
        if (file_exists($file))
        {
            $this->render = $file;
            $this->selectedItems = explode("_", $viewName);
        }        
        $file = SERVER_ROOT . 'css/' . strtolower($viewName) . '.css';
        if (file_exists($file))
        {
            $this->style = SITE_ROOT . 'css/' . strtolower($viewName) . '.css';;
        }        
    }

    public function assign($variable , $value) //Változók hozzárendelése
    {
        $this->data[$variable] = $value;
    }

    public function __destruct() //Destruktor
    {
        $this->data['render'] = $this->render;
        $this->data['selectedItems'] = $this->selectedItems;
        $this->data['style'] = $this->style;
        $viewData = $this->data;
        include(SERVER_ROOT . 'views/page_main.php'); //parancs betölti a fő nézet fájlt, és ez tartalmazhatja a tartalom megjelenítéséhez szükséges logikát.
    }
}

?>