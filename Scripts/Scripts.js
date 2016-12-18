$(document).ready(function(){
  $("#reservationdate").on('dp.change',function(){
    var date = $("#reservationdate").val();
    var rest = $('#restaurant').val();
    var datastring = 'date='+date+"&rest="+rest;
    if(rest != ""){
      $.ajax({
        type : "POST",
        url: "./Ajax_Requests/Hours.php",
        data: datastring,
        cache: false,
        success: function(result){
          $("#hland").html(result);
        }
      });
    }
  })
});
