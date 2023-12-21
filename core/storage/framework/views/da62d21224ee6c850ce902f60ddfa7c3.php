
<?php $__env->startSection('title', __('Daily tasks ')); ?>
<?php $__env->startSection('panel'); ?>
    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title float-start" style="margin-top:5px;"><?php echo app('translator')->get('Daily Tasks'); ?></h4>
                <button type="button" data-bs-toggle="modal" data-bs-target="#storeLevel"
                    class="btn btn-sm btn-dark float-end">
                    <i class="fas fa-plus"></i> <?php echo app('translator')->get('New task'); ?>
                </button>
            </div>
            <?php if(isset($task)): ?>
            <?php echo $__env->make('dailytasks::admin.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
            <?php if(isset($tasks)): ?>
                <?php echo $__env->make('dailytasks::admin.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </div>
    </div>
    </div>
    <?php echo $__env->make('dailytasks::admin.modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.js-notify','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('js-notify'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>

<?php echo $__env->make('admin.layout.primary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\workspace\v1Xapps30-11\core\Modules/DailyTasks\Resources/views/admin/index.blade.php ENDPATH**/ ?>