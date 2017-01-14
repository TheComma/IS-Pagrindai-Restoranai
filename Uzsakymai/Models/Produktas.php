<?php
    class Produktas {
        protected $database = null;

        function Produktas($dbc) {
            $this->database = $dbc;
        }

        function isrinkti_produktus($page = null, $count = null){
            $query = "  SELECT produktas.*
                        FROM produktas
                        ORDER BY id";

            //echo $query;

            if ($page && $count) {
                $offset = ($page - 1) * $count;
                $query .= " LIMIT {$count} OFFSET {$offset}";
            }

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

        function getProductCount() {
            $query = "  SELECT COUNT(id) AS count
                        FROM produktas";

            $result = mysqli_query($this->database, $query);
            /* Error occurred, return given name by default */
            if (!$result || (mysqli_num_rows($result) < 1)) {
                return 0;
            }

            $count = mysqli_fetch_assoc($result);

            return $count['count'];
        }
    }