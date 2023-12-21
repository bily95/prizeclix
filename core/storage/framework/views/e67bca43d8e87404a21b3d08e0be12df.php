<div class="card pt-100 pb-100" id="twofaauth">
    <div class="card-body">
        <h5 class="card-title">Two Factor Authentication</h5>
        <p><b>Two factor authentication</b> (2FA) strengthens access security by requiring two methods (also referred to
            as
            factors) to verify your identity.
            <br /> <b>Two factor authentication</b> protects against phishing, social engineering
            and
            password brute force attacks and secures your logins from attackers exploiting weak or stolen credentials.
        </p>
        <div class="row justify-content-center mt-4">
            <div class="col-12 ">
                <?php if(Auth::user()->ts): ?>
                    <div class="form-group text-center">
                        <a href="#0" class="btn btn-block btn-lg btn-danger" data-bs-toggle="modal"
                            data-bs-target="#disableModal">
                            <?php echo app('translator')->get('Disable 2FA'); ?></a>
                    </div>
                <?php else: ?>
                    <div class="form-group">
                        <label for="key" class="d-block">you can use the code: </label>
                        <div class="input-group input-group w-75 mb-3">
                            <input type="text" name="key" value="<?php echo e($secret); ?>"
                                class="form-control m-0 rounded-0" id="referralURL" readonly>
                            <span class="input-group-text copytext" id="copyBoard"> <i class="fa fa-copy"></i>
                            </span>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <label for="qrcode" class="d-block">Or scan this QR code with your Google Authenticator
                            App</label> <br>
                        <img class="mx-auto" src="<?php echo e($qrCodeUrl); ?>" height="200px" style="width: 200px">
                    </div>
                    <div class="form-group text-center">
                        <a href="#0" class="btn btn-primary btn-lg mt-3 mb-1" data-bs-toggle="modal"
                            data-bs-target="#enableModal"><?php echo app('translator')->get('Enable 2FA'); ?></a>
                    </div>
                <?php endif; ?>
            </div>

            <div class="col-12">
                <p></p>
                <a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en"
                    target="_blank">
                    <img src="<?php echo e(asset('/asset/static/app/imgs/getitonplaystore2fa.svg')); ?>" height="45px"
                        width="250px">

                </a>
            </div>
        </div><!-- //. single service item -->
    </div>
</div>



<!--Enable Modal -->
<div id="enableModal" class="modal fade" role="dialog">
    <div class="modal-dialog ">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo app('translator')->get('Verify Your Otp'); ?></h4>

            </div>
            <form action="<?php echo e(route('user.twofactor.enable')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-body ">
                    <div class="form-group">
                        <input type="hidden" name="key" value="<?php echo e($secret); ?>">
                        <label for="code">Enter the pin from Google Authenticator app:
                            Authenticator Code</label> <br>
                        <input type="text" class="form-control" name="code" placeholder="<?php echo app('translator')->get('Enter Google Authenticator Code'); ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('Verify'); ?></button>
                </div>
            </form>
        </div>

    </div>
</div>

<!--Disable Modal -->
<div id="disableModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo app('translator')->get('Verify Your Otp'); ?></h4>

            </div>
            <form action="<?php echo e(route('user.twofactor.disable')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" name="code" placeholder="<?php echo app('translator')->get('Enter Google Authenticator Code'); ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('Disable'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php $__env->startPush('style'); ?>
    <style>
        .copytext {
            cursor: pointer;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict";

            $('.copytext').on('click', function() {
                var copyText = document.getElementById("referralURL");
                copyText.select();
                copyText.setSelectionRange(0, 99999);
                document.execCommand("copy");
                notify('success', "Copied: " + copyText.value);
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/xapphfem/v1.xapps.store/core/resources/views/theme/nova/profile/partials/twofactor.blade.php ENDPATH**/ ?>