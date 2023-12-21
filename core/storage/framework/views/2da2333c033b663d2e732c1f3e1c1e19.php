

<?php $__env->startSection('title', 'Manage Offerwalls '); ?>
<?php $__env->startSection('panel'); ?>
    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title float-start"><?php echo app('translator')->get('Manage Offerwalls'); ?></h4>
            </div>
            <div class="card-body">
                <form action="" method="GET">
                    <div class="form-group">
                        <input type="search" name="search" class="form-control" placeholder="search by name click enter" />
                    </div>
                </form>
                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table','data' => ['th' => ['Offerwall', 'Postback', 'Auto-Pay', 'Status', '']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['th' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['Offerwall', 'Postback', 'Auto-Pay', 'Status', ''])]); ?>
                    <?php $__empty_1 = true; $__currentLoopData = $offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <img src="<?php echo e(getImage(imagePath()['offers']['path'] . '/' . $offer->image)); ?>"
                                    height="50px" width="50px" />
                                <br>
                                <?php echo e(__($offer->name)); ?>

                            </td>
                            <td data-url="<?php echo e(route('offers.builtin.callback', $offer->endpoint)); ?>"
                                style="max-width: 200px; overflow: auto; cursor: pointer;" class="callbackURL"
                                data-scrollbar>
                                <?php echo e(route('offers.builtin.callback', $offer->endpoint)); ?>

                            </td>

                            <td data-label="<?php echo app('translator')->get('Auto Pay'); ?>">
                                <?php echo bolToText($offer->is_auto_pay, true, 'Disabled', 'Enabled'); ?>

                                <a href="<?php echo e(route('moder.offer.update-pay', $offer->id)); ?>" class="btn btn-icon btn-sm">
                                    <i class="fas fa-exchange-alt text-dark"></i>
                                </a>
                            </td>

                            <td data-label="<?php echo app('translator')->get('Status'); ?>">
                                <?php echo bolToText($offer->is_active, true, 'Disabled', 'Enabled'); ?>

                                <a href="<?php echo e(route('moder.offer.update-status', $offer->id)); ?>" class="btn btn-icon btn-sm">
                                    <i class="fas fa-exchange-alt text-dark"></i>
                                </a>
                            </td>
                            <td data-label="<?php echo app('translator')->get('Action'); ?>">
                                <a href="<?php echo e(route('moder.offer.builtin.edit',$offer->id)); ?>" class="btn btn-sm btn-warning edit-offer ml-1"
                                    data-toggle="tooltip" title="" "
                                                data-original-title="<?php echo app('translator')->get('Edit'); ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
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

                <?php echo e($offers->links()); ?>

            </div>
        </div>
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
<?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.bootstrap-toggle','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('bootstrap-toggle'); ?>
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
<?php $__env->startPush('script'); ?>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.callbackURL', function() {
                let url = $(this).data('url');
                let $temp = $("<input>");
                $("body").append($temp);
                $temp.val(url).select();
                document.execCommand("copy");
                $temp.remove();
                notify('info', 'the postback is copied');
            })
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layout.primary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\workspace\v1Xapps30-11\core\resources\views/admin/offer-wall/builtin/list.blade.php ENDPATH**/ ?>