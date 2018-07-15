<?php
/**
 * @File Events.php
 * @Project Uchaanarts
 * @Author: Jagat Prakash
 * @Date: 15/07/18
 * @Time: 11:00 AM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'events';

    public function getAllEvents() {
        $events = Events::where('shide', 1)
                    ->orderBy('start_date', 'desc')
                    ->get();

        if (!empty($events)) {
            return $events;
        }

        return [];
    }
    
}
