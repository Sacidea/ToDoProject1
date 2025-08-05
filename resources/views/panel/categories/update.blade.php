@extends('panel.layout.app')


@section('content') 
   



<div class='card p-4'>
    <div class="card-header">

<h3>Kategori Güncelle</h3>


 </div>



<div class="card-body">


 <!--any kullanarak birdençok hata mesajını gösterme-->
    @if($errors->any()) <!--varsa if i çalıştırır-->
     <div class="alert alert-danger ">
       <ul>
         @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
          @endforeach
       </ul>      
         
    </div>

    @endif
  
  

  <form action="{{route('panel.updateCategory',$category->id)}}" method="POST">
    @csrf

    <input type="hidden"   name="categoryId" value="{{$category->id}}" >
    <label for="">Kategori Adı : </label>
    <input type="text" class="form-control" name="upname" value="{{$category->name}}">

    <label for="" class="mt-4">Kategori Durumu : </label>
    <select class="form-control" name="upstatus">
        <option value="1" @if ($category->is_active==1) selected  @endif>Aktif</option>
        <option value="0" @if ($category->is_active==0) selected @endif>Pasif</option>
    </select>

        <button type="submit" class="btn btn-primary mt-3">Güncelle</button>
  </form>


</div>

</div>



@endsection