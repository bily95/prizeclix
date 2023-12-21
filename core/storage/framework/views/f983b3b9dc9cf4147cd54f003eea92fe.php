
<?php $__env->startSection('title', 'Referrals'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">statistics</h5>
                    <div class="d-flex">
                        <div class="panel text-center me-2 p-3 border-white border">
                            <h6 class="panel-title">Total Referrals</h6>
                            <p><?php echo e(showAmount($totalReferrals, 0)); ?></p>
                        </div>
                        <div class="panel text-center me-2 p-3 border-white border">
                            <h6 class="panel-title">Total Commission</h6>
                            <p><?php echo e(showAmount($totalCommission, 0)); ?><?php echo e(GENERAL_SETTING['cur_sym']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
        </div>
    </div>
    <div class="card text-center" id="referrallinkcommition">
        <div class="card-body text-center">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="text-center"><?php echo app('translator')->get('YOUR REFERRAL LINK'); ?></h4>

                    <div class="form-group">
                        <div class="input-group input-group w-75 mx-auto mb-3">
                            <input type="text" id="reflink" value="<?php echo e($userRefLink); ?>"
                                class="form-control m-0 rounded-0" readonly>
                            <span class="input-group-text bg-primary copytext" id="copyBoard" role="button">
                               <i class="fas fa-link"></i> Copy Link
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="share-icons">
                        <p class="bp-0 mb-0">share your referral link</p>
                        <div id="share-icons-holder"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-5">
        <div class="card-body">
            <h5 class="card-tit">
                Commission history
            </h5>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table','data' => ['th' => ['#', 'from', 'amount', 'date']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['th' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['#', 'from', 'amount', 'date'])]); ?>
                        <?php $__currentLoopData = $commissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(++$index); ?></td>
                                <td><?php echo e($log->bywo ? $log->bywho->username : 'Deleted Account'); ?></td>
                                <td><?php echo e(showAmount($log->amount)); ?><?php echo e(GENERAL_SETTING['cur_sym']); ?></td>
                                <td><?php echo e(showDateTime($log->created_at,'y-m-d')); ?>

                                    <br> <?php echo e(diffForHumans($log->created_at)); ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                    <?php echo e($commissions->links()); ?>

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
<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict";

            $('.copytext').on('click', function() {
                var copyText = document.getElementById("reflink");
                copyText.select();
                copyText.setSelectionRange(0, 99999);
                document.execCommand("copy");
                notify('info', 'Link Copied!');
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('/asset/static/social-share/jssocials.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/asset/static/social-share/jssocials-theme-flat.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('/asset/static/social-share/jssocials.min.js')); ?>"></script>
    <script>
        (function($) {
            $('#share-icons-holder').jsSocials({
                shares: ["twitter", "facebook", {
                    share: "telegram",
                    logo: "fab fa-telegram"
                }, "whatsapp", {
                    share: "email",
                    logo: "fas fa-envelope"
                }, "linkedin", "pinterest"],
                showLabel: false,
                showCount: false,
                url: "<?php echo e($userRefLink); ?>",
                text: "<?php echo e(SETTING['siteName'] . '|' . SETTING['siteMetaDescription']); ?>",
                shareIn: "popup",

            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(SETTING['site_theme'] . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xapphfem/v1.xapps.store/core/resources/views/theme/nova/referral/index.blade.php ENDPATH**/ ?>