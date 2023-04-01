<?php

  define("CHAT", "chat.txt");

  date_default_timezone_set('Asia/Tokyo');

  if($_SERVER["REQUEST_METHOD"] === "POST"){
    $text = $_POST['message'] . "," . date('m月d日 H時i分s秒') . "\n";
    file_put_contents(CHAT, $text, FILE_APPEND);
  }
?>











<!DOCTYPE html>
<html lang="jp">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>掲示板</title>
  <style type="text/css">
    *{
      margin: 0;
      padding: 0;
      list-style: none;
    }

    h1 {
      text-align: center;
    }

    .wrap {
      width: 600px;
      margin: 0 auto;
      padding: 20px 0 100px 0;
      background: #f1f1f2;
      min-height: 100vh;
    }

    li {
      position: relative;
      padding: 10px 20px;
      margin: 0 10px 10px 10px;
      background-color: #fff;
      border-radius:5px;
    }

    span {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      right: 10px;
      font-size: 12px;
      color: #ccc;
    }

    form {
      position: absolute;
      top: 1.5%;
      right: 5%;
    }
  </style>
</head>
<body>
  <div container>
    <h1>掲示板</h1>
    <form action="index.php" method="post">
      <input type="text" name="message">
      <button type="submit">送信</button>
    </form>
  </div>
  <div class="wrap">
    <ul>
      <!-- <li><span></span></li> -->
      <li>あまい<span>02月25日 15時33分</span></li>
    </ul>
  </div>
  
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script>
    $(function(){
      $.ajax({
        url: 'chat.txt',
      })
      .done(function(data) {
        data.split('\n').forEach(function(chat){
          const post_text = chat.split(',')[0];
          const post_time = chat.split(',')[1];
          if(post_text){
            const li = `<li>${post_text}<span>${post_time}</span></li>`;
            $('ul').append(li);
          }
        });
      });
    });
  </script>
</body>
</html>