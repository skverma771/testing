<?php
  if (!empty($projectCategories)) {
    //   var_dump($projectCategories);
    $categories = array_chunk($projectCategories, 6);
?>

<h5><?php echo __l('Browse Categories');?></h5>
<ul class="span4 unstyled">
  <?php foreach ($categories[0] as $projectCategorie): ?>
  <li><?php echo $this->Html->link($projectCategorie['PledgeProjectCategory']['name'], array('controller' => 'projects', 'action' => 'index', 'project_type'=>'pledge', 'category' => $projectCategorie['PledgeProjectCategory']['slug']), array('title' => $projectCategorie['PledgeProjectCategory']['name']));?></li>
  <?php endforeach; ?>
</ul>
<?php if(!empty($categories[1])) {?>
<ul class="span3 unstyled">
  <?php foreach ($categories[1] as $key => $projectCategorie): ?>
    <?php if($key == 5): ?>
    <li><a href="javascript:;" class="js-no-pjax modal-trigger">See More</a></li>
    <?php else: ?>
    <li><?php echo $this->Html->link($projectCategorie['PledgeProjectCategory']['name'], array('controller' => 'projects', 'action' => 'index', 'project_type'=>'pledge', 'category' => $projectCategorie['PledgeProjectCategory']['slug']), array('title' => $projectCategorie['PledgeProjectCategory']['name']));?></li>
    <?php endif; ?>
  <?php endforeach; ?>
</ul>
<?php } ?>

<!-- CUSTOM MODAL -->
<div class="custom-modal">
    <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h3 class="modal-title">List of categories</h3>
    <hr>
    <?php if (!empty($projectCategories)): ?>
        <?php foreach($projectCategories as $category): ?>
            <?php echo $this->Html->link($category['PledgeProjectCategory']['name'], 
                array(
                    'controller' => 'projects',
                    'action' => 'index',
                    'project_type'=>'pledge',
                    'category' => $category['PledgeProjectCategory']['slug']), 
                array(
                    'class' => 'badge badge-success',
                    'title' => $category['PledgeProjectCategory']['name']
                ));
            ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<!-- NEW USER POPUP -->
<div class="popup-newuser">
    <div class="wrapper"></div>
</div>
<div class="popup-newproject">
    <div class="wrapper"></div>
</div>

<?php } ?>

<style>
    .custom-modal {
        z-index: 9999;
    }
    .custom-modal .modal-title {
        color: #000;
    }
    .custom-modal .badge {
        padding: 8px 5px;
        margin: 5px;
        font-size: 14px;
        display: inline-block;
    }
    .custom-modal {
        display: none;
        
        position: fixed;
        top: 50%;
        left: 50%;
        width: 400px;
        min-height: 400px;
        margin-left: -200px;
        margin-top: -200px;

        background-color: #f1f1f1;
        padding: 15px 30px;
        border-radius: 5px;
        border: 2px solid #3dcf0d;
    }

    .popup-newuser,
    .popup-newproject{
        display: none;
        
        left: 5%;
        bottom: 5%;
        position: fixed;
        box-shadow: -2px 10px 46px -6px rgba(0,0,0,0.49);
        -webkit-box-shadow: -2px 10px 46px -6px rgba(0,0,0,0.49);
        -moz-box-shadow: -2px 10px 46px -6px rgba(0,0,0,0.49);
    }
    .popup-newproject {
        bottom: 15%;
    }
    .popup-newuser p,
    .popup-newproject p {
        color: #fff;
        font-size: 17px;
        display: block;
        margin: 0;
    }
    .popup-newuser .wrapper,
    .popup-newproject .wrapper {
        display: inline-table;
        position: relative;

        min-width: 200px;
        height: 20px;

        background-color: #fff;
        border-radius: 5px;

        padding: 10px;

        border-radius: 13px;
        background: rgb(159,69,49);
        background: linear-gradient(90deg, rgba(159,69,49,1) 0%, rgba(52,186,131,1) 46%, rgba(119,131,190,1) 100%);
    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $('.modal-trigger').on('click', function(e) {
        $('.custom-modal').slideToggle();
    });

    $('.custom-modal .close, .custom-modal .badge').on('click', function(e) {
        $('.custom-modal').slideToggle();
    });
</script>