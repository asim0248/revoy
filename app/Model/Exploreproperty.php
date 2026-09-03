<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use PDO;
class Exploreproperty extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_explore_property';
   
	 public $timestamps = false;
	
    
}
