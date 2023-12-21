
<?php $__env->startSection('title', __('Coupon System Config')); ?>
<?php $__env->startSection('panel'); ?>
    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
        data-bs-target="#couponModal"><?php echo app('translator')->get('Create New'); ?></button>
    <div class="clearfix"></div>
    <div class="table-responsive-sm">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Coupon</th>
                    <th>Rewards</th>
                    <th>Paied</th>
                    <th>clicked/Limit</th>
                    <th>Status</th>
                    <th>Expire At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e(++$index); ?></td>
                        <td>
                            <a href="<?php echo e(route('moder.coupon.history')); ?>?s=<?php echo e($item->token); ?>" target="_blank">
                                <?php echo e($item->token); ?>

                            </a>
                        </td>
                        <td><?php echo e(showAmount($item->rewards,0)); ?></td>
                        <td><?php echo e(showAmount($item->log->count() * $item->rewards,0)); ?></td>
                        <td><?php echo e($item->log->count()); ?>/<?php echo e($item->limit); ?></td>
                        <td>
                            <?php if($item->log->count() >= $item->limit): ?>
                                <span class="px-2 bg-info">Completed</span>
                            <?php elseif($item->expire_at <= today()): ?>
                                <span class="px-2 bg-info">Expired</span>
                            <?php elseif($item->status == 0): ?>
                                <span class="px-2 bg-primary">Disabled</span>
                            <?php else: ?>
                                <span class="px-2 bg-warning">Active</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo e(showDateTime($item->expire_at,'m-d-y')); ?></td>
                        <td>
                            <div class="dropdown dropstart">
                                <button class="btn btn-info btn-sm dropdown-toggle" type="button"
                                    id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-list-dots"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item"
                                            href="<?php echo e(route('moder.coupon.change-status', $item->id)); ?>">
                                            <?php if($item->status): ?>
                                                Disable
                                            <?php else: ?>
                                                Enable
                                            <?php endif; ?>
                                        </a></li>
                                    <li><a class="dropdown-item edit_coupon" href="#"
                                            data-coupon-id="<?php echo e($item->id); ?>">Edit</a></li>
                                    <li><a class="dropdown-item"
                                            href="<?php echo e(route('moder.coupon.destroy', $item->id)); ?>">Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <?php echo e($coupons->links()); ?>

    </div>
    
    <div class="modal fade" id="couponModal" tabindex="-1" aria-labelledby="couponModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="couponModalLabel">Create New</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?php echo e(route('moder.coupon.store')); ?>" method="POST" id="couponForm">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'bs::components.input','data' => ['type' => 'text','name' => 'token','label' => 'Coupon Code']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('bs::input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'token','label' => 'Coupon Code']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                        <br>
                        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'bs::components.input','data' => ['type' => 'number','name' => 'rewards','label' => 'Coupon Rewards']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('bs::input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'number','name' => 'rewards','label' => 'Coupon Rewards']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                        <br>
                        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'bs::components.input','data' => ['type' => 'number','name' => 'limit','label' => 'Coupon Limit']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('bs::input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'number','name' => 'limit','label' => 'Coupon Limit']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                        <br>
                        <div class="form-group">
                            <label for="date">Expire At</label>
                            <input type="date" name="expire_at" class="form-control" value="<?php echo e(date('Y-d-m')); ?>" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php $__env->startPush('script'); ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
        <script>
            $(document).ready(function() {
                $('a.edit_coupon').click(function(e) {
                    e.preventDefault()
                    let couponId = $(this).data('coupon-id');
                    $.ajax({
                        url: "<?php echo e(route('moder.coupon.edit')); ?>",
                        type: "GET",
                        dataType: "JSON",
                        data: {
                            id: couponId
                        },
                        success: function(res) {
                            if (res.coupon) {
                                const formInput = 'form#couponForm input';
                                // update form elements values
                                $(formInput + '[name="token"]').val(res.coupon.token);
                                $(formInput + '[name="rewards"]').val(res.coupon.rewards);
                                $(formInput + '[name="limit"]').val(res.coupon.limit);
                                var expire_at = moment(res.coupon.expire_at).format('YYYY-MM-DD');
                                $(formInput + '[name="expire_at"]').val(expire_at);
                                $('form#couponForm').append(
                                    '<input type="hidden" name="id" value="' + res.coupon.id +
                                    '"/>');

                                // update form action
                                $('form#couponForm').attr('action',
                                    '<?php echo e(route('moder.coupon.update')); ?>');

                                // update modal title
                                $('.modal#couponModal #couponModalLabel').html('Update Coupon');

                                // show modal
                                $('.modal#couponModal').modal('show');

                            } else {
                                notify('error', 'Something goes wrong');
                            }
                        },
                        error: function(xml, error, message) {
                            notify('error', 'Something goes wrong');
                        }
                    })
                })
            })
        </script>
    <?php $__env->stopPush(); ?>
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

<?php echo $__env->make('admin.layout.primary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xapphfem/v1.xapps.store/core/Modules/Coupon/Resources/views/admin/index.blade.php ENDPATH**/ ?>