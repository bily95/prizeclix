
<?php $__env->startSection('title', 'Profile '); ?>
<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-8">
                    <div class="d-flex align-items-center">
                        <div class="me-2 user-image">
                            <img src="<?php echo e(getUserImage()); ?>" height="120px" width="100%" class="user-profile-img" />
                            <?php
                                $color = \App\Models\UserLevelsColor::where('id',$level)->first();
                            ?>
                            <span class="badge" style="background: <?php echo $color ? $color->color : '#cccc'; ?>"><?php echo e($level); ?></span>
                        </div>
                        
                        <div class="">
                            <h5 class="text-capitalize">
                                <?php echo e($user->fullname); ?>

                                <?php if($user->ev): ?>
                                    <i class="fas fa-star text-warning" title="Email Verified"></i>
                                <?php endif; ?>
                            </h5>
                            <p>ID: <span class="badge bg-gradient-danger"><?php echo e($user->token_id); ?></span><br>
                                Username: <span class="badge bg-gradient-danger"><?php echo e($user->username); ?></span><br>
                                Referred By:
                                <?php if($referredBy): ?>
                                    <span class="badge bg-gradient-danger"><?php echo e($referredBy->username); ?></span><br>
                                <?php else: ?>
                                    <span class="badge bg-gradient-danger">None</span><br>
                                <?php endif; ?>
                                Joined At: <span
                                    class="badge bg-gradient-danger"><?php echo e(showDateTime($user->created_at)); ?></span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <?php if(Route::has('coupon.click')): ?>
                        <?php echo $__env->make('coupon::index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <hr>
        <li class="nav-item ">
            <a class="nav-link <?php if(\Route::current()->parameter('tab') == false): ?> active <?php endif; ?>" href="<?php echo e(route('user.profile')); ?>">About</a>
        </li>
        <li class="nav-item ">
            <a class="nav-link <?php if(\Route::current()->parameter('tab') === 'update'): ?> active <?php endif; ?>"
                href="<?php echo e(route('user.profile', 'update')); ?>">Edit Profile</a>
        </li>
        <li class="nav-item ">
            <a class="nav-link <?php if(\Route::current()->parameter('tab') === 'password'): ?> active <?php endif; ?>"
                href="<?php echo e(route('user.profile', 'password')); ?>">Change Password</a>
        </li>
        <li class="nav-item ">
            <a class="nav-link <?php if(\Route::current()->parameter('tab') === 'twofactor'): ?> active <?php endif; ?>"
                href="<?php echo e(route('user.profile', 'twofactor')); ?>">2-FA Authentication</a>
        </li>
        <li class="nav-item ">
            <a class="nav-link <?php if(\Route::current()->parameter('tab') === 'account'): ?> active <?php endif; ?>"
                href="<?php echo e(route('user.profile', 'account')); ?>">Account Setting</a>
        </li>
    </ul>
    <div class="tab-content min-vh-50" id="myTabContent">
        <?php if(\Route::current()->parameter('tab') == false): ?>
            <?php echo $__env->make(SETTING['site_theme'] . 'profile.partials.about', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
        <?php if(\Route::current()->parameter('tab') === 'update'): ?>
            <?php echo $__env->make(SETTING['site_theme'] . 'profile.partials.setting', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
        <?php if(\Route::current()->parameter('tab') === 'password'): ?>
            <?php echo $__env->make(SETTING['site_theme'] . 'profile.partials.password', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
        <?php if(\Route::current()->parameter('tab') === 'twofactor'): ?>
            <?php echo $__env->make(SETTING['site_theme'] . 'profile.partials.twofactor', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
        <?php if(\Route::current()->parameter('tab') === 'account'): ?>
            <?php echo $__env->make(SETTING['site_theme'] . 'profile.partials.account', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </div>

    <!-- Delete Modal -->
    <?php echo $__env->make(SETTING['site_theme'] . 'profile.partials.modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select2','data' => ['search' => 'true']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('select2'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['search' => 'true']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
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
<?php $__env->startPush('style'); ?>
    <style>
        .me-2.user-image {
            position: relative;
        }

        .me-2.user-image span {
            position: absolute;
            left: 0;
            font-size: 1rem;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(SETTING['site_theme'] . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\workspace\v1Xapps30-11\core\resources\views/theme/nova/profile/index.blade.php ENDPATH**/ ?>