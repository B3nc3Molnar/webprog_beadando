<?php

class Elerhetoseg_Controller
{
	public $baseName = 'elerhetoseg';  //meghatározni, hogy melyik oldalon vagyunk
	public function main(array $vars) // a router �ltal tov�bb�tott param�tereket kapja
	{
		//betöltjük a nézetet
		$view = new View_Loader($this->baseName."_main");
	}
}

?>