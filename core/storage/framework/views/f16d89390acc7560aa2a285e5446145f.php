<?php $__env->startSection('title', __('Appeareance Settings')); ?>
<?php $__env->startSection('page-title', __('Site General Setting')); ?>

<div>
    <div class="">
        <div class="row">
            
            <div class="col-md-6">
                <div class="card my-2">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo app('translator')->get('Basic Settings'); ?> </h5>
                        <form id="demo-form2" wire:submit.prevent="save">
                            <div class="form-group">
                                <label for="siteName"><?php echo app('translator')->get('Site Name * :'); ?></label>
                                <input type="text" id="siteName" class="form-control" wire:model="setting.siteName"
                                     required />
                            </div>
                            
                            <div class="form-group">
                                <label for="siteEmail"><?php echo app('translator')->get('Site Email * :'); ?></label>
                                <input type="text" id="siteEmail" class="form-control" wire:model="setting.siteEmail"
                                     required />
                            </div>
                            <hr />
                            <h5 class="card-title mt-2"><?php echo app('translator')->get('SEO Settings'); ?></h5>
                            <div class="form-group">
                                <label for="siteMetaDescription"><?php echo app('translator')->get('Description * :'); ?></label>
                                <textarea id="siteMetaDescription" class="form-control" rows="3" wire:model="setting.siteMetaDescription"
                                    required />
                                
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="siteMetaKeywords"><?php echo app('translator')->get('Keywords *'); ?> :</label>
                                <input type="text" id="siteMetaKeywords" class="form-control"
                                    wire:model="setting.siteMetaKeywords" 
                                     required />
                            </div>
                            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.upload','data' => ['string' => 'site Social Image','name' => ''.e(set('siteSocialImage', 'default.png')).'','upload' => 'siteSocialImage']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('upload'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['string' => 'site Social Image','name' => ''.e(set('siteSocialImage', 'default.png')).'','upload' => 'siteSocialImage']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                            <div class="form-group">
                                <label for="googleAnalysis"><?php echo app('translator')->get('Google Analysis * :'); ?></label>
                                <input type="text" id="googleAnalysis" value="<?php echo e(set('googleAnalysis', '975498623')); ?>" class="form-control" wire:model="setting.googleAnalysis"
                                     required />
                            </div>
                            <hr />
                            <button type="submit" class="btn btn-success btn-block my-2"><?php echo app('translator')->get('Save'); ?></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card my-2">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo app('translator')->get('Logo And Favicon Settings'); ?></h5>
                        <form id="demo-form4" wire:submit.prevent="saveSiteLogoAndFavicon"
                            enctype="multipart/form-data">
                            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.upload','data' => ['string' => 'site loading image','name' => ''.e(set('siteLoadingImage', 'default.png')).'','upload' => 'siteLoadingImage']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('upload'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['string' => 'site loading image','name' => ''.e(set('siteLoadingImage', 'default.png')).'','upload' => 'siteLoadingImage']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>

                            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.upload','data' => ['string' => 'Site Small Logo Image','name' => ''.e(set('siteSmallLogoImage', 'default.png')).'','upload' => 'siteSmallLogoImage']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('upload'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['string' => 'Site Small Logo Image','name' => ''.e(set('siteSmallLogoImage', 'default.png')).'','upload' => 'siteSmallLogoImage']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>

                            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.upload','data' => ['string' => 'Site Big Logo Image','name' => ''.e(SETTING['siteLogoImage']).'','upload' => 'siteLogoImage']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('upload'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['string' => 'Site Big Logo Image','name' => ''.e(SETTING['siteLogoImage']).'','upload' => 'siteLogoImage']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>

                            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.upload','data' => ['string' => 'Site Favicon Image','name' => ''.e(SETTING['siteFaviconImage']).'','upload' => 'siteFaviconImage']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('upload'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['string' => 'Site Favicon Image','name' => ''.e(SETTING['siteFaviconImage']).'','upload' => 'siteFaviconImage']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>

                            
                            <button type="submit" class="btn btn-success btn-block my-2"><?php echo app('translator')->get('Save'); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.js-notify','data' => ['livewire' => 'true']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('js-notify'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['livewire' => 'true']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?><?php /**PATH D:\workspace\v1Xapps30-11\core\resources\views/admin/setting/general.blade.php ENDPATH**/ ?>