<!doctype HTML>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Instgraphic</title>
        <link href="style.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
              rel="stylesheet">

</head>
<body>
<div class="wrapper">
<nav>
    <ul>
        <li><a href="index.php"><i class="material-icons">&#xE88A; </i></a></li>
        <li><a href="search.php"><i class="material-icons">search</i></a></li>
        <li><a href="upload.php"><i class="material-icons">&#xE439;</i></a></li>
        <li><a href="login.php"><i class="material-icons">&#xE7FD;</i></a></li>
        <li><a href="register.php"><i class="material-icons">&#xE7FE;</i></a></li>
    </ul>
</nav>
</div>
<fieldset class="artic2">
    <form method="post" action="register.php">
<h1 style="font-size: 30px;"> Registreren</h1>
    <input type="text" placeholder="Username..." name="username" required="required" autocomplete="false">
    <input type="email" placeholder="Email..." name="email" required="required" autocomplete="false">
    <input type="password" placeholder="Password..." name="password" required="required" autocomplete="false">
    <input type="submit" name="submit" value="Registreer...">
    </form>
</fieldset>

</body>
<style>
    .material-icons{
        font-size: 45px;
    }
    @media screen and (max-width: 860px){
    .material-icons{
        font-size: 25px;
    }}
</style>
</html>

<?php

if(isset($_POST['submit'])) {
    require_once('dbconnect.php');
    $dbc = mysqli_connect(HOST, USER, PASS, DBNAME) or die('Error connect');

    $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
    $password = mysqli_real_escape_string($dbc, trim($_POST['password']));
    $email = mysqli_real_escape_string($dbc, trim($_POST['email']));

//    $md5Pass = md5($password);
    function randomStringCode() {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < 25; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return  $randomString;
    }
    $randomCode = randomStringCode();

//    $conferm = md5($email);
//    $hashPass = hash(algo:'sha512',data:$password);
    $subject = 'E-mail verifcatie';
    $message = "Hier is de verificatie link om je account te activiren:\n\n" .$baseSite . "/?confirm=" . $randomCode;

    $query = "INSERT INTO instaclone_db_users VALUES('$username','$password','$email',0,'$randomCode',0)";
    mail($email,$subject, $message) or die("Could not send mail!");
    $result = mysqli_query($dbc, $query) or die('Error querying database');
    echo "<script>alert('Gelukt! Er is een activatie mail naar uw e-mail gestuurd.')</script>";
    header("Location:login.php");

}
?>