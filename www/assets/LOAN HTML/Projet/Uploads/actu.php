
<?php 

session_start();

$xml = simplexml_load_file("links.xml");

if(isset($_POST['btn_ok'])) {
    echo "changement";
    setcookie("cookie", $_POST['list_deroul']);
    $URL="actu.php";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}

$number = $_COOKIE['cookie'];
    
?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Actualités GOOGLE</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
    <ul id="nav">
        <?php 
            echo "Bienvenue : ";
            echo "<h1>" . $_SESSION['username'] . "</h1>";
        ?>

        <a href="deconnexion.php">Deconnexion</a>

    </ul>

    <section id="news">

        <?php foreach($xml->children() as $link) { if ($number <= 0) break; ?>
            
            <?php if ($number % 2 != 0) echo "<div class='news-container'>" ?>
            
            <div class="news-item">
                <iframe src="<?= $link; ?>" ></iframe>
            </div>
        
            <?php if ($number % 2 == 0) echo "</div>"; $number -= 1; ?>

        <?php } ?>

    </section>
    <form method="POST">
        <p>Combien d’actualités voulez-vous voir affichées ?</p>
        <SELECT name="list_deroul" id="list_deroul" size="1">
            <OPTION value="5">5</OPTION>
            <OPTION value="6">6</OPTION>
            <OPTION value="7">7</OPTION>
            <OPTION value="8">8</OPTION>
            <OPTION value="9">9</OPTION>
        </SELECT>
        <input type="submit" name="btn_ok" id="btn_ok" value="OK">
    </FORM>

</body>
</html>