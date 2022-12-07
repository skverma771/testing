<?php /* SVN: $Id: $ */ ?>
<div class="sudopays index">
<section>
<div class="img-thumbnail clearfix">
	<h3>
		<?php
			echo __l('Payment Confirmation');			
		?>
	</h3>
	<div class="alert alert-info">
		<?php
			echo sprintf('Amount got revised from %s%s to %s%s as buyer is set to bear gateway fee', Configure::read('site.currency'),$amount,Configure::read('site.currency'),$sudopay_revised_amount);
		?>
	</div>
	<?php
		echo $this->Form->create('Sudopay', array('url' => array('controller' => 'sudopays', 'action'=> 'confirmation', $foreign_id,$transaction_type), 'class' => 'form-horizontal js-project-form clearfix','enctype' => 'multipart/form-data'));
	?>
	<div>
	<?php
		echo $this->Form->input('confirm', array('value' => '1', 'type' => 'hidden'));
		echo $this->Form->submit(__l('Confirm'), array('class' => 'btn btn-primary', 'div' => false));
		echo $this->Html->link(__l("Cancel"),$redirect,array('class'=>'btn btn-default') );
		echo $this->Form->end();
	?>
	</div>
  </div>

</section>
</div>