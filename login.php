<?php
$baza=mysqli_connect('localhost','root','','second');
if(!$baza){
    echo "CONNECTION LOST";
}
$name=$_POST['user'];
$password=md5($_POST['pass']);
if(mysqli_num_rows($chek)>0){
    echo "Вы успешно вошли!";
}
else{
    echo "Ошибка входа!";
}