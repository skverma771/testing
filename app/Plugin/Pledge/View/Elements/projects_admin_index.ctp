<?php
$q=!empty($this->request->data['Project']['q'])?$this->request->data['Project']['q']:'';
  echo $this->requestAction(array('controller' => 'pledges', 'action' => 'index','admin' => true,'q'=>$q), array('return'));
?>