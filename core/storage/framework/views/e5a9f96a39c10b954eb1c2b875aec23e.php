<div id="laravel-livewire-toasts" data-bs-delay="<?php echo e(config('laravel-livewire-toasts.hide_delay')); ?>"
    data-error-message="<?php echo e(__(config('laravel-livewire-toasts.error_message'))); ?>"
    class="toast position-fixed align-items-center text-white bg-<?php echo e($color); ?> border-0 fade hide"
    style="top: 1rem; right: 1rem; width: 18rem; z-index: 1090;">

    <div class="d-flex">
        <div class="toast-body">
            <?php echo e($message); ?>

        </div>

        <button type="button" data-bs-dismiss="toast" class="btn-close btn-close-white me-2 m-auto"></button>
    </div>

</div>
<?php /**PATH /home/xapphfem/v1.xapps.store/core/resources/views/vendor/laravel-livewire-toasts/toasts.blade.php ENDPATH**/ ?>