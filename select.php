<?php

require_once('funcs.php');

//1.  DB接続します
$pdo = db_conn();

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT* FROM php03_needs_table");
$status = $stmt->execute();

//３．データ表示
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

// 配列をJSONデータにして、JSに渡す
$json_array = json_encode($view2);

?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>一覧表示</title>
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

    #myMap {
      height: 100%;
    }
    #maparea {
      height: 100%;
    }
    .result_area {
      height: 100px;
    }

  </style>

  <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  <script defer
  src="https://maps.googleapis.com/maps/api/js?key=Your_API_key&callback=initMap&libraries=&v=weekly">
  </script>


</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <h2 class="title">データ一覧</h2>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->


<div class="result_area">
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


  <form method="post" action="search.php">
    <div class="jumbotron">
      <fieldset>
        <legend>検索</legend>
          <label>記入者名：<input type="text" name="name"></label><br>
          <label>国・地域名：<input type="text" name="country"></label><br>
          <input type="submit" value="検索">
      </fieldset>
    </div>
  </form>


  <div><a href="index.php">データ登録へ</a></div>

  <div><a href="user_select.php">ユーザー一覧へ</a></div>
</div>

<div id="maparea">
    <div id="myMap"></div>
</div>

<!-- Main[End] -->

<script>
  // phpから配列を受け取る
  let js_ary = <?php echo $json_array?>


    console.log(js_ary);
    console.log(js_ary.length);
    console.log(js_ary[0][6]);

    // 最初の地図の中心を東京にするため、ロケーションを設定
    const Tokyo = { lat: 35.68, lng: 139.77 };

    // 地図を作成
    function initMap() {
        map = new google.maps.Map(document.getElementById("myMap"), {
            center: Tokyo,
            zoom: 2,
        });

        for(let i=0 ; i<js_ary.length;i++ ){

            let place = { lat: Number(js_ary[i]['lat'] ), lng: Number(js_ary[i]['lng'])};

            console.log(place);

            let marker = new google.maps.Marker({
                position: place,
                map,
                label: String(js_ary[i]['id']),
            });
        }
    }

</script>


</body>
</html>
