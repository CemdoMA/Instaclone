<?php session_start();
        if (!isset($_SESSION['username'])){
            echo '<script language="javascript">';
            echo 'alert("message successfully sent")';
            echo '</script>';
            header("Location:login.php");
        }
?>
<!doctype HTML>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Instgraphic</title>
    <link href="style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet"></head>
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

<fieldset class="artic2">
    <h1 style="font-size: 30px;">Foto Uploaden</h1>
    <form enctype="multipart/form-data" method="post" action="upload.php">
        <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
        <input type="file" name="image" /><br>
        <h3 style="font-size: 20px;">Max. 1 Mb.</h3>
        <br/>
        <label for="description" style="font-size: 20px;">Omschrijving foto (Max. 140 tekens)</label>
            <textarea name="description" id="description"></textarea>
        <input type="submit" id="submit" name="submit"/>
    </form>
</fieldset>

</div>
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

if(isset($_POST['submit'])){
    $username = $_SESSION['username'];
    require_once ('dbconnect.php');
    $dbc = mysqli_connect(HOST,USER,PASS,DBNAME) or die('Error connect');
    $description = mysqli_real_escape_string($dbc,trim($_POST['description']));
    $target = 'image/' . time() . $_FILES['image']['name'];
    $temp = $_FILES['image']['tmp_name'];
    if (!empty($description)) {
        if (move_uploaded_file($temp, $target)) {
            echo '<br/><fieldset class="fielt">Gelukt!</fieldset>';
            $query = "INSERT INTO instaclone_db VALUE (0,DATE_FORMAT(NOW(),'%d %b %Y'),'$description','$target','$username')";
            $result = mysqli_query($dbc,$query) or die('Error querying!');
        } else {
            echo '<br> Jammer! Niet gelukt!';
        }
    }

}

?>