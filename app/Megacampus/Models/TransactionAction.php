<?php 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class TransactionAction extends Model {
	 
	use SoftDeletes;

	
	protected $table = 'transaction_actions';

	public $timestamps = true;

	protected $dates = ['deleted_at'];  //for SoftDelete
    

	
}
