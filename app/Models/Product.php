<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','barcode','alert','image','category_id'
    ];
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function getImagenAttribute(){
        if(file_exists('storage/productos/' . $this->image)){
            return $this->image;
        }else{
            return 'default.png';
        }
    }
}
