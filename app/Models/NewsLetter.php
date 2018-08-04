<?php
/**
 * @File Artists.php
 * @Project Uchaanarts
 * @Author: Jagat Prakash
 * @Date: 15/07/18
 * @Time: 11:00 AM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;

class NewsLetter extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'news_letter';

    public function add($input) {
       
       $newsLtr = DB::table('news_letter')->insert([ 'email' => $input['email'] ]);

        if (!empty($newsLtr)) {
            return $newsLtr;
        }

        return [];
    }
    
    
}
