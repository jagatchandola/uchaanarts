<?php
/**
 * @File Contactus.php
 * @Project Uchaanarts
 * @Author: Jagat Prakash
 * @Date: 20/07/18
 * @Time: 11:00 AM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Contactus extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contactus';

    public function insert($input) {
        $contactus = DB::table('contactus')->insert([
                            'uname' => $input['fname'] . ' ' . $input['lname'],
                            'uemail' => $input['email'],
                            'msg' => $input['message'],
                            'phone' => $input['mobile'],
                            'cdate' => date('Y-m-d H:i:s')
                    ]);

        if (!empty($contactus)) {
            return $contactus;
        }

        return [];
    }

    public function getAllMessages() {
        $contactus = Contactus::where('isvalid', 1)
                    ->orderBy('sno', 'desc')
                    ->get();
        
        if (!empty($contactus)) {
            return $contactus;
        }

        return [];
    }
}
