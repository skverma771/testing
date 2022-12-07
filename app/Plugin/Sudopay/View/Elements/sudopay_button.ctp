<dl class="row">
    <dt class="col-md-3"><?php echo __l('Amount') . ' ('. Configure::read('site.currency') .')'; ?></dt>
    <dd class="col-md-3"><?php echo $this->Html->cCurrency($data['amount']); ?></dd>
</dl>
<?php
    $secret_string = $data['secret_string'];
    unset($data['secret_string']);
    unset($data['obj']);
    unset($data['callAction']);
    unset($data['gateway_id']);
    $data['signature'] = md5($secret_string . urldecode(http_build_query($data, '', '&')));
    $post_string = http_build_query($data, '', '&');
?>
<button id="sudopaybtn" class="sudopaybtn" type="button" data-param="<?php echo $post_string; ?>">Pay with ZazPay</button>
<script>
(function(s, u, d, o, p, a, y, b, t, n) {
    s['sudopay_btn_ids'] = p;
    a = u.createElement(d),
    y = u.getElementsByTagName(d)[0];
    a.async = 1;
    a.src = o;
    y.parentNode.insertBefore(a, y);
})(window, document, 'script', '//d1fhd8b1ym2gwa.cloudfront.net/btn/sudopay_btn.js', ['sudopaybtn']);
</script>