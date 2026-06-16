<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Session;
use DB;
use PDO;

class Leads extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_leads';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
	
	public function property()
    {
        return $this->belongsTo(Property::class, 'listing_id');
    }
   
    
 }
