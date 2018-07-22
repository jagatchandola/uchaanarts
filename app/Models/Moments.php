<?php
/**
 * @File Moments.php
 * @Project Uchaanarts
 * @Author: Jagat Prakash
 * @Date: 22/07/18
 * @Time: 11:00 AM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Moments extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'moments';

    public function getAllMoments() {
        $moments = Moments::where('is_active', 1)
                    ->orderBy('id', 'desc')
                    ->get();

        if (!empty($moments)) {
            return $moments;
        }

        return [];
    }

}
