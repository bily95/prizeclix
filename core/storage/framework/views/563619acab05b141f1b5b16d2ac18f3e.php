
<?php $__env->startSection('title', __('Edit Offerwall ')); ?>
<?php $__env->startSection('panel'); ?>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <?php echo app('translator')->get('Edit Offerwall'); ?>
            </h3>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('moder.offer.builtin.update', $offer->id)); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="<?php echo e(uploads('offerwalls', $offer->image)); ?>" height="100px" width="100px" />

                            </div>
                            <div class="col-md-6">
                                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'bs::components.input','data' => ['type' => 'file','name' => 'image','accept' => '.png,.jpg','label' => __('Offerwall Logo'),'placeholder' => __('Offerwall Logo')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('bs::input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'file','name' => 'image','accept' => '.png,.jpg','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Offerwall Logo')),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Offerwall Logo'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>

                            </div>
                            <div class="col-md-6">
                                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'bs::components.input','data' => ['type' => 'text','name' => 'name','value' => ''.e($offer->name).'','label' => __('Offerwall Name'),'placeholder' => __('Offerwall Name'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('bs::input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'name','value' => ''.e($offer->name).'','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Offerwall Name')),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Offerwall Name')),'required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                            </div>

                            <div class="col-md-6">
                                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'bs::components.input','data' => ['type' => 'color','name' => 'bgcolor','value' => ''.e($offer->bgcolor).'','label' => __('card background color'),'placeholder' => __('card background color'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('bs::input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'color','name' => 'bgcolor','value' => ''.e($offer->bgcolor).'','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('card background color')),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('card background color')),'required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>


                            </div>
                            <div class="col-md-12">
                                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'bs::components.input','data' => ['type' => 'text','name' => 'iframe_url','value' => ''.e($offer->iframe_url).'','label' => __('Offerwall URL'),'required' => true,'placeholder' => 'Ex:https://surveywall.wannads.com?apiKey=xxxxxxxx&userId={user_id}','title' => __('Use {user_id} as user identifier and the system will replace it.'),'help' => 'valid iframe parameters {user_id}, {secure}']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('bs::input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'iframe_url','value' => ''.e($offer->iframe_url).'','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Offerwall URL')),'required' => true,'placeholder' => 'Ex:https://surveywall.wannads.com?apiKey=xxxxxxxx&userId={user_id}','title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Use {user_id} as user identifier and the system will replace it.')),'help' => 'valid iframe parameters {user_id}, {secure}']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>

                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="col-md-12">
                        <div class="row">
                            <?php $__currentLoopData = $offer->offer_keys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php if($index): ?>
                                            <label><?php echo e(str_replace('_', ' ', $index)); ?></label>
                                        <?php endif; ?>
                                        <input
                                            <?php if($index): ?> type="text" 
                                    <?php else: ?>
                                    type="hidden" <?php endif; ?>
                                            name="offer_keys[<?php echo e($index); ?>]" class="form-control"
                                            value="<?php echo e($key ?? '***'); ?>" />
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Require User Level</label>
                                    <input type="text" name="user_level" class="form-control"
                                        value="<?php echo e($offer->user_level); ?>" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center justify-content-between mt-3">
                                    <input type="checkbox" name="is_auto_pay"
                                        <?php if($offer->is_auto_pay): ?> checked="checked" <?php endif; ?> />
                                    <label>Is Auto Pay</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center justify-content-between mt-3">
                                    <input type="checkbox" name="en_api"
                                        <?php if($offer->en_api): ?> checked="checked" <?php endif; ?> />
                                    <label>Enable API Features</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center justify-content-between mt-3">
                                    <input type="checkbox" name="is_active"
                                        <?php if($offer->is_active): ?> checked="checked" <?php endif; ?> />
                                    <label>Is Active</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center justify-content-between mt-3">
                                    <input type="checkbox" name="is_available"
                                        <?php if($offer->is_available): ?> checked="checked" <?php endif; ?> />
                                    <label>Is Available</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id" value="<?php echo e($offer->id); ?>" />
                <input type="hidden" name="is_builtin" value="<?php echo e($offer->id); ?>" />
                <input type="submit" value="Save" class="btn btn-primary mt-3" />
            </form>
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

<?php echo $__env->make('admin.layout.primary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\workspace\v1Xapps30-11\core\resources\views/admin/offer-wall/builtin/edit.blade.php ENDPATH**/ ?>