

var modal = document.getElementsByClassName("modal");
var btn = document.getElementsByClassName("My_Btn");
var span = document.getElementsByClassName("close");


btn[0].onclick = function() { modal[0].style.display = "block"; }
span[0].onclick = function() { modal[0].style.display = "none"; }

btn[1].onclick = function() { modal[1].style.display = "block"; }
span[1].onclick = function() { modal[1].style.display = "none"; }

btn[2].onclick = function() { modal[2].style.display = "block"; }
span[2].onclick = function() { modal[2].style.display = "none"; }

btn[3].onclick = function() { modal[3].style.display = "block"; }
span[3].onclick = function() { modal[3].style.display = "none"; }

btn[4].onclick = function() { modal[4].style.display = "block"; }
span[4].onclick = function() { modal[4].style.display = "none"; }

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal[0].style.display = "none";
    modal[1].style.display = "none";
    modal[2].style.display = "none";
    modal[3].style.display = "none";
    modal[4].style.display = "none";
  }
}