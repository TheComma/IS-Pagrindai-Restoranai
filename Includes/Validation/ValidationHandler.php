<?php
	class ValidationHandler {
		protected $paramArray = null;
		protected $errors = array();
		protected $validators = array();

		public function setParams($paramArray) {
			$this->paramArray = $paramArray;
		}

		public function getErrors() {
			return $this->errors;
		}

		public function addField($fieldName, $required = true, $missingErrorMessage = "") {
			if (array_key_exists($fieldName, $this->validators)) {
				throw new Exception("Trying to add a field to ValidationHandler when such field already exists");
			}

			if (!is_bool($required)) {
				throw new Exception("Variable required must be a boolean in addField");
			}

			$this->validators[$fieldName]['required'] = $required;
			$this->validators[$fieldName]['errorMessage'] = $missingErrorMessage;
			$this->validators[$fieldName]['validators'] = array();
		}

		public function addFieldValidator($fieldName, $validator, $breakChain = false) {
			if (!is_subclass_of($validator, "ValidatorAbstract")) {
				throw new Exception("Validator must be a subclass of ValidatorAbstract");
			}

			if (!array_key_exists($fieldName, $this->validators)) {
				throw new Exception("Field {$fieldName} doesn't exist in addFieldValidator");
			}

			if (!is_bool($breakChain)) {
				throw new Exception("Variable breakChain must be a boolean in addFieldValidator");
			}

			$this->validators[$fieldName]['validators'][] = $validator;
			$this->validators[$fieldName]['breakChain'][] = $breakChain;
		}

		public function isValid() {
			$valid = true;
			$this->errors = array();

			if (!isset($this->paramArray)) {
				throw new Exception("Parameters not set in ValidatorAbstract, use setParams before calling isValid");
			}

			foreach ($this->validators as $fieldName => $field){

				if (!isset($this->paramArray[$fieldName])) {
					if ($field['required'] == true) {
						$this->errors[$fieldName][] = $field['errorMessage'];
						$valid = false;
					}
				}

				// If it is an array, iterate over every value of an array
				if (is_array($this->paramArray[$fieldName])) {
					foreach ($this->paramArray[$fieldName] as $key => $value) {
						$valid = $this->isValidParam($fieldName, $field, $key, $value);
					}
				} else {
					$valid = $this->isValidParam($fieldName, $field, 0, $this->paramArray[$fieldName]);
				}
			}

			return $valid;
		}

		protected function isValidParam($fieldName, $field, $paramKey, $value) {
			// If a field is an empty string
			if (mb_strlen(trim($value)) == 0 && $field['required'] == true) {
				$this->errors[$fieldName][$paramKey][] = $field['errorMessage'];
				return false;
			}

			$valid = true ;

			// Iterate over all set validators
			foreach($field['validators'] as $validatorkey => $validator) {
				if (!$validator->isValid($value)) {
					$this->errors[$fieldName][$paramKey][] = $validator->getErrorMessage();
					$valid = false;

					if ($field['breakChain'][$validatorkey] == true) 
						break;
				}
			}

			return $valid;
		}
	}