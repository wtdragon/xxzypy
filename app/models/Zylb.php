<?php
use Nicolaslopezj\Searchable\SearchableTrait;
class Zylb extends \Eloquent {
	use SearchableTrait;
	protected $fillable = [];
	protected $table = 'zylb';  
	public function province(){
    return $this->belongsTo('Province','provinceID');
    }
	protected $searchable = [
        'columns' => [
            'zymingcheng' => 20,
            'coid'       =>10,
        ],
    ];
	
}