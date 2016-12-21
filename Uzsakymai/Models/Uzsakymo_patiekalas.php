<?php
    class Uzsakymo_patiekalas {
        protected $database = null;

        function Uzsakymo_patiekalas($dbc) {
            $this->database = $dbc;
        }

		function getOrderDishes($order){
            $query = "  SELECT uzsakymo_patiekalas.*, patiekalas.pavadinimas,
                            patiekalo_tipas.pavadinimas AS tipoPavadinimas,
                            patiekalo_busena.pavadinimas AS busena
                        FROM uzsakymo_patiekalas
                        INNER JOIN patiekalo_busena
                            ON fk_busena=patiekalo_busena.id
                        INNER JOIN patiekalas
                            ON fk_patiekalas=patiekalas.id
                        INNER JOIN patiekalo_tipas
                            ON fk_tipas=patiekalo_tipas.id
						WHERE uzsakymo_patiekalas.fk_uzsakymas=$order
                        ORDER BY uzsakymo_patiekalas.id";

            //echo $query;

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

        function getCurrentOrders() {
            $query = "  SELECT uzsakymo_patiekalas.*, patiekalas.pavadinimas,
                            staliukas.staliuko_indentifikatorius AS staliukoPav,
                            padavejas.vardas AS padavejoVardas, padavejas.pavarde AS padavejoPavarde,
                            patiekalo_busena.pavadinimas AS busena
                        FROM uzsakymo_patiekalas
                        INNER JOIN patiekalo_busena
                            ON fk_busena=patiekalo_busena.id
                        INNER JOIN patiekalas
                            ON fk_patiekalas=patiekalas.id
                        INNER JOIN uzsakymas
                            ON fk_uzsakymas=uzsakymas.id
                        INNER JOIN staliukas
                            ON fk_staliukas=staliuko_indentifikatorius
                        INNER JOIN padavejas
                            ON fk_padavejas=padavejas.id
						WHERE uzsakymo_patiekalas.fk_busena < 3
                        ORDER BY uzsakymo_patiekalas.fk_busena DESC";

            //echo $query;

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

		function insertOrderDishes($orderId, $dishes, $comments) {
			if (count($dishes) > 0) {
				foreach ($dishes as $key => $dish) {
					$this->insertOrderDish($orderId, $dish, $comments[$key]);
				}
			}
		}

		function insertOrderDish($orderId, $dish, $comment) {
			$query = "  INSERT INTO uzsakymo_patiekalas (komentaras, fk_uzsakymas, fk_patiekalas, fk_busena) 
                        VALUES(?, ?, ?, 1)";
            $stmt = mysqli_prepare($this->database, $query);
            
            mysqli_stmt_bind_param($stmt, 'sii', $comment, $orderId, $dish);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
		}

        function cancelDish($dishId) {
            $query = "  UPDATE uzsakymo_patiekalas SET fk_busena = 4 WHERE id = ?";
            $stmt = mysqli_prepare($this->database, $query);
            
            mysqli_stmt_bind_param($stmt, 'i', $dishId);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }

        function produceDish($dishId) {
            $query = "  UPDATE uzsakymo_patiekalas SET fk_busena = 2 WHERE id = ?";
            $stmt = mysqli_prepare($this->database, $query);
            
            mysqli_stmt_bind_param($stmt, 'i', $dishId);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }

        function finishDish($dishId) {
            $query = "  UPDATE uzsakymo_patiekalas SET fk_busena = 3 WHERE id = ?";
            $stmt = mysqli_prepare($this->database, $query);
            
            mysqli_stmt_bind_param($stmt, 'i', $dishId);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }

        function cancelDishes($orderId) {
            $query = "  UPDATE uzsakymo_patiekalas SET fk_busena = 4 WHERE fk_uzsakymas = ? AND fk_busena < 3";
            $stmt = mysqli_prepare($this->database, $query);
            
            mysqli_stmt_bind_param($stmt, 'i', $orderId);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }