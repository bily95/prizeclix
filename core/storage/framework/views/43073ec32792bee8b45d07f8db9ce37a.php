<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'modal' => false,
    'search' => false,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'modal' => false,
    'search' => false,
]); ?>
<?php foreach (array_filter(([
    'modal' => false,
    'search' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>



<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('/asset/static/select2/css/select2.min.css')); ?>">
    <style>
        .select2-container {
            min-width: 100%;
            padding: 0px;
            color: #212529;
        }

        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            min-height: 35px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 30px;
            position: absolute;
            top: 1px;
            right: 1px;
            width: 35px;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('/asset/static/select2/js/select2.min.js')); ?>"></script>
    <?php if($modal): ?>
        <script>
            $(document).ready(function() {
                $('select.form-control').select2({
                    dropdownParent: $('<?php echo e('#' . $modal); ?>'),
                    <?php echo e($search ? 'minimumResultsForSearch: 1' : 'minimumResultsForSearch: Infinity'); ?>,
                });
            });
        </script>
    <?php else: ?>
        <script>
            $(document).ready(function() {
                $('select.form-control').select2({
                    <?php echo e($search ? 'minimumResultsForSearch: 1' : 'minimumResultsForSearch: Infinity'); ?>,
                });
            });
        </script>
    <?php endif; ?>


<?php $__env->stopPush(); ?>
<?php /**PATH D:\workspace\v1Xapps30-11\core\resources\views/components/select2.blade.php ENDPATH**/ ?>