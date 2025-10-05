@extends('layouts.app')
@section('content')
<div class="container">
  <div id="info-alert" class="alert alert-info d-none" role="alert"></div>
  <div class="d-flex justify-content-between mb-3">
    <h3>Müşteri Listesi</h3>
    <a href="{{ route('customers.create') }}" class="btn btn-primary">Müşteri Ekle</a>
  </div>
  <table id="customers-table" class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Müşteri Kodu</th>
        <th>Müşteri Adı</th>
        <th>Adres</th>
        <th>Telefon</th>
        <th>Email</th>
        <th>Oluşturan Kullanıcı</th>
        <th>Oluşturma Tarihi</th>
        <th>Güncelleyen Kullanıcı</th>
        <th>Güncelleme Tarihi</th>
        <th>İşlem</th>
      </tr>
    </thead>
  </table>
</div>
@endsection

@push('scripts')
<script>
$(function(){
  const $alertBox = $('#info-alert');
  
  $('#customers-table').DataTable({
    processing:true,
    serverSide:true,
    ajax:
    {
      url: '{!! route("customers.index") !!}',
      data: function (d) {
        if (d.length === 1000) {
          $alertBox
            .removeClass('d-none alert-danger')
            .addClass('alert-info')
            .html('<strong>Bilgi:</strong> Performans nedeniyle en fazla 1000 kayıt görüntülenmektedir. Geri kalan kayıtlara sayfalama ile ulaşabilirsiniz.');
        } else {
          $alertBox.addClass('d-none');
        }
      }
    },
    columns:[
      {data:'customer_code',name:'customer_code'},
      {data:'name',name:'name'},
      {data:'address',name:'address'},
      {data:'phone',name:'phone'},
      {data:'email',name:'email'},
      {data:'creator',name:'creator'},
      {data:'created_at',name:'created_at'},
      {data:'updater',name:'updater'},
      {data:'updated_at',name:'updated_at'},
      {data:'action',name:'action',orderable:false,searchable:false},
    ],
    language: {
        url: '/database/tr.json'
    },
    pageLength:100,
    stateSave: true,
    lengthMenu:[[10,20,30,50,100,1000],[10,20,30,50,100,"Tümü"]]
  });
});
</script>
@endpush
