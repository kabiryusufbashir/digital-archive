<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'status',
        'user_id',
    ];


    public function postedBy($id){
        if($id){
            $user = User::where('id', $id)->first();
            if(!empty($user)){
                $posted_by = $user->name;
                return $posted_by;
            }else{
                return '';
            }
        }else{
            return '';
        }
    }

    public function docCategory($id){
        if($id){
            $category = Category::where('id', $id)->first();
            if(!empty($category)){
                $category_name = $category->name;
                return $category_name;
            }else{
                return '';
            }
        }else{
            return '';
        }
    }

    public function dateFormat($date){
        if($date){
            //l : a full textual representation of a day
            //F : a full textual representation of a month
            $date_format = date('H:i:s l d, F Y', strtotime($date));
                return $date_format;
        }else{
            return '';
        }
    }
}
