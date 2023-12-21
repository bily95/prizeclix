
<?php $__env->startSection('title', __('Manage Cronjob')); ?>
<?php $__env->startSection('panel'); ?>
    <div class="card">
        <div class="card-header">
            <h6 class="card-title">
                <?php echo app('translator')->get('Manage Cronjob'); ?>
            </h6>
        </div>
        <div class="card-body p-3">
            <?php $__currentLoopData = $crons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="d-flex justify-content-between m-0 p-0">
                    <p class="p-0"><?php echo e($key); ?></p>
                    <p class="p-0" role="button" onclick="copyToClipboard(this)">curl -s <?php echo e($value); ?></p>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    </div>

    <div class="card">
        <div class="card-body">

            <div class="search my-2">
                <form>
                    <div class="d-flex justify-content-center">
                        <input type="search" class="form-control" name="url" placeholder="search by url" />
                        <button type="submit" class="btn btn-info">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>

            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table','data' => ['th' => ['URL', 'status']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['th' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['URL', 'status'])]); ?>
                <?php $__empty_1 = true; $__currentLoopData = $cronjobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cron): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($cron->url); ?></td>
                        <td><?php echo bolToText($cron->status, true, 'Fails', 'success'); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p>no records!</p>
                <?php endif; ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
            <?php echo e($cronjobs->links()); ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        function copyToClipboard(element) {
            const textarea = document.createElement('textarea');
            textarea.value = element.innerText;

            document.body.appendChild(textarea);

            textarea.select();
            textarea.setSelectionRange(0, 99999);

            document.execCommand('copy');

            document.body.removeChild(textarea);

            element.style.backgroundColor = '#d4edda';

            setTimeout(() => {
                element.style.backgroundColor = '';
            }, 1000);
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layout.primary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\workspace\v1Xapps30-11\core\resources\views/admin/manage-site/cron.blade.php ENDPATH**/ ?>