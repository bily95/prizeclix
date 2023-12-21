<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#couponModal">
    Enter Coupon Code
</button>


<div class="modal fade" id="couponModal" tabindex="-1" aria-labelledby="couponModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card m-0">
                    <div class="row justify-content-center">
                        <div class="col-md-6 text-center">
                            <form action="<?php echo e(route('coupon.click')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'bs::components.input','data' => ['type' => 'text','name' => 'coupon','label' => 'Enter Coupon Code']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('bs::input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'coupon','label' => 'Enter Coupon Code']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                <br>
                                <div class="d-flex justify-content-between align-items-center mb-3 ">
                                    <button type="submit" class="btn btn-primary">Apply</button>
                                    <button type="button"  data-bs-dismiss="modal" class="btn btn-secondary">cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH D:\workspace\v1Xapps30-11\core\Modules/Coupon\Resources/views/index.blade.php ENDPATH**/ ?>