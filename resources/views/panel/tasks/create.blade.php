@extends('panel.layout.app')






@section('content')
    <!-- Sadece içerik -->
    <div class="card p-3">
    <div class="card-header"><h2>GÖREV OLUŞTUR</h2></div> 

    <div class="card-body">
        <form action="{{ route('panel.addTask') }}" method="POST">
            @csrf
            <!-- Form elemanları -->
             <input type="hidden" name="user_id" value="{{ auth()->id() }}">   <!--***********-->
            
            <label for="defaultFormControlInput" class="form-label">Başlık</label>
            <input name="title" type="text" class="form-control" id="defaultFormControlInput" placeholder="" aria-describedby="defaultFormControlHelp" >


            <label for="defaultFormControlInput" class="form-label">İçerik</label>
            <input name="content" type="text" class="form-control" id="defaultFormControlInput" >

            <label for="defaultFormControlInput" class="form-label">Kategori</label>
            <select name="category_id" class="form-control" value="" >
                <option selected value="" disabled selected>Kategori seçiniz</option>

                @foreach($categories as $c) <!--Bu scop ile db kategorileri kayıtlarını select elemanında gösterecek-->
                <option value="{{$c->id}}" > {{$c->name }}  </option>
                @endforeach
               
                
            </select> 

           <label for="defaultFormControlInput" class="form-label">Durum</label>
            <select name="status" class="form-control" value="">
                <option selected value="" disabled>Durum seçiniz</option>
                <option value="0">YAPILMADI</option>
                <option value="1">YAPILIYOR</option>
                <option value="2">ERTELENDİ</option>
                <option value="3">İPTAL OLDU</option>
                
            </select>


             <label for="defaultFormControlInput" class="form-label">Bitiş Tarihi</label>
             <input name="deadline"type="datetime-local" class="form-control" id="" >


             <button type="submit" class=" btn btn-success mt-3">KAYDET</button>

            <div id="defaultFormControlHelp" class="form-text"></div>
          </div>
        </form>
        
    </div>
    </div>
  
@endsection