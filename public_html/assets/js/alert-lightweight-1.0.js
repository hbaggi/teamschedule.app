/*-----------------------------------------
  Alert
---------------------------------------*/
$(function() {
  $("#liveAlert").show();
  setTimeout(function() {
    $("#liveAlert").fadeOut();
  }, 3000);
});
