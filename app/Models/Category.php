<?php
//Bu model sınıfı ile controller işlemlerinde nesne oluşturacağız bu nesneyi categories db tablosunun her bir
// satırı temsil edecek ve bu elemanın id, name gibi özelliklerine ulaşmamızı sağlayacak
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes; 
use App\Models\User;
use App\Models\Task;

class Category extends Model
{
    use HasFactory; 
    use SoftDeletes; //Migration de softdelete komutunun çalışması için modele tanıtma işlemi

    protected $table='categories';


    public function getTasks(){
        return this->hasMany(Task::class, 'category_id','id');//foreign key sonra local key yazılır

    }



    public function getUser(){

        return $this->belongsTo(User::class, 'user_id','id');
    }
}
    