<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes; 
use App\Models\User;
use App\Models\Category;

class Task extends Model
{
    //
    use HasFactory;
    use SoftDeletes;
    protected $table='tasks';

    
    public function getCategory(){
        return $this->belongsTo(Category::class, 'category_id', 'id');

    }
     
   
}