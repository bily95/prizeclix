<?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table','data' => ['th' => ['Rank', 'User', GENERAL_SETTING['cur_text'], 'Rewards']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['th' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['Rank', 'User', GENERAL_SETTING['cur_text'], 'Rewards'])]); ?>
    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <tr>
        <td data-label="<?php echo app('translator')->get('Rank'); ?>">#<?php echo e((++$index)); ?></td>
        <td data-label="<?php echo app('translator')->get('User Name'); ?>"><?php echo e($user->users->username); ?></td>
        <td data-label="<?php echo e(GENERAL_SETTING['cur_text']); ?>">
            <?php echo e($user->total_earning); ?> <?php echo e(GENERAL_SETTING['cur_sym']); ?>

        </td>
        <td data-label="Rewards">
            <?php echo e(isset($levels[$index-1]) ?  $levels[$index-1]->reward : 0); ?> <?php echo e(GENERAL_SETTING['cur_sym']); ?>

        </td>
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <tr>
        <td colspan="3" class="text-center"><?php echo app('translator')->get('Data not found'); ?></td>
    </tr>
<?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>

<?php /**PATH D:\workspace\v1Xapps30-11\core\Modules/Leaderboard\Resources/views/user/table.blade.php ENDPATH**/ ?>