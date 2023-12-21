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
    <link rel="stylesheet" href="<?php echo e(asset('/asset/static/checkbox/bootstrap-toggle.min.css')); ?>">
    <style>
        .toggle.btn {
            min-width: 100px;
            height: 32px !important;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('/asset/static/checkbox/bootstrap-toggle.min.js')); ?>"></script>
    <script>
        $(document).ready(function() {
            $('input[type="checkbox"]').bootstrapToggle({
                // on: "on",
                // off: "off",
                onstyle: "info",
                offstyle: "dark",
                size:"small",
            });
        });
    </script>
    <?php if($livewire): ?>
        <script>
            let checkbox = $('input[type="checkbox"]');

            checkbox.bootstrapToggle({
                // on: "on",
                // off: "off",
                onstyle: "info",
                offstyle: "dark",
                size:"small",
            });

            $.each(checkbox, function(index, item) {
                if ($(item).data('value') == 'on' || $(item).data('value') == '1') {
                    $(item).bootstrapToggle('on')
                }else{
                    $(item).bootstrapToggle('off')
                }
            })


            checkbox.change(function() {
                let model = $(this).attr('model');
                let wireModel = $(this).attr('wire:model');
                if(typeof(model) !== 'undefined'){
                    window.livewire.find('<?php echo e($_instance->id); ?>').set(model, $(this).prop('checked') ? 'on' : 'off');
                }else if(typeof(wireModel) !== 'undefined'){
                    window.livewire.find('<?php echo e($_instance->id); ?>').set(wireModel, $(this).prop('checked') ? '1' : '0');
                }else{
                    console.log('Invalid wire model');
                }
            });
        </script>
    <?php endif; ?>
<?php $__env->stopPush(); ?>
<?php /**PATH D:\workspace\v1Xapps30-11\core\resources\views/components/bootstrap-toggle.blade.php ENDPATH**/ ?>