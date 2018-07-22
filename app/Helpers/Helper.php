<?php

namespace App\Helpers;

class Helper
{
    /**
     * Check user is authenticated or not.
     * @return boolean true/false
     */
    public static function calculatePrice($data){
        $amount = $data['price'];
        $amount += ($data['price'] * config('app.commission'))/100;
        $amount += ($amount * $data['gst'])/100;

        if (!empty($data['discountValue'])) {            
            $amount = $data['discountType'] == 'fixed' ? 
                        ($amount - $data['discountValue']) :
                        ($amount - ($amount * $data['discountValue'])/100);
        }

        return ceil($amount);
    }

    public static function getImage($image, $type='0'){

        $img = '/img/swagatika.jpg';
        switch ($type) {
            case 0:
                $img = '/img/swagatika.jpg';
                if(is_file('/uploads/arts/'.$image)) {
                    $img = '/uploads/arts/'.$image;
                }
                break;

            case 1:
                $img = '/img/swagatika.jpg';
                if(is_file('/uploads/artists/'.$image)) {
                    $img = '/uploads/artists/'.$image;
                }
                break;
        }

        return $img;

    }
    
}//END CLASS