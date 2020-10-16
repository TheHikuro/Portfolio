$(document).ready(function () {
    var letters = $('h1').text();
    var nHTML = '';
    for (var letter of letters) {
      nHTML += "<span class='a'>" + letter + "</span>";
    }
    $('h1').html(nHTML);
  })