<h2>
    <?php
        switch($viewData['eredmeny']) {
            case "OK":
                echo "<p>Felhasználók listája:<p>";
                ?>
                <table>
                <tr>
                    <th>Családi név</th>
                    <th>Utónév</th>
                    <th>Belépési név</th>
                    <th>Jogosultság</th>
                </tr>
                <?php

                //Ez a ciklus az összes felhasználón végigmegy, és minden felhasználót 
                //egy-egy táblázatsorban jelenít meg.
                foreach($viewData['rows'] as $row) {
                    echo "<tr>";
                    //A belső ciklus pedig az egyes felhasználók adatainak (oszlopainak) kiírásáért felel.
                    foreach($row as $column) {
                        echo "<td>".$column."</td>";
                    }
                    ?>
                    <td>
                    <form action="<?= SITE_ROOT ?>torol" method="post">
                        
                        <input type="hidden" name="rowid" value="<?= $row["id"] ?>">
                        <input type="submit" value="Törlés">
                    </form>
                    </td>
                    </tr>
                    <?php
                }
                echo "</table>";
                break;
            case "ERROR":
                echo "<p>".$viewData['uzenet']."</p>";
                break;
        }
    ?>
</h2>