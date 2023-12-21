<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'label' => null,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'label' => null,
]); ?>
<?php foreach (array_filter(([
    'label' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
    $attributes = $attributes->class([
        'form-text',
    ])->merge([
        //
    ]);
?>

<?php if($label || !$slot->isEmpty()): ?>
    <div <?php echo e($attributes); ?>>
        <?php echo e($label ?? $slot); ?>

    </div>
<?php endif; ?>
<?php /**PATH D:\workspace\v1Xapps30-11\core\resources\views/vendor/bs/components/help.blade.php ENDPATH**/ ?>