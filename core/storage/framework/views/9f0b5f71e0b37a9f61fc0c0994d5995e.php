<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'name' => null,
    'style' => config('laravel-bootstrap-components.font_awesome_style'),
    'size' => null,
    'color' => null,
    'spin' => false,
    'pulse' => false,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'name' => null,
    'style' => config('laravel-bootstrap-components.font_awesome_style'),
    'size' => null,
    'color' => null,
    'spin' => false,
    'pulse' => false,
]); ?>
<?php foreach (array_filter(([
    'name' => null,
    'style' => config('laravel-bootstrap-components.font_awesome_style'),
    'size' => null,
    'color' => null,
    'spin' => false,
    'pulse' => false,
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
        'fa' . Str::limit($style, 1, null) . ' fa-fw fa-' . $name,
        'fa-' . $size => $size,
        'text-' . $color => $color,
        'fa-spin' => $spin,
        'fa-pulse' => $pulse,
    ])->merge([
        //
    ]);
?>

<?php if($name): ?>
    <i <?php echo e($attributes); ?>></i>
<?php endif; ?>
<?php /**PATH D:\workspace\v1Xapps30-11\core\resources\views/vendor/bs/components/icon.blade.php ENDPATH**/ ?>