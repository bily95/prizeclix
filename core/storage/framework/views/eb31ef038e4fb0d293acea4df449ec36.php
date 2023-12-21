<div class="modal fade" id="deleteModal" tabindex="-1" data-bs-backdrop="static">
  <div class="modal-dialog" role="document">
      <div class="modal-content p-4">
          <h5 class="text-center" ><?php echo app('translator')->get('Delete Account'); ?></h5>
          <form action="<?php echo e(route('user.account.delete')); ?>" method="post">
              <?php echo csrf_field(); ?>
              <div class="modal-body">
                  <p class="text-center">Your account and all data will be deleted
                      permanently and this action cannot be undo.</p>
              </div>
              <div class="modal-footer  justify-content-center border-0">
                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                      ><?php echo app('translator')->get('Cancel'); ?></button>
                  <button type="submit" class="btn btn-primary"
                      ><?php echo app('translator')->get('Delete'); ?></button>
              </div>
          </form>
      </div>
  </div>
</div><?php /**PATH D:\workspace\v1Xapps30-11\core\resources\views/theme/nova/profile/partials/modal.blade.php ENDPATH**/ ?>