<?php

class Student extends \Eloquent {
	protected $fillable = [];
	public function sclass(){
    return $this->belongsTo('Sclass','sclassid');
    }
	public function school(){
    return $this->belongsTo('Mschool','mschoolid');
    }
	public function teachers(){
    return $this->hasMany('Teacher');
	}
}