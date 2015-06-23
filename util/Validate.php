<?php

/**
 * Fields = array(
 *              "fieldName" => array("inputArray", "type", required (true/false)),
 *              "fieldName" => array("inputArray", "type", required (true/false)),
 * 
 * InputArray: $_POST, $_GET, $_SESSION.
 * Types: "entero", "texto", "email", "fecha", "verdadero o falso".
 */
class Validate {

    private $fields;
    private $errorMessage;

    public function __construct($fields) {
        $this->fields = $fields;
    }

    public function getErrorMessage() {
        return $this->errorMessage;
    }

    public function validate() {

        foreach ($this->fields as $fieldName => $field) {
            if (!isset($field[0][$fieldName])) {
                $this->errorMessage = "Error. El campo " . $fieldName . " debe ser de tipo \"" . $field[1] . "\"";
                return false;
            }
            if (!$this->validateRequired($fieldName, $field)) {
                $this->errorMessage = "Error. El campo " . $fieldName . " está vacío.";
                return false;
            }
            if (!$this->validateType($fieldName, $field)) {
                $this->errorMessage = "Error. El campo " . $fieldName . " debe ser de tipo \"" . $field[1] . "\"";
                return false;
            }
        }
        return true;
    }

    private function validateRequired($fieldName, $field) {
        if (isset($field[2]) && $field[2] == true) {
            return $field[0][$fieldName] != "";
        }

        return true;
    }

    private function validateType($fieldName, $field) {

        if ($field[1] == "entero") {
            return filter_var($field[0][$fieldName], FILTER_VALIDATE_INT) || $field[0][$fieldName] === "0";
        } else if ($field[1] == "email") {
            return filter_var($field[0][$fieldName], FILTER_VALIDATE_EMAIL);
        } else if ($field[1] == "fecha") {
            return $this->validate_date($field[0][$fieldName]);
        } else if ($field[1] == "verdadero o falso") {
            return filter_var($field[0][$fieldName], FILTER_VALIDATE_BOOLEAN);
        }

        return true;
    }

    private function validate_date($fecha) {
        if (ereg("(0[1-9]|[12][0-9]|3[01])[-](0[1-9]|1[012])[-](19|20)[0-9]{2}", $fecha)) {
            return true;
        } else {
            return false;
        }
    }

}
