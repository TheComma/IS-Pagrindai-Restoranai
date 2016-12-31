<?php 
	require_once(INCLUDE_ROOT . '/Validation/ValidatorAbstract.php');

	class Validator_Numeric extends ValidatorAbstract {

		public function Validator_Numeric($errorMessage = "") {
			$this->error = $errorMessage;
		}

		public function isValid($value) {
			return (is_numeric($value));
		}
	}