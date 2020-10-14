<?php session_start(); ?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="demo.css">
</head>
<body>
  <a id="btn_homescreen" href="../index.html"> Projets</a>
  <form method="POST">
    <label for="username">Nom d'utilisateur :</label>
    <input type="text" name="username" required/><br>

    <label for="password">Mot de passe :</label>
    <input type="password" name="password" required/><br>

    <input type="submit" name="Connexion" id="Connexion" value="Connexion">
  </form>
  <a href='inscription.php'>Inscription</a>

    <?php 
    require('config.php');

    if(isset($_POST['Connexion'])){ 
      extract($_POST);
      if(!empty($_POST['username']) && !empty($_POST['password'])){
        $q = $conn->prepare("SELECT * FROM user WHERE username=:username");
        $q->execute(['username' => $username]);
        $result = $q->fetch();
        //var_dump($result);
        $options = [
          'cost' => 12,
        ];
        $hashpass = password_hash($password, PASSWORD_BCRYPT, $options);
        if($result == true){
          $hashpass = $result['password'];
          if(password_verify($password, $hashpass)){
            $_SESSION['username'] = $username;
            //header ("actu.php"); //Marche pas pour des raisons incomprhensibles
            $URL="actu.php";
            echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
            echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
          }
          else{
            echo "Le nom d'utilisateur ou le mot de passe est incorrect.";
          }
        }
        else{
          echo "L'utilisateur " .$username. " n'existe pas.";
        }
      }
      else{
        $message = "Tout les champs ne sont pas remplis.";
        echo $message;
      }
    }

    ?>

</body>
</html>