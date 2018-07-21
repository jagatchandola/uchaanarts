<?php
/**
 * @File Testimonials.php
 * @Project Uchaanarts
 * @Author: Jagat Prakash
 * @Date: 20/07/18
 * @Time: 11:00 AM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonials extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'testimonials';

    public function getTestimonials() {
        $testimonials = Testimonials::where('status', '1')
                    ->get();
        
        if (!empty($testimonials)) {
            return $testimonials;
        }

        return [];
    }

}
