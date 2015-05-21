<?php

namespace App\Services\Validators;

class GradeValidator extends Validator {
 
    public static $rules = array(
        'gradename' => 'required'
    );
}