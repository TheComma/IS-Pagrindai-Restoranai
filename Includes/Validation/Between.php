<?php 
	require_once(INCLUDE_ROOT . '/Validation/ValidatorAbstract.php');

	class Validator_Between extends ValidatorAbstract {
		protected $min = ~PHP_INT_MAX;
		protected $max = PHP_INT_MAX;

		public function Validator_Between($errorMessage = "", $min = ~PHP_INT_MAX, $max = PHP_INT_MAX) {
			$this->error = $errorMessage;
			$this->min = $min;
			$this->max = $max;
		}

		public function isValid($value) {
			if (!is_numeric($value)) return false;

			$floatval = floatval($value);

			if ( $floatval > $this->max || $floatval < $this->min ) {
				return false;
			}

			return true;
		}

		public function setMin($newMin) {
			$this->min = $newMin;
		}

		public function setMax($newMax) {
			$this->max = $newMax;
		}
	}