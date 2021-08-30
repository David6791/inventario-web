<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denomination extends Model
{
    use HasFactory;

    protected $fillable = [
        'type','value','image'
    ];
    public function getImagenAttribute(){
        if(!empty($this->image)){
            if(file_exists('storage/denominaciones/' . $this->image)){
                return $this->image;
            }else{
                return 'default.png';
            }
        }else{
            return 'default.png';
        }
    }
}
