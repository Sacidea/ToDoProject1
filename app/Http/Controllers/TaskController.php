<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller


{
    
    public function createPage(){

        $categories=Category::where('user_id' , Auth::user()->id)->get();
        
        return view('panel.tasks.create', compact('categories'));//Burada $categories'i tanımladıktan sonra panel/Task/create dosyasında $categories değişkeni
                                                                 // compact ile sayfaya gönderilmeli yazmadığında undefined hatası verir.


    }



    public function addTask(Request $req) {
        //dump and die
        //dd($req->all());

        //validasyon(doğrulama)  
        $req->validate([  //form elemanından gelen veriler belirlediğimiz özellikte olup olmadığı kontrol edilecek
            'title'=>'required|max:15|min:3'
        ]);

        //dd($task);
        
        $user=Auth::user();
        $task=new Task();
          if ($user) { // Kullanıcı giriş yapmışsa
            $task->user_id = $user->id;
        $task->category_id=$req->category_id;  
        $task->title = $req->title;
        $task->content = $req->content;
        $task->status = $req->status;
        $task->deadline =$req->deadline;
        $task->save();
        } else {
            // Kullanıcı giriş yapmamışsa hata yönetimi
            abort(403, 'Bu işlemi yapmak için giriş yapmalısınız');
            }

        return redirect()->route('panel.indexTask')->with(['success','Task Başarıyla Eklendi']);
    }
    
    public function indexPage(){

        //$tasks=new Task();
        $user=Auth::user();
        
    $tasks = $user->getTasks()->with('getCategory')->get();
        //$tasks=$user->getTasks;
        //$kategori=$tasks->getCategory ;//tablolar birbiriyle ilişkili olduğunda metodun parantezi kullanılmaz hata verir
        //$user=$kategori->getUser;     //bu controllersaydalarında tanımlıyoruz

        return view('panel.tasks.index', compact('tasks'));//$tasks $ olmadan yazmalıyız burda
    } 

    

}
