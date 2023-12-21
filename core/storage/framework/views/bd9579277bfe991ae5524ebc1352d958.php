<div>
    <div class="container">
        <form class="form">
            <div class="row">
                <div class="col-md-5 mb-2">
                    <input type="search" name="search" class="form-control"
                        placeholder="Username, Email, Firstname, Lastname, Providers, OfferName, TRX"
                        value="<?php echo e(request('search')); ?>"
                        title="Search By Username, Email, Firstname, Lastname, Providers, OfferName, TRX" />
                </div>
                <div class="col-md-5 mb-2">
                    <div class="form-group">
                        <select class="form-control" name="is_paid">
                            <option value=""><?php echo app('translator')->get('Filter By Paid'); ?></option>
                            <option <?php if(request('is_paid') == 'paid'): ?> selected <?php endif; ?> value="paid"><?php echo app('translator')->get('Paid'); ?>
                            </option>
                            <option <?php if(request('is_paid') == 'not_paid'): ?> selected <?php endif; ?> value="not_paid"><?php echo app('translator')->get('Not Paid'); ?>
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
        <table class="table table-responsive-sm">
            <thead>
                <tr>
                    <th><?php echo app('translator')->get('UserName'); ?></th>
                    <th><?php echo app('translator')->get('TRX'); ?></th>
                    <th><?php echo app('translator')->get('OfferName'); ?></th>
                    <th><?php echo app('translator')->get('Provider'); ?></th>
                    <th><?php echo app('translator')->get('Rewards'); ?></th>
                    <th><?php echo app('translator')->get('Date'); ?></th>
                    <th><?php echo app('translator')->get('Status'); ?></th>
                    <th><?php echo app('translator')->get('Action'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php if($offer->users && $offer->offers): ?>
                        <tr>
                            <td data-label="<?php echo app('translator')->get('Username'); ?>">
                                <?php if($offer->users): ?>
                                    <a href="<?php echo e(route('moder.users.detail', $offer->users->id)); ?>"
                                        target="_blank">
                                        <?php echo e(__(Str::limit($offer->users->username, 5))); ?>

                                        <i class="fas fa-link"></i>
                                    </a>
                                <?php else: ?>
                                    Deleted Account
                                <?php endif; ?>
                            </td>
                            <td data-label="<?php echo app('translator')->get('TRX'); ?>"><?php echo e(__(Str::limit($offer->trx, 5))); ?>

                            </td>
                            <td data-label="<?php echo app('translator')->get('OfferName'); ?>"><?php echo e($offer->offer_name ?? 'N/A'); ?>

                            </td>
                            <td data-label="<?php echo app('translator')->get('Provider'); ?>">
                                <?php if($offer->offers): ?>
                                    <a <?php if($offer->offers->is_builtin): ?> href="<?php echo e(route('moder.offer.builtin.index')); ?>" <?php else: ?> href="<?php echo e(route('moder.offer.index')); ?>" <?php endif; ?>
                                       >
                                        <?php echo e(__($offer->offers->name)); ?><i class="fas fa-link"></i>
                                    </a>
                                <?php else: ?>
                                    Deleted Provider
                                <?php endif; ?>
                            </td>
                            <td data-label="<?php echo app('translator')->get('Rewards'); ?>"><?php echo e(__($offer->amount)); ?><i class="fas fa-coins"></i>
                            </td>
                            <td data-label="<?php echo app('translator')->get('Date'); ?>"><?php echo e(showDateTime($offer->created_at)); ?>

                                <br> <?php echo e(diffForHumans($offer->created_at)); ?>

                            </td>

                            <td data-label="<?php echo app('translator')->get('Status'); ?>">
                                <?php echo bolToText($offer->is_paid, true, 'Not Paid', 'Paid'); ?>

                            </td>
                            <td data-label="<?php echo app('translator')->get('Action'); ?>" class="d-flex">
                                <?php if(!$offer->is_paid): ?>
                                    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'bs::components.button','data' => ['href' => '#','wire:click' => 'sendPayment('.e($offer->id).')','icon' => 'share','title' => 'Send Payment','size' => 'sm','color' => 'info','style' => 'box-shadow:none;']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('bs::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => '#','wire:click' => 'sendPayment('.e($offer->id).')','icon' => 'share','title' => 'Send Payment','size' => 'sm','color' => 'info','style' => 'box-shadow:none;']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                <?php else: ?>
                                    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'bs::components.button','data' => ['href' => '#','wire:click' => 'reversePayment('.e($offer->id).')','icon' => 'share','title' => 'Reverse','size' => 'sm','color' => 'danger','style' => 'box-shadow:none;']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('bs::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => '#','wire:click' => 'reversePayment('.e($offer->id).')','icon' => 'share','title' => 'Reverse','size' => 'sm','color' => 'danger','style' => 'box-shadow:none;']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                <?php endif; ?>
                                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'bs::components.button','data' => ['href' => '#','wire:click' => 'delete('.e($offer->id).')','icon' => 'trash','title' => 'Delete','size' => 'sm','color' => 'warning','confirm' => true,'style' => 'box-shadow:none;']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('bs::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => '#','wire:click' => 'delete('.e($offer->id).')','icon' => 'trash','title' => 'Delete','size' => 'sm','color' => 'warning','confirm' => true,'style' => 'box-shadow:none;']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td class="text-muted text-center" colspan="100%"><?php echo e(__('No Data Yet!')); ?></td>
                    </tr>
                <?php endif; ?>

            </tbody>
        </table>
        <?php if($offers): ?>
            <?php if(request('search') && request('is_paid')): ?>
                <?php echo e($offers->appends(['is_paid' => request('is_paidd'), 'search' => request('search')])->links('pagination::bootstrap-4')); ?>

            <?php elseif(request('search') && !request('is_paid')): ?>
                <?php echo e($offers->appends(['search' => request('search')])->links('pagination::bootstrap-4')); ?>

            <?php elseif(request('is_paid') && !request('search')): ?>
                <?php echo e($offers->appends(['is_paid' => request('is_paid')])->links('pagination::bootstrap-4')); ?>

            <?php else: ?>
                <?php echo e($offers->links('pagination::bootstrap-4')); ?>

            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH D:\workspace\v1Xapps30-11\core\resources\views/admin/offer-wall/livewire-analysis.blade.php ENDPATH**/ ?>