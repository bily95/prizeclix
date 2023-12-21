<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>
        <?php if(View::hasSection('title')): ?>
            <?php echo $__env->yieldContent('title'); ?>
        <?php else: ?>
            Admin Dashboard
        <?php endif; ?>
    </title>
    <link rel="shortcut icon" href="<?php echo e(asset('/asset/uploads/setting/' . SETTING['siteFaviconImage'])); ?>" type="image/x-icon">
    <!-- theme Style -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('/asset/static/app/css/style.css')); ?>">
    
    <link href="<?php echo e(asset('asset/static/app/css/app.css')); ?>?v=1" rel="stylesheet">
    
    <link href="<?php echo e(asset('/asset/admin')); ?>/css/nucleo-icons.css" rel="stylesheet" />
    <link href="<?php echo e(asset('/asset/admin')); ?>/css/nucleo-svg.css" rel="stylesheet" />

    <link id="pagestyle" href="<?php echo e(asset('/asset/admin')); ?>/css/material-dashboard.min.css?v=3.1.0" rel="stylesheet" />
    <style>
        .table>:not(caption)>*>* {
            border-bottom-color: rgb(182 187 184 / 20%);
            font-size: 0.9rem;
            padding: 2px 15px;
        }

        input.form-control,
        select.form-control,
        textarea.form-control {
            border: 1px solid #ddd;
            padding: 5px;
            margin: 0;
        }

        .form-control:focus {
            border: 1px solid #ccc;
        }

        .form-label,
        label {
            margin-bottom: 0rem;
            margin-top: 0.7rem;
        }

        .table.align-items-center td,
        .table.align-items-center th {
            vertical-align: middle;
            text-align: center;
        }

        .navbar-vertical.navbar-expand-xs {
            z-index: 99;
        }

        .card .card-body {
            padding: 1rem;
        }

        .input-group-text {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: left;
            background: #ddd;
            margin: auto;
            height: 35px;
            width: 50px;
            color: #000;
            overflow: hidden;
        }

        .badge {
            font-size: 0.7rem;
            padding: 4px 9px;
            text-transform: capitalize;
        }
    </style>
    <?php echo $__env->yieldPushContent('style'); ?>
    <?php echo \Livewire\Livewire::styles(); ?>

</head>

