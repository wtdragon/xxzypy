<?php

namespace App\Services\Validators;

class AdminValidator extends Validator {
 
    public static $rules = array(
        'classname' => 'required'
    );
}