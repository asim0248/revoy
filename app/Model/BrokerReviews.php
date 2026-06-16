<?php namespace App\Model;







use Illuminate\Database\Eloquent\Model;



use DB;



use PDO;



class BrokerReviews extends Model



{



    /**



     * The database table used by the model.



     *



     * @var string



     */



    protected $table = 'tbl_broker_reviews';



    //public $timestamps = false;



	

	public function agent()

    {

        return $this->belongsTo(Brokers::class, 'user_id');

    }



    

	public static function rating_reviews($user_id){

      

       $result=DB::select( DB::raw("SELECT COUNT(star_rating) AS total_reviews, SUM(star_rating) AS total_stars, AVG(star_rating) AS average_star_rating FROM tbl_broker_reviews  

			WHERE

				  user_id = '".$user_id."'  AND admin_status = 'Yes' 

			") );

        $result = json_decode(json_encode($result), true);

		return $result[0];

    }

}



