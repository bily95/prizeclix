<?php $__env->startSection('title', trans('Register')); ?>
<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <?php echo app('translator')->get('Start for free!'); ?>
                    </h3>
                </div>
                <div class="card-body">
                    <?php if(SETTING['enable_google_auth']): ?>
                        <a href="<?php echo e(url('auth/google')); ?>">
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" type="button"><i class="fab fa-google"></i></button>
                            </div>
                        </a>
                    <?php endif; ?>
                    <form class="account-form w-100" action="<?php echo e(route('user.register.complete')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php if(session()->get('reference') != null): ?>
                            <div class="form-group">
                                <label for="referenceBy"><?php echo app('translator')->get('Reference By'); ?> <sup class="text-danger">*</sup></label>
                                <input type="text" name="referBy" id="referenceBy" class="form-control"
                                    value="<?php echo e(session()->get('reference')); ?>" readonly>
                            </div>
                        <?php endif; ?>
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="username"><?php echo e(__('Username')); ?></label>
                                        <input id="username" type="text" class="form-control checkUser" name="username"
                                            value="<?php echo e(old('username')); ?>" tabindex="1" required
                                            placeholder="<?php echo app('translator')->get('Username'); ?>">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email"><?php echo app('translator')->get('E-Mail Address'); ?></label>
                                        <input id="email" type="email" tabindex="2" class="form-control checkUser"
                                            name="email" value="<?php echo e(old('email')); ?>" required
                                            placeholder="<?php echo app('translator')->get('E-Mail Address'); ?>">
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="form-group hover-input-popup">
                                        <label for="password"><?php echo app('translator')->get('Password'); ?></label>
                                        <input id="password" type="password" tabindex="3" class="form-control"
                                            name="password" required placeholder="<?php echo app('translator')->get('Password'); ?>">
                                        <?php if(GENERAL_SETTING['secure_password']): ?>
                                            <div class="input-popup">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <p class="error lower"><?php echo app('translator')->get('1 small letter minimum'); ?></p>
                                                        <p class="error capital"><?php echo app('translator')->get('1 capital letter minimum'); ?></p>
                                                        <p class="error number"><?php echo app('translator')->get('1 number minimum'); ?></p>

                                                    </div>
                                                    <div class="col-lg-6">
                                                        <p class="error special"><?php echo app('translator')->get('1 special character minimum'); ?></p>
                                                        <p class="error minimum"><?php echo app('translator')->get('6 character password'); ?></p>
                                                    </div>
                                                </div>

                                            </div>
                                        <?php endif; ?>
                                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e(__($message)); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="password-confirm"><?php echo app('translator')->get('Confirm Password'); ?></label>
                                        <input id="password-confirm" tabindex="4" type="password" class="form-control"
                                            name="password_confirmation" required autocomplete="new-password"
                                            placeholder="<?php echo app('translator')->get('Confirm Password'); ?>">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <?php if($enabledCaptcha): ?>
                                            <?php echo $captcha; ?>

                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="checkbox" required class="custom-form-input" data-on="yes" data-off="no" />
                                        <label class="custom-form-label"><?php echo app('translator')->get('Signing up you agree to the '); ?>
                                            <a href="<?php echo e(route('tos')); ?>"><?php echo app('translator')->get('Terms of Service'); ?></a> and
                                            <a href="<?php echo e(route('policy')); ?>"><?php echo app('translator')->get('Privacy Policy'); ?></a>
                                        </label>
                                    </div>
                                </div>

                                <div class="d-grid gap-6">
                                    <button type="submit" class="btn btn-primary mt-3"><?php echo app('translator')->get('Register
                                                                                                                                                                                                                                                                                                                Now'); ?></button>
                                    <div class="col-12 text-center">
                                        <p class="text-center mt-3"><span class=""><?php echo app('translator')->get('Have an account?'); ?></span> <a
                                                href="<?php echo e(route('user.login')); ?>" class="text-base"><?php echo app('translator')->get('Login here'); ?></a>
                                        </p>
                                    </div>
                                </div>
                            </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="existModalCenter" tabindex="-1" role="dialog" aria-labelledby="existModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="existModalLongTitle">
                        <?php echo app('translator')->get('Warning'); ?></h5>

                </div>
                <div class="modal-body">
                    <h6><?php echo app('translator')->get('You already have an account please Sign in '); ?></h6>
                </div>
                <div class="modal-footer">
                    <a href="<?php echo e(route('user.login')); ?>" class="btn btn-primary"><?php echo app('translator')->get('Login'); ?></a>
                </div>
            </div>
        </div>
    </div>

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
<?php $__env->stopSection(); ?>
<?php $__env->startPush('style'); ?>
    <style>
        .form-group.hover-input-popup {
            position: relative;
        }

        .form-group.hover-input-popup .input-popup {
            position: absolute;
            top: 70px;
            left: 28px;
            background: #383d52;
            color: #bcb7be;
            padding: 5px;
            border-radius: 5px;
            display: none;
            z-index: 99;
        }

        .form-group.hover-input-popup:hover .input-popup {
            display: block;
        }

        .input-popup p {
            padding: 2px 0;
            margin: 0px;
        }

        .input-popup p.error {
            color: coral;
        }

        .input-popup p.success {
            color: rgb(4, 191, 197);
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script'); ?>
    <?php if(GENERAL_SETTING['secure_password']): ?>
        <script src="<?php echo e(asset('asset/static/app/js/secure_password.js')); ?>"></script>
    <?php endif; ?>
    <script>
        "use strict";

        (function($) {

            <?php if(GENERAL_SETTING['secure_password']): ?>
                $('input[name=password]').on('input', function() {
                    secure_password($(this));
                });
            <?php endif; ?>

            $('.checkUser').on('focusout', function(e) {
                var url = '<?php echo e(route('user.checkUser')); ?>';
                var value = $(this).val();
                var token = '<?php echo e(csrf_token()); ?>';

                if ($(this).attr('name') == 'email') {
                    var data = {
                        email: value,
                        _token: token
                    }
                }
                if ($(this).attr('name') == 'username') {
                    var data = {
                        username: value,
                        _token: token
                    }
                }
                $.post(url, data, function(response) {
                    if (response['data'] && response['type'] == 'email') {
                        $('#existModalCenter').modal('show');
                    } else if (response['data'] != null) {
                        $(`.${response['type']}Exist`).text(`${response['type']} already exist`);
                    } else {
                        $(`.${response['type']}Exist`).text('');
                    }
                });
            });

        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(SETTING['site_theme'] . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\workspace\v1Xapps30-11\core\resources\views/theme/nova/auth/register.blade.php ENDPATH**/ ?>