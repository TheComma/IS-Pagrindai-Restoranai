<?php
    class Patiekalas {
        protected $database = null;

        function Patiekalas($dbc) {
            $this->database = $dbc;
        }

        function isrinkti_patiekalus($page = null, $count = null){
            $query = "  SELECT patiekalas.*
                        FROM patiekalas
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

        function getDishCount() {
            $query = "  SELECT COUNT(id) AS count
                        FROM patiekalas";

            $result = mysqli_query($this->database, $query);
            /* Error occurred, return given name by default */
            if (!$result || (mysqli_num_rows($result) < 1)) {
                return 0;
            }

            $count = mysqli_fetch_assoc($result);

            return $count['count'];
        }

		function naujas_patiekalas($patiekaloTipas, $pavadinimas, $kaina, $aktyvus, $komentaras) {
			$query = "  INSERT INTO patiekalas (pavadinimas, kaina, sukurimo_data,
                            modifikavimo_data, aktyvus, komentarai, fk_tipas) 
                        VALUES(?, ?, NOW(), NOW(), ?, ? , ?)";
            $stmt = mysqli_prepare($this->database, $query);
            
            mysqli_stmt_bind_param($stmt, 'sdisi', $pavadinimas, $kaina,
				 $aktyvus, $komentaras, $patiekaloTipas);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
		}

		function getLastInsertId(){
			return mysqli_insert_id($this->database);
		}
    }