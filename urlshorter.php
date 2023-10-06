<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
$db = mysqli_connect('localhost', 'root', '', 'short') or die('error');

$link = htmlspecialchars($_POST['link']);
if(empty($_POST['submit'])){}
if(empty($_POST['link'])){}
else {
    $select = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `test` WHERE `url` =  '$link' "));
    if($select){
        $result1 = [
            'url'  => $select['url'],
            'key'  => $select['short_key'],
            'link' => 'http://'.$_SERVER['HTTP_HOST'].'/'.$select['short_key']
        ];
        print_r($result1);
    }
    else{
        $unique = uniqid('', true);
        $result = substr($unique, strlen($unique) - 4);
        mysqli_query($db,"INSERT INTO `test` (`id`, `url`, `short_key`) VALUES (NULL, '$link', '$result')");
        $select1=mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `test` WHERE `url` =  '$link' "));
        $result = [
            'url'  => $select1['url'],
            'key'  => $select1['short_key'],
            'link' => 'http://'.$_SERVER['HTTP_HOST'].'/'.$select1['short_key']
        ];
        print_r($result);
    }
}
$key = htmlspecialchars($_GET['key']);
if (empty($_GET['key'])){
}
else{
    $select1 = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `test` WHERE `short_key` =  '$key'"));
    if($select1){
        $result2=[
            'url' => $select1['url'],
            'key' => $select1['short_key']
        ];
        header('Location:'.$result2['url']);
    }
}
?>
<form action="" method="post">
    <input type="text" name="link">
    <input type="submit" name="submit">
</form>
</body>
</html>