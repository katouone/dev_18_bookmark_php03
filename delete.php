<?php

require_once('funcs.php');
$pdo = db_conn();
$id=$_GET['id'];

//データSQL作成
$stmt = $pdo->prepare("DELETE FROM php03_needs_table WHERE id= :id");

$stmt->bindValue(':id', $id, PDO::PARAM_INT);

$status = $stmt->execute();


//データ処理

if ($status == false) {
    sql_error($status);
} else {
    redirect('select.php');
}
?>