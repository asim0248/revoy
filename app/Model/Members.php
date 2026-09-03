<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use PDO;

class Members extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_members';
    protected $primaryKey = 'id';
    
    
    
 }
