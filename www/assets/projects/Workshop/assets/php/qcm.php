<?php session_start();
/* let_dump($_SESSION['mail']); */
if(empty($_SESSION['mail'])){
	header("Location: ".$_server['server_name']."/assets/projects/Workshop/index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>QCM - EFFICOM</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../css/qcm_etudiants.css">
</head>
<body>
	<header>
		<button><a href="logout.php">Deconnexion</a></button>
	</header>
	<div class="container">
		<h1 class="text-center">QCM</h1>
		<div class="dashboard">
			<div><span>Timer</span><span id="timer" class="disp">&nbsp;</span></div>
			<div><span>Question</span><span id="counter" class="disp">&nbsp;</span></div>
			<div><span>Score</span><span id="score" name="i_score" class="disp">&nbsp;</span></div>
		</div>
		<div id="sandbox">
			<h2 id="question" class="text-center">Cliquez sur le bouton Lancer</h2>
<!--            <p id="info">Vous avez 10s entre chaque question, il ne sera pas possible de copier les questions pour vous aider de google. <br> Ne perdez plus de temps et bon courage !</p>-->			<div id="choices">
				<button class="rep_btn" type="button" data="1">...</button>
				<button class="rep_btn" type="button" data="2">...</button>
				<button class="rep_btn" type="button" data="3">...</button>
			</div>
		</div>
		<div class="text-center">
			<button type="button" id="startBtn">Lancer</button>
		</div>
	</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
	(function() {
		'use strict';

		const QCM = [
			{
                state: false,
				question: "Quelle est la distance du marathon",
				choices: "30,1 km|42,195 km|50 km",
				answer: 2
			},{
                state: false,
				question: "De combien de joueurs se compose une équipe de football",
				choices: "11 joueurs|13 joueurs|15 joueurs",
				answer: 1
			},{
                state: false,
				question: "Les Jeux olympiques (été ou hiver) sont organisés :",
				choices: "Tous les ans|Tous les 4 ans|Tous les 5 ans",
				answer: 2
			},{
                state: false,
				question: "Qu’est-ce que la NBA",
				choices: "National Basketball Association|National Boxe Association|National Badminton Association",
				answer: 1
			},{
                state: false,
				question: "Quel sport est arbitré obligatoirement en français",
				choices: "Le tir à l’arc|L’équitation|L’escrime",
				answer: 3
			},{
                state: false,
				question: "Au judo, quel est le grade le plus élevé parmi ces ceintures",
				choices: "Ceinture blanche-rouge|Ceinture rouge|Ceinture noire",
				answer: 2
			},{
                state: false,
				question: "Combien y a-t-il de périodes dans un match de hockey sur glace",
				choices: "2 périodes de 30 minutes chacun|3 périodes de 20 minutes chacune|4 périodes de 15 minutes chacune",
				answer: 2
			},{
                state: false,
				question: "En bowling, quel est le score parfait (pour douze strikes consécutifs)",
				choices: "300 points|350 points|400 points",
				answer: 1
			},{
                state: false,
				question: "Avant un combat de sumo, que jettent les lutteurs sur la zone de combat",
				choices: "Du sel|Du sable|De l’eau",
				answer: 1
			},{
                state: false,
				question: "Pour que les courses de chevaux classiques soient les plus serrées possible, les chevaux portent un poids de façon à rééquilibrer leurs chances :",
				choices: "Vrai|Faux|Je ne sais pas",
				answer: 1
			}
		];

		/* --------- Start here --------------- */
		const duration = 1000;
		const credits = 15;
		let decompte;
		let counter;
		let timer1;
		let score;
		const timerDisp = document.getElementById('timer');
		const counterDisp = document.getElementById('counter');
		const scoreDisp = document.getElementById('score');
        let QCM_copy = QCM;
        let randomCounter; 
		let nbQuestion;
		let KeepArray;
		let qcmTerminer = true;

		const choices = document.getElementById('choices');
		choices.addEventListener('click', function(event) {
			if(qcmTerminer == false){
				if(event.target.tagName == 'BUTTON' && event.target.hasAttribute('data')) {
					clearInterval(timer1);
					event.preventDefault();
					if(parseInt(event.target.getAttribute('data')) == KeepArray) {
						score++;
						scoreDisp.textContent = score;
						alert("Bonne réponse à\nla question n°" + (counter + 1));
					} else {
						alert("Mauvaise réponse à\nla question n°" + (counter + 1));
					}
					nextQuestion();
				}
			}
		});

		const startBtn = document.getElementById('startBtn');
		startBtn.addEventListener('click', function(event) {
			qcmTerminer = false;
			counter = -1;
			score = 0;
			QCM_copy = QCM;
			nbQuestion = QCM.length;
			nextQuestion();
			event.preventDefault();
			startBtn.textContent = 'Playing...';
			startBtn.disabled = true;
		});

		function myTimeout() {
			decompte--;
			timerDisp.textContent = decompte;
			if(decompte <= 0) {
				clearInterval(timer1);
				alert('Délai dépassé');
				nextQuestion();
			}
		}

        function randomNumber(p_QCM_copy) {
            let questionNumber;
            questionNumber = Math.floor(Math.random() * p_QCM_copy.length);
            return questionNumber;
        }

        function removeArray(p_number){
			QCM_copy.splice(p_number, 1); 
        }

		const questionCaption = document.getElementById('question');
		const choicesBtns = choices.getElementsByTagName('BUTTON');
		function nextQuestion() {
            randomCounter = randomNumber(QCM_copy);
			counter++;
			if(randomCounter < QCM_copy.length) {
				counterDisp.textContent = (counter + 1) + ' / ' + nbQuestion;
				questionCaption.textContent = QCM_copy[randomCounter].question + ' ?';
				const texts = QCM_copy[randomCounter].choices.split('|');
				for(let i=0, iMax=choicesBtns.length; i <iMax; i++) {
					choicesBtns[i].textContent = (i < texts.length) ? texts[i] : '&nbsp;';
				}
				decompte = credits;
				timerDisp.textContent = decompte;
				timer1 = setInterval(myTimeout, duration);
				/* console.log('randomCouter = ' + randomCounter); */
				KeepArray = QCM_copy[randomCounter].answer;
				removeArray(randomCounter);
			} else {
				// game over
				startBtn.textContent = 'QCM Terminé';
				startBtn.disabled = true;
				startBtn.classList.add('game-over');
				let keepScore = scoreDisp.textContent; 
				qcmTerminer = true;
				
				fetch ('saveScore.php',
				{
					method: "POST",
					headers: {
						"Content-Type": "application/json"
					},
					body: JSON.stringify({score: keepScore})
				}).then(function(response){

				});
				
			}
		}
	})();
</script>
</body>
</html>