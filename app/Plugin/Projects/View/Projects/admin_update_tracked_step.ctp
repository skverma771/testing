<div>
    <div class="page-header clearfix space">
        <h4>
            <?php if(!empty($this->request->params['named']['reject'])): ?>
                <?php echo __l('Reject').' - '.$this->Html->cText($project['Project']['name']);?>
            <?php else: ?>
                <?php echo __l('Approve').' - '.$this->Html->cText($project['Project']['name']);?>
            <?php endif; ?>
        </h4>
    </div>
    <div>
        <?php echo $this->Form->create('Project', array('class' => 'form-horizontal space')); ?>
        <?php echo $this->Form->input('private_note', array('type' => 'textarea')); ?>
        <?php if(!empty($this->request->params['named']['reject'])): ?>
            <?php echo $this->Form->input('information_to_user', array('type' => 'textarea')); ?>
        <?php endif;  ?>
        <?php echo $this->Form->submit(__l('Submit')); ?>
        <?php echo $this->Form->end(); ?>
    </div>
</div>