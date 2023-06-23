<?php

header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: application/json');

$student = $_POST;

$studentsStr = file_get_contents("data.json");
$students = json_decode($studentsStr);

$students[] = $student;

$studentsStr = json_encode($students);

file_put_contents("data.json", $studentsStr);
echo $studentsStr;