<?php 
	require_once(INCLUDE_ROOT . '/Validation/ValidatorAbstract.php');

	class Validator_StringLength extends ValidatorAbstract {
		protected $min = 0;
		protected $max = PHP_INT_MAX;

		public function Validator_StringLength($errorMessage = "", $min = 0, $max = PHP_INT_MAX) {
			$this->error = $errorMessage;
			$this->min = $min;
			$this->max = $max;
		}

		public function isValid($value) {
			$length = mb_strlen(trim($value));

			if ( $length > $this->max || $length < $this->min ) {
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