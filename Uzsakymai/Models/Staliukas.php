<?php
    class Staliukas {
        protected $database = null;

        function Staliukas($dbc) {
            $this->database = $dbc;
        }

        function getTableList(){
            $query = "  SELECT *
                        FROM staliukas
                        ORDER BY staliuko_indentifikatorius";

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