<?php

class Mschool extends \Eloquent {
	protected $fillable = [];
	public function classes(){
    return $this->hasMany('Sclass','sclassid');
	}
	public function teachers(){
    return $this->belongsTo('Teacher','tcid');
	}
}