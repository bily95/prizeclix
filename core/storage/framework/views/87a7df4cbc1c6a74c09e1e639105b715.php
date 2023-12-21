<div class="page">
    <div>
        <!-- main-header -->
        <div class="main-header side-header nav nav-item sticky">
            <div class="main-container container-fluid">
                <div class="main-header-left">
                    
                    <div class="app-sidebar__toggle" data-bs-toggle="sidebar">
                        <a class="open-toggle" href="javascript:void(0);"><i
                                class="header-icon fe fe-align-left"></i></a>
                        <a class="close-toggle" href="javascript:void(0);"><i class="header-icon fe fe-x"></i></a>
                    </div>
                    <div class="responsive-logo">
                      <a href="<?php echo e(route('welcome')); ?>" class="header-logo">
                          <img src="<?php echo e(asset('asset/uploads/setting/' . set('siteSmallLogoImage'))); ?>"
                              class="mobile-logo logo-1" style="width: 35px;" alt="logo">
                          <img src="<?php echo e(asset('asset/uploads/setting/' . set('siteSmallLogoImage'))); ?>"
                              class="mobile-logo dark-logo-1" style="width: 35px;" alt="logo">
                      </a>
                  </div>
                    <div class="logo-horizontal">
                        <a href="<?php echo e(route('welcome')); ?>" class="header-logo">
                            <img src="<?php echo e(asset('asset/uploads/setting/' . SETTING['siteLogoImage'])); ?>"
                                class="mobile-logo logo-1" style="width: 35px;" alt="logo">
                            <img src="<?php echo e(asset('asset/uploads/setting/' . SETTING['siteLogoImage'])); ?>"
                                class="mobile-logo dark-logo-1" style="width: 35px;" alt="logo">
                        </a>
                    </div>
                </div>

                <div class="main-header-right">
                    
                    <div class="navbar navbar-nav-right responsive-navbar navbar-dark mb-0 p-0">
                        <ul class="nav nav-item header-icons navbar-nav-right ms-auto">
                            <li class="dropdown nav-item top-chat">
                                <a class="new nav-link nav-link-bg" onclick="toggleChat()">
                                    <svg viewBox="0 0 512 512" class="header-icon-svgs" width="24" height="24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <title />
                                        <g data-name="1" id="_1">
                                            <path
                                                d="M364,450a15,15,0,0,1-11.29-5.12L273.5,354.34H118.64a64.58,64.58,0,0,1-64.5-64.51V112.51A64.58,64.58,0,0,1,118.64,48h273a64.58,64.58,0,0,1,64.5,64.51V289.83a64.58,64.58,0,0,1-64.5,64.51H379V435a15,15,0,0,1-15,15ZM118.64,78a34.55,34.55,0,0,0-34.5,34.51V289.83a34.55,34.55,0,0,0,34.5,34.51H280.3a15,15,0,0,1,11.29,5.12L349,395.09V339.34a15,15,0,0,1,15-15h27.59a34.55,34.55,0,0,0,34.5-34.51V112.51A34.55,34.55,0,0,0,391.63,78Z" />
                                            <path
                                                d="M199.63,264A15.13,15.13,0,0,1,189,259.61c-.34-.35-.67-.72-1-1.1a14.34,14.34,0,0,1-.87-1.18q-.41-.61-.75-1.26c-.23-.43-.44-.88-.63-1.33s-.35-.92-.5-1.38-.26-1-.36-1.43-.17-1-.22-1.45a14.66,14.66,0,0,1-.07-1.48,14.33,14.33,0,0,1,.07-1.47c.05-.49.13-1,.22-1.46s.22-1,.36-1.42.31-.94.5-1.39.4-.89.63-1.32a14.6,14.6,0,0,1,.75-1.27c.27-.4.56-.8.87-1.18s.65-.75,1-1.1a15.15,15.15,0,0,1,12.08-4.32c.49.05,1,.13,1.46.22s1,.22,1.42.36.94.31,1.39.5.89.4,1.32.63.86.48,1.27.75.8.56,1.18.87.75.65,1.09,1,.68.72,1,1.1.6.78.87,1.18a14.6,14.6,0,0,1,.75,1.27q.35.65.63,1.32c.19.45.35.92.5,1.39s.26.94.36,1.42.17,1,.22,1.46.07,1,.07,1.47,0,1-.07,1.48-.13,1-.22,1.45-.22,1-.36,1.43-.31.93-.5,1.38-.4.9-.63,1.33-.48.85-.75,1.26-.57.8-.87,1.18-.65.75-1,1.1-.71.68-1.09,1-.78.6-1.18.87-.84.52-1.27.75-.87.44-1.32.63-.92.35-1.39.5-.94.26-1.42.36-1,.17-1.46.22S200.12,264,199.63,264Z" />
                                            <path
                                                d="M310.64,264c-.49,0-1,0-1.47-.07s-1-.13-1.46-.22-1-.22-1.43-.36-.93-.31-1.38-.5-.89-.4-1.32-.63a14.6,14.6,0,0,1-1.27-.75c-.4-.27-.8-.56-1.18-.87s-.75-.65-1.1-1-.68-.72-1-1.1-.6-.78-.87-1.18a14.6,14.6,0,0,1-.75-1.27q-.35-.65-.63-1.32c-.19-.45-.35-.92-.5-1.38s-.26-1-.36-1.43-.17-1-.22-1.45-.07-1-.07-1.48,0-1,.07-1.48.13-1,.22-1.45.22-1,.36-1.43.31-.93.5-1.38.4-.9.63-1.33.48-.85.75-1.26a14.34,14.34,0,0,1,.87-1.18c.31-.38.65-.75,1-1.1s.72-.68,1.1-1,.78-.6,1.18-.87a14.6,14.6,0,0,1,1.27-.75q.65-.34,1.32-.63c.45-.19.92-.35,1.38-.5s1-.26,1.43-.36,1-.17,1.46-.22a16.15,16.15,0,0,1,2.95,0c.48.05,1,.13,1.45.22s1,.22,1.43.36.93.31,1.38.5.89.4,1.32.63a14.6,14.6,0,0,1,1.27.75c.4.27.8.56,1.18.87s.75.65,1.1,1,.68.72,1,1.1a14.34,14.34,0,0,1,.87,1.18q.4.62.75,1.26c.23.43.44.88.63,1.33s.35.92.5,1.38.26,1,.36,1.43.17,1,.22,1.45a15.68,15.68,0,0,1,0,3c-.05.48-.13,1-.22,1.45s-.22,1-.36,1.43-.31.93-.5,1.38-.4.89-.63,1.32a14.6,14.6,0,0,1-.75,1.27c-.27.4-.56.8-.87,1.18s-.65.75-1,1.1-.72.68-1.1,1-.78.6-1.18.87a14.6,14.6,0,0,1-1.27.75q-.65.34-1.32.63c-.45.19-.92.35-1.38.5s-.95.26-1.43.36-1,.17-1.45.22S311.13,264,310.64,264Z" />
                                            <path
                                                d="M255.13,264a14.6,14.6,0,0,1-1.47-.07c-.49-.05-1-.13-1.46-.22s-.95-.22-1.42-.36-.93-.31-1.38-.5-.9-.4-1.33-.63a15.58,15.58,0,0,1-2.45-1.62c-.38-.31-.75-.65-1.09-1a14.67,14.67,0,0,1-1-1.1c-.31-.38-.61-.78-.88-1.18a14.6,14.6,0,0,1-.75-1.27q-.34-.65-.63-1.32c-.18-.45-.35-.92-.49-1.39a13.41,13.41,0,0,1-.36-1.42,14.46,14.46,0,0,1-.29-2.93,14.66,14.66,0,0,1,.07-1.48,14.51,14.51,0,0,1,.22-1.45,14.24,14.24,0,0,1,.36-1.43c.14-.46.31-.93.49-1.38s.4-.89.63-1.32a14.6,14.6,0,0,1,.75-1.27c.27-.4.57-.8.88-1.18a14.67,14.67,0,0,1,1-1.1c.34-.34.71-.68,1.09-1a15.58,15.58,0,0,1,2.45-1.62c.43-.23.88-.44,1.33-.63s.91-.35,1.38-.5.95-.26,1.42-.36,1-.17,1.46-.22a16.15,16.15,0,0,1,3,0c.49.05,1,.13,1.45.22s1,.22,1.43.36.93.31,1.38.5.9.4,1.33.63.85.48,1.26.75a14.5,14.5,0,0,1,1.19.87c.38.31.75.65,1.09,1a14.67,14.67,0,0,1,1,1.1c.31.38.6.78.88,1.18a14.6,14.6,0,0,1,.75,1.27,13.2,13.2,0,0,1,.62,1.32,14.25,14.25,0,0,1,.5,1.38c.14.47.26,1,.36,1.43a14.51,14.51,0,0,1,.22,1.45,14.66,14.66,0,0,1,.07,1.48,14.46,14.46,0,0,1-.29,2.93c-.1.48-.22,1-.36,1.42a13.53,13.53,0,0,1-.5,1.39,13.2,13.2,0,0,1-.62,1.32c-.23.43-.48.86-.75,1.27s-.57.8-.88,1.18a14.67,14.67,0,0,1-1,1.1c-.34.34-.71.68-1.09,1a14.5,14.5,0,0,1-1.19.87q-.61.4-1.26.75c-.43.23-.88.44-1.33.63s-.91.35-1.38.5-.95.26-1.43.36-1,.17-1.45.22A14.66,14.66,0,0,1,255.13,264Z" />
                                        </g>
                                    </svg>
                                </a>
                            </li>
                            <?php if(auth()->guard()->guest()): ?>
                                <?php echo $__env->make(SETTING['site_theme'] . 'partial.guset-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endif; ?>
                            <?php if(auth()->guard()->check()): ?>
                                <?php echo $__env->make(SETTING['site_theme'] . 'partial.auth-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endif; ?>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /main-header -->

        <!-- main-sidebar -->
        <div class="sticky">
            <aside class="app-sidebar">
                <div class="main-sidebar-header active">
                    <a class="header-logo active" href="<?php echo e(route('welcome')); ?>">
                        <img src="<?php echo e(asset('asset/uploads/setting/' . SETTING['siteSmallLogoImage'])); ?>"
                            class="main-logo desktop-logo" alt="logo" />
                        <img src="<?php echo e(asset('asset/uploads/setting/' . SETTING['siteLogoImage'])); ?>"
                            class="main-logo desktop-dark" style="filter: invert(1) grayscale(100%) brightness(200%)"
                            alt="logo" />
                        <img src="<?php echo e(asset('asset/uploads/setting/' . SETTING['siteSmallLogoImage'])); ?>"
                            class="main-logo mobile-logo" alt="logo" />
                        <img src="<?php echo e(asset('asset/uploads/setting/' . SETTING['siteLogoImage'])); ?>"
                            class="main-logo mobile-dark" alt="logo" />
                    </a>
                </div>
                <div class="main-sidemenu">
                    <div class="slide-left disabled" id="slide-left">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                        </svg>
                    </div>
                    <ul class="side-menu navbar-menu">
                        <li class="side-item side-item-category">Main</li>
                        <li class="slide">
                            <a class="side-menu__item" href="<?php echo e(route('user.home')); ?>">
                                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" class="left-menu-icon" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M225.814 32.316c-3.955-.014-7.922-.01-11.9.007-19.147.089-38.6.592-58.219 1.32l5.676 24.893c20.431-2.31 42.83-4.03 65.227-4.89 12.134-.466 24.194-.712 35.892-.65 35.095.183 66.937 3.13 87.77 11.202l8.908 3.454-3.977 8.685c-29.061 63.485-35.782 124.732-31.228 184.826 2.248-71.318 31.893-134.75 70.81-216.068-52.956-8.8-109.634-12.582-168.959-12.78zm28.034 38.79c-8.74.007-17.65.184-26.559.526-41.672 1.6-83.199 6.49-110.264 12.096 30.233 56.079 54.69 112.287 70.483 167.082a71.934 71.934 0 0 1 5.894.045c4.018.197 7.992.742 11.875 1.59-16.075-51.397-34.385-98.8-57.146-146.131l-5.143-10.694 11.686-2.068c29.356-5.198 59.656-7.21 88.494-7.219 1.922 0 3.84.007 5.748.024 18.324.16 35.984 1.108 52.346 2.535l11.054.965-3.224 10.617c-18.7 61.563-22.363 127.678-11.79 190.582.176.163.354.325.526.49 3.813-1.336 7.38-2.698 10.705-4.154-8.254-67.394-4.597-136.923 26.229-209.201-17.202-4.383-43.425-6.674-72.239-7.034a656.656 656.656 0 0 0-8.675-.05zm144.945 7.385c-30.956 65.556-52.943 118.09-56.547 174.803 20.038-66.802 58.769-126.685 102.904-165.158a602.328 602.328 0 0 0-46.357-9.645zM103.832 97.02c-18.76 3.868-37.086 8.778-54.812 15.562 8.626 7.48 24.22 21.395 43.14 39.889 8.708-8.963 17.589-17.818 26.852-25.87a1067.587 1067.587 0 0 0-15.18-29.581zm142.023 7.482c-13.62-.066-27.562.324-41.554 1.293-1.468 13.682-9.56 26.482-19.225 39.07 15.431 36.469 28.758 73.683 40.756 113.194 18.375 5.42 36.554 11.827 51.28 19.504-5.47-42.458-4.722-85.963 2.38-128.508-12.885-13.31-19.597-28.09-20.135-44.34a621.48 621.48 0 0 0-13.502-.213zm182.018 26.985c-24.73 29.3-46.521 65.997-61.37 105.912 27.264-38.782 60.79-69.032 96.477-90.4a1318.664 1318.664 0 0 0-35.107-15.512zm-300.74 11.959c-14.594 13.188-29.014 29.017-44.031 44.097 32.289 19.191 59.791 41.918 82.226 67.66 1.393-.526 2.8-.999 4.215-1.43-10.498-36.096-24.885-73.033-42.41-110.327zM360.52 268.198c-16.397 19.788-31.834 30.235-53.09 38.57 2.391 9.22-1.16 19.805-9.334 27.901-4.808 4.761-10.85 10.188-19.684 13.715a62.896 62.896 0 0 0 3.9 2.127c12.364 6.17 34.207 4.18 54.5-5.049 20.23-9.2 38.302-25.092 45-41.191 3.357-9.05.96-13.77-4.917-20.692-4.184-4.925-10.295-9.89-16.375-15.38zm-170.079.586c-10.715-.098-21.597 2.994-30.59 9.76-12.79 9.623-22.65 26.784-22.738 55.934v.2l-.01.2c-2.92 61.381 1.6 89.7 10.555 105.065 7.904 13.562 21.05 20.054 40.28 31.994.916-2.406 1.87-5.365 2.765-9.098 2.277-9.499 4.161-22.545 5.355-36.975 2.389-28.858 2.04-63.51-1.955-88.445l-2.111-13.19 13.016 2.995c31.615 7.273 49.7 8.132 60.2 6.28 10.502-1.854 14.061-5.523 20.221-11.624 5.79-5.732 5.682-7.795 4.456-11.021-1.227-3.227-6.149-8.545-14.5-13.633-16.703-10.176-45.085-19.611-71.614-26.647a53.988 53.988 0 0 0-13.33-1.795zm189.1 69.416c-10.013 9.754-22.335 17.761-35.277 23.647-20.983 9.542-44.063 13.907-63.211 7.553-6.76 2.516-10.687 5.407-12.668 7.8-2.718 3.284-2.888 5.7-1.967 9.16.92 3.46 3.665 7.568 7.059 10.524 3.393 2.956 7.426 4.492 8.959 4.564 46.794 2.222 67.046-11.207 92.277-26.783 7.358-4.542 10.174-13.743 9.469-22.931-.353-4.594-1.69-8.911-3.233-11.63a9.009 9.009 0 0 0-1.408-1.904zm-166.187 9.096c2.727 25.068 2.772 54.314.642 80.053-1.247 15.072-3.175 28.779-5.789 39.685-1.137 4.746-2.388 8.954-3.9 12.659l146.697-6.465c-1.656-6.149-3.344-12.324-5.031-18.502a127.004 127.004 0 0 1-17.24 4.424l.044.73-8.316.518c-5.121.614-10.452.953-15.983.992l-83.86 5.21 2.493-11.607c7.947-37.006 8.68-69.589 3.778-105.234a353.433 353.433 0 0 1-13.536-2.463zm31.972 4.684c3.948 31.933 3.473 62.41-2.406 95.2l19.264-1.196a39.44 39.44 0 0 1-6.1-14.778c-1.296-6.88-.575-14.538 3.926-20.87.199-.281.414-.55.627-.821-5.246-4.845-9.628-11.062-11.614-18.524-2.114-7.944-.794-17.67 5.497-25.27 2.079-2.51 4.592-4.776 7.543-6.816-2.61-2.08-4.898-4.285-6.874-6.582-3.064.021-6.345-.093-9.863-.343zm132.666 41.785c-23.456 14.253-49.81 27.876-96.41 25.664a26.402 26.402 0 0 1-4.518-.615c-1.233.553-1.891 1.256-2.382 1.947-.963 1.355-1.532 3.8-.909 7.113 1.248 6.627 7.525 13.889 13.37 14.569 41.385 4.813 69.979-8.726 87.341-24.477 8-7.258 8.068-11.9 6.89-16.951-.59-2.523-1.89-4.969-3.382-7.25zm-6.683 49.062a114.657 114.657 0 0 1-8.547 4.86c1.65 6.051 3.304 12.102 4.937 18.154l19.92-3.572c-5.14-4.387-9.162-8.954-12.39-13.496-1.442-2.029-2.713-4.001-3.92-5.946z"></path></svg>
                                <span class="side-menu__label">Home</span>
                            </a>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                                <i class="fas fa-question-circle me-2"></i>
                                <span class="side-menu__label">Earn</span><i class="angle fe fe-chevron-right"></i>
                            </a>
                            <ul class="slide-menu load-category">
                            </ul>
                        </li>

                        <li class="slide">
                            <a class="side-menu__item" href="<?php echo e(route('user.withdraw')); ?>">
                              <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" class="left-menu-icon" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path fill="none" d="M0 0h24v24H0z"></path><path d="M19 14V6c0-1.1-.9-2-2-2H3c-1.1 0-2 .9-2 2v8c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zm-9-1c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3zm13-6v11c0 1.1-.9 2-2 2H4v-2h17V7h2z"></path></svg>
                                <span class="side-menu__label">Cashout</span>
                            </a>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" href="<?php echo e(route('user.leaderboard')); ?>">
                              <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" class="left-menu-icon" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path fill="none" d="M0 0h24v24H0z"></path><path d="M7.5 21H2V9h5.5v12zm7.25-18h-5.5v18h5.5V3zM22 11h-5.5v10H22V11z"></path></svg>
                                <span class="side-menu__label">Ranking</span>
                            </a>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" href="<?php echo e(auth()->check() ? '#' : route('user.login')); ?>"
                                <?php if(auth()->guard()->check()): ?>
onclick="openDailyTasks()" <?php endif; ?>>
<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" class="left-menu-icon" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M305.975 298.814l22.704 2.383V486l-62.712-66.965V312.499l18.214 8.895zm-99.95 0l-22.716 2.383V486l62.711-66.965V312.499l-18.213 8.895zm171.98-115.78l7.347 25.574-22.055 14.87-1.847 26.571-25.81 6.425-10.803 24.314-26.46-2.795-18.475 19.087L256 285.403l-23.902 11.677-18.475-19.15-26.46 2.795-10.803-24.313-25.81-6.363-1.847-26.534-22.118-14.92 7.348-25.573-15.594-21.544 15.644-21.52-7.398-25.523 22.068-14.87L150.5 73.03l25.86-6.362 10.803-24.313 26.46 2.794L232.098 26 256 37.677 279.902 26l18.475 19.149 26.46-2.794 10.803 24.313 25.81 6.425 1.847 26.534 22.055 14.87-7.347 25.574 15.656 21.407zm-49.214-21.556a72.242 72.242 0 1 0-72.242 72.242 72.355 72.355 0 0 0 72.242-72.242zm-72.242-52.283a52.282 52.282 0 1 0 52.282 52.283 52.395 52.395 0 0 0-52.282-52.245z"></path></svg>
                                <span class="side-menu__label">Rewards</span>
                            </a>
                        </li>
                       
                    </ul>

                    <div class="slide-right" id="slide-right">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                        </svg>
                    </div>
                </div>
            </aside>
        </div>
        <!-- main-sidebar -->

    </div>
    <!-- main-content -->
    <div class="main-content app-content">

        <div class="main-container container-fluid">

            <div id="last_offers">
                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('live-state')->html();
} elseif ($_instance->childHasBeenRendered('XuB9lET')) {
    $componentId = $_instance->getRenderedChildComponentId('XuB9lET');
    $componentTag = $_instance->getRenderedChildComponentTagName('XuB9lET');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('XuB9lET');
} else {
    $response = \Livewire\Livewire::mount('live-state');
    $html = $response->html();
    $_instance->logRenderedChild('XuB9lET', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
            <div id="chat">
                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('live-chat')->html();
} elseif ($_instance->childHasBeenRendered('fiBqvYX')) {
    $componentId = $_instance->getRenderedChildComponentId('fiBqvYX');
    $componentTag = $_instance->getRenderedChildComponentTagName('fiBqvYX');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('fiBqvYX');
} else {
    $response = \Livewire\Livewire::mount('live-chat');
    $html = $response->html();
    $_instance->logRenderedChild('fiBqvYX', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>

            <!-- breadcrumb -->
            <div class="breadcrumb-header justify-content-between">
                <div class="left-content">
                    <span class="main-content-title mg-b-0 mg-b-lg-1">
                        <?php if(Route::is('welcome') == false): ?>
                            <?php if (! empty(trim($__env->yieldContent('title')))): ?>
                                <?php echo $__env->yieldContent('title'); ?>
                            <?php else: ?>
                                Dashboard
                            <?php endif; ?>
                        <?php endif; ?>
                    </span>
                </div>
                <div class="justify-content-center mt-2">
                    <ol class="breadcrumb">

                    </ol>
                </div>
            </div>
            <!-- /breadcrumb -->
<?php /**PATH /home/xapphfem/v1.xapps.store/core/resources/views/theme/nova/partial/header.blade.php ENDPATH**/ ?>