<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class CategoryController extends Controller
{
    public function index(){  //Kategori Listesinin olduğu sayfayı döndürecek bilgileri database den çekecek

        //$kategoriler = Category::get();  //Model/Category:db de categories tablosundaki herbir satırdaki  elemanlara get ile ulaşacak
        //bu kod kullanıcı ayırt etmeden tüm listeyi getirir bu nedenle aş kod ile sadece her kullanıcı kendi listesini görecek
        $kategoriler =Category::where('user_id',Auth::id())->get(); //Category modelini kullanarak sorgu oluştur where ile filtrele user_id sütununda
                                                                    //Auth:id() ile şu anda giriş yapmış kullanıcının ID sine eşit olan kayıtları getir
                                                                    //get() sorguyu çalıştırıp sonuçları kolleksiyon olarak alma
        //$kategoriler=Auth::user()->getCategory();//getCategory 1 user ile çalıştığından Auth ile kullanmalıyız Bu kod çalışmadı
        return view('panel.categories.index', compact('kategoriler'));
    }



    public function createPage(){  //yeni kategori  sayfasını döndürecek
        

        
        return view('panel.categories.create');

    

}
    public function postCategory(Request $request ){   //Yeni kategori oluşturacak fonksiyon
        

        $input=new Category();
        $input->name=$request->category_name;   //input database ile, request html sayfası ile bağlantılı

        if($request->category_status=='Aktif'){  //Database te boolean değer olduğu için bu şekilde alınmalı
            $input->is_active=1;
        }
        else{
            $input->is_active=0;
        }

        //$user=Auth::user();//hazır bir kod sisteme giriş yapan user  bilgisini döner (parametre ile almıyoruz)
        $input->user_id=Auth::id(); //giriş yapan kullanıcının id sine database de user_id kısmına atayacak
        $input->save();  //database e kaydet
        
        //return "Kaydedildi";

        return redirect()->route('panel.categoryindex')->with(['success'=>'Kategori Başarıyla Kaydedildi']); //kaydetti bilgisi ve kategoriler listesi sayfasına döndürür.
                                                                                                            //with nesne döndürmez compact nesne döndürür

                                                                                                    
    }
    //Güncellenecek datayı bulma
    public function updatePage($a){


    $category = Category::find($a); 
    return view('panel.categories.update', compact('category'));

    }

    //Güncelleme
    public function updateCategory(Request $request){
        //dd($request->all());  //upname, upstatus, categoryId

        $request->validate([ //fonk nu bir dizi alır ve 'form_elemanı_name=>'kural1'|'kural2'| şeklinde devam eder
            'upstatus'=>'min:0|max:1|boolean',
            'upname'=>'min:3|max:20|required'

        ] /*,['upname.min'=>'Kategori adı daha uzun olmalıdır.',           //tr dilini eklediğimiz için elle yazdığımız mesajlara gerek yok
           'upname.max'=>'Kategori adı en fazla 20 karakter olabilir.',
           'upname.required'=>'Kategori adı zorunludur.'
        ]*/);

        $category=Category::find($request->categoryId); 

        if($category!=null){      //kategori id sini değiştirip olmayan bir veri ile işlem yapılmaya çalışılma durumunda hata mesajı verilecek
        $category->name=$request->upname;
        $category->is_active=$request->upstatus;
        $category->save();
        return redirect()->route('panel.categoryindex' )->with(['success'=>'Kategori Başarıyla Güncellendi.']);
    }


        else{
            return redirect()->route('panel.categoryindex' )->with(['errors'=>'Bir hata oluştu. Lütfen tekrar deneyiniz.']);


        }

        
    }
      //parametre kullanarak silme işlemi
      public function categoryDelete($id){
        $category=Category::find($id);  //Model/Category:db de categories tablosundaki herbir satırın tamsili 
        $category->delete(); 
        if($category->deleted_at==null)
        return redirect()->route('panel.categoryindex' )->with(['success'=>'Kategori Başarıyla Silindi.']);
        else
         return redirect()->route('panel.categoryindex' )->with(['errors'=>'Bir hata oluştu.']);


      } 
}  


