<?php
	if (session_status() == PHP_SESSION_NONE) {
    	session_start();
    	if(!isset($_SESSION["userType"]) || !isset($_SESSION["userId"])){
      	header('Location: ./index.html');
    	}
		}?>

		
<?php
									if(isset($_GET['id'])){
									  $id = $_GET['id']; //some_value
									}
									$dbc = mysqli_connect('localhost', 'root', '','restoranai-db');
											if(!$dbc ){
											  die('Negaliu prisijungti: '.mysqli_error($dbc));
											}
									$query = "DELETE FROM padavejas WHERE id = '$id'";
									$result = mysqli_query($dbc, $query);
									if (!$result = $dbc->prepare($query))
									{
										die('Query failed: (' . $dbc->errno . ') ' . $dbc->error);
									}
									if (!$result->execute())
									{
										echo "Negalite ištrinti darbuotojo.";
									}
									else
									{
										echo "Ištrinta sėkmingai!";
									}
									if(!$result){
											session_start();
											$_SESSION["errmsg"] = $dbc->error;
											$dbc->close();
											header('Location: ../mainPage.php');
									}
									else{
											header('Location: ../darbuotoju_trynimas.php');
									}
?>


