<?php

require_once('funcs.php');

//POSTデータ(検索値)取得
$name = $_POST['name'];
$country = $_POST['country'];
// $scene = $_POST['scene'];
// $type = $_POST['type'];
// $content = $_POST['content'];
// $url = $_POST['url'];


//DB接続

$pdo = db_conn();

//データ取得SQL作成
$stmt = $pdo->prepare("SELECT* FROM php03_needs_table WHERE name = :name OR country = :country");

// バインド変数を用意
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':country', $country, PDO::PARAM_STR);

//実行
$status = $stmt->execute();

//データ表示
// $view="";
$view2=[];
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    // $view .= '<p>'.h($result['bookname']).'/'.h($result['bookurl']).'/'.h($result['comment']).'</p>';
    $view2[] = $result;
    // var_dump($result);
    // echo '<br>';
    // echo $view2;
  }
// var_dump($view2);
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>検索表示</title>
<!-- <link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet"> -->
<style>
div { 
  padding: 10px;
  font-size: 16px;
}

table{
  text-align: center;
  border-collapse:  collapse;
  margin: auto;
}

th,td{
  border: solid 1px black;
  padding: 10px;
}

table th {
  color: #FF9800;
  background: #fff5e5;
}

.table_content{
  max-width: 500px;
}

</style>

</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <h2 class="title">検索結果</h2>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->

<table>
  <!-- 表の１行目（列のタイトル） -->
  <tr>
    <th>ID</th>
    <th>投稿者</th>
    <th>国・地域名</th>
    <th>場面</th>
    <th>情報のタイプ</th>
    <th>内容</th>
    <th>参考URL</th>
    <th>投稿日時</th>
    <th>更新</th>
    <th>削除</th>
  </tr>

  <!-- 表の2行目以降 -->
  <?php 
      for( $j =0; $j< count($view2); $j++){
  ?>
    <tr>
      <td><?php echo h($view2[$j]['id']); ?></td>
      <td><?php echo h($view2[$j]['name']); ?></td>
      <td><?php echo h($view2[$j]['country']); ?></td>
      <td><?php echo h($view2[$j]['scene']); ?></td>
      <td><?php echo h($view2[$j]['type']); ?></td>
      <td class="table_content"><?php echo h($view2[$j]['content']); ?></td>
      <td>
        <?php 
          if(h($view2[$j]['url']=='')){
            echo '';
          }else{
            echo '<a href='.h($view2[$j]['url']).' target="_blank">Link</a>'; 
          }
        ?>
      </td>
      <td><?php echo h($view2[$j]['indate']); ?></td>
      <td><?php echo '<a href=update_view.php?id='.h($view2[$j]['id']).'>更新</a>'; ?></td>
      <td><?php echo '<a href=delete.php?id='.h($view2[$j]['id']).'>削除</a>'; ?></td>
    </tr>
  <?php
  }
  ?>
</table>

<div><a href="select.php">データ一覧へ</a></div>
<div><a href="index.php">データ登録へ</a></div>

<!-- Main[End] -->
</body>
</html>
