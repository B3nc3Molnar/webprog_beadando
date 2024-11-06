<?php
//menükezelőt valósít meg, amely adatbázisból tölti be a menü elemeit, majd eltárolja azokat egy statikus tömbben ($menu). A kód célja, hogy a menüelemeket az adatbázisból a felhasználó hozzáférési szintje (jogosultsága) alapján töltse be,
//és ezek alapján jelenítse meg a menüt a felhasználó számára. Nézzük meg részletesen, hogy hogyan működik.
Class Menu {
    public static $menu = array(); //üres tömb, de később tartalmazni fogja az adatbázisból lekért menüelemeket.
    
    //setMenu() metódus lekéri a felhasználó jogosultsági szintjének megfelelő menüelemeket az adatbázisból.
    public static function setMenu() {
        ////a fv. kiüríti a self::$menu tömböt, minden korábban betöltött menüelemet töröl, hogy egy tiszta, friss tömböt használjon
        self::$menu = array(); 
        $connection = Database::getConnection();
        $stmt = $connection->query("select url, nev, szulo, jogosultsag from menu where jogosultsag like '".$_SESSION['userlevel']."'order by sorrend");
        while($menuitem = $stmt->fetch(PDO::FETCH_ASSOC)) {
            //menüelemek az URL alapján kerülnek tárolásra a statikus $menu tömbben, és minden elemhez tartozik a név, szülő elem és jogosultsági szint.
            self::$menu[$menuitem['url']] = array($menuitem['nev'], $menuitem['szulo'], $menuitem['jogosultsag']);
        }
    }

    public static function getMenu($sItems) {
        try {
            $submenu = "";

        
        
        $menu = "<ul class=\"menu\">";
        
        foreach(self::$menu as $menuindex => $menuitem)       
        {
            if($menuitem[1] == "")
            { $menu.= "<li><a href='".SITE_ROOT.$menuindex."' ".($menuindex==$sItems? "class='selected'":"").">".$menuitem[0]."</a></li>"; }
            else if($menuitem[1] == $sItems)
            { $submenu .= "<li><a href='".SITE_ROOT.$sItems[0]."/".$menuindex."' ".($menuindex==$sItems[1]? "class='selected'":"").">".$menuitem[0]."</a></li>"; }
        }
        $menu.="</ul>";
        
        if($submenu != "")
            $submenu = "<ul class=\"menu\">".$submenu."</ul>";
        
        return $menu.$submenu;;
        } catch (\Throwable $th) {
            echo "BAJ VAN!";
        }

        
    }
}

Menu::setMenu();
?>
