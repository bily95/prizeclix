<div <?php if(is_local() == false): ?> wire:poll.70ms <?php endif; ?>>
  <?php $__currentLoopData = $statists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($entry->user): ?>
      

      <?php
        $withdrawal = \App\Models\Withdrawal::with(['method:id,name,image', 'user:id,username'])->find($entry->source_id);

        $offerLog = \App\Models\OfferLog::with(['users:id,username,google_id', 'users.profile:user_id,image'])->find($entry->source_id);

        $dailyTask = \Modules\DailyTasks\Entities\DailyTaskLog::with(['task:id,title', 'user:id,username,google_id', 'user.profile:user_id,image'])->find($entry->source_id);
      ?>

      <div class="offer-wrapper animated zoomIn">
        <?php switch($entry->from):
          case ('WITHDRAW_REQUEST'): ?>
            <?php echo $__env->make(SETTING['site_theme'] . 'addons.live-activity.partials.withdraw', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <?php break; ?>

          <?php case ('OFFER_REWARD'): ?>
          <?php case ('OFFER_RECHARGE'): ?>
            <?php echo $__env->make(SETTING['site_theme'] . 'addons.live-activity.partials.offerwall', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <?php break; ?>

          <?php case ('DAILY_TASKS'): ?>
            <?php echo $__env->make(SETTING['site_theme'] . 'addons.live-activity.partials.daily-tasks', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <?php break; ?>

          <?php case ('REFERRAL_BOUNCE'): ?>
          <?php case ('REFERRAL_COMMISSION'): ?>

          <?php case ('ADMIN_ADD_BALANCE'): ?>
          <?php case ('ADMIN_SUBTRACT_BALANCE'): ?>
          <?php case ('LEADERBOARD'): ?>
            <?php echo $__env->make(SETTING['site_theme'] . 'addons.live-activity.partials.bounces', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <?php break; ?>
        <?php endswitch; ?>
      </div>
    <?php endif; ?>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH /home/xapphfem/v1.xapps.store/core/resources/views/theme/nova/addons/live-activity/index.blade.php ENDPATH**/ ?>