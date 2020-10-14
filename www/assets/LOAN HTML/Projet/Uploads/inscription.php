<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Sign in</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <form method="POST">
    <label for="i_username">Nom d'utilisateur :</label>
    <input type="text" name="i_username" required/><br>

    <label for="i_password">Mot de passe :</label>
    <input type="password" name="i_password" required/><br>

    <input type="submit" name="Inscription" id="Inscription" value="Inscription">
  </form>

    <?php 
    session_start();

    if(isset($_POST['Inscription'])){ 
      extract($_POST);
      if(!empty($_POST['i_username']) && !empty($_POST['i_password'])){
        $options = [
            'cost' => 12,
          ];
          $hashpass = password_hash($i_password, PASSWORD_BCRYPT, $options); 
        require('config.php');
        global $conn;

        $q = $conn->prepare("INSERT INTO user(username, password) VALUES(:username,:password)");
        $q -> execute([
            'username' => $i_username,
            'password' => $hashpass
        ]);
        echo "vous vous êtes bien inscrits";
      }
      else{
        $message = "Tout les champs ne sont pas remplis.";
        echo $message;
      }
    }

    ?>
    <a href="index.php">BACK</a>
</body>
</html>