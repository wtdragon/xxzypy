<?php

class Teacher extends \Eloquent {
	protected $fillable = [];
	public function sclass(){
    return $this->belongsTo('Sclass','sclassid');
    }
	public function school(){
    return $this->belongsTo('Mschool','mschoolid');
    }
}