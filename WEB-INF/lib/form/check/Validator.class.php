<?php
// +----------------------------------------------------------------------+
// | WR Time Tracker
// +----------------------------------------------------------------------+
// | Copyright (c) 2004-2006 WR Consulting (http://wrconsulting.com)
// +----------------------------------------------------------------------+
// | LIBERAL FREEWARE LICENSE: This source code document may be used
// | by anyone for any purpose, and freely redistributed alone or in
// | combination with other software, provided that the license is obeyed.
// |
// | There are only two ways to violate the license:
// |
// | 1. To redistribute this code in source form, with the copyright
// |    notice or license removed or altered. (Distributing in compiled
// |    forms without embedded copyright notices is permitted).
// |
// | 2. To redistribute modified versions of this code in *any* form
// |    that bears insufficient indications that the modifications are
// |    not the work of the original author(s).
// |
// | This license applies to this document only, not any other software
// | that it may be combined with.
// |
// +----------------------------------------------------------------------+
// | Contributors: Igor Melnik <igor.melnik@mail.ru>
// +----------------------------------------------------------------------+

class Validator {

    var $errorMsg;
    var $string;

    function Validator ($value="") {
    	$this->string=$value;
        $this->errorMsg=array();
        $this->validate();
    }

    function validate() {
        // Superclass method does nothing
    }

    function setError($msg) {
        $this->errorMsg[]=$msg;
    }

    function isValid() {
        if ( count($this->errorMsg)>0 ) {
            return false;
        } else {
            return true;
        }
    }

    function getError() {
        return array_pop($this->errorMsg);
    }
    
    function validateEmptyString() {
    	if (strlen($this->string) == 0  ) {
            $this->setError('Value is empty');
        }
    }
    
    function validateSpaceString() {
    	if (strlen(trim($this->string)) == 0  ) {
            $this->setError('Value is empty');
        }
    }
    
    // cyrillic symbols, latin, digit
    function validateCyrillicCharset() {
       	if (!preg_match('/^[à-ÿÀ-ßa-zA-Z0-9_.,\s]+$/',$this->string )) {
            $this->setError('Value contains invalid characters');
        }
	}
	
	function validateLatinCharset() {
		if (!preg_match('/^[a-zA-Z0-9_.,!"#@$%\^&\*]+$/',$this->string )) {
            $this->setError('Value contains invalid characters');
    	}
	}
	
	// only digital
	function validateDigital() {
	    if (!preg_match('/^[0-9.,]+$/',$this->string )) {
            $this->setError('Value contains invalid characters');
        }
	}
	
	// only integer
	function validateInteger() {
	    if (!preg_match('/^[0-9]+$/',$this->string )) {
            $this->setError('Value contains invalid characters');
        }
	}
	
	// only float
	function validateFloat($lim="") {
		if (!$lim) $lim = ".";
		$this->validateEmptyString();
	    if (!preg_match('/^[0-9'.$lim.']+$/',$this->string )) {
            $this->setError('Value contains invalid characters');
        }
	}
	
	function validateEmail() {
	    if (!preg_match('/^[0-9a-zA-Z_.@\-\+]+$/',$this->string )) {
            $this->setError('Value contains invalid characters');
        }
	}
}

/**
 *  ValidatorText subclass of Validator
 *  Validates a text
 */
class ValidateText extends Validator {

    var $string;

    function ValidateText($value) {
        $this->string=$value;
        Validator::Validator();
    }

    function validate() {
    	if (strlen($this->string) == 0  ) {
            $this->setError('Value is empty');
        }
    }
}

/**
 *  ValidatorSimpleText subclass of Validator
 *  Validates a text
 */
class ValidateSimpleText extends Validator {

    var $string;

    function ValidateSimpleText($value) {
        $this->string=$value;
        Validator::Validator();
    }

    function validate() {
    	if (strlen($this->string) == 0  ) {
            $this->setError('Value is empty');
        }
        // ğóññêèå ñèìâîëû, ëàòèíñêèå ñèìâîëû, ïîä÷åğêèâàíèå, ïğîáåë, öèôğû
    	if (!preg_match('/^[à-ÿÀ-ßa-zA-Z0-9_\s]+$/',$this->string )) {
            $this->setError('Value contains invalid characters');
        }
    }
}

/**
 *  ValidatorDigital subclass of Validator
 *  Validates a digital
 */
class ValidateDigital extends Validator {

    var $string;

    function ValidateDigital($value) {
        $this->string=$value;
        Validator::Validator();
    }

    function validate() {
        if (strlen($this->string) == 0  ) {
            $this->setError('Value is empty');
        }
    	if (!preg_match('/^[0-9.,]+$/',$this->string )) {
            $this->setError('Value contains invalid characters');
        }
    }
}

/**
 *  ValidatorUser subclass of Validator
 *  Validates a username
 */
class ValidateUser extends Validator {

    var $user;

    function ValidateUser ($user) {
        $this->user=$user;
        Validator::Validator();
    }

    function validate() {
        if (!preg_match('/^[a-zA-Z0-9_]+$/',$this->user )) {
            $this->setError('Username contains invalid characters');
        }
        if (strlen($this->user) < 4 ) {
            $this->setError('Username is too short');
        }
        if (strlen($this->user) > 20 ) {
            $this->setError('Username is too long');
        }
    }
}

/**
 *  ValidatorPassword subclass of Validator
 *  Validates a password
 */
class ValidatePassword extends Validator {
    var $pass; // ïàğîëü
    var $conf; // ïîäòâåğæäåíèå ïàğîëÿ

    function ValidatePassword ($pass,$conf) {
        $this->pass=$pass;
        $this->conf=$conf;
        Validator::Validator();
    }

    function validate() {
        if ($this->pass!=$this->conf) {
            $this->setError('Passwords do not match');
        }
        if (!preg_match('/^[a-zA-Z0-9_]+$/',$this->pass )) {
            $this->setError('Password contains invalid characters');
        }
        if (strlen($this->pass) < 3 ) {
            $this->setError('Password is too short');
        }
        if (strlen($this->pass) > 20 ) {
            $this->setError('Password is too long');
        }
    }
}

class ValidateEmail extends Validator {
    var $email;

    function ValidateEmail ($email){
        $this->email=$email;
        Validator::Validator();
    }

    function validate() {
        $pattern="/^([a-zA-Z0-9])+([\.a-zA-Z0-9_-])*@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-]+)+/";
        if(!preg_match($pattern,$this->email)){
            $this->setError('Invalid email address');
        }
        if (strlen($this->email)>100){
            $this->setError('Address is too long');
        }
    }
}
?>