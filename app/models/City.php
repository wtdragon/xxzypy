<?php

class City extends \Eloquent {
	protected $fillable = [];
	protected $table = 'city';  
	protected $primaryKey = 'cityID';
	public function areas(){
    return $this->hasMany('Area','cityID');
  }
}