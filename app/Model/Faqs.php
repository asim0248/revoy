<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use PDO;

class Faqs extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_faq';
    protected $primaryKey = 'id';
       public $timestamps = false;
    
    
 }
