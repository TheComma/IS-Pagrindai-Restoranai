$(document).ready(function(){
  $("#reservationdate").on('dp.change',function(){
    var date = $("#reservationdate").val();
    var datastring = 'date='+date;
    $.ajax({
      type : "POST",
      url: "./Ajax_Requests/Hours.php",
      data: datastring,
      cache: false,
      success: function(result){
        $("#hland").html(result);
      }
  });
  })
});
