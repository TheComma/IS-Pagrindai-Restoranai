<?php
	if (session_status() == PHP_SESSION_NONE) {
    	session_start();
    	if(!isset($_SESSION["userType"]) || !isset($_SESSION["userId"])){
      	header('Location: ./index.html');
    	}
		}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Darbuotojo šalinimas</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./Content/css/bootstrap.min.css">
  <link rel="stylesheet" href="./Content/style.css">
</head>
<body>
<?php include("./Includes/navbar.php")  ?>
<div class="container">


  <legend>Darbuotojo šalinimas</legend>
  
						<div class="col-md-12">
						  <h2 align="center">Esamų darbuotojų sąrašas:</h2>     
						  <p align= "center">pasirinkite, kurį darbuotoją norite pašalinti</p>
						  <table class="table table-hover">
							<thead>
							  <tr>
								<th>Vardas</th>
								<th>Pavardė</th>
								<th>Asmens kodas</th>
							  </tr>
							</thead>
							<tbody>
								<?php
											$dbc = mysqli_connect('localhost', 'root', '','restoranai-db');
											if(!$dbc ){
											  die('Negaliu prisijungti: '.mysqli_error($dbc));
											}
											$query="SELECT * FROM `padavejas`";
											$result=mysqli_query($dbc, $query);
											if(mysqli_num_rows($result)>0){
											while($row =  mysqli_fetch_assoc($result)){
											echo "<tr><td>" . $row['vardas'] . "</td><td>" . $row['pavarde'] .
											"</td><td>" . $row['saskaitos_numeris'] . "</td><td><a href='Personalas/darbuotoju_salinimas.php?id=" . $row['id'] . "' class='btn btn-danger' role='button'>Trinti</a></td></tr>";
											}
											}
								?>
							</tbody>
						  </table>
						</div> 

</div>
<script src='./Scripts/js/jquery-2.2.4.min.js' type='text/javascript'></script>
<script src='./Scripts/js/bootstrap.min.js' type='text/javascript'></script>
</body>
</html>