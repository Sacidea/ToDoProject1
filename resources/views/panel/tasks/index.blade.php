@extends('panel.layout.app')






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

    





        <h3>Tasklar</h3>

        <!--Kategori oluştur sayfasına yönlendirme  butonu-->
        <a href="{{route('panel.createTaskPage')}}" type="button" class="btn btn-primary">Yeni Task Oluştur</a>
          

    </div>

    <div class="card-body">
      <h5 class="card-header">Task Listesi</h5>
      <p class="ms-2">Task Listesi aşağıdaki tabloda bulunmaktadır.</p>

 <div class="table-responsive text-nowrap">

      <!-- ilk elemanı kontrol edecek task olup olmamasına göre iki durum var -->
      
      @if($tasks->first() ) 

        <table class="table table-striped table-dark">
          <thead>
             <tr>
           
          
             </tr>
          </thead>
          <tbody>
            @foreach($tasks as $t)
              <tr>
                 
                <td > {{$t->content}}</td>
              </tr>

            @endforeach
          </tbody>
        </table>
      
         

                  
                  
      @else
      
  <p class="text-white bg-warning rounded-pill py-5 px-5 d-inline">  Henüz Task Oluşturulmadı. </p>
  @endif

                </div>

    </div>   
</div>





@endsection