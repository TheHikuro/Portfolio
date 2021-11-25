<?php
    session_start();
    if(empty($_SESSION['mail'])){
        http_response_code(401);
        echo("ERROR CONNECTE TOI !!");
        exit;
    }
    $data = trim(file_get_contents("php://input"));
    $data = json_decode($data, true);
    var_dump($data);

    require('config.php');
    global $conn;

    $check = $conn->prepare("SELECT scores FROM tabscore WHERE user_mail=:mail");
    $check -> execute([
         'mail' => $_SESSION['mail']
    ]);
    $select = $check->fetchAll();
    var_dump($select);
    
    if($select){
        $replaceScore = $conn->prepare("UPDATE tabscore set scores = :scores WHERE user_mail=:mail");
        $replaceScore -> execute([
            'scores' => $data['score'],
            'mail' => $_SESSION['mail']
        ]);
    }
    else{
        $q = $conn->prepare("INSERT INTO tabscore(scores,user_mail) VALUES(:scores, :mail)");
        var_dump($q);
        $q -> execute([
            'scores' => $data['score'],
            'mail' => $_SESSION['mail']
        ]); 
    }
    

?>