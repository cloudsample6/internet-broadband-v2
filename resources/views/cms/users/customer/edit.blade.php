<form method="post" action="{{ route('customer-update', $data['user']->id)  }}">
@csrf
    <div class="form-group ">
        <label for="username">Username</label>
        <input class="form-control" name="username" type="text" value="{{$data['user']->username}}" id="username">
    </div>
    <div class="form-group ">
        <label for="name">Name</label>
        <input class="form-control" name="name" type="text" value="{{$data['user']->name}}" id="name">
    </div>
    <div class="form-group ">
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Package</th>
                <th scope="col">Harga Package</th>
                <th scope="col">Kecepatan Upload</th>
                <th scope="col">Kecepatan Download</th>
                </tr>
            </thead>
            <tbody>
            @forelse($data['package'] as $key => $package)
                <tr>
                <th scope="row">{{ $key+1 }}</th>
                <td>{{ $package->package_name }}</td>
                <td>{{ $package->price }}</td>
                <td>{{ $package->upload  . ' ' .$package->upload_unit . 'bps'}}</td>
                <td>{{ $package->download  . ' ' .$package->download_unit . 'bps' }}</td>
                </tr>
            @empty
                <tr>Data Paket Kosong</tr>
            @endforelse
            </tbody>
            </table>
        
    </div>
    <div class="form-group ">
    <label for="name">Address</label>
        <textarea class="form-control" name="address" placeholder="Required">{{$data['user']->address}}</textarea>
    </div>    
    
   
</form>