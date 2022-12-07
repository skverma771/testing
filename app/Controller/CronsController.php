<?php
/**
 *
 * @package		Crowdfunding
 * @author 		siva_063at09
 * @copyright 	Copyright (c) 2012 {@link http://www.agriya.com/ Agriya Infoway}
 * @license		http://www.agriya.com/ Agriya Infoway Licence
 * @since 		2012-07-25
 *
 */


class CronsController extends AppController
{
    public $name = 'Crons';
    public $components = array(
        'Cron',
    );
    public function main() 
    {
        $this->Cron->main();
        if (!empty($_GET['r'])) {
            $this->Session->setFlash(__l('Status updated successfully') , 'default', null, 'success');
            $this->redirect(Router::url(array(
                'controller' => 'nodes',
                'action' => 'tools',
                'admin' => true
            ) , true));
        }
        $this->autoRender = false;
    }
    public function testCron() {
        // $this->loadModel('Gender');
        // $gender = $this->Gender->find('first');
        // $gender['Gender']['name'] = 'asdf';
        // var_dump("cron job called");
        // $this->Gender->save($gender);
        App::import('Component', 'Pledge.TestCron');
        var_dump($this->TestCronComponent);
        // var_dump((new TestCronComponent())->sample());
    }
    public function daily() 
    {
        $this->Cron->daily();
        if (!empty($_GET['r'])) {
            $this->Session->setFlash(__l('Status updated successfully') , 'default', null, 'success');
            $this->redirect(Router::url(array(
                'controller' => 'nodes',
                'action' => 'tools',
                'admin' => true
            ) , true));
        }
        $this->autoRender = false;
    }
	public function encode()
    {
		if (isPluginEnabled('HighPerformance')) {
			App::import('Core', 'ComponentCollection');
			$collection = new ComponentCollection();
			App::import('Component', 'HighPerformance.HighPerformanceCron');
			$this->HighPerformanceCron = new HighPerformanceCronComponent($collection);
			$this->HighPerformanceCron->encode();
			if (!empty($_GET['f'])) {
				$this->Session->setFlash(__l('Encode updated successfully') , 'default', null, 'success');
				$this->redirect(Router::url(array(
					'controller' => 'nodes',
					'action' => 'tools',
					'admin' => true
				) , true));
			}
		}
		$this->autoRender = false;
    }
}
