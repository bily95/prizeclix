<div>
    <button type="button" onclick="closeDailyTasks()">&times;</button>
    <h3 class="title"><?php echo app('translator')->get('Daily tasks'); ?></h3>
    <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="task-card">
            <div class="task_header">
                <p class="task-title">
                    <?php echo e($task->title); ?>

                    <?php if($task->type == 'offer'): ?>
                        <i class="fas fa-info-circle" title="Minimum Earnings <?php echo e($task->require); ?><?php echo e(GENERAL_SETTING['cur_sym']); ?>"></i>
                    <?php endif; ?>

                </p>
                <p class="task-info">Rewards: <?php echo e($task->reward); ?><?php echo e(GENERAL_SETTING['cur_sym']); ?></p>
            </div>
            <div class="task-claim">
                <?php if($task->type == 'earn'): ?>
                    <?php if(($userEarnings >= $task->require) && ($userClaimedEarn < $task->reward)): ?>
                        <a href="<?php echo e(route('dailytasks.claim', $task->id)); ?>" class="task-btn btn btn-primary">
                            <?php echo app('translator')->get('Claim'); ?>
                        </a>
                    <?php else: ?>
                        <a href="#!" class="task-btn btn btn-primary disabled">
                            <?php echo app('translator')->get('Claim'); ?>
                        </a>
                    <?php endif; ?>
                <?php else: ?>
                    <?php if(($userOffers >= $task->condition) && ($userClaimedOffers < $task->reward) && ($userClaimedEarn < $task->reward)): ?>
                        <a href="<?php echo e(route('dailytasks.claim', $task->id)); ?>" class="task-btn btn btn-primary">
                            <?php echo app('translator')->get('Claim'); ?>
                        </a>
                    <?php else: ?>
                        <a href="#!" class="task-btn btn btn-primary disabled">
                            <?php echo app('translator')->get('Claim'); ?>
                        </a>
                    <?php endif; ?>
                <?php endif; ?>

            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH D:\workspace\v1Xapps30-11\core\Modules/DailyTasks\Resources/views/index.blade.php ENDPATH**/ ?>