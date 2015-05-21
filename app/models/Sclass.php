<?php

class Sclass extends \Eloquent {
	protected $table = 'sclasses';  
	protected $fillable = [];
	public function teacher(){
    return $this->belongsTo('Teacher','tid');
	}
	public function students(){
    return $this->hasMany('Student');
	}
	public function school(){
    return $this->belongsTo('Mschool','schoolid');
    }
	public function grade(){
    return $this->belongsTo('Grade','gradeid');
    }
}