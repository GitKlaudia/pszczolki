<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "bmovie";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn -> connect_errno) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, tytul, rok_produkcji, czas_trwania, opis, plakat FROM filmy";
if ($result = $conn -> query($sql)) {
  if ($result -> num_rows > 0) {
    echo "Lista filmów:<br><ul>";
    while ($row = $result -> fetch_assoc()) {
      echo "<img src='plakaty_filmow/" . $row['plakat'] . "' alt='" . $row['tytul'] . " plakat' style='width:100px;'><br>";
      echo "<li>" . $row['tytul'] . " (" . $row['rok_produkcji'] . ")</li><br>";
      echo "Czas trwania: " . $row['czas_trwania'] . " minut<br><br>";
      echo "Opis: " . $row['opis'] . "<br><br>";
     
      $sqlKategorie = "SELECT kategorie.nazwa FROM kategorie_tresci
      JOIN kategorie ON kategorie_tresci.id_kategorii = kategorie.id
      WHERE kategorie_tresci.typ_tresci = 'film' AND kategorie_tresci.id_tresci = " . $row['id'];
      if ($kategorieResult = $conn -> query($sqlKategorie)) {
        if ($kategorieResult -> num_rows > 0) {
          echo "Kategorie: ";
          $kategorie = [];
          while ($kategoria = $kategorieResult -> fetch_assoc()) {
            $kategorie[] = $kategoria['nazwa'];
          }
          echo implode(", ", $kategorie) . "<br><br>";
        } else {
          echo "Brak informacji o kategoriach.<br><br>";
        }
        $kategorieResult -> free_result();
      }

      $sqlRezyseria = "SELECT rezyserzy.imie, rezyserzy.nazwisko, rezyserzy.data_urodzenia FROM produkcje_rezyserow
      JOIN rezyserzy ON produkcje_rezyserow.id_rezysera = rezyserzy.id
      WHERE produkcje_rezyserow.typ_tresci = 'film' AND produkcje_rezyserow.id_tresci = " . $row['id'];
      if ($rezyseriaResult = $conn -> query($sqlRezyseria)) {
        if ($rezyseriaResult -> num_rows > 0) {
          echo "Reżyseria: ";
          $rezyserzy = [];
          while ($rezyser = $rezyseriaResult -> fetch_assoc()) {
            $rezyserzy[] = $rezyser['imie'] . " " . $rezyser['nazwisko'] . " (ur. " . $rezyser['data_urodzenia'] . ")";
          }
          echo implode(", ", $rezyserzy) . "<br><br>";
        } else {
          echo "Brak informacji o reżyserii.<br><br>";
        }
        $rezyseriaResult -> free_result();
      }

      $sqlOcena = "SELECT AVG(ocena) AS ocena FROM oceny WHERE typ_tresci = 'film' AND id_tresci = " . $row['id'];
      if ($ocenaResult = $conn -> query($sqlOcena)) {
        if ($ocenaRow = $ocenaResult -> fetch_assoc()) {
          $sredniaOcena = round($ocenaRow['ocena'], 2);
          if ($sredniaOcena) {
            echo "Średnia ocena: " . $sredniaOcena . "/10<br><br>";
          } else {
            echo "Brak ocen.<br><br>";
          }
        }
        $ocenaResult -> free_result();
      }

      $sqlPlatformy = "SELECT platformy.nazwa, platformy.ikona, dostepnosc_na_platformach.link FROM dostepnosc_na_platformach
      JOIN platformy ON dostepnosc_na_platformach.id_platformy = platformy.id
      WHERE dostepnosc_na_platformach.typ_tresci = 'film' AND dostepnosc_na_platformach.id_tresci = " . $row['id'];
      if ($platformyResult = $conn -> query($sqlPlatformy)) {
        if ($platformyResult -> num_rows > 0) {
          echo "Dostępne na platformach:<br>";
          while ($platforma = $platformyResult -> fetch_assoc()) {
            echo "<a href='" . $platforma['link'] . "' target='_blank'><img src='ikony_platform/" . $platforma['ikona'] . "' alt='" . $platforma['nazwa'] . "' title='" . $platforma['nazwa'] . "' style='width:50px; margin-right:10px;'></a>";
          }
          echo "<br><br>";
        } else {
          echo "Brak informacji o dostępności na platformach.<br><br>";
        }
        $platformyResult -> free_result();
      }

      $sqlObsada = "SELECT aktorzy.imie, aktorzy.nazwisko, aktorzy.data_urodzenia, aktorzy.zdjecie, wystepy_aktorow.rola
      FROM wystepy_aktorow 
      JOIN aktorzy ON wystepy_aktorow.id_aktora = aktorzy.id
      WHERE wystepy_aktorow.typ_tresci = 'film' AND wystepy_aktorow.id_tresci = " . $row['id'];
      if ($obsadaResult = $conn -> query($sqlObsada)) {
        if ($obsadaResult -> num_rows > 0) {
          echo "Obsada:<br><ul>";
          while ($aktor = $obsadaResult -> fetch_assoc()) {
            echo "<li><img src='zdjecia_aktorow/" . $aktor['zdjecie'] . "' alt='" . $aktor['imie'] . " " . $aktor['nazwisko'] . "' style='width:50px; vertical-align:middle; margin-right:10px;'>" ;
            echo $aktor['imie'] . " " . $aktor['nazwisko'] . " (ur. " . $aktor['data_urodzenia'] . ") jako " . $aktor['rola'] . "</li>";
          }
          echo "</ul><br>";
        } else {
          echo "Brak informacji o obsadzie.<br><br>";
        }
        $obsadaResult -> free_result();
      }

      $sqlKomentarze = "SELECT komentarze.nazwa_uzytkownika, komentarze.komentarz, komentarze.polubienia FROM komentarze
      WHERE komentarze.typ_tresci = 'film' AND komentarze.id_tresci = " . $row['id'];;
      if ($komentarzeResult = $conn -> query($sqlKomentarze)) {
        if ($komentarzeResult -> num_rows > 0) {
          echo "Komentarze:<br><ul>";
          while ($komentarz = $komentarzeResult -> fetch_assoc()) {
            echo "<li><strong>" . $komentarz['nazwa_uzytkownika'] . "</strong>: " . $komentarz['komentarz'] . " (Polubienia: " . $komentarz['polubienia'] . ")</li>";
          }
          echo "</ul><br>";
        } else {
          echo "Brak komentarzy.<br><br>";
        }
        $komentarzeResult -> free_result();
      }
    }
    echo "</ul>";
  } else {
    echo "Brak filmów w bazie danych.<br>";
  }

  $result -> free_result();
}

