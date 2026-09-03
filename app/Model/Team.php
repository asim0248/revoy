<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Session;
use DB;
use PDO;

class Team extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_team';
    protected $primaryKey = 'id';
	 public $timestamps = false;
   
    
 }
