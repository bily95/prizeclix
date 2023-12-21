
<?php $__env->startSection('title', 'Welcome'); ?>
<?php $__env->startSection('content'); ?>
<div>
    <?php echo $__env->make('offersnetwork::index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make(SETTING['site_theme'] . 'offers.index', ['data' => $data], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.js-notify','data' => ['livewire' => 'true']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('js-notify'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['livewire' => 'true']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
<script>
    function loadUserOffers($provider)
    {
        $.ajax({
            type: "GET",
            dataType: "Json",
            url: "<?php echo e(url('api/offers-network/load')); ?>/" + $provider,
            success: function(res) {
              console.log($provider + ": " + res);  
            },
            error:function(error)
            {
                console.log($provider + ": " + error);
            }
        })
    }
    loadUserOffers('wannads');
    loadUserOffers('kiwiwall');
    loadUserOffers('cpx-research');
    loadUserOffers('monlix');
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(SETTING['site_theme'] . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xapphfem/v1.xapps.store/core/resources/views/theme/nova//welcome.blade.php ENDPATH**/ ?>