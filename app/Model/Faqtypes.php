<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Session;
use DB;
use PDO;

class Faqtypes extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_faq_types';
    protected $primaryKey = 'id';
	public $timestamps = false;
    
    
    
    
	
}
