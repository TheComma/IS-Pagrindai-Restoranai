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
              <?php
                if($_SESSION["userType"] == 1)
                {
               ?>
                <li><a href="./CreateReservation.php">Rezervuoti Staliuką</a></li>
                <li><a href="./EditReservation.php">Redaguoti Rezervaciją</a></li>
                <?php } ?>
                <li><a href="./User/userlogout.php">Atsijungti</a></li>
            </ul>
        </div>
    </div>
</div>
