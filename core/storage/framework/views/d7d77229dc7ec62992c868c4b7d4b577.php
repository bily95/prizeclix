<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['livewire' => false]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['livewire' => false]); ?>
<?php foreach (array_filter((['livewire' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>
<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('/asset/static/pnotify/dist/pnotify.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/asset/static/pnotify/dist/pnotify.brighttheme.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('/asset/static/pnotify/dist/pnotify.js')); ?>"></script>

    <?php $__currentLoopData = session('notify') ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <script>
            (function($) {
                "use strict";
                new PNotify({
                    type: '<?php echo e($msg[0]); ?>',
                    text: '<?php echo e(__($msg[1])); ?>'
                });
            })
            (jQuery);
        </script>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php
        $collection = collect($errors->all());
        $errors = $collection->unique();
    ?>

    <script>
        (function($) {
            "use strict";
            <?php $__currentLoopData = $errors ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                new PNotify({
                    type: 'default',
                    text: '<?php echo e(__($error)); ?>'
                });
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        })(jQuery);
    </script>

    <script>
        "use strict";

        function notify(status, message) {
            new PNotify({
                type: status,
                text: message
            });
        }
    </script>

    <?php if($livewire): ?>
        <script>
            (function($){
                Livewire.on('showToast', function(type, text){
                    new PNotify({
                        type:type,
                        text:text,
                    })
                })
            })(jQuery)
        </script>
    <?php endif; ?>

<?php $__env->stopPush(); ?>
<?php /**PATH /home/xapphfem/v1.xapps.store/core/resources/views/components/js-notify.blade.php ENDPATH**/ ?>