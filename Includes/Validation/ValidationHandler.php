<?php
	class ValidationHandler {
		protected $errors = array();
		protected $validators = array();

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

		public function addFieldValidator($fieldName, $validator) {
			if (!is_subclass_of($validator, "ValidatorAbstract")) {
				throw new Exception("Validator must be a subclass of ValidatorAbstract");
			}

			if (!array_key_exists($fieldName, $this->validators)) {
				throw new Exception("Field {$fieldName} doesn't exist in addFieldValidator");
			}

			$this->validators[$fieldName]['validators'][] = $validator;
		}

		public function isValid($paramArray) {
			// clear the error array
			$this->errors = array();

			if (!isset($paramArray)) {
				throw new Exception("Passed a null to isValid in ValidationHandler");
			}

			foreach ($this->validators as $fieldName => $field){
				// If a field is not set
				if (!isset($paramArray[$fieldName])) {
					// If a missing field is required, raise an error
					if ($field['required'] == true) {
						$this->errors[$fieldName][] = $field['errorMessage'];
					}

					// Skip validation of this field, as it's not set anyway
					continue;
				}

				// If it is an array, iterate over every value of an array
				if (is_array($paramArray[$fieldName])) {
					foreach ($paramArray[$fieldName] as $key => $value) {
						$this->validateParam($fieldName, $field, $key, $value);
					}
				} else {
					// If there is only one element, pass a paramKey of 0, as array starts at 0
					$this->validateParam($fieldName, $field, 0, $paramArray[$fieldName]);
				}
			}

			// If there are no errors
			return count($this->errors) == 0;
		}

		protected function validateParam($fieldName, $field, $paramKey, $value) {
			// If a field is an empty
			if (mb_strlen(trim($value)) == 0) {
				// If a field is required, set an error message and return false,
				// else consider a field valid
				if ($field['required'] == true) {
					$this->errors[$fieldName][$paramKey] = $field['errorMessage'];
				}

				// No point in validating if it's empty
				return;
			}

			// Iterate over all set validators
			foreach($field['validators'] as $validatorkey => $validator) {
				// If a field is invalid, get an error message and return false
				if (!$validator->isValid($value)) {
					$this->errors[$fieldName][$paramKey] = $validator->getErrorMessage();
					return;
				}
			}
		}
	}