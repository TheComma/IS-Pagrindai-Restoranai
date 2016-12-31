<?php
	abstract class ValidatorAbstract {
		protected $error;

		abstract public function isValid($value);

		public function getErrorMessage() {
			return $this->error;
		}

		public function setErrorMessage($message) {
			$this->error = $message;
		}
	}