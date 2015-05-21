<?php

class Ktest extends \Eloquent {
	protected $fillable = [];
	public function colleges(){
    return $this->belongsTo('College','co_id');
    }
	public function student(){
    return $this->belongsTo('Student','stuid');
    }
}