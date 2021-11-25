<?php session_start();
    if(empty($_SESSION['mail'])){
        var_dump($_SESSION['mail']);
        header("Location: ".$_server['server_name']."/assets/projects/Workshop/index.php");
    }
?> 

<html xml:lang="en" lang="en">
    <head>
        <title>Enseignants</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <link rel="stylesheet" href="../css/prof.css">
        
    </head>
    <body>
        <header>
            <button><a href="logout.php">Deconnexion</a></button>
        </header>
        <div class="cont_list">
            <div class="cont_title">
                <div class="tilte"><h2>Liste des Eleves et leurs Scores</h2></div>
            </div>
            <div class="list_score">
                <?php
                require('config.php');
                $results = $conn->prepare("SELECT nom,prenom,scores FROM users LEFT JOIN tabscore ON users.mail=tabscore.user_mail WHERE users.profil='Eleve' ORDER BY scores_id DESC"); 
                $results -> execute([
						'mail' => $_SESSION['mail']
					]); ?>
                <?php
                    foreach($results as $result) { ?>
                    <div class="list_user">
                        <div class="user_info"><p>Etudiant(e) : <?= $result['nom'] ?> <?= $result['prenom']?></p></div>
                        <div class="user_info_score"><p>Dernier score : <?= $result['scores']?>/10</p></div>
                    </div>  
                <?php
                    } ?>
            </div>
        </div>
    </body>

</html>