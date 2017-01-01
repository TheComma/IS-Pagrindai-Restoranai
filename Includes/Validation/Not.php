<?php 
	require_once(INCLUDE_ROOT . '/Validation/ValidatorAbstract.php');

	class Validator_Not extends ValidatorAbstract {
		protected $value = null;

		public function Validator_Not($errorMessage = "", $value = null) {
			$this->error = $errorMessage;
			$this->value = $value;
		}

		public function isValid($value) {
			return ($this->value != $value);
		}

		public function setValue($value) {
			$this->value = $value;
		}
	}