<body class="g-sidenav-show  bg-gray-200">
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <div class="loader__label"></div>
        </div>
    </div>

    <aside
        class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="<?php echo e(route('welcome')); ?>" target="_blank">
                <img src="<?php echo e(asset('/asset/uploads/setting/' . SETTING['siteLogoImage'])); ?>" class="navbar-brand-img h-100"
                    alt="main_logo">
                <span class="ms-1 font-weight-bold text-white"><?php echo e(SETTING['siteName']); ?></span>
            </a>
        </div>
        <hr class="horizontal light mt-0 mb-2">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white active bg-gradient-primary" href="<?php echo e(route('admin.dashboard')); ?>">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="<?php echo e(route('user.home')); ?>">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">User Panel</span>
                    </a>
                </li>

                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">System
                    </h6>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#DailyTasks" class="nav-link text-white"
                        aria-controls="DailyTasks" role="button" aria-expanded="false">
                        <i class="material-icons-round opacity-10">list</i>
                        <span class="nav-link-text ms-2 ps-1">DailyTasks</span>
                    </a>
                    <div class="collapse" id="DailyTasks">
                        <ul class="nav ">
                            <li class="nav-item">
                                <a class="nav-link text-white" href="<?php echo e(route('moder.dailytasks.index')); ?>">
                                    <span class="sidenav-mini-icon"> A </span>
                                    <span class="sidenav-normal  ms-2  ps-1"> Configures </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link text-white " href="<?php echo e(route('moder.dailytasks.history')); ?>">
                                    <span class="sidenav-mini-icon"> D </span>
                                    <span class="sidenav-normal  ms-2  ps-1"> History </span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#coupons" class="nav-link text-white"
                        aria-controls="coupons" role="button" aria-expanded="false">
                        <i class="material-icons-round opacity-10">list</i>
                        <span class="nav-link-text ms-2 ps-1">Coupons</span>
                    </a>
                    <div class="collapse" id="coupons">
                        <ul class="nav ">
                            <li class="nav-item">
                                <a class="nav-link text-white" href="<?php echo e(route('moder.coupon.index')); ?>">
                                    <span class="sidenav-mini-icon"> A </span>
                                    <span class="sidenav-normal  ms-2  ps-1"> Configures </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link text-white " href="<?php echo e(route('moder.coupon.history')); ?>">
                                    <span class="sidenav-mini-icon"> D </span>
                                    <span class="sidenav-normal  ms-2  ps-1"> History </span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#LeaderBoard" class="nav-link text-white"
                        aria-controls="LeaderBoard" role="button" aria-expanded="false">
                        <i class="material-icons-round opacity-10">list</i>
                        <span class="nav-link-text ms-2 ps-1">LeaderBoard</span>
                    </a>
                    <div class="collapse" id="LeaderBoard">
                        <ul class="nav ">
                            <li class="nav-item">
                                <a class="nav-link text-white" href="<?php echo e(route('moder.leaderboard.index')); ?>">
                                    <span class="sidenav-mini-icon"> A </span>
                                    <span class="sidenav-normal  ms-2  ps-1"> Configures </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link text-white " href="<?php echo e(route('moder.leaderboard.history')); ?>">
                                    <span class="sidenav-mini-icon"> D </span>
                                    <span class="sidenav-normal  ms-2  ps-1"> History </span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#Providers" class="nav-link text-white"
                        aria-controls="Providers" role="button" aria-expanded="false">
                        <i class="material-icons-round opacity-10">list</i>
                        <span class="nav-link-text ms-2 ps-1">Affiliate Net.</span>
                    </a>
                    <div class="collapse" id="Providers">
                        <ul class="nav ">
                            <li class="nav-item">
                                <a class="nav-link text-white"
                                    href="<?php echo e(route('moder.offers-network.category.list')); ?>">
                                    <span class="sidenav-mini-icon"> A </span>
                                    <span class="sidenav-normal  ms-2  ps-1"> Categories </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link text-white "
                                    href="<?php echo e(route('moder.offers-network.manage-offers.list')); ?>">
                                    <span class="sidenav-mini-icon"> F </span>
                                    <span class="sidenav-normal  ms-2  ps-1"> Manage Offers </span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#Offerwalls" class="nav-link text-white"
                        aria-controls="Offerwalls" role="button" aria-expanded="false">
                        <i class="material-icons-round opacity-10">list</i>
                        <span class="nav-link-text ms-2 ps-1">Offerwalls</span>
                    </a>
                    <div class="collapse" id="Offerwalls">
                        <ul class="nav ">
                            <li class="nav-item">
                                <a class="nav-link text-white" href="<?php echo e(route('moder.offer.builtin.index')); ?>">
                                    <span class="sidenav-mini-icon"> A </span>
                                    <span class="sidenav-normal  ms-2  ps-1"> Builtin Sites </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link text-white " href="<?php echo e(route('moder.offer.index')); ?>">
                                    <span class="sidenav-mini-icon"> D </span>
                                    <span class="sidenav-normal  ms-2  ps-1">Web Sites </span>
                                </a>
                            </li>

                            <li class="nav-item ">
                                <a class="nav-link text-white " href="<?php echo e(route('moder.offer.analysis')); ?>">
                                    <span class="sidenav-mini-icon"> F </span>
                                    <span class="sidenav-normal  ms-2  ps-1"> Reports </span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="<?php echo e(route('moder.offers.config')); ?>">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">Anti-Fraud</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="<?php echo e(route('moder.ads.index')); ?>">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">Ads Rotator</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Essential
                    </h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="<?php echo e(route('moder.referral.index')); ?>">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text ms-1">Referral System</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#Users" class="nav-link text-white" aria-controls="Users"
                        role="button" aria-expanded="false">
                        <i class="material-icons-round opacity-10">list</i>
                        <span class="nav-link-text ms-2 ps-1">Users </span>
                    </a>
                    <div class="collapse" id="Users">
                        <ul class="nav ">
                            <li class="nav-item">
                                <a class="nav-link text-white" href="<?php echo e(route('moder.users.all')); ?>">
                                    <span class="sidenav-mini-icon"> A </span>
                                    <span class="sidenav-normal  ms-2  ps-1"> Manage Accounts </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link text-white " href="<?php echo e(route('moder.users.email.all')); ?>">
                                    <span class="sidenav-mini-icon"> D </span>
                                    <span class="sidenav-normal  ms-2  ps-1">E-mail Users </span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#Withdraw" class="nav-link text-white"
                        aria-controls="Withdraw" role="button" aria-expanded="false">
                        <i class="material-icons-round opacity-10">list</i>
                        <span class="nav-link-text ms-2 ps-1">Withdraw</span>
                    </a>
                    <div class="collapse" id="Withdraw">
                        <ul class="nav ">
                            <li class="nav-item">
                                <a class="nav-link text-white" href="<?php echo e(route('moder.withdraw.method.index')); ?>">
                                    <span class="sidenav-mini-icon"> A </span>
                                    <span class="sidenav-normal  ms-2  ps-1"> Manage Methods </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link text-white " href="<?php echo e(route('moder.withdraw.pending')); ?>">
                                    <span class="sidenav-mini-icon"> D </span>
                                    <span class="sidenav-normal  ms-2  ps-1">Pending Requests </span>
                                </a>
                            </li>

                            <li class="nav-item ">
                                <a class="nav-link text-white " href="<?php echo e(route('moder.withdraw.log')); ?>">
                                    <span class="sidenav-mini-icon"> F </span>
                                    <span class="sidenav-normal  ms-2  ps-1"> Reports </span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="<?php echo e(route('moder.ticket.index')); ?>">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">headset</i>
                        </div>
                        <span class="nav-link-text ms-1">Support</span>
                    </a>
                </li>

                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Site Control
                    </h6>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#SiteControl" class="nav-link text-white"
                        aria-controls="SiteControl" role="button" aria-expanded="false">
                        <i class="material-icons-round opacity-10">list</i>
                        <span class="nav-link-text ms-2 ps-1">Site Settings</span>
                    </a>
                    <div class="collapse" id="SiteControl">
                        <ul class="nav ">
                            <li class="nav-item">
                                <a class="nav-link text-white" href="<?php echo e(route('moder.settings.control')); ?>">
                                    <span class="sidenav-mini-icon"> A </span>
                                    <span class="sidenav-normal  ms-2  ps-1"> General </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link text-white " href="<?php echo e(route('moder.settings.general')); ?>">
                                    <span class="sidenav-mini-icon"> D </span>
                                    <span class="sidenav-normal  ms-2  ps-1">Apperance</span>
                                </a>
                            </li>

                            <li class="nav-item ">
                                <a class="nav-link text-white " href="<?php echo e(route('moder.settings.authentication')); ?>">
                                    <span class="sidenav-mini-icon"> F </span>
                                    <span class="sidenav-normal  ms-2  ps-1"> Social Auth. </span>
                                </a>
                            </li>

                            <li class="nav-item ">
                                <a class="nav-link text-white " href="<?php echo e(route('moder.settings.security')); ?>">
                                    <span class="sidenav-mini-icon"> F </span>
                                    <span class="sidenav-normal  ms-2  ps-1"> Captcha Setup. </span>
                                </a>
                            </li>

                            <li class="nav-item ">
                                <a class="nav-link text-white " href="<?php echo e(route('moder.email.setting')); ?>">
                                    <span class="sidenav-mini-icon"> F </span>
                                    <span class="sidenav-normal  ms-2  ps-1"> E-Mail Setup. </span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white " href="<?php echo e(route('moder.email.templates')); ?>">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">E-Mail Templates</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="<?php echo e(route('moder.language.manage')); ?>">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">Language</span>
                    </a>
                </li>

                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Extra
                    </h6>
                </li>

                

                <li class="nav-item">
                    <a class="nav-link text-white " href="javascript:void()"
                        onclick="event.preventDefault(); $('form#logout-form').submit();">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">logout</i>
                        </div>
                        <span class="nav-link-text ms-1">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        <form id="logout-form" action="<?php echo e(url('logout')); ?>"><?php echo csrf_field(); ?></form>
    </aside>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <h6 class="font-weight-bolder mb-0">Dashboard</h6>
                </nav>
                <form
                    action="<?php echo e(route('moder.users.search',$scope =str_replace('admin.users.','',request()->route()->getName()) ?? 'null')); ?>">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        <div class="form-control">
                            <input type="search" class="form-control" placeholder="username, Email ID">
                        </div>
                    </div>
                </form>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <ul class="navbar-nav  justify-content-end">
                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center me-3">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item dropdown pe-2 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-bell cursor-pointer"></i>
                            </a>
                            <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4"
                                aria-labelledby="dropdownMenuButton">
                                <?php $__empty_1 = true; $__currentLoopData = $adminNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notify): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <li class="mb-2">
                                        <a class="dropdown-item border-radius-md" href="<?php echo e($notify->click_url); ?>">
                                            <div class="d-flex py-1">

                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="text-sm font-weight-normal mb-1">
                                                        <span class="font-weight-bold">New message</span>
                                                        <?php echo e($notify->title); ?>

                                                    </h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        <i class="fa fa-clock me-1"></i>
                                                        <?php echo e(showDateTime($notify->created_at)); ?>

                                                    </p>
                                                </div>

                                            </div>
                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <li class="mb-2">No Message</li>
                                <?php endif; ?>
                                <hr class="">
                                <li class="mb-2">
                                    <a class="dropdown-item border-radius-md"
                                        href="<?php echo e(route('moder.notifications')); ?>">
                                        <div class="d-flex py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                    See All Notifications
                                                </h6>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid py-4 min-vh-100">

            

            <?php if (! empty(trim($__env->yieldContent('panel')))): ?>
                <?php echo $__env->yieldContent('panel'); ?>
            <?php else: ?>
                <?php echo e($slot); ?>

            <?php endif; ?>

        </div>
        <footer class="footer py-4  ">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>,
                            made with <i class="fa fa-heart"></i> by
                            <a href="https://fiverr.com/hansal02" class="font-weight-bold" target="_blank">Hansal
                                Scripts</a>
                            .
                        </div>
                    </div>
                    <div class="col-lg-6">

                    </div>
                </div>
            </div>
        </footer>
        </div>
    </main>
    <?php echo \Livewire\Livewire::scripts(); ?>

    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('loader', [])->html();
} elseif ($_instance->childHasBeenRendered('NSrAmZD')) {
    $componentId = $_instance->getRenderedChildComponentId('NSrAmZD');
    $componentTag = $_instance->getRenderedChildComponentTagName('NSrAmZD');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('NSrAmZD');
} else {
    $response = \Livewire\Livewire::mount('loader', []);
    $html = $response->html();
    $_instance->logRenderedChild('NSrAmZD', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>

    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('toasts', [])->html();
} elseif ($_instance->childHasBeenRendered('328sZf2')) {
    $componentId = $_instance->getRenderedChildComponentId('328sZf2');
    $componentTag = $_instance->getRenderedChildComponentTagName('328sZf2');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('328sZf2');
} else {
    $response = \Livewire\Livewire::mount('toasts', []);
    $html = $response->html();
    $_instance->logRenderedChild('328sZf2', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    <!-- Custom Theme Scripts -->

    <script src="<?php echo e(asset('asset/admin/app.js')); ?>?v=2"></script>

    <script src="<?php echo e(asset('asset/static/app/js/app.js')); ?>"></script>
    <script src="<?php echo e(asset('/asset/admin')); ?>/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="<?php echo e(asset('/asset/admin')); ?>/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
        Scrollbar.initAll();
    </script>
    <script src="<?php echo e(asset('/asset/admin')); ?>/js/material-dashboard.min.js?v=3.1.0"></script>

    <script>
        $("[title]").tooltip();
    </script>
    <?php echo $__env->yieldPushContent('script'); ?>

</body>

</html>
<?php /**PATH /home/xapphfem/v1.xapps.store/core/resources/views/admin/layout/primary.blade.php ENDPATH**/ ?>