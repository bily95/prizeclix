<div>
  <div class="chat-container <?php if($showChat): ?> active <?php endif; ?>">
    <?php if($showChat): ?>
    <div class="chart-info position-absolute top-0">
      <div class="current-online">
        <i class="fas fa-dot-circle info"></i> <?php echo e(showAmount($currentOnline, 0)); ?> online
      </div>
      <div class="support">
        <a href="<?php echo e(route('user.ticket.open')); ?>">
          <i class="fas fa-headset fa-2x me-5"></i>
        </a>
      </div>
    </div>
      <div class="chat-messages" wire:boll>
        <div class="load-more text-center">
          <div class="btn btn-sm btn-dark align-self-center p-0 px-2" wire:click="loadMore()">..</div>
        </div>
        <?php $__currentLoopData = $chats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if($message->users): ?>
            <div class="chats-wrapper">
              <div class="wrapper-top">
                <div>
                  <div class="chat-header">
                    <div class="time">
                      <?php echo e(diffForHumans($message->created_at)); ?>

                    </div>
                    <img src="<?php echo e(getUserImage($message->users)); ?>" alt="" />
                    <div class="username">
                      <p class="user m-0 px-1 py-0"><?php echo e(ucfirst($message->users->username)); ?></p>
                      <?php if($message->users->profile->user_id == 1): ?>
                        <p class="admin-chat info m-0 px-1 py-0">
                          Owner
                        </p>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="wrapper-bottom">
                <p><?php echo e($message->message); ?></p>
              </div>
            </div>
          <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <div class="chart-form">
        <?php if(auth()->guard()->check()): ?>
          <form id="chat_form" wire:submit.prevent="sendMessage">
            <input class="form-control" type="text" wire:model.defer="messageText" placeholder="Say Something" />
            <div class="animas-holder"></div>
            <button type="submit" class="btn btn-info btn-dark">
              <i class="fas fa-paper-plane"></i>
            </button>
          </form>
        <?php else: ?>
          <form id="chat_form" action="<?php echo e(route('user.login')); ?>">
            <input class="form-control" type="text" wire:model.defer="messageText" placeholder="Please Login" />
          </form>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>
</div>
<?php /**PATH /home/xapphfem/v1.xapps.store/core/resources/views/theme/nova/addons/chat-room/index.blade.php ENDPATH**/ ?>