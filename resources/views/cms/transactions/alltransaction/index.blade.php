@extends('_layout.app') 
@section('title', 'All Transaction') 
@section('page_header', 'Transaction') 
@section('content')

<div class="card card-primary">
    <div class="card-header">
        <h4>All Transaction</h4>

        @if(!empty(request()->range))
        <div class="card-header-action">
          <a class="btn btn-outline-primary" href="{{route('all-transaction-index') }} " title="Reset Data"> Reset Data </i></a>
        </div>
        @endif
        <div class="card-header-action">
            {{-- <button id="lunas" class="btn btn-info">Set Lunas</button> --}}
            <a class="btn btn-outline-primary btn-confirm" href="{{route('all-transaction-sync') }} " title="Sync Data"><i class="fas fa-sync"> Sync Data </i></a>
            <a href="{{ route('all-transaction-create') }}" class="btn btn-outline-primary modal-show" title="Tambah Transaction Baru ">(+) Tambah Baru</a>
           
        </div>
        {{-- Start Date Filter --}}
        {{-- <div class="card-header-action">
            <input type="text" name="datefilter" class="form-control datefilter" placeholder="Search by date range.."/> 
        </div> --}}
        {{-- End Date Filter --}}
       
        {{-- <div class="card-header-action">
            <a href="{{ route('all-transaction-create') }}" class="btn btn-outline-primary modal-show" title="Tambah Transaction Baru ">(+) Tambah Baru</a>
        </div> --}}
        {{-- <div class="card-header-action">

            <i class="glyphicon glyphicon-calendar"></i> 
            <input type="text" name="datefilter" placeholder="Search by date range.."/> 
            <input type="text" name="datefilter" value="Filter date" />

        </div> --}}
        
    </div>
    <div class="card-body ">
        
        <div class="table">
            
            <table id="appTable" class="table nowrap table-bordered table-hover dataTable table-striped" style="width:100%">
                
                <thead>
                    
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">id</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Paket</th>
                        <th scope="col">Expired Date</th>
                        <th scope="col">Status</th>
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
<link rel='stylesheet' href='https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css'>
<link rel='stylesheet' href='https://cdn.datatables.net/rowreorder/1.2.7/css/rowReorder.dataTables.min.css'>
{{-- <link rel='stylesheet' href='https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css'> --}}
<link rel='stylesheet' href='https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css'>
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css'>

<!-- Datepicker -->
<link rel="stylesheet" href="https://demo.getstisla.com/assets/modules/bootstrap-daterangepicker/daterangepicker.css" />
<link rel="stylesheet" href="https://demo.getstisla.com/assets/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css" /> 

@endpush 
@push('js')
<!-- add Js Script Here -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js"></script>
{{-- <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script> --}}
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.21/sorting/stringMonthYear.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

<!-- Midtrans -->


<!-- <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('service.midtrans.clientkey') }}"></script> -->
     <!-- Production or Sandbox -->
    <script src="{{
        !config('services.midtrans.isProduction') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}"
        data-client-key="{{ config('services.midtrans.clientKey')
    }}"></script>
<!-- Datepicker -->


<script type="text/javascript">
    $(function() {
    
      $('.datefilter').daterangepicker({
          autoUpdateInput: false,
          locale: {
              cancelLabel: 'Clear'
          }
      });
    
      $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
        document.location.href = "{{ route('all-transaction-index') }}" +'?range='+picker.startDate.format('YYYY-MM-DD')+' - '+picker.endDate.format('YYYY-MM-DD');
          $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
                  

      });
    
      $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
          $(this).val('');
      });
    
    });
    </script>


<script>
    $(document).ready(function() {
        var table = $('#appTable').DataTable({
            rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive:true, 
        dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        processing:true,
        
        serverSide:true,
            ajax: "{{ url()->current().'/datatables'.(empty(request()->range) == true ? null : ('?range='.request()->range)) }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'name',
                    searchable: false
                }, {
                    data: 'id',
                    visible: false,
                    className: 'id'
                }, {
                    data: 'name',
                    name: 'name'
                },
                // {data: 'month_date', name:'month_date'},
                {
                    data: 'package_name',
                    name: 'package_name'
                },
                // {data: 'price', name:'price'},
                {
                    data: 'expired_date',
                    name: 'expired_date'
                }, {
                    data: 'status',
                    name: 'status'
                }, {
                    data: 'action',
                    name: 'action',
                    searchable: false
                }
            ],
            'select': {
                // 'style': 'multi'
            },
            'order': [
                [1, 'asc']
            ]
        });

        // $('#appTable tbody').on('click', 'tr', function() {
        //     // $(this).toggleClass('selected');
        //     var tblData = table.rows('.selected').data();
        //     // var tmpData;
        //     // $.each(tblData, function(i, val) {
        //     //     tmpData = tblData[i];
        //     // alert(tmpData);
        //     // })
        // });

        // $('#lunas').click(function() {
        //     // var selectedIds = table.rows('.selected').data()
        //     // selectedIds.push(table[0]);
        //     // console.log(selectedIds);
        //     $.each(table.rows('.selected').nodes(), function(i, item) {
        //             var id = item.id;
        //             var data = table.row(this).data();

        //             alert("Produt Id : " +
        //                 id + " && product Status:  " + data[2]);
        //         })
        //         // alert( table.rows('.selected').data());
        // });
        // Handle form submission event

        //    $('#lunas').on('click', function(e){

        //     var selectedIds = tbl.columns().checkboxes.selected()[0];
        //    console.log(selectedIds)

        //    selectedIds.forEach(function(selectedId) {
        //        alert(selectedId);
        //    });
        // var table = table.row(this).data();                          
        // console.log(table.rows(this).data());

        // var table = table.column(0).checkboxes.selected();
        //     console.log(table.rows(this).data());


        // // Iterate over all selected checkboxes
        // $.each(table, function(index, rowId){
        // // Create a hidden element
        // console.log(index);
        // console.log(rowId);
        // $(form).append(
        //     $('<input>')
        //         .attr('type', 'hidden')
        //         .attr('name', 'id[]')
        //         .val(rowId)
        // );
        // });

        // alert('beres');

        //   var form = this;

        //   var rows_selected = table.column(0).checkboxes.selected();

        //   // Iterate over all selected checkboxes
        //   $.each(rows_selected, function(index, rowId){
        //      // Create a hidden element
        //      console.log(index);
        //      console.log(rowId);
        //      $(form).append(
        //          $('<input>')
        //             .attr('type', 'hidden')
        //             .attr('name', 'id[]')
        //             .val(rowId)
        //      );
        //   });
    });
    // });
</script>
@endpush