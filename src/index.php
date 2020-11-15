<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css/stylesheet.css">

    <title>Absenzverwaltung</title>
  </head>
  <body>
    <div class="container-fluid">
      <header>
        <div id="title">Absenzverwaltung</div>
      </header>
      <div style="display: flex;">
        <div id="classSelectContainer">
          <label for="classSelect">Klasse</label>
          <select autocomplete="off" class="custom-select" id="classSelect">
            <option disabled hidden selected>Klasse</option>
            <?php
            $db = new SQLite3(realpath('../db/absenzverwaltung.db'));
            $result = $db->query("SELECT LehrKlasse FROM TLehrer;");
            while($teacher = $result->fetchArray(SQLITE3_ASSOC)){
              $class = $teacher['LehrKlasse'];
              echo "<option value='$class'>$class</option>";
            }
            ?>
          </select>
        </div>
        <div id="dateSelectContainer">
          <label for="dateSelect">Datum</label>
          <select autocomplete="off" class="custom-select" id="dateSelect" disabled>
              <option disabled hidden selected>Datum</option>
          </select>
        </div>
      </div>
      <table class="table" id="studentTable">
        <thead>
          <tr>
            <th scope="col">Nr.</th>
            <th scope="col">Schüler</th>
            <th scope="col">Anwesend</th>
            <th scope="col">Abgemeldet</th>
            <th scope="col">Fehlt</th>
          </tr>
        </thead>
        <tbody id="studentTableBody">
        </tbody>
      </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
  </body>
  <footer>© Benedek Kámán</footer>
</html>