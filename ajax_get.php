<?php
//db接続
include("functions.php");
$pdo = connect_to_db();

//
$search_word = $_GET["searchword"];

// echo '<pre>';
// var_dump($_GET);
// echo '<pre>';
// exit();

$sql = "SELECT * FROM todoLists WHERE todo LIKE :search_word";
// $sql = "SELECT * FROM todoLists  WHERE todo LIKE '%なす%'";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':search_word', "%{$search_word}%", PDO::PARAM_STR);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(['sql error' => "{$e->getMessage()}"]);
    exit();
}

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);


echo json_encode($result);

// echo '<pre>';
// var_dump($result);
// echo '<pre>';
// exit();
