<?php
$baza=mysqli_connect('localhost','root','','second');
if(!$baza){
    echo "CONNECTION LOST";
}
$name=$_POST['username'];
$email=$_POST['email'];
$password=md5($_POST['password']);
if(trim($name=='')){
    echo "Введите имя!";
}
else if(trim($email=='')){
    echo "Введите почту!";
}
else if(trim($password=='')){
    echo "Введите пароль!";
}
else{

    mysqli_query($baza,"INSERT INTO `users` (`id`, `login`, `mail`, `password_hash`) VALUES (NULL, '$name','$email', '$password')");
    header('Location: urlshorter.php');
}
