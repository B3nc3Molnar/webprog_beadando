<?php

class Felhasznalok_Controller
{
	public $baseName = 'felhasznalok';
	public function main(array $vars) // Ezen a metóduson keresztül fut le minden lépés, ami szükséges a nézethez
	{
		include_once(SERVER_ROOT.'models/felhasznalok_model.php');
		$felhasznalokModel = new Felhasznalok_Model;  //az oszt�lyhoz tartoz� modell
		//a modellben bel�pteti a felhaszn�l�t
		$retData = $felhasznalokModel->get_data(); 
		//bet�ltj�k a n�zetet
		$view = new View_Loader($this->baseName."_main");
		//�tadjuk a lek�rdezett adatokat a n�zetnek
		foreach($retData as $name => $value)
			$view->assign($name, $value);
	}
}

?>