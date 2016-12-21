<div class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <?php if($_SESSION["userType"] == 1) { ?>
                     <!-- Parts for the client -->
                    <li><a href="./CreateReservation.php">Rezervuoti Staliuką</a></li>
                    <li><a href="./vartotojo_rezervacijos.php">Vartotojo Rezervacijos</a></li>
                <?php } ?>

                <?php if($_SESSION["userType"] == 3) { ?>
                    <!-- Parts for the kitchen -->
                    <li><a href="./uzsakytu_produktu_sarasas.php">Produktų užsakymai</a></li>
                <?php } ?>

                <?php if($_SESSION["userType"] == 5) { ?>
                    <!-- Parts for the waiter -->
                    <li><a href="./patiekalu_sarasas.php">Patiekalai</a></li>
                    <li><a href="./uzsakymu_sarasas.php">Patiekalų užsakymai</a></li>
                    <li><a href="./padavejo_rezervacijos.php">Rezervacijos</a></li>
                <?php } ?>

                <?php if($_SESSION["userType"] == 9) { ?>
                    <!-- Parts for the admin, because of a lot of options,
                        dropdowns are suggested -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Rezervacijos
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="./CreateReservation.php">Rezervuoti Staliuką</a></li>
                            <li><a href="./EditReservation.php">Redaguoti Rezervaciją</a></li>
                            <li><a href="./admin_reservations.php">Rezervaciju valdymas</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Personalas
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Užsakymai
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="./uzsakymu_sarasas.php">Patiekalų užsakymai</a></li>
                            <li><a href="./uzsakytu_produktu_sarasas.php">Produktų užsakymai</a></li>
                            <li><a href="./patiekalu_sarasas.php">Patiekalai</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Ataskaitos
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="./rezervavimu_ataskaita.php">Rezervavimu Ataskaita</a></li>
                        </ul>
                    </li>
                <?php } ?>


            </ul>
            <!-- Put this on the right side -->
            <ul class="nav navbar-nav navbar-right">
                <li><a href="./User/userlogout.php">Atsijungti</a></li>
            </ul>
        </div>
    </div>
</div>
