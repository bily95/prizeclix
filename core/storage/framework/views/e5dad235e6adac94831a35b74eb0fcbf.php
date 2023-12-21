<div class="my-3">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Balance</h5>
                    <p><?php echo e(showAmount($user->balance)); ?> <?php echo e(GENERAL_SETTING['cur_sym']); ?></p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Withdrawals</h5>
                    <p><?php echo e(showAmount($totalWithdrawals)); ?> <?php echo e(GENERAL_SETTING['cur_sym']); ?></p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Completed Offers</h5>
                    <p><?php echo e($completedOffers); ?> <small>Offers</small> </p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Pending Offers</h5>
                    <p><?php echo e($pendingOffers); ?> <small>Offers</small> </p>
                </div>
            </div>
        </div>
        
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h3 class="card-title">
            <?php echo e($earningChart->options['chart_title']); ?>

        </h3>
        <div class="row">
            <div class="col-md-6" wire:ignore>
                <?php echo $earningChart->renderHtml(); ?>

            </div>
        </div>


        <?php echo $earningChart->renderChartJsLibrary(); ?>

        <script>
            Chart.defaults.backgroundColor = '#9BD0F5';
            Chart.defaults.borderColor = '#36A2EB';
            Chart.defaults.color = '#000';
        </script>
        <?php echo $earningChart->renderJs(); ?>

    </div>
</div>
<?php /**PATH D:\workspace\v1Xapps30-11\core\resources\views/theme/nova/profile/partials/about.blade.php ENDPATH**/ ?>