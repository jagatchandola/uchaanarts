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
use DB;

class Testimonials extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'testimonials';

    public function getTestimonials($all = 0) {
       
        $testimonials = DB::table('testimonials');
        if($all == 0){
            $testimonials->where('status', '=', 1);
        }
                            
        $testimonials = $testimonials->orderBy('date_created', 'ASC')
        ->get();
        
        if (!empty($testimonials)) {
            return $testimonials;
        }

        return [];
    }

    public function getTestimonialDetails($testimonial_id = '') {
        
        $testimonials = DB::table('testimonials');
                
        if($testimonial_id != '')
            $testimonials->where('id', $testimonial_id);

        $testimonials = $testimonials->get()
                         ->toArray();

        if (!empty($testimonials)) {
            return $testimonials;
        }

        return [];
    }

    public function updateTestimonialStatus($testimonial_id, $status) {
        
        $updateStatus = DB::table('testimonials')
            ->where('id', $testimonial_id)
            ->update(['status' => $status]);
        
        //var_dump($updateStatus);exit;
        if ($updateStatus >= 1) {
            return true;
        }
        return false;
    }

    public function updateTestimonial($data) {

        $where = ['name' => $data['name'], 'designation' => $data['designation'], 'content' => $data['content'], 'status' => $data['status']];

        if (!empty($data['image'])) {
            $where['image'] = $data['image'];
        }
        $updateStatus = DB::table('testimonials')
            ->where('id', $data['testimonial-id'])
            ->update($where);
        
        if ($updateStatus >= 1) {
            return true;
        }
        return false;
    }

    public function addTestimonial($data) {
        
        $lastInsertId = DB::table('testimonials')->insertGetId(['name' => $data['name'], 'designation' => $data['designation'], 'content' => $data['content'], 'status' => $data['status'], 'image' => $data['image']]);

        if ($lastInsertId > 0) {
            return true;
        }
        
        return false;
    }

}
