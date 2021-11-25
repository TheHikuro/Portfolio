<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Sign in</title>
  <link rel="stylesheet" href="../css/index.css">
  <link rel="stylesheet" href="../css/contact.css">
  <link rel="stylesheet" href="../css/util.css">
  <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css"> 
</head>
<body>
  <header>
  <button class="contact100-form-btn" id="Back"><a href="../../index.php">Home</a></button>
  </header>
  <div class="bg-contact100">
      <div class="container-contact100">
        <div class="wrap-contact100">
          <div class="contact100-pic js-tilt" data-tilt>
            <img src="assets/images/logoOgsbc.png" alt="">
          </div>
          <form method="POST" class="contact100-form validate-form" id="contactForm" name="contactForm">
            <span class="contact100-form-title">
              Inscrivez vous !
            </span>

            <div class="wrap-input100 validate-input" id="contact__input" data-validate = "Votre email est obligatoire: ex@abc.xyz">
              <input class="input100" type="text" name="i_nom" id="contactName" placeholder="Nom" required>
              <span class="focus-input100"></span>
              <span class="symbol-input100">
              <i class="fa fa-user-circle" aria-hidden="true"></i>
              </span>
            </div>


            <div class="wrap-input100 validate-input" id="contact__input" data-validate = "Votre prenom est obligatoire">
              <input class="input100" type="text" name="i_prenom" id="contactName" placeholder="Prenom" required>
              <span class="focus-input100"></span>
              <span class="symbol-input100">
                <i class="fa fa-user" aria-hidden="true"></i>
              </span>
            </div>

            <div class="wrap-input100 validate-input" id="contact__input" data-validate = "Votre email est obligatoire: ex@abc.xyz">
              <input class="input100" type="text" name="i_mail" id="contactName" placeholder="Adresse E-mail" required>
              <span class="focus-input100"></span>
              <span class="symbol-input100">
              <i class="fa fa-envelope" aria-hidden="true"></i>
              </span>
            </div>
            

            <div class="wrap-input100 validate-input" id="contact__input2" data-validate = "Votre mot de passe est obligatoire">
              <input class="input100" type="password" name="i_password" id="contactName" placeholder="Mot de passe" required>
              <span class="focus-input100"></span>
              <span class="symbol-input100">
              <i class="fa fa-unlock-alt" aria-hidden="true"></i>
              </span>
            </div>

            <div class="cont_btn">
              <div class="container-contact100-form-btn" id="contact__input4">
                <button type="submit" class="contact100-form-btn" name="Inscription" id="Inscription" value="Inscription">
                  S'inscrire<p style="visibility: hidden;">L</p> <i class="fa fa-paper-plane" aria-hidden="true"></i>
                </button>
              </div>
            </div>
          
          </form>
        </div> 
      </div>
    </div>

    <?php 
    session_start();

    if(isset($_POST['Inscription'])){ 
      extract($_POST);
      if(!empty($_POST['i_mail']) && !empty($_POST['i_password'])){
        $options = [
            'cost' => 12,
          ];
          $hashpass = password_hash($i_password, PASSWORD_BCRYPT, $options); 
        require('config.php');
        global $conn;

        $q = $conn->prepare("INSERT INTO users(nom,prenom,mail, password,profil) VALUES(:nom,:prenom,:mail,:password,'Eleve')");
        $q -> execute([
            'nom' => $i_nom,
            'prenom' => $i_prenom,
            'mail' => $i_mail,
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
</body>
</html>