<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Session;
use DB;
use PDO;

class Ecofriendlyfeatures extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_eco_friendly_features';
    protected $primaryKey = 'id';
	public $timestamps = false;
    
    
    
    
	
}
