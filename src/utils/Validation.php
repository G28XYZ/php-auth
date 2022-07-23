<?php

namespace Utils;

require_once __DIR__ . '/constants.php';

use const constants\REG_FOR_NAME;
use const constants\REG_FOR_EMAIL;
use const constants\REG_FOR_SYMBOLS;
use const constants\REG_FOR_PASSWORD;
use const constants\errorMessages;

class Validation {
    protected const TABLE = 'validation';

    public $isPassword;
    public $isEmail;
    public $isName;

    public function validateEmail($email) {
        return !preg_match(REG_FOR_EMAIL, strtolower($email)) ? errorMessages['email'] : '';
    }

    public function validatePassword($password) {
        $password = strtolower($password);
        $haveSymbols = preg_match(REG_FOR_SYMBOLS, $password);
        $singleMatch = preg_match(REG_FOR_PASSWORD, $password);
        return (strlen($singleMatch) > 1 || $haveSymbols) ? errorMessages['password'] : '';
    }

    public function validateName($name) {
        $name = strtolower($name);
        $haveSymbols = preg_match(REG_FOR_SYMBOLS, $name);
        $singleMatch = strlen(preg_match(REG_FOR_NAME, $name));
        $numberMatch = preg_match('/[0-9]/', $name);
        return ($numberMatch || !$singleMatch || $singleMatch > 1 || $haveSymbols) ? errorMessages['name'] : '';
    }

    function checkValidation($data) {
        $this->isEmail = $this->validateEmail($data['email']);
        $this->isPassword = $this->validatePassword($data['password']);
        $this->isName = $this->validateName($data['name']);
        return !$this->isEmail && !$this->isPassword && !$this->isName;
    }


}