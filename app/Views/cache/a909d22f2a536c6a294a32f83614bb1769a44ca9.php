<?php $__env->startSection('content'); ?>
    <div class="section-header">
        <h1>Blank Pages</h1>
    </div>
    <div class="section-body"></div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js_content'); ?>
<script>
    $(document).ready(function(){
        alert("a");
    })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\user-access-control\app\Views/dashboard/index.blade.php ENDPATH**/ ?>