<?php

class Registrator_Controller
{
	public $baseName = 'home';  //meghat�rozni, hogy melyik oldalon vagyunk
	public function main(array $vars) // a router �ltal tov�bb�tott param�tereket kapja
	{
		include_once(SERVER_ROOT.'models/registrator_model.php');
		$registratorModel = new Registrator_Model;  //az oszt�lyhoz tartoz� modell
		//a modellben bel�pteti a felhaszn�l�t
		$retData = $registratorModel->get_data($vars);
		/*if($retData['eredmeny'] == "ERROR")
			$this->baseName = "registration";
		//bet�ltj�k a n�zetet*/
		if(isset($_POST["username"])){
			$connection = Database::getConnection();
			$sql = "SELECT * FROM felhasznalok WHERE  bejelentkezes ='".$_POST["username"]."'";
			$stmt = $connection->query($sql);
			$felhasznalo = $stmt->fetchAll(PDO::FETCH_ASSOC);

			if(count($felhasznalo) >= 1){
				echo "<script>alert('Ilyen felhasználó névvel már létezik fiók!');</script>";
			}else{
				// Kapcsolat az adatbázishoz
				$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				// Előkészített utasítás a biztonság érdekében
				$sql = "INSERT INTO felhasznalok (id, csaladi_nev, utonev, bejelentkezes, jelszo, jogosultsag) 
						VALUES (null, :csaladi_nev, :utonev, :bejelentkezes, :jelszo, :jogosultsag)";

				$stmt = $connection->prepare($sql);

				// Felhasználói adatok megadása
				$csaladi_nev = "Teszt";  // Figyelj a helyes változó névre: "csaladi_nev"
				$utonev = "ELEK";
				$hashed_password = sha1($_POST["password"]);
				$jogosultsag = "010";

				// Adatok megkötése (bindolása) a felhasználói bemenetekhez
				$stmt->bindParam(":csaladi_nev", $csaladi_nev);  // Javítottam a változó nevét
				$stmt->bindParam(":utonev", $utonev);
				$stmt->bindParam(":bejelentkezes", $_POST["username"]);
				$stmt->bindParam(":jelszo", $hashed_password);
				$stmt->bindParam(":jogosultsag", $jogosultsag);
				// Adatbázis lekérdezés végrehajtása
				if (!$stmt->execute()) {  // Az execute() metódust kell használni
					echo "Error: " . $stmt->errorInfo()[2];
				}


			}
			echo "<script>alert('Sikeres regisztráció!');</script>";	

			$view = new View_Loader('home_main');
		}else{
			echo "<script>alert('Minden mező kitöltése kötelező');</script>";	
			$view = new View_Loader($this->baseName.'_main');

			
		}
		//$view = new View_Loader("teszt");
		
		//�tadjuk a lek�rdezett adatokat a n�zetnek
		/*foreach($retData as $name => $value)
			$view->assign($name, $value);*/
	}
}

?>

