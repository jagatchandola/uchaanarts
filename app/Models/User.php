<?php
/**
 * @File Users.php
 * @Project Uchaanarts
 * @Author: Jagat Prakash
 * @Date: 16/07/18
 * @Time: 10:00 PM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';

//     public function authenticate($input) {
//         $matchThese = [
//                         'email' => $input['email'], 
//                         'password' => md5($input['password'])
//                     ];

//         $user = User::where($matchThese)
//                     ->get()
//                     ->toArray();
// // print_r($user);exit;
//         if (!empty($user)) {
//             return $user;
//         }

//         return [];
//     }
    
    // public function getEventDetails($event_id) {
    //     $events = Events::where('id', $event_id)
    //                 ->get();

    //     if (!empty($events)) {
    //         return $events[0];
    //     }

    //     return [];
    // }
}
