<?php 

header("Content-type: application/json");

$l = $_GET["location"];
$t = $_GET["type"];
$conn = new PDO("mysql:host=localhost;dbname=lambertj;",
				"lambertj", "gopooves");

$test = $conn->query("SELECT * FROM accommodation WHERE location LIKE '%$l%' AND type LIKE '%$t%'");
$row = $test->fetchAll(PDO::FETCH_ASSOC);

if($l == "" AND $t == "")
{
    header("HTTP/1.1 400 BAD REQUEST");
}
elseif($row == false)
{
    header("HTTP/1.1 404 NOT FOUND");
}
elseif(isset($_GET["type"])&&isset($_GET["location"]))
{
    $result = $conn->query("SELECT * FROM accommodation WHERE type LIKE '%$t%' AND location LIKE '%$l%'");
    $rows = $result->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($rows);
    header("HTTP/1.1 200 OK");
}			
elseif(isset($_GET["location"]))
{
    $result = $conn->query("SELECT * FROM accommodation WHERE location LIKE '%$l%'");
    $rows = $result->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($rows);
    header("HTTP/1.1 200 OK");
} 
elseif(isset($_GET["type"]))
{
    $result = $conn->query("SELECT * FROM accommodation WHERE type LIKE '%$t%'");
    $rows = $result->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($rows);
    header("HTTP/1.1 200 OK");
}
 
?> 