$sql = "SELECT id, tytul, rok_produkcji, ilosc_sezonow, opis, plakat FROM seriale";

if ($result = $conn -> query($sql)) {
  if ($result -> num_rows > 0) {
    echo "Lista seriali:<br><ul>";
    while ($row = $result -> fetch_assoc()) {
      echo "<img src='plakaty_seriali/" . $row['plakat'] . "' alt='" . $row['tytul'] . " plakat' style='width:100px;'><br>";
      echo "<li>" . $row['tytul'] . " (" . $row['rok_produkcji'] . ")</li><br>";
      echo "Ilość sezonów: " . $row['ilosc_sezonow'] . "<br><br>";
      echo "Opis: " . $row['opis'] . "<br><br>";

      $sqlKategorie = "SELECT kategorie.nazwa FROM kategorie_tresci
      JOIN kategorie ON kategorie_tresci.id_kategorii = kategorie.id
      WHERE kategorie_tresci.typ_tresci = 'serial' AND kategorie_tresci.id_tresci = " . $row['id'];
      if ($kategorieResult = $conn -> query($sqlKategorie)) {
        if ($kategorieResult -> num_rows > 0) {
          echo "Kategorie: ";
          $kategorie = [];
          while ($kategoria = $kategorieResult -> fetch_assoc()) {
            $kategorie[] = $kategoria['nazwa'];
          }
          echo implode(", ", $kategorie) . "<br><br>";
        } else {
          echo "Brak informacji o kategoriach.<br><br>";
        }
        $kategorieResult -> free_result();
      }

      $sqlRezyseria = "SELECT rezyserzy.imie, rezyserzy.nazwisko, rezyserzy.data_urodzenia FROM produkcje_rezyserow
      JOIN rezyserzy ON produkcje_rezyserow.id_rezysera = rezyserzy.id
      WHERE produkcje_rezyserow.typ_tresci = 'serial' AND produkcje_rezyserow.id_tresci = " . $row['id'];
      if ($rezyseriaResult = $conn -> query($sqlRezyseria)) {
        if ($rezyseriaResult -> num_rows > 0) {
          echo "Reżyseria: ";
          $rezyserzy = [];
          while ($rezyser = $rezyseriaResult -> fetch_assoc()) {
            $rezyserzy[] = $rezyser['imie'] . " " . $rezyser['nazwisko'] . " (ur. " . $rezyser['data_urodzenia'] . ")";
          }
          echo implode(", ", $rezyserzy) . "<br><br>";
        } else {
          echo "Brak informacji o reżyserii.<br><br>";
        }
        $rezyseriaResult -> free_result();
      }

      $sqlOcena = "SELECT AVG(ocena) AS ocena FROM oceny WHERE typ_tresci = 'serial' AND id_tresci = " . $row['id'];
      if ($ocenaResult = $conn -> query($sqlOcena)) {
        if ($ocenaRow = $ocenaResult -> fetch_assoc()) {
          $sredniaOcena = round($ocenaRow['ocena'], 2);
          if ($sredniaOcena) {
            echo "Średnia ocena: " . $sredniaOcena . "/10<br><br>";
          } else {
            echo "Brak ocen.<br><br>";
          }
        }
        $ocenaResult -> free_result();
      }

      $sqlPlatformy = "SELECT platformy.nazwa, platformy.ikona, dostepnosc_na_platformach.link FROM dostepnosc_na_platformach
      JOIN platformy ON dostepnosc_na_platformach.id_platformy = platformy.id
      WHERE dostepnosc_na_platformach.typ_tresci = 'serial' AND dostepnosc_na_platformach.id_tresci = " . $row['id'];
      if ($platformyResult = $conn -> query($sqlPlatformy)) {
        if ($platformyResult -> num_rows > 0) {
          echo "Dostępne na platformach:<br>";
          while ($platforma = $platformyResult -> fetch_assoc()) {
            echo "<a href='" . $platforma['link'] . "' target='_blank'><img src='ikony_platform/" . $platforma['ikona'] . "' alt='" . $platforma['nazwa'] . "' title='" . $platforma['nazwa'] . "' style='width:50px; margin-right:10px;'></a>";
          }
          echo "<br><br>";
        } else {
          echo "Brak informacji o dostępności na platformach.<br><br>";
        }
        $platformyResult -> free_result();
      }

      $sqlObsada = "SELECT aktorzy.imie, aktorzy.nazwisko, aktorzy.data_urodzenia, aktorzy.zdjecie, wystepy_aktorow.rola
      FROM wystepy_aktorow 
      JOIN aktorzy ON wystepy_aktorow.id_aktora = aktorzy.id
      WHERE wystepy_aktorow.typ_tresci = 'serial' AND wystepy_aktorow.id_tresci = " . $row['id'];
      if ($obsadaResult = $conn -> query($sqlObsada)) {
        if ($obsadaResult -> num_rows > 0) {
          echo "Obsada:<br><ul>";
          while ($aktor = $obsadaResult -> fetch_assoc()) {
            echo "<li><img src='zdjecia_aktorow/" . $aktor['zdjecie'] . "' alt='" . $aktor['imie'] . " " . $aktor['nazwisko'] . "' style='width:50px; vertical-align:middle; margin-right:10px;'>" ;
            echo $aktor['imie'] . " " . $aktor['nazwisko'] . " (ur. " . $aktor['data_urodzenia'] . ") jako " . $aktor['rola'] . "</li>";
          }
          echo "</ul><br>";
        } else {
          echo "Brak informacji o obsadzie.<br><br>";
        }
        $obsadaResult -> free_result();
      }

      $sqlKomentarze = "SELECT komentarze.nazwa_uzytkownika, komentarze.komentarz, komentarze.polubienia FROM komentarze
      WHERE komentarze.typ_tresci = 'serial' AND komentarze.id_tresci = " . $row['id'];;
      if ($komentarzeResult = $conn -> query($sqlKomentarze)) {
        if ($komentarzeResult -> num_rows > 0) {
          echo "Komentarze:<br><ul>";
          while ($komentarz = $komentarzeResult -> fetch_assoc()) {
            echo "<li><strong>" . $komentarz['nazwa_uzytkownika'] . "</strong>: " . $komentarz['komentarz'] . " (Polubienia: " . $komentarz['polubienia'] . ")</li>";
          }
          echo "</ul><br>";
        } else {
          echo "Brak komentarzy.<br><br>";
        }
        $komentarzeResult -> free_result();
      }
    }
    echo "</ul>";
  } else {
    echo "Brak seriali w bazie danych.<br>";
  }

  $result -> free_result();
}

$conn -> close();

?>