<?php

class Province extends \Eloquent {
	protected $fillable = [];
	protected $table = 'province';  
	protected $primaryKey = 'provinceID';
	public function cities(){
    return $this->hasMany('City','provinceID');
	}
	public function colleges(){
    return $this->hasMany('College','provinceID');
	}
}