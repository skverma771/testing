<div id="node-list-<?php echo $alias; ?>" class="node-list">
  <ul class="unstyled">
    <?php
      foreach ($nodesList AS $n) {
        if ($options['link']) {
          echo '<li>';
          echo $this->Html->link($n['Node']['title'], array(
            'controller' => $options['controller'],
            'action' => $options['action'],
            'type' => $n['Node']['type'],
            'slug' => $n['Node']['slug'],
          ));
          echo '</li>';
        } else {
          echo '<li>' . $n['Node']['title'] . '</li>';
        }
      }
    ?>
  </ul>
</div>