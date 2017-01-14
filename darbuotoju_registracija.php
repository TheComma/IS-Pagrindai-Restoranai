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
  <title>Darbuotojo registracija</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./Content/css/bootstrap.min.css">
  <link rel="stylesheet" href="./Content/style.css">
</head>
<body>
<?php include("./Includes/navbar.php")  ?>
<div class="container">
  <form action="./User/employeeregistration.php" method="post" class="form-horizontal">
  <fieldset>

  <legend>Darbuotojo registracija</legend>
  
  <div class="form-group">
  <label class="col-md-4 control-label" for="employeetype">Pasirinkite darbuotojo pareigas:</label>
  <div class="col-md-4">
  <select class="form-control" id="employeetype" name="employeetype" required="">
    <option value="5">Padavėjas</option>
    <option value="3">Virtuvės darbuotojas</option>
  </select>
</div>
</div>

  <div class="form-group">
    <label class="col-md-4 control-label" for="username">Vartotojo vardas</label>
    <div class="col-md-4">
    <input id="username" name="username" type="text" placeholder="Vartotojo vardas" class="form-control input-md" required="" maxlength="20">
    </div>
  </div>

  <div class="form-group">
    <label class="col-md-4 control-label" for="password">Slaptažodis</label>
    <div class="col-md-4">
      <input id="password" name="password" type="password" placeholder="Slaptažodis" class="form-control input-md" required="" maxlength="20">

    </div>
  </div>

  <div class="form-group">
    <label class="col-md-4 control-label" for="name">Vardas</label>
    <div class="col-md-4">
    <input id="name" name="name" type="text" placeholder="Vardas" class="form-control input-md" required="" maxlength="20">

    </div>
  </div>

  <div class="form-group">
    <label class="col-md-4 control-label" for="lastname">Pavardė</label>
    <div class="col-md-4">
    <input id="lastname" name="lastname" type="text" placeholder="Pavardė" class="form-control input-md" required="" maxlength="20">

    </div>
  </div>

  <div class="form-group">
    <label class="col-md-4 control-label" for="adress">Adresas</label>
    <div class="col-md-4">
    <input id="adress" name="adress" type="text" placeholder="Adresas" class="form-control input-md" maxlength="50">

    </div>
  </div>

  <div class="form-group">
    <label class="col-md-4 control-label" for="account">Sąskaitos numeris</label>
    <div class="col-md-4">
    <input id="account" name="account" type="text" placeholder="Sąskaitos numeris" class="form-control input-md" maxlength="50">

    </div>
  </div>

  <div class="form-group">
    <label class="col-md-4 control-label" for="phone">Telefonas</label>
    <div class="col-md-4">
    <input id="phone" name="phone" type="text" placeholder="Telefonas" class="form-control input-md" required="" maxlength="13">

    </div>
  </div>

  <div class="form-group">
    <label class="col-md-4 control-label" for="personalcode">Asmens kodas</label>
    <div class="col-md-4">
    <input id="personalcode" name="personalcode" type="text" placeholder="Asmens kodas" class="form-control input-md" required="" maxlength="50">

    </div>
  </div>
  
   <div class="form-group">
    <label class="col-md-4 control-label" for="personalcode">Etatas</label>
    <div class="col-md-4">
    <input id="shift" name="shift" type="number" step="any" min="0" placeholder="Etatas" class="form-control input-md" required="" maxlength="50">

    </div>
  </div>

   <div class="form-group">
    <label class="col-md-4 control-label" for="startdate">Įdarbinimo data</label>
    <div class="col-md-4">
    <input id="startdate" name="startdate" type="date" step="any" min="0" placeholder="Įdarbinimo data" class="form-control input-md" required="" maxlength="50">

    </div>
  </div>  

  <div class="form-group">
    <div class="col-md-12 text-center">
      <input type="submit" value='Registruoti' class="btn btn-primary"  />
    </div>
  </div>

  </fieldset>
  </form>

</div>
<script src='./Scripts/js/jquery-2.2.4.min.js' type='text/javascript'></script>
<script src='./Scripts/js/bootstrap.min.js' type='text/javascript'></script>
</body>
</html>