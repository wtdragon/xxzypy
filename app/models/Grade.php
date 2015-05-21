<?php

class Grade extends \Eloquent {
	protected $fillable = [];
	protected $table = 'grades';  
	public function sclasses(){
    return $this->hasMany('Sclass','sclassid');
    }
	public function school(){
    return $this->belongsTo('Mschool','mschoolid');
    }
	public function teachers(){
    return $this->hasMany('Teacher','tid');
	}
}