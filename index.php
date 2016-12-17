<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="./Content/css/bootstrap.min.css">
	<link rel="stylesheet" href="./Content/style.css">
</head>
<body>
<div class="container">
    <div class="row">
		<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Vartotojų prisijungimas</h3>
			 	</div>
			  	<div class="panel-body">
			    	<form action="./User/userlogin.php" method="post" accept-charset="UTF-8" role="form">
                    <fieldset>
			    	  	<div class="form-group">
			    		    <input class="form-control" placeholder="Vartotojo vardas" name="username" type="text">
			    		</div>
			    		<div class="form-group">
			    			<input class="form-control" placeholder="Slaptažodis" name="password" type="password" value="">
			    		</div>
			    		<input class="btn btn-lg btn-success btn-block" type="submit" value="Prisijungti">
			    	</fieldset>
			      	</form>
								<a href="klientu_registracija.php">Klientų registracija</a>
			    </div>
			</div>
		</div>
	</div>
</div>
<script src='./Scripts/js/jquery-2.2.4.min.js' type='text/javascript'></script>
<script src='./Scripts/js/bootstrap.min.js' type='text/javascript'></script>
</body>
</html>
