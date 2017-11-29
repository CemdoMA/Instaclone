<?php session_start(); ?>
<!doctype HTML>
<html>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <head><title>Instgraphic</title>
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
            
            <div class="container">
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

    <select name="sortmenu" onchange="this.form.submit()">
        <option value="" selected disabled>Select...</option>
        <option value="date_asc">Datum Oplopend{1 - 31)</option>
        <option value="date_desc">Datum Aflopend{31 - 1}</option>
        <option value="descr_asc">Beschrijving Oplopend{A - Z}</option>
        <option value="descr_desc">Beschrijving Aflopend{Z - A}</option>
        <option value="Random">Random</option>

    </select>
</form>
                <?php
                $column = 'date';
                $order = 'DESC';
                if (isset($_POST['sortmenu'])){
                    switch ($_POST['sortmenu']){
                        case 'date_asc':
                            $column = 'date';
                            $order = 'ASC';
                            break;

                        case 'date_desc':
                            $column = 'date';
                            $order = 'DESC';
                            break;

                        case 'descr_asc':
                            $column = 'description';
                            $order = 'ASC';
                            break;

                        case 'descr_desc':
                            $column = 'description';
                            $order = 'DESC';
                            break;

                        case 'Random':
                            $column = 'rand()';
                            $order = '';
                            break;
                    }
                }
                ?>


                <?php
                require_once ('dbconnect.php');
                $dbc = mysqli_connect(HOST,USER,PASS,DBNAME) or die('Error connect');

                $query = "SELECT * FROM instaclone_db ORDER BY " . $column ." " . $order;
                $result = mysqli_query($dbc,$query);
                if ($_POST['submit']== "logout") {session_write_close(); if (session_destroy()) {header("Location: index.php");}}
                if(isset($_SESSION['username'])){
                    echo '<form action="logout.php" method="post"> <input type="submit" name="submit" value="logout" /> </form>';
                    echo "Welcome: " . $_SESSION['username'];
                }
                while ($row = mysqli_fetch_array($result)) {

                    $target = $row['target'];
                    $date = $row['date'];
                    $username = $row['username'];
                    $description = $row['description'];
//                    $description1 = $_POST['editSpan'];
                    $imageid1 = $row['id'];
                    echo '<img scr"' . $target . '" /><br>';
                    echo "<article class=\"artic\">
                    <header>
                        <a href=\"user\" > <img src=\"\" class=\"userLogo\"/> </a>
                        <a href=\"user\" class=\"userName\"> $username </a>
                        <span class=\"date\"> $date </span>
                    </header>
                    <img src=\"$target\" class=\"uploadimg\"/>
                    <div class=\"beschrijving\">
                        <a href=\"user\" class=\"userName\">$username  </a>
                        <span id=\"span\" style='display: inline-block'>  $description</span>
                        <form method='post' action='update.php' class='ajax'>
                            <input type=\"hidden\" value=\"$imageid1\" name='imageid'>
                            <input type=\"button\" name='editButton' class='editButton' id=\"$imageid1\" value=\"Bewerken\" style='display: inline-block'>
                            <input type=\"text\" class=\"editSpan\" value='$description' name=\"editSpan\" style='display: none'>
                            <input type=\"submit\" name=\"submitPHP\" value=\"Opslaan\" class=\"submitPHP\" style='display: none'>
                           </form>
                    </div>
                </article><br>";
                }


                mysqli_close($dbc);
                ?>




            </div>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="script.js"></script>
</html>

<?php
require_once('dbconnect.php');
if(isset($_GET['confirm']) || !empty($_GET['confirm']))
{
    $c_code = $_GET['confirm'];

    $dbc = mysqli_connect(HOST, USER, PASS, DBNAME) or die ('ERROR!');
    $query = "SELECT status FROM instaclone_db_users WHERE confirm='$c_code'";
    $result = mysqli_query($dbc,$query);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if(mysqli_num_rows($result) == 1)
    {
        $query = "UPDATE instaclone_db_users SET status=1 WHERE confirm='$c_code'";
        $result = mysqli_query($dbc,$query);
        header('Location: login.php');
        echo "<script>alert('Account geactiveerd!')</script>";
    } else {
        echo "<script>alert('Deze link is incorrect!')</script>";
    }
}