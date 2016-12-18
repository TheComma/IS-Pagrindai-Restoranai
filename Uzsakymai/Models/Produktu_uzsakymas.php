<?php
    class Produktu_uzsakymas {
        protected $database = null;

        function Produktu_uzsakymas($dbc) {
            $this->database = $dbc;
        }

        function getOrders($page = null, $count = null){
            $query = "  SELECT produktu_uzsakymas.*, produktas.id AS produktoId, 
                            produktas.pavadinimas AS produktoPav, produktu_uzsakymo_busena.pavadinimas AS busena
                        FROM produktu_uzsakymas
                        INNER JOIN produktas
                            ON fk_produktas=produktas.id
                        INNER JOIN produktu_uzsakymo_busena
                            ON fk_busena=produktu_uzsakymo_busena.id
                        ORDER BY produktu_uzsakymas.id";

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
            while ($order = mysqli_fetch_assoc($result)){
                $dbarray[] = $order;
            }

            return $dbarray;
        }

        function getOrderCount() {
            $query = "  SELECT COUNT(produktu_uzsakymas.id) AS count
                        FROM produktu_uzsakymas";

            $result = mysqli_query($this->database, $query);
            /* Error occurred, return given name by default */
            if (!$result || (mysqli_num_rows($result) < 1)) {
                return 0;
            }

            $count = mysqli_fetch_assoc($result);

            return $count['count'];
        }

    }