<?php
$link = htmlspecialchars($_POST['link']);
if(empty($_POST['submit'])){}
if(empty($_POST['link'])){}
else {
    $db = mysqli_connect('localhost', 'root', '', 'short') or die('error');

    $select = mysqli_fetch_assoc(mysqli_query("SELECT * FROM `test` WHERE `url` =  '$link' ", ''));
    if($select){
        $result1 = [
            'url'  => $select['url'],
            'key'  => $select['short_key'],
            'link' => 'http://'.$_SERVER['HTTP_HOST'].'/-'.$select['short_key'].$select['short_key']
        ];
        print_r($result1);
    }
    else{
        $letters='qwertyuiopasdfghjklzxcvbnm1234567890';
        $count=strlen($letters);
        $intval=time();
        $result='';
        for($i=0;$i<4;$i++) {
            $last=$intval%$count;
            $intval=($intval-$last)/$count;
            $result=$letters[$last];
        }
        mysqli_query("INSERT INTO `test` (`id`, `url`, `short_key`) VALUES (NULL, '$link', '$result')");
        $select1=mysqli_fetch_assoc(mysqli_query("SELECT * FROM `test` WHERE `url` =  '$link' "));
        $result1 = [
            'url'  => $select['url'],
            'key'  => $select['short_key'],
            'link' => 'http://'.$_SERVER['HTTP_HOST'].'/-'.$select['short_key'].$select['short_key']
        ];
        print_r($result1);
    }
}
?>
<form action="" method="post">
    <input type="text" name="link">
    <input type="submit" name="submit">
</form>
