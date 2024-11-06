<?php

class Beleptet_Model
{
	public function get_data($vars)
	{
		$retData['eredmeny'] = "";
		try {
			$connection = Database::getConnection();
			$sql = "select id, csaladi_nev, utonev, jelszo, jogosultsag from felhasznalok where bejelentkezes='".$vars['login']."'";
			$stmt = $connection->query($sql);
			$felhasznalo = $stmt->fetchAll(PDO::FETCH_ASSOC);
			switch(count($felhasznalo)) {
				case 0:
					$retData['eredmeny'] = "ERROR";
					$retData['uzenet'] = "Ilyen felhasználó nem létezik!";
					break;
				case 1:
					if(sha1($vars['password']) == $felhasznalo[0]['jelszo'])
					{
						$retData['eredmeny'] = "OK";
						$retData['uzenet'] = "Kedves ".$felhasznalo[0]['csaladi_nev']." ".$felhasznalo[0]['utonev']."!<br><br>
											  Üdvözöllek a weboldalamon.<br><br>";
						$_SESSION['userid'] =  $felhasznalo[0]['id'];
						$_SESSION['userlastname'] =  $felhasznalo[0]['csaladi_nev'];
						$_SESSION['userfirstname'] =  $felhasznalo[0]['utonev'];
						// 1 marad
						// 0 legyen _
						// $_SESSION['userlevel'] = $felhasznalo[0]['jogosultsag'];
						$_SESSION['userlevel'] = str_replace("0","_",$felhasznalo[0]['jogosultsag']);
						//$_SESSION['userlevel'] = "___";
					}
					else
					{
						$retData['eredmeny'] = "ERROR";
						$retData['uzenet'] = password_hash("asdasd",PASSWORD_DEFAULT);
					}
					break;
				default:
					$retData['eredmeny'] = "ERROR";
					$retData['uzenet'] = "Több felhasználót találtunk a megadott felhasználói név -jelszó párral!";
			}
		}
		catch (PDOException $e) {
					$retData['eredmeny'] = "ERROR";
					$retData['uzenet'] = "Adatbázis hiba: ".$e->getMessage()."!";
		}
		return $retData;
	}
}

?>