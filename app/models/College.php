<?php
use Nicolaslopezj\Searchable\SearchableTrait;
class College extends \Eloquent {
	use SearchableTrait;
	protected $fillable = [];
	protected $primaryKey = 'coid';
	protected $table = 'college';  
	public function schools(){
    return $this->hasMany('School','coid');
	}
	public function province(){
    return $this->belongsTo('Province','provinceID');
    }
	protected $searchable = [
        'columns' => [
            'name' => 10,
        ],
    ];
}