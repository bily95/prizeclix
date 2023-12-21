<?php $__env->startSection('title', trans('Login')); ?>
<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <?php echo app('translator')->get('Welcome Back!'); ?>
                    </h3>
                </div>
                <div class="card-body">
                    <?php if(SETTING['enable_google_auth']): ?>
                        <a href="<?php echo e(url('auth/google')); ?>">
                            <div class="d-grid gap-6">

                                <button class="btn btn-primary" type="button"
                                    ><i class="fab fa-google"></i> </button>
                            </div>
                        </a>
                    <?php endif; ?>

                    <form class="account-form" method="POST" action="<?php echo e(route('user.login.complete')); ?>"
                        onsubmit="return submitUserForm();">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label ><?php echo app('translator')->get('Email'); ?> <sup class="text-danger">*</sup></label>
                            <input type="text" name="username" value="<?php echo e(old('username')); ?>"
                                placeholder="<?php echo app('translator')->get('Email'); ?>" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label ><?php echo e(__('Password')); ?> <sup class="text-danger">*</sup></label>
                            <input id="password" type="password" class="form-control" placeholder="<?php echo app('translator')->get('Enter your password'); ?>"
                                name="password" required>
                        </div>

                        <div class="form-group">
                            <?php if($enabledCaptcha): ?>
                                <?php echo $captcha; ?>

                            <?php endif; ?>
                        </div>


                        <div class="form-group text-end">
                            <a href="<?php echo e(route('user.password.request')); ?>" class="text-drak"
                                ><?php echo app('translator')->get('Forgot Password?'); ?></a>
                        </div>

                        <div class="d-grid gap-6">
                            <button type="submit" class="btn btn-primary"
                                ><?php echo app('translator')->get('Login Now'); ?></button>
                        </div>
                        <p class="text-center mt-3"><span class=""><?php echo app('translator')->get('New to'); ?> <?php echo e(SETTING['siteName']); ?>?</span>
                            <a href="<?php echo e(route('user.register')); ?>"
                                class="text-base"><?php echo app('translator')->get('Register here'); ?></a>
                        </p>
                    </form>
                </div>
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
<?php echo $__env->make(SETTING['site_theme'] . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xapphfem/v1.xapps.store/core/resources/views/theme/nova/auth/login.blade.php ENDPATH**/ ?>