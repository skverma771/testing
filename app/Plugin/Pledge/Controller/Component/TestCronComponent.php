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


class TestCronComponent extends Component
{
    public $name = "TestCron";

    public function __construct()
    {
        App::import('Model', 'Pledge.PledgeProjectCategory');
        $this->PledgeProjectCategory = new PledgeProjectCategory();
        $pledgeProjectCategory = $this->PledgeProjectCategory->find('first');
        $pledgeProjectCategory['PledgeProjectCategory']['is_approved'] = !$pledgeProjectCategory['PledgeProjectCategory']['is_approved'];
        $this->PledgeProjectCategory->save($pledgeProjectCategory);        
    }
    public function main() 
    {
        App::import('Model', 'Pledge.PledgeProjectCategory');
        $this->PledgeProjectCategory = new PledgeProjectCategory();
        $pledgeProjectCategory = $this->PledgeProjectCategory->find('first');
        $pledgeProjectCategory['PledgeProjectCategory']['is_approved'] = !$pledgeProjectCategory['PledgeProjectCategory']['is_approved'];
        $this->PledgeProjectCategory->save($pledgeProjectCategory);
    }

    public function sample() {
        return "asdf";
    }
}

// echo (new PledgeCronComponent())->main();
?>