<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

<link rel="shortcut icon" href="<?php echo e(asset('asset/uploads/setting/' . SETTING['siteFaviconImage'])); ?>" />
<!-- CSRF Token -->
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">


<meta name="description" content="<?php echo e(SETTING['siteMetaDescription']); ?>" />
<meta name="keywords" content="<?php echo e(SETTING['siteMetaKeywords']); ?>" />


<!--  Essential META Tags -->
<meta property="og:title" content="<?php echo e(SETTING['siteName']); ?>">
<meta property="og:description" content="<?php echo e(SETTING['siteMetaDescription']); ?>">
<meta property="og:image" content="<?php echo e(asset('asset/uploads/setting/' . SETTING['siteSocialImage'])); ?>">
<meta property="og:url" content="<?php echo e(url('/')); ?>">
<meta name="twitter:card" content="summary_large_image">

<!--  Non-Essential, But Recommended -->
<meta property="og:site_name" content="<?php echo e(SETTING['siteName']); ?>">
<meta name="twitter:image:alt" content="Alt text for image">

<!--  Non-Essential, But Required for Analytics -->
<meta property="fb:app_id" content="<?php echo e(SETTING['siteName']); ?>" />
<meta name="twitter:site" content="<?php echo e('@' . SETTING['siteName']); ?>">

<title>
    <?php if(View::hasSection('title')): ?>
        <?php echo $__env->yieldContent('title'); ?>
    <?php else: ?>
        <?php if(Auth::check()): ?>
            <?php if(is_null(request()->segment(count(request()->segments())))): ?>
                <?php echo e(SETTING['siteMetaDescription']); ?> | <?php echo e(SETTING['siteName']); ?>

            <?php else: ?>
                <?php echo e(ucwords(request()->segment(count(request()->segments())))); ?> | <?php echo e(SETTING['siteName']); ?>

            <?php endif; ?>
        <?php else: ?>
            <?php echo e(SETTING['siteName']); ?> | <?php echo e(SETTING['siteMetaDescription']); ?>

        <?php endif; ?>
    <?php endif; ?>
</title>


<?php echo $__env->yieldPushContent('style'); ?>


<link rel="stylesheet" href="<?php echo e(asset('/asset/theme/nova/css/icons.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('asset/theme/nova/css/app.min.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('/asset/static/app/css/style.css?v=' . filemtime('asset/static/app/css/style.css'))); ?>" />



<?php echo \Livewire\Livewire::styles(); ?>


<?php if(!is_local()): ?>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-<?php echo e(set('googleAnalysis')); ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'AW-<?php echo e(set('googleAnalysis')); ?>');
    </script>
<?php endif; ?>


<script src="<?php echo e(asset('/asset/static/app/js/jquery.min.js')); ?>"></script>
<?php /**PATH /home/xapphfem/v1.xapps.store/core/resources/views/theme/nova/partial/head.blade.php ENDPATH**/ ?>