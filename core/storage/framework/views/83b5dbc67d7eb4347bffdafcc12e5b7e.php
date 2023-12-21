
<?php $__env->startSection('title', __('Coupon System History')); ?>
<?php $__env->startSection('panel'); ?>
    <form action="">
        <div class="form-group d-flex justify-content-center align-items-center">
            <input type="search" name="s" class="form-control"
                placeholder="Coupon Code, Username, Firstname, Lastname, Email" value="<?php echo e(request('s')); ?>" />
            <button type="submit" class="btn btn-info">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>
    <div class="clearfix"></div>
    <div class="table-responsive-sm">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Coupon</th>
                    <th>User</th>
                    <th>Rewards</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($item->coupon): ?>
                        <tr>
                            <td><?php echo e(++$index); ?></td>
                            <td><?php echo e($item->coupon->token); ?></td>
                            <td>
                                <a href="<?php echo e(route('moder.users.detail', $item->user->id)); ?>">
                                    <?php echo e($item->user->username); ?>

                                </a>
                            </td>
                            <td><?php echo e($item->coupon->rewards); ?><?php echo e(GENERAL_SETTING['cur_sym']); ?></td>
                            <td><?php echo e(showDateTime($item->created_at)); ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <?php echo e($logs->links()); ?>

    </div>

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

<?php echo $__env->make('admin.layout.primary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\workspace\v1Xapps30-11\core\Modules/Coupon\Resources/views/admin/history.blade.php ENDPATH**/ ?>