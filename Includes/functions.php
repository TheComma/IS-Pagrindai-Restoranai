<?php 
    // function for redirection
    function redirect($url) {
        header("Location: $url");
        die();
    }

    /*
        Function for connecting to database. Calls die() in case of failure
        return - databse connection if succesful
    */
    function connect(){
        $dbc = mysqli_connect('localhost', 'root', '','restoranai-db');

        if( !$dbc ){
            die('Negaliu prisijungti: ' . mysqli_connect_errno($dbc) . ' : ' . mysqli_connect_error());
        }

        mysqli_set_charset($dbc, "utf8");

        return $dbc;
    }