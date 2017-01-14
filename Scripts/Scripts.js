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

$(document).on('click','#getData',function(){
  var start = $("#start").val();
  var end = $('#end').val();
  var rest = $('#restaurant').val();
  var datastring = "start="+start+"&end="+end+"&rest="+rest;
  if(start != "" && end != ""){
    $.ajax({
      type : "POST",
      url: "./Ajax_Requests/rezervavimu_ataskaitos.php",
      data: datastring,
      cache: false,
      success: function(result){
        $('#landing').html(result);
      }
    });
  }
});

$(document).on('click','#getData1',function(){
  var start = $("#start").val();
  var end = $('#end').val();
  var vart = $('#vartotojas').val();
  var datastring = "start="+start+"&end="+end+"&vart="+vart;
  if(start != "" && end != ""){
    $.ajax({
      type : "POST",
      url: "./Ajax_Requests/darbo_valandu_ataskaitos.php",
      data: datastring,
      cache: false,
      success: function(result){
        $('#landing1').html(result);
      }
    });
  }
});

$(document).on('click','#getData2',function(){
  var start = $("#start").val();
  var end = $('#end').val();
  var vart = $('#vartotojas').val();
  var datastring = "start="+start+"&end="+end+"&vart="+vart;
  if(start != "" && end != ""){
    $.ajax({
      type : "POST",
      url: "./Ajax_Requests/suvartotu_produktu_ataskaitos.php",
      data: datastring,
      cache: false,
      success: function(result){
        $('#landing2').html(result);
      }
    });
  }
});
function DeleteReservation(id){
  dataid = "id="+id;
  $.ajax({
      type: "POST",
      url: "./Ajax_Requests/DeleteReservation.php",
      data: dataid,
      cache: false,
      success: function(){
        $('#'+id).remove();
      }
  })
}
function ConfirmReservation(id){
  dataid = "id="+id;
  $.ajax({
      type: "POST",
      url: "./Ajax_Requests/ConfirmReservation.php",
      data: dataid,
      cache: false,
      success: function(){
        $('#'+id).remove();
      }
  })
}
function DenyReservation(id){
  dataid = "id="+id;
  $.ajax({
      type: "POST",
      url: "./Ajax_Requests/DenyReservation.php",
      data: dataid,
      cache: false,
      success: function(){
        $('#'+id).remove();
      }
  })
}