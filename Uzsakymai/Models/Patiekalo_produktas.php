<?php
    class Patiekalo_produktas {
        protected $database = null;

        function Patiekalo_produktas($dbc) {
            $this->database = $dbc;
        }

		function irasyti_patiekalo_produktus($dishId, $products, $amounts) {
			if (count($products) > 0) {
				foreach ($products as $key => $product) {
					$this->insertDishProduct($dishId, $product, $amounts[$key]);
				}
			}
		}

		function insertDishProduct($dishId, $product, $amount) {
			$query = "  INSERT INTO patiekalo_produktas (kiekis, fk_patiekalas, fk_produktas) 
                        VALUES(?, ?, ?)";
            $stmt = mysqli_prepare($this->database, $query);
            
            mysqli_stmt_bind_param($stmt, 'dii', $amount, $dishId, $product);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
		}
    }