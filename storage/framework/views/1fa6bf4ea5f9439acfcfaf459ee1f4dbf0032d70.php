
<?php $__env->startSection('content'); ?>
<div class="card card-custom">
  <div class="card-header flex-wrap border-0 pt-6 pb-0">
    <div class="card-title">
      <h3 class="card-label">Master Customer
      <span class="d-block text-muted pt-2 font-size-sm">Data Customer yang tersedia</span></h3>
    </div>
    <div class="card-toolbar">
      <a href="<?php echo e(url('master/customer/create')); ?>" class="btn btn-primary font-weight-bolder">
      <i class="la la-plus"></i>Tambah Data Customer</a>
    </div>
  </div>
  <div class="card-body">
      <div class="table-responsive">
        <table id="datatables" class="table table-striped table-hover table-bordered">
          <thead>
            <tr>
              <th></th>
              <th>Nama Customer</th>
              <th>Alamat</th>
              <th>No Telp</th>
              <th>Nomor Rekening</th>
              <th>Atas Nama (a/n)</th>
              <th>Bank</th>
              <th>Aksi</th>
            </tr>
          </thead>
        </table>
      </div>
  </div>
</div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
  function format ( d ) {
    return `<table style="width:50%;" class="table">
        <tr>
          <th><strong> Harga Koli Kecil </strong> </th>
          <td> : `+d.harga_koli_k+`</td>  
        </tr>
        <tr>
          <th><strong> Harga Koli Sedang </strong> </th>
          <td> : `+d.harga_koli_s+`</td>  
        </tr>
        <tr>
          <th><strong> Harga Besar </strong> </th>
          <td> : `+d.harga_koli_b+`</td>  
        </tr>
        <tr>
          <th><strong> Harga Besar Banget </strong> </th>
          <td> : `+d.harga_koli_bb+`</td>  
        </tr>
        <tr>
          <th><strong> Harga Per Kg </strong> </th>
          <td> : `+d.harga_kg+`</td>  
        </tr>
        <tr>
          <th><strong> Harga Doc </strong> </th>
          <td> : `+d.harga_doc+`</td>  
        </tr>
        <tr>
          <th><strong> Harga oa </strong> </th>
          <td> : `+d.harga_oa+`</td>  
        </tr>
        <tr>
          <th><strong> Harga oa_ship </strong> </th>
          <td> : `+d.harga_oa_ship+`</td>  
        </tr>
      </table>`;
}
    var dt = $('#datatables').DataTable({
	     processing: true,
	     serverSide: false,
	     paging:true,
	     ajax: '<?php echo e(url('master/customer/datatables')); ?>',
	     columns: [
         
        {
                "class":          "details-control",
                "orderable":      false,
                "data":           null,
                "defaultContent": ""
            },
	     {data: 'nama', name:'nama'},
	     {data: 'alamat', name:'alamat'},
	     {data: 'notelp', name:'notelp'},
	     {data: 'rekening', name:'rekening'},
	     {data: 'rekeningatasnama', name:'rekeningatasnama'},
	     {data: 'bank', name:'bank'},
	     {data: 'aksi', name:'aksi'},
	 ],
	  "order": [[ 1, "asc" ]],
    });

    var detailRows = [];
 
    $('#datatables tbody').on( 'click', 'tr td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = dt.row( tr );
        var idx = $.inArray( tr.attr('id'), detailRows );
 
        if ( row.child.isShown() ) {
            tr.removeClass( 'details' );
            row.child.hide();
 
            // Remove from the 'open' array
            detailRows.splice( idx, 1 );
        }
        else {
            tr.addClass( 'details' );
            row.child( format( row.data() ) ).show();
 
            // Add to the 'open' array
            if ( idx === -1 ) {
                detailRows.push( tr.attr('id') );
            }
        }
    } );
 
    // On each draw, loop over the `detailRows` array and show any child rows
    dt.on( 'draw', function () {
        $.each( detailRows, function ( i, id ) {
            $('#'+id+' td.details-control').trigger( 'click' );
        } );
    } );

   function deleteCustomer(id,nama)
    {
         Swal.fire({   
                      title: "Anda Yakin?",   
                      text: "Data Agen akan terhapus dari sistem",   
                      icon: "warning",   
                      showCancelButton: true,   
                      confirmButtonColor: "#e6b034",   
                      confirmButtonText: "Ya, Hapus Agen" 
                       
                  }).then((result) => {
            if (result.value) {
                $.ajax({
                            method:'POST',
                            url:base_url+'master/agen/delete',
                            data:{
                              id:id,
                              '_token': $('input[name=_token]').val()
                            },
                            success:function(data){
                                Swal.fire({title:"Terhapus!", text:"Agen "+data.agen.nama+" berhasil terhapus dari sistem", icon:"success"}
                                ).then((result) => {
                                    location.reload()
                                })
                            }
                          }) 
            } 
         });
    }

  </script>
  
<?php if(Session::get('message') == "created"): ?>
    <script type="text/javascript">
        toastr.success("Customer Baru Berhasil ditambahkan!");
    </script>
<?php endif; ?>
<?php if(Session::get('message') == "updated"): ?>
    <script type="text/javascript">
        toastr.success("Data Customer Berhasil diubah!");
    </script>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\awb\resources\views/pages/master/customer/index.blade.php ENDPATH**/ ?>