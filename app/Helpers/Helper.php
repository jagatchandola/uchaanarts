<?php

namespace App\Helpers;

class Helper
{

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

    public static function getImage($image, $type = 0){

        $img = '/image/dummy-400x400.jpg';
        switch ($type) {
            case 0:
                //$img = '/img/swagatika.jpg';
                if(is_file(public_path(config('constants.uploads.arts').$image))) {
                    $img = config('constants.uploads.arts').$image;
                }
                break;

            case 1:
                //$img = '/img/swagatika.jpg';
                if(is_file(public_path(config('constants.uploads.artists').$image))) {
                    $img = config('constants.uploads.artists').$image;
                }
                break;

            case 2:
                //$img = '/img/swagatika.jpg';
                if(is_file(public_path(config('constants.uploads.testimonials').$image))) {
                    $img = config('constants.uploads.testimonials').$image;
                }
                break;

            case 3:
                //$img = '/img/swagatika.jpg';
                if(is_file(public_path(config('constants.uploads.events').$image))) {
                    $img = config('constants.uploads.events').$image;
                }
                break;
            case 4:
                //$img = '/img/swagatika.jpg';
                if(is_file(public_path(config('constants.uploads.memorable').$image))) {
                    $img = config('constants.uploads.memorable').$image;
                }
                break;
            case 5:
                //$img = '/img/swagatika.jpg';
                if(is_file(public_path(config('constants.uploads.category').$image))) {
                    $img = config('constants.uploads.category').$image;
                }
                break;
            case 6:
                //$img = '/img/swagatika.jpg';
                if(is_file(public_path(config('constants.uploads.banner').$image))) {
                    $img = config('constants.uploads.banner').$image;
                }
                break;
            case 7:
                //$img = '/img/swagatika.jpg';
                if(is_file(public_path(config('constants.uploads.media').$image))) {
                    $img = config('constants.uploads.media').$image;
                }
                break;
        }

        return $img;

    }
    
    public static function saveImage($image, $type='0') {
        switch ($type) {
            case 0:
                $img = '/img/swagatika.jpg';
                if(is_file(public_path(config('constants.uploads.art').$image))) {
                    $img = config('constants.uploads.art').$image;
                }
                break;
        }
    }
    
    public static function getFormattedDate($date) {
        return date('jS M Y', strtotime($date));
    }
    
    public static function getFormattedPrice($price) {
        return number_format($price);
    }

    public static function nameFormat($name){
        return preg_replace('/\s+/','-',strtolower($name));
    }

    public static function readMore($str , $link ='' ,$len=100){
        if(strlen($str) == 0) return;
        if(strlen($str) > $len){
            $str = substr($str, 0, $len) . '...<a href="'.($link != '' ? $link : 'javascript:;').'" class="read-more-btn sep-text">Read More</a>';
        }
        return $str;
    }
}//END CLASS