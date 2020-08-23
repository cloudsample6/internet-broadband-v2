<form>
@csrf
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col"><b>Customer</b></th>
      <th>{{ $data->name }}</th>    
    </tr>
    <tr>
      <th scope="col"><b>Nomor Telpon</b></th>
      <th>{{ $data->contact_person }}</th>    
    </tr>
    <tr>
      <th scope="col"><b>Paket Internet</b></th>
      <th>{{ $data->package_name}}</th>    
    </tr>
    <tr>
      <th scope="col"><b>Jatuh Tempo</b></th>
      <th>{{ $data->expired_date}}</th>    
    </tr>
    <tr>
      <th scope="col"><b>Tanggal Bayar</b></th>
      @if(empty($data->payment_date))
      <th>Belum Pembayaran</th>    
      @else
      <th>{{Carbon\Carbon::parse($data->payment_date)->format('d M Y')}}</th> 
      @endif   
    </tr>
    
    <tr>
      <th scope="col"><b>Biaya Tagihan</b></th>
      <th>{{ $data->payment_billing}}</th>    
    </tr>
    <tr>
      <th scope="col"><b>Pembayaran Sebelumnya</b></th>
      <th>{{ $data->paid}}</th>    
    </tr>
    <tr>
      <th scope="col"><b>Admin</b></th>
      <th>{{ auth()->user()->name }}</th>    
      <!-- TODO auth 
        auth()->user()->name
      -->
    </tr>
  </thead> 
</table>
<!-- <a href="{{url('storage/app/'.$data->file)}}" src="{{ asset('storage/app/'.$data->file) }}" class="btn pop btn-primary btn-sm" size="25%" title="{{$data->file}}">{{ $data->file }}</a> -->
<div class="form-group">
 <!-- <input type="file" class="form-control" name="user_photo" id="userphoto">
 <img style="max-width: calc(100% - 20px)" src="/storage/app/{{ $data->file }}"> -->
 <img class="img-fluid" src="{{ url('storage/'.$data->file) }}" alt="" style="50%">

</div>
<!-- <div class="form-group ">
    <label for="type_payment">Tipe Pembayaran</label>
    <select class="form-control" id="type_payment" name="type_payment">
            <option value="Transfer">Transfer</option>
            <option value="Cash">Cash</option>
        </select>
    </div>   
    <div class="form-group ">
    <label for="file">Upload Bukti Bayar</label>
        <input class="form-control-file" name="file" type="file" id="file">
    </div>
    <div class="form-group ">
    <label for="name">Biaya Admin</label>
        <input class="form-control" name="fee" type="number" value="0" id="fee" readonly>
    </div>
    <div class="form-group ">
    <label for="paid">Nominal Dibayar</label>
        <input class="form-control" name="paid" type="number" value="{{ $data->payment_billing - $data->paid}}" id="paid">
    </div> -->

</form>


