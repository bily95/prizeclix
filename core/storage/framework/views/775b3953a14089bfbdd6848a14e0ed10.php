<?php if($dailyTask && $dailyTask->user && $dailyTask->task): ?>

  <?php if($dailyTask->user->google_id): ?>
    <img src="<?php echo e($dailyTask->user->profile->image); ?>" alt="image" onclick="UserPublicProfile(<?php echo e($dailyTask->user_id); ?>)"/>
  <?php elseif($dailyTask->user->profile->image): ?>
    <img src="<?php echo e(getImage(imagePath()['users']['path'] . '/' . $dailyTask->user->profile->image)); ?>" alt="image" onclick="UserPublicProfile(<?php echo e($dailyTask->user_id); ?>)"/>
  <?php else: ?>
    <img src="https://ui-avatars.com/api/?name=<?php echo e($dailyTask->user->username); ?>" alt="image" onclick="UserPublicProfile(<?php echo e($dailyTask->user_id); ?>)"/>
  <?php endif; ?>

  <div>
    <p><?php echo e(Str::limit($dailyTask->task->title, 10, '.')); ?></p>
    <p><?php echo e(Str::limit($dailyTask->user->username, 10, '.')); ?></p>
  </div>
  <div class="offer-wrapper-inner">
    <p class="column">
      <span class="title">Offername: </span>
      <span class="value"><?php echo e(Str::limit($dailyTask->task->title, 10, '.')); ?></span>
    </p>
    <p class="column">
      <span class="title">Offerwall: </span>
      <span class="value">DailyTaks</span>
    </p>

    <p class="column">
      <span class="title">Reward:</span>
      <span class="value"><?php echo e(showAmount($entry->amount)); ?><?php echo e(GENERAL_SETTING['cur_sym']); ?></span>
    </p>
  </div>
  <p class="offer-amount text-white"><?php echo e(showAmount($entry->amount, 0)); ?></p>
<?php endif; ?>
<?php /**PATH D:\workspace\v1Xapps30-11\core\resources\views/theme/nova/addons/live-activity/partials/daily-tasks.blade.php ENDPATH**/ ?>