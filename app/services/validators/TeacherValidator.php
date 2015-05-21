<?php

namespace App\Services\Validators;

class TeacherValidator extends Validator {
 
    public static $rules = array(
        'teachername' => 'required',
        'emailaddress' => 'required',
        'phone' => 'required'
    );
}