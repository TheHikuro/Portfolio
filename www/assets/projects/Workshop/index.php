<?php session_start(); ?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link rel="stylesheet" href="assets/css/index.css">
  <link rel="stylesheet" href="assets/css/contact.css">
  <link rel="stylesheet" href="assets/css/util.css">
  <link rel="stylesheet" href="../../css/btn_home.css">
  <link rel="stylesheet" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css"> 
</head>
<body>
  <header>
    <section class="buttons">
      <div class="container">
          <a href="../../html/projects.html" class="btn btn_home"> Projects </a>
      </div>
    </section>
  </header>
  <div class="bg-contact100">
    <div class="container-contact100">
      <div class="wrap-contact100">
        <div class="contact100-pic js-tilt" data-tilt>
          <img src="assets/images/logoOgsbc.png" alt="">
        </div>
        <form method="POST" class="contact100-form validate-form" id="contactForm" name="contactForm">
        <span class="contact100-form-title">
          Connectez vous !
        </span>

        <div class="wrap-input100 validate-input" id="contact__input" data-validate = "Votre email est obligatoire: ex@abc.xyz">
          <input class="input100" type="text" name="mail" id="contactName" placeholder="Adresse e-mail" required>
          <span class="focus-input100"></span>
          <span class="symbol-input100">
            <i class="fa fa-user" aria-hidden="true"></i>
          </span>
        </div>

        <div class="wrap-input100 validate-input" id="contact__input2" data-validate = "Votre mot de passe est obligatoire">
          <input class="input100" type="password" name="password" id="contactName" placeholder="Mot de passe" required>
          <span class="focus-input100"></span>
          <span class="symbol-input100">
          <i class="fa fa-unlock-alt" aria-hidden="true"></i>
          </span>
        </div>

        <div class="cont_btn">
          <div class="container-contact100-form-btn" id="contact__input4">
            <button type="submit" class="contact100-form-btn" name="Connexion" id="Connexion" value="Connexion">
              Connexion<p style="visibility: hidden;">L</p> <i class="fa fa-paper-plane" aria-hidden="true"></i>
            </button>
          </div>
          
          <div class="container-contact100-form-btn" id="contact__input5">
            <button onclick="window.location.href='assets/php/inscription.php'" class="contact100-form-btn" name="Connexion" id="Connexion" value="Connexion">
             Inscription<p style="visibility: hidden;">L</p> <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            </button>
          </div>
        </div>
        
        </form>
      </div> 
    </div>
  </div>
    <?php 
    require('assets/php/config.php');

    if(isset($_POST['Connexion'])){ 
      extract($_POST);
      if(!empty($_POST['mail']) && !empty($_POST['password'])){
        $q = $conn->prepare("SELECT * FROM users WHERE mail=:mail");
        $q->execute(['mail' => $mail]);
        $result = $q->fetch();
        /* var_dump($result); */
        $options = [
          'cost' => 12,
        ];
        $password = $_POST['password'];
        $hashpass = password_hash($password, PASSWORD_BCRYPT, $options);

        if($result['profil'] == "admin"){
          $hashpass = $result['password'];
          if(password_verify($password, $hashpass)){
            $_SESSION['mail'] = $mail;
            $URL="assets/php/gestionAdmin.php";
            echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
            echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
          }
        }
        if($result['profil'] == "prof"){
          $hashpass = $result['password'];
          if(password_verify($password, $hashpass)){
            $_SESSION['mail'] = $mail;
            $URL="assets/php/prof.php";
            echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
            echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
          }
        }
        if($result['profil'] == "Eleve"){
          $hashpass = $result['password'];
          if(password_verify($password, $hashpass)){
            $_SESSION['mail'] = $mail;
            $URL="assets/php/qcm.php";
            echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
            echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
          }
          else{
            echo "Le nom d'utilisateur ou le mot de passe est incorrect.";
          }
        }
        else{
          echo "L'utilisateur " .$mail. " n'existe pas.";
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