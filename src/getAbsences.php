<?php
$class = $_GET['class'];
$date = $_GET['date'];

$db = new SQLite3(realpath('../db/absenzverwaltung.db'));
$students = $db->query("SELECT SchuelId, SchuelVorname, SchuelNachname FROM TSchueler WHERE LehrKlasse = '".$class."';");
$lessonId = $db->query("SELECT LeId FROM TLektionen WHERE LeDatum = '".$date."' AND LehrKlasse = '".$class."';")->fetchArray(SQLITE3_NUM)[0];

$dateArray = [];
while($student = $students->fetchArray(SQLITE3_ASSOC)){
    $absence = $db->query("SELECT AbsId, AbsTyp FROM TAbsenzen WHERE SchuelId = '".$student['SchuelId']."' AND LeId = '".$lessonId."';")->fetchArray(SQLITE3_ASSOC);
    array_push($dateArray, [
        "studentId" => $student['SchuelId'],
        "studentFirstname" => $student['SchuelVorname'],
        "studentLastname" => $student['SchuelNachname'],
        "absenceType" => $absence['AbsTyp'] ?? ""
        ]);
}
echo json_encode($dateArray);

$db->close();