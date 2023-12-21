<?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table','data' => ['th' => ['#', 'Type', 'Requires', 'Rewards', 'Action']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['th' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['#', 'Type', 'Requires', 'Rewards', 'Action'])]); ?>
    <?php $id = 1;  ?>
    <?php $__empty_1 = true; $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td>
                <?php echo e($id++); ?>

            </td>
            <td>
                <?php echo e(ucfirst($task->type)); ?>

            </td>
            <td>
                <?php echo e($task->require); ?> <?php echo e(GENERAL_SETTING['cur_sym']); ?>

                <?php if($task->condition): ?>
                    /<?php echo e($task->condition); ?> Offers
                <?php endif; ?>
            </td>
            <td>
                <?php echo e($task->reward); ?>

            </td>

            <td data-label="<?php echo app('translator')->get('Action'); ?>">
                <a href="<?php echo e(route('moder.dailytasks.edit', $task->id)); ?>" class="btn btn-icon btn-3 px-2 py-1 btn-info">
                    <span class="btn-inner--icon"><i class="material-icons">edit</i></span>
                </a>
                <a href="<?php echo e(route('moder.dailytasks.delete', $task->id)); ?>" class="btn btn-icon btn-3 px-2 py-1 btn-danger">
                    <span class="btn-inner--icon"><i class="material-icons">delete</i></span>
                </a>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td class="text-muted text-center" colspan="100%"><?php echo e(__('No Data Yet!')); ?></td>
        </tr>
    <?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
<?php echo e($tasks->links()); ?>


<?php /**PATH D:\workspace\v1Xapps30-11\core\Modules/DailyTasks\Resources/views/admin/table.blade.php ENDPATH**/ ?>