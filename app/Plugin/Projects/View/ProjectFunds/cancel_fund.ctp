<script type="text/javascript" charset="utf-8">
  handleEmbeddedFlow();
  function handleEmbeddedFlow() {
    if (top && top.opener && top.opener.top) {
      window.parent.location.href = "<?php echo $redirect; ?>";
      top.opener.top.myEmbeddedPaymentFlow.paymentCanceled();
      window.close();
    } else if (top.myEmbeddedPaymentFlow) {
      window.parent.location.href = "<?php echo $redirect; ?>";
      top.myEmbeddedPaymentFlow.paymentCanceled();
    } else {
      alert('Please close the window and reload to continue');
    }
  }
</script>