<div class="cookie-consent-banner" id="cookie-banner" style="display: none">
  <div class="cookie-consent-banner__inner">
    <div class="cookie-consent-banner__copy">
      <div class="cookie-consent-banner__header"> We use cookies!</div>
      <div class="cookie-consent-banner__description">
        Hi, this website uses essential cookies to ensure its proper operation and tracking cookies to
        understand how you interact with it.
        The latter will be set only after consent.
      </div>
    </div>

    <div class="cookie-consent-banner__actions" style="font-size:14px;">
      <a href="javascript:void(0);" onclick="acceptAll();" class="cookie-consent-banner__cta" style="font-size:14px;">
        Accept all
      </a>

      <a href="javascript:void(0);" onclick="rejectAll();" class="cookie-consent-banner__cta cookie-consent-banner__cta--secondary" style="font-size:14px;">
        Reject all
      </a>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    let isAcceptCookie = $.cookie('is_accepted_cookie');
    if (isAcceptCookie != 'done') {
      $("#cookie-banner").css('display', 'block');
    }
  });

  function acceptAll() {
    $.cookie('is_accepted_cookie', 'done', 7);
    $("#cookie-banner").fadeOut(800);
  }

  function rejectAll() {
    $("#cookie-banner").fadeOut(800);
  }
</script>
<?php /**PATH D:\workspace\v1Xapps30-11\core\resources\views/theme/nova/addons/cookies.blade.php ENDPATH**/ ?>