<?php
$class = $_GET['class'];

$db = new SQLite3(realpath('../db/absenzverwaltung.db'));
$select = "SELECT LeDatum FROM TLektionen WHERE LehrKlasse = '".$class."';";
$result = $db->query($select);

$dateArray = [];
while($row = $result->fetchArray(SQLITE3_NUM)){
    array_push($dateArray, $row[0]);
}

echo json_encode($dateArray);

$db->close();