<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Session;
use DB;
use PDO;

class Emailque extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_email_que';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
	
   
    
 }
