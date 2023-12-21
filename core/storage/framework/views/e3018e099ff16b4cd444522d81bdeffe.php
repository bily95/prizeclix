

<?php $__env->startSection('title', __('Leaderboard')); ?>

<?php $__env->startSection('content'); ?>
    <section class="pt-100 pb-100">
        <div class="container">
            <div class="row justify-content-center mt-2">
                <div class="col-md-12">
                    <div class="levels-rewards my-3">
                        <?php echo $__env->make('leaderboard::user.links', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="levels">
                        <?php echo $__env->make('leaderboard::user.card', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card text-center">
                        <div class="card-body">
                            <p><?php echo app('translator')->get('You Earned'); ?>:
                                <?php echo e($userPoints); ?><?php echo e(GENERAL_SETTING['cur_sym']); ?>

                                <?php echo e($type == 'daily' ? 'Today' : 'this month'); ?></p>
                            <p><?php echo app('translator')->get('Server Time:'); ?> <?php echo e(date('h')); ?>h <?php echo e(date('m')); ?>m <?php echo e(date('s')); ?>s</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 my-5">
                    <?php echo $__env->make('leaderboard::user.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('style'); ?>
    <style>
        body.dark-theme .panel:not(.user-panel) .panel-body {
            border: 0px !important;
            box-shadow: none !important;
            background: #383d52;
        }

        .user-panel.panel .panel-body {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 130px;
        }

        .user-panel.panel .panel-body img.d-block {
            position: absolute;
            top: -15px;
            z-index: 3;
        }

        .user-panel.panel .panel-body img:not(.d-block) {
            border-radius: 50%;
            position: absolute;
            top: 14px;
            z-index: 3;
            border: 1px solid #000;
        }

        .user-panel h5 {
            position: absolute;
            bottom: 0;
            margin: 25px 0 0 0;
            text-transform: uppercase;
        }

        body.dark-theme .panel-body h5 {
            background: #2a2e3f;
            padding: 7px;
            border-radius: 5px;
        }

        @media screen and (max-width:551px) {
            [class *=float] {
                float: unset !important;
                padding: 5px 0 0 0;
                text-align: center;
            }
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(SETTING['site_theme'] . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\workspace\v1Xapps30-11\core\Modules/Leaderboard\Resources/views/user/index.blade.php ENDPATH**/ ?>