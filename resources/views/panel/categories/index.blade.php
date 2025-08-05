@extends('panel.layout.app')

<!--Bu html sayfası db tablosundan verilerin listesinin olduğu sayfa-->

@section('content')
<div class='card p-3'>  
    <div class="card-header">

     <!--CategoryController sayfasında yeni kategori oluşturduktan sonra bu sayfaya döndüğünde görünecek mesaj-->
      @if(session('success')) 
        

            <div class="alert alert-success alert-dismissible" role="alert">
                        {{session('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>

      @endif

    





        <h3>Kategoriler</h3>

        <!--Kategori oluştur sayfasına yönlendirme  butonu-->
        <a href="{{route('panel.categoryCreatePage')}}" type="button" class="btn btn-primary">Yeni Kategori Oluştur</a>
          

    </div>

    <div class="card-body">
      <h5 class="card-header">Kategori Listesi</h5>
      <p class="ms-2">Kategori Listesi aşağıdaki tabloda bulunmaktadır.</p>

    
         

 <div class="table-responsive text-nowrap">

      <!--Hiç kategori yoksa ilk elemanı kontrol edecek -->
      
      @if($kategoriler->first() )  
         

                  <table class="table">
                    <thead>
                      <tr>
                         
                        <th>KATEGORİ ADI</th>
                        <th>DURUM</th>
                        <th>OLUŞTURULMA TARİHİ</th>
                        <th>İŞLEMLER</th>
                      </tr>
                    </thead>

                    <tbody class="table-border-bottom-0">

                      @foreach ($kategoriler as $item) <!-- kategoriler controller sınıfı içinde bu sayfa ile bağlantılı fonksiyonda oluştorduğumuz
                                                        Model nesnesi-->
                          <tr class="table-default">
                        
                        <td>
                          <!--<i> html italik yazdırmak için kullanılır-->
                          <i class="icon-base bx bxl-sketch icon-md text-warning me-4"></i> <span>{{$item->name}}</span>
                        </td>
                        <td>
                        @if($item->is_active==1)<!-- database den gelen boolen değerlerin pasif-aktif olatrak sayfada görünmesi için if else kodu-->
                          Aktif
                          @else
                          Pasif
    
                         @endif

                        </td>

                         <!--sadece creat_at db verisinin ne zaman eklendiğini gösterir diffForhumans eklenirse şimdiye göre kaç hafta veya kaç ay önce oluşturduğunu gösterir-->
                        <td>{{$item->created_at->diffForHumans()}}</td>
                        <td>
                          <a href="{{route('panel.categoryUpdatePage',$item->id)}}" class='btn btn-outline-warning'>Güncelle</a>
                          <!--değişkenin(db categori tablosu türündeki değişken) id 'sini url ile gönderiyoruz-->   
                          <a href="{{route('panel.categoryDelete',$item->id)}}" class='btn btn-outline-danger'>Sil</a> 
                


                        </td>
                        
                      </tr>
                      @endforeach
                      
                      
                     
                      
       
                    </tbody>
                  </table>

      @else
      
  <p class="text-white bg-warning rounded-pill py-5 px-5 d-inline">  Henüz Kategori Oluşturulmadı. </p>
  @endif

                </div>

    </div>   
</div>
@endsection