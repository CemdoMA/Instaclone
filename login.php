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

    <fieldset class="artic2">
        <form method="post">
        <h1 style="font-size: 30px;">Login:</h1>
        <input type="text" placeholder="Username..." name="username" autocomplete="false">
        <input type="password" placeholder="Password..." name="password" autocomplete="false">
            <input type="checkbox" name="checkboxx" autocomplete="false">
        <input type="submit" name="submit" value="Login...">
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
        if(isset($_POST['submit'])) {

            require_once ('dbconnect.php');
            $dbc = mysqli_connect(HOST,USER,PASS,DBNAME) or die('Error connect');
            $username = $_POST['username'];
            $password = $_POST['password'];
            $check = $_POST['checkboxx'];

            $query = "SELECT * FROM instaclone_db_users WHERE username= '$username'";
            $result = mysqli_query($dbc, $query) or die('Error writing 1st query');

            if (mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_array($result);
                    if ($row[1] == $password && $row[0] == $username) {
                        if ($row['status'] > 0) {

                            header("Location: index.php");
                        echo "<script>alert('Inloggen gelukt!')</script>";
                        session_start();
                        $_SESSION['username'] = $username;
                        $_SESSION['password'] = $password;
                        if ($check == 1)

                    } else {
                            echo "<script>alert('Bekijk uw E-mail voor de registratie-bevestingsmail!')</script>";
                        }
                    }
                else{
                    echo 'Fill In The Right Password';
                }
            } else {echo 'Username does not exist.';}


        }

        ?>
