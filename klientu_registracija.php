<!DOCTYPE html>
<html>
<head>
  <title>Klientų registracija</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./Content/css/bootstrap.min.css">
  <link rel="stylesheet" href="./Content/style.css">
</head>
<body>
<div class="container">
  <form action="./User/userregistration.php" method="post" class="form-horizontal">
  <fieldset>

  <legend>Klientų registracija</legend>
  <a href="index.php" class="btn btn-default">Grįžti į pagrindinį</a>

  <div class="form-group">
    <label class="col-md-4 control-label" for="username">Vartotojo vardas</label>
    <div class="col-md-4">
    <input id="username" name="username" type="text" placeholder="Vartotojo vardas" class="form-control input-md" required="" maxlength="20">
    <?php session_start();
    if(isset($_SESSION["errmsg"]))
    {
       echo $_SESSION["errmsg"];
    }
    session_destroy();
     ?>
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
    <label class="col-md-4 control-label" for="email">El. Paštas</label>
    <div class="col-md-4">
    <input id="email" name="email" type="email" placeholder="El. Paštas" class="form-control input-md" required="" maxlength="25">

    </div>
  </div>

  <div class="form-group">
    <label class="col-md-4 control-label" for="adress">Adresas</label>
    <div class="col-md-4">
    <input id="adress" name="adress" type="text" placeholder="Adresas" class="form-control input-md" maxlength="50">

    </div>
  </div>

  <div class="form-group">
    <label class="col-md-4 control-label" for="phone">Telefonas</label>
    <div class="col-md-4">
    <input id="phone" name="phone" type="text" placeholder="Telefonas" class="form-control input-md" required="" maxlength="13">

    </div>
  </div>

  <div class="form-group">
    <label class="col-md-4 control-label" for="city">Miestas</label>
    <div class="col-md-4">
    <input id="city" name="city" type="text" placeholder="Miestas" class="form-control input-md" required="" maxlength="50">

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
