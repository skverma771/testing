		<div class="row-fluid ver-space">
            <?php if(!empty($this->request->params['plugin']) && $this->request->params['plugin'] != 'extensions') { ?>
              <div class="alert alert-warning"><?php echo " ".$this->Html->cText(Inflector::humanize(ucfirst($this->request->params['plugin']))).__l(' plugin is currently enabled. You can disable it from ') . ' ' . $this->Html->link(__l('plugins'), array('controller' => 'extensions_plugins'), array('title' => __l('plugins'), 'class' => 'plugin'));  ?>.</div>
            <?php } ?>
            <?php if ($this->request->params['controller'] == 'affiliate_types' && $this->request->params['action'] == 'admin_edit' && isPluginEnabled('Affiliates')) : ?>
              <div class="alert alert-info">
                <?php echo __l('Commission percentage will be calculated from admin commission'); ?>
              </div>
            <?php endif; ?>
          <?php
            if (!empty($this->request->params['controller']) && $this->request->params['controller'] == 'settings' && ((!empty($this->request->data['Setting']['setting_category_id'])) && ($this->request->data['Setting']['setting_category_id'] == ConstPluginSettingCategories::Projects || $this->request->data['Setting']['setting_category_id'] == ConstPluginSettingCategories::Wallet || $this->request->data['Setting']['setting_category_id'] == ConstPluginSettingCategories::Withdrawals))) {
              $enable_text = 'enabled';
              $disable_text = 'disable';
              if(!empty($this->request->data['Setting']['setting_category_id']) && $this->request->data['Setting']['setting_category_id'] == ConstPluginSettingCategories::Wallet) {
                // wallet
                if (!isPluginEnabled('Wallet')) {
                  $enable_text = 'disabled';
                  $disable_text = 'enable';
                }
                $plugin_name = 'Wallet';
              }
              if(!empty($this->request->data['Setting']['setting_category_id']) && $this->request->data['Setting']['setting_category_id'] == ConstPluginSettingCategories::Projects) {
                // Contests
                if(!isPluginEnabled('Projects')) {
                  $enable_text = 'disabled';
                  $disable_text = 'enable';
                }
                $plugin_name = 'Projects';
              }
              if(!empty($this->request->data['Setting']['setting_category_id']) && $this->request->data['Setting']['setting_category_id'] == ConstPluginSettingCategories::Withdrawals) {
                // withdrawals
                if(!isPluginEnabled('Withdrawals')) {
                  $enable_text = 'disabled';
                  $disable_text = 'enable';
                }
              $plugin_name = 'Withdrawals';
              }
          ?>
          <div class="alert alert-warning"><i class="icon-warning-sign"></i><?php echo $this->Html->cText(Inflector::humanize(ucfirst($plugin_name))).__l(' plugin is currently '.$enable_text.'. You can '.$disable_text.' it from ') . ' ' . $this->Html->link(__l('plugins'), array('controller' => 'extensions_plugins'), array('title' => __l('plugins'), 'class' => 'plugin'));  ?>.</div>
          <?php }  ?>
          <?php
            if ($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'admin_stats') {
              echo $content_for_layout;
            } else { ?>
              <section class="thumbnail no-pad top-mspace">
                <?php
                  $diagnostics_menu = array('devs', 'search_logs');
                  $links_menu = array('links');
                  if(isset($plugin_name) && !empty($plugin_name)){
                    if (in_array($plugins[$plugin_name]['icon'], $image_plugin_icons)):
                      $pluginImage = $this->Html->image($plugins[$plugin_name]['icon'] . '-icon.png', array('width'=>20, 'height'=>20));
                    else:
                      $pluginImage = '<i class="icon-'.$plugins[$plugin_name]['icon'].' text-20"></i>';
                    endif;
                  } elseif ($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'admin_diagnostics') {
                    $class = "diagnostics-title";
                  } elseif ($this->request->params['controller'] == 'user_profiles' || $this->request->params['controller'] == 'user_add_wallet_amounts') {
                    $class = "users-title";
                  } elseif (in_array($this->request->params['controller'], $diagnostics_menu)) {
                    $class = "diagnostics-title";
                  } elseif (in_array($this->request->params['controller'], $links_menu)) {
                    $class = "cms-title";
				  } elseif ($this->request->params['controller'] == 'settings' && !empty($this->request->params['pass'][0]) && $this->request->params['pass'][0] == '85') {
					 $class = "icon-bullhorn";
				  } elseif ($this->request->params['controller'] == 'settings' && !empty($this->request->params['pass'][0]) && $this->request->params['pass'][0] == '60') {
					 $class = "icon-trophy";
				  }elseif ($this->request->params['controller'] == 'settings' && !empty($this->request->params['pass'][0]) && $this->request->params['pass'][0] == '21') {
					$class = "icon-group";
                  } elseif ($this->request->params['controller'] == 'settings') {
                    $class = "icon-cogs";
                  } else {
                    $class = Configure::read('admin_heading_class');
                  }
                ?>
                <div class="no-mar no-bor clearfix box-head">
                  <h5 class="pull-left space">
                    <?php
                      if (!empty($pluginImage) && !empty($plugin_name)) {
                        echo $pluginImage;
                      } else { ?>
                        <i class="<?php echo $class;?> no-bg yop-mspace"></i>
                      <?php } ?>
                    <?php
                      if($this->request->params['controller'] == 'settings' && $this->request->params['action'] == 'index' || $this->request->params['controller'] == 'entry_flag_categories' && $this->request->params['action'] == 'index') {
                        echo $this->Html->link(__l('Settings'), array('controller' => 'settings', 'action' => 'index'), array('title' => __l('Back to Settings')));
                      } elseif ($this->request->params['controller'] == 'settings' && $this->request->params['action'] == 'admin_edit' ) {
                        if(!empty($setting_categories['SettingCategory'])) {
                          echo $this->Html->link(__l('Settings'), array('controller' => 'settings', 'action' => 'index'), array('title' => __l('Back to Settings')));?> &raquo; <?php echo $setting_categories['SettingCategory']['name'];
                        }
                      } elseif(in_array( $this->request->params['controller'], $diagnostics_menu) || $this->request->params['controller'] == 'users' && $this->request->params['action'] == 'admin_logs') {
                        echo $this->Html->link(__l('Diagnostics'), array('controller' => 'users', 'action' => 'diagnostics', 'admin' => true), array('title' => __l('Diagnostics'))); ?> &raquo; <?php echo $this->Html->cText($this->pageTitle,false); ?>
                      <?php
                      } else {
                        echo $this->Html->cText($this->pageTitle,false);
                      }
                    ?>
                  </h5>
                  <?php if ($this->request->params['controller'] == 'settings' || $this->request->params['controller'] == 'payment_gateways' || $this->request->params['controller'] == 'extensions_plugins') { ?>
                    <span class="pull-right grayc top-space hor-mspace"><?php echo sprintf(__l('To reflect changes, you need to %s.'), $this->Html->link(__l('clear cache'), array('controller' => 'devs', 'action' => 'clear_cache', '?f=' . $this->request->url), array('title' => __l('clear cache'), 'class' => 'js-confirm')));?></span>
                  <?php } ?>
                </div>
                <?php echo $content_for_layout;  ?>
              </section>
              <?php } ?>
          </div>