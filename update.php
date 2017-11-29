<?php

    require_once('dbconnect.php');
    $dbc = mysqli_connect(HOST, USER, PASS, DBNAME) or die('Error connect');
    $editinput = $_POST['editinput'];
    $imageid = $_POST['imgid'];

    $query = "UPDATE instaclone_db SET description='$editinput' WHERE id='$imageid'";
    $result = mysqli_query($dbc, $query) or die("Errer");
    echo "Gelukt!";
    header("Location:index.php");

?>