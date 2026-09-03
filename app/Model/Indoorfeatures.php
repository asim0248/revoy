<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Session;
use DB;
use PDO;

class Indoorfeatures extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_indoor_features';
    protected $primaryKey = 'id';
	public $timestamps = false;
    
    
    
    
	
}
