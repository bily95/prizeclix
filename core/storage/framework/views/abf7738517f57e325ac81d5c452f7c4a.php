<div class="container-grid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3 class="card-tile">
                Offer Partners
            </h3>
            <div class="home_slider">
                <?php $__currentLoopData = $data['offers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $oneOffer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $subId = auth()->id();
                        $secure = md5($subId);

                        $url = str_replace('{user_id}', $subId, $oneOffer->iframe_url);
                        $offerURL = str_replace('{secure}', $secure, $url);
                    ?>
                <?php if($oneOffer->iframe_url): ?>
                    <?php echo $__env->make(SETTING['site_theme'] . 'offers.card', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div wire:ignore.self class="modal fade offerWallIframeModal" id="showModal" tabindex="-1"
                aria-labelledby="showModal" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="showModalHeader"></h5>
                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal"
                                aria-label="Close">
                                &times;
                            </button>
                        </div>
                        <div class="modal-body  position-relative">
                            <div class="modal-loading" style="display: none;">
                                <div class="progress-bar-container">
                                    <div class="progress-bar" style="width: 0;"></div>
                                </div>
                            </div>
                            <iframe src="" width="100%" id="offerIframe" height="80vh"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if(auth()->guard()->check()): ?>

    <?php $__env->startPush('script'); ?>
        <script>
            $(document).ready(function() {
                $('.offerwallsposition a').click(function(e) {
                    e.preventDefault();

                    var loadingDiv = $('.modal-loading');
                    var progressBar = $('.progress-bar');

                    loadingDiv.show();
                    progressBar.css('width', '0');

                    var iframe = $('#offerIframe');
                    iframe.on('load', function() {
                        loadingDiv.hide();
                    });

                    var linkHref = $(this).attr('href');
                    var offerName = $(this).attr('title');
                    iframe.attr('src', linkHref);

                    $('#showModalHeader').html(offerName);
                    $('#showModal').modal('show');

                    // Simulate progress with a timer (adjust as needed)
                    var progress = 0;
                    var progressInterval = setInterval(function() {
                        progress += 10;
                        progressBar.css('width', progress + '%');
                        if (progress >= 100) {
                            clearInterval(progressInterval);
                        }
                    }, 500); // 500ms interval for demonstration purposes
                });
            });
        </script>
    <?php $__env->stopPush(); ?>

<?php endif; ?>
<?php /**PATH /home/xapphfem/v1.xapps.store/core/resources/views/theme/nova/offers/index.blade.php ENDPATH**/ ?>