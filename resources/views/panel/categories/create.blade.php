@extends ('panel.layout.app')


@section('content') 


<div class="card p-4">
   <div class="card-header">

   
 
      <h2>Kategori Oluştur</h2>
  </div>

  <div class="card-body ">   

 

 

    <form action="{{route('panel.categoryAdd')}}" method='post'>
      @csrf

    <div class="mb-4">
                        <label for="exampleFormControlInput1" class="form-label">Kategori Adı</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="category_name"  placeholder="Lütfen kategori adı giriniz">
                      </div>


                      <div class="mb-4">
                        <label for="exampleFormControlInput1" class="form-label mt-3">Kategori Durumu</label>
                        <select name="category_status" id="" class="form-control">
                           <option value="0">Aktif</option>
                            <option value="1">Pasif</option>
                        </select>
                      </div>


                     <button type="submit" class="btn btn-info">Kaydet</button>
                     </form>
 
   </div>
 
 </div>
 @endsection