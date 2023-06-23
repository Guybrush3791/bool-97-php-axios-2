<?php

header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: application/json');

$index = $_POST['index'];

$studentsStr = file_get_contents("data.json");
$students = json_decode($studentsStr);

array_splice($students, $index, 1);

$studentsStr = json_encode($students);

file_put_contents("data.json", $studentsStr);
echo $studentsStr;