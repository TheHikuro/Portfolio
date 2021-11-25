<?php session_start();
 if(empty($_SESSION['mail'])){
	header("Location: ".$_server['server_name']."/assets/projects/Workshop/index.php");
}
?> 

<!DOCTYPE html>
<html xml:lang="en" lang="en">
    <head>
        <title>Administration</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
	    <link rel="stylesheet" href="../css/gestionAdmin.css">
    </head>
    <body>
        <header>
            <button id="btnDecoAdmin"><a href="logout.php">Deconnexion</a></button>
        </header>
        <?php 
            require('config.php');
            
            $results = $conn->query("SELECT nom,prenom FROM users");
            /* foreach($results as $result){
                var_dump($result);
            } */
            
        ?>
        <div class="cont_giveRole">
            <div class="listes">
                <form method="POST">
                    <div class="cont">
                        <div class="liste">
                            <div class="cont_title">Liste des utilisateurs : </div>
                            <div class="cont_dd_list">
                                <select class="dd_list"name="userSelected">
                                    <option selected="selected">Selectionner un utilisateur</option>
                                    <?php
                                        foreach($results as $result) { ?>
                                        <option value="<?= $result['nom'] ?> <?= $result['prenom'] ?> ">
                                            <?= $result['nom'] ?> <?= $result['prenom']?>
                                        </option>
                                    <?php
                                        } ?>
                                </select>  
                            </div>
                        </div>
                        <div class="liste">
                            <div class="cont_title">Liste des rôles :</div>  
                            <div class="cont_dd_list" id="list2">
                                <select class="dd_list" name="profilSelected">
                                    <option selected="selected">Eleve</option>
                                    <option value="prof">Professeur</option>  
                                    <option value="admin">Administrateur</option>
                                </select>   
                            </div>
                        </div>
                        <div class="cont_btn">
                            <button type="submit" name="Update" id="Update" value="Update">Sauvegarder</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php 
            if(isset($_POST['Update'])){
            extract($_POST);
            if(!empty($_POST['userSelected']) && !empty($_POST['profilSelected'])){
                $nomPrenom = $_POST['userSelected'];
                $spltNomPrenom = explode(" ",$nomPrenom);
                $nomSelected = strtolower($spltNomPrenom[0]);
                $prenomSlected = strtolower($spltNomPrenom[1]); 
                
                $q = $conn->prepare("UPDATE users set profil = ? WHERE nom=? and prenom=?");
                $q -> execute(array($profilSelected, $nomSelected, $prenomSlected));
                echo "Les informations on bien été mises à jours";
            }
            else{
                $message = "Tout les champs ne sont pas remplis.";
                echo $message;
            }
            }

        ?>
    </body>
</html>