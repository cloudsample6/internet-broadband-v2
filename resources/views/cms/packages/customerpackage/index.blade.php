@extends('_layout.app')
@section('title', 'Customer Package')
@section('page_header', 'Customer Package')
@section('content')

    <div class="card card-primary">
        <div class="card-header">
            <h4>Customer Package</h4>
            <div class="card-header-action">
                <a href="{{ route('customer-package-create') }}" class="btn btn-outline-primary modal-show" title="Tambah Package Baru ">(+) Tambah Baru</a>                
            </div>
        </div>
        <div class="card-body ">
            <div class="table-responsive">
                <table id="appTable" class="table table-bordered table-hover dataTable table-striped" >
                    <thead>
                    <tr>
                    <th scope="col">No</th>
                        <th scope="col">Username</th>
                        <th scope="col">Package Name</th>
                        <th scope="col">Speed</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                </table>    
            </div>
        </div>
    </div>

@endsection

@push('css')
<!-- add Css Here -->
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<!-- datatables -->
<!-- <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css'> -->
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css'>
<link rel='stylesheet' href='https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css'>

<link rel='stylesheet' href='https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css'>

@endpush

@push('js')
<!-- add Js Script Here -->
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<script>
 $('#appTable').DataTable({
        responsive:true, 
        dom: '<"top"fB>rt<"bottom"lp><"clear">',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],    
        processing:true,
        serverSide:true,
        ajax: "{{ url()->current().'/datatables' }}",
        columns:[
            {data: 'DT_RowIndex', name:'username', searchable: false},
            {data: 'username', name:'username'},
            {data: 'package_name', name:'package_name'},
            {data: 'speed', name:'speed'},
            {data: 'price', name:'price'},
            {data: 'action', name:'action'},           
        ]
    });
</script>
@endpush
