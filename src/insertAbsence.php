<?php
extract($_POST);

$db = new SQLite3(realpath('../db/absenzverwaltung.db'));
$lessonId = $db->query("SELECT LeId FROM TLektionen WHERE LeDatum = '".$date."' AND LehrKlasse = '".$class."';")->fetchArray(SQLITE3_NUM)[0];
$absenceResult = $db->query("SELECT AbsId FROM TAbsenzen WHERE SchuelId = ".$studentId." AND LeId = ".$lessonId.";");

if($row = $absenceResult->fetchArray(SQLITE3_ASSOC)){
    $db->exec("UPDATE TAbsenzen SET AbsTyp = '".$absenceType."' WHERE AbsId = ".$row['AbsId'].";");
}else{
    $db->exec("INSERT INTO TAbsenzen VALUES(NULL, '".$absenceType."', ".$studentId.", ".$lessonId.");");
}

$db->close();