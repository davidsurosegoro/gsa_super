

<?php $__env->startSection('content'); ?>

    <div class="row justify-content-center">
    	<div class="col-md-12 col-xl-12">
            <div class="card card-custom">
                <div class="card-body text-left">
                	<div class="table-responsive">
                		<table id="datatables">
                            <thead>
                                <tr>
                                    <th>created_at</th>
                                    <th>User</th>
                                    <th>Deskripsi Aktivitas</th>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                		</table>
                	</div>
                </div>
            </div>
    	</div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript">
	 $(function() {
        $('#datatables').DataTable({
            processing: true,
            serverSide: false,
            paging:true,
            ajax: '<?php echo e(url('log/datatables')); ?>',
             columns: [
            {data: 'dates', name:'dates'},
            {data: 'user', name:'user'},
            {data: 'description', name:'description'},
            {data: 'tanggal', name:'tanggal'},
            {data: 'keterangan', name:'keterangan'}
        ],
         "order": [[ 0, "desc" ]],
         "columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            },
            ]
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\awb\resources\views/pages/log.blade.php ENDPATH**/ ?>