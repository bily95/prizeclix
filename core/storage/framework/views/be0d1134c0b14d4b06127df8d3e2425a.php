<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'string' => 'Site Logo Image',
    'name' => 'default.png',
    'upload' => null,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'string' => 'Site Logo Image',
    'name' => 'default.png',
    'upload' => null,
]); ?>
<?php foreach (array_filter(([
    'string' => 'Site Logo Image',
    'name' => 'default.png',
    'upload' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>
<div class="form-group">
    <label for="siteSocialImage"><?php echo app('translator')->get($string); ?> * :</label>
    <div class="row">
        <div class="col-3">
            <img src="<?php echo e(asset('asset/uploads/setting/' . $name)); ?>" alt="image"
                width="100px" height="100px"
                class="mb-5 img-responsive rounded mx-auto d-block bg-light" />
        </div>
        <div class="col-6">
            <input type="file" id="<?php echo e($upload); ?>" class="form-control"
                wire:model="<?php echo e($upload); ?>" />
            <div wire:loading wire:target="<?php echo e($upload); ?>"><i
                    class="spinner-border text-primary"></i>
            </div>
            <?php $__errorArgs = [$upload];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-danger"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>
</div><?php /**PATH D:\workspace\v1Xapps30-11\core\resources\views/components/upload.blade.php ENDPATH**/ ?>