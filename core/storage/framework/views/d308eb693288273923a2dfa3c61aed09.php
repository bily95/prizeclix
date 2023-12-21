<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'th' => [],
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'th' => [],
]); ?>
<?php foreach (array_filter(([
    'th' => [],
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<div class="table-responsive px-2">
    <table class="table align-items-center mb-0">
        <thead>
            <tr>
                <?php $__currentLoopData = $th; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><?php echo e($item); ?>

                    </th>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
        </thead>
        <tbody>
            <?php echo e($slot); ?>

        </tbody>
    </table>
</div>
<?php /**PATH /home/xapphfem/v1.xapps.store/core/resources/views/components/table.blade.php ENDPATH**/ ?>