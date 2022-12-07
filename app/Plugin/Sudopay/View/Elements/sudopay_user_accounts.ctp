<?php
	echo $this->requestAction(array('controller' => 'sudopays', 'action' => 'user_accounts', 'project' => $project, 'step' => $step, 'user' => $user, 'from_action' => $from_action), array('return')); 
?>