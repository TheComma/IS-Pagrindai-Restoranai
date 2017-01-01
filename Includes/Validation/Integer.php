<?php 
	require_once(INCLUDE_ROOT . '/Validation/ValidatorAbstract.php');

	class Validator_Integer extends ValidatorAbstract {

		public function Validator_Integer($errorMessage = "") {
			$this->error = $errorMessage;
		}

		public function isValid($value) {
			return (filter_var($value, FILTER_VALIDATE_INT) !== false);
		}
	}