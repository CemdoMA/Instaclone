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
        <form method="post" action="search.php">
        <h1>Zoeken</h1>
        <input type="search" name="search" required="required" autocomplete="off" placeholder="Zoeken...">
        <input type="submit" name="submit" value="Zoek">
        </form>
    </fieldset>
    <div class="container">
    <?php
    if (isset($_POST['submit'])) {
        require_once('dbconnect.php');
        $dbc = mysqli_connect(HOST, USER, PASS, DBNAME) or die('Error connect');
        $search = $_POST['search'];
        $query = "SELECT * FROM instaclone_db WHERE description LIKE '%" . $search . "%' OR username LIKE '%" . $search . "%' OR date LIKE '%" . $search . "%' ORDER BY id DESC";
        $result = mysqli_query($dbc, $query) or die('Error writing 1st query');

        if (mysqli_num_rows($result) >= 1) {
            if (mysqli_num_rows($result) == 1) {
                echo 'Er is <strong>' . mysqli_num_rows($result) . '</strong> upload gevonden van de zoekopdracht: "' . $search . '"';
            }else{
                echo 'Er zijn <strong>' . mysqli_num_rows($result) . '</strong> uploads gevonden van de zoekopdracht: "' . $search . '"';
            }
            while ($row = mysqli_fetch_array($result)) {
                $target = $row['target'];
                $date = $row['date'];
                $username = $row['username'];
                $description = $row['description'];
                echo '<img scr"' . $target . '" /><br>';
                echo "<article class=\"artic\">
                    <header>
                        <a href=\"user\" > <img src=\"\" class=\"userLogo\"/> </a>
                        <a href=\"user\" class=\"userName\"> $username </a>
                    </header>
                    <img src=\"$target\" class=\"uploadimg\"/>
                    <div class=\"beschrijving\">
                        <a href=\"user\" class=\"userName\">$username  </a>
                        <span class=\"description\">  $description</span>
                    </div>
                </article><br>";
            }
        }else{
            echo 'Nothing found!';
        }
    }
    ?>
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