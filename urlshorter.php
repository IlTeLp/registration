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
            'link' => 'http://'.$select['short_key']
        ];
        print_r($result1);
    }
    else{
        $unique = uniqid('', true);
        $result = substr($unique, strlen($unique) - 4);
        mysqli_query($db,"INSERT INTO `test` (`id`, `url`, `short_key`) VALUES (NULL, '$link', '$result.$intval')");
        $select1=mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `test` WHERE `url` =  '$link' "));
        $result = [
            'url'  => $select1['url'],
            'key'  => $select1['short_key'],
            'link' => 'http://'.$select1['short_key']
        ];
        print_r($result);
    }
}
?>
<form action="" method="post">
    <input type="text" name="link">
    <input type="submit" name="submit">
</form>
</body>
</html>