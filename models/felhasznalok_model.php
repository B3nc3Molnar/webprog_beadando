<?php

class Felhasznalok_Model
{
	public function get_data()
	{
		$retData['eredmeny'] = "OK";
		$retData['rows'] = Array(); //Üres tömb, amelybe az adatokat fogjuk menteni
		
		try {
            //adatbázis kapcsolat létrehozása
			$connection = Database::getConnection();
            //SQL lekérdezés
			$sql = "select id, csaladi_nev, utonev, bejelentkezes, jogosultsag from felhasznalok order by id";
			//SQL utasítás végrehajtása
            $stmt = $connection->query($sql);
            //Az eredményeket asszociatív tömb formájában gyűjtjük be
			$retData['rows'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) {
            //Ha hiba történik, az eredményt "ERROR"-ra állítjuk
			$retData['eredmeny'] = "ERROR";
            //Hibaüzenetet adunk vissza, amely tartalmazza a hiba részleteit
			$retData['uzenet'] = "Adatbázis hiba:<br>".$e->getMessage()."!";
		}
        //Visszaadjuk az eredményeketv
		return $retData;
	}
}

?>