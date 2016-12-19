<?php
    class Patiekalo_tipas {
        protected $database = null;

        function Patiekalo_tipas($dbc) {
            $this->database = $dbc;
        }

        function getProductTypeList(){
            $query = "  SELECT id, pavadinimas
                        FROM patiekalo_tipas
                        ORDER BY id";

            $result = mysqli_query($this->database, $query);

            if (!$result || (mysqli_num_rows($result) < 1)) {
                return NULL;
            }

            $dbarray = array();
            while ($product = mysqli_fetch_assoc($result)){
                $dbarray[] = $product;
            }

            return $dbarray;
        }
    }