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
class PledgeCronComponent extends Component
{
    public function main() 
    {
        // App::import('Model', 'Pledge.Pledge');
        // $this->Pledge = new Pledge();
        // $projects = $this->Pledge->find('all', array(
        //     'conditions' => array(
        //         'Project.is_draft' => 0,
        //         'Pledge.pledge_project_status_id' => array(
        //             ConstPledgeProjectStatus::OpenForFunding,
        //             ConstPledgeProjectStatus::GoalReached,
        //         ) ,
        //     ) ,
        //     'contain' => array(
        //         'Project'
        //     ) ,
        //     'recursive' => 0
        // ));
        // foreach($projects as $project) {
        //     if (($project['Project']['collected_amount'] >= $project['Project']['needed_amount'] && empty($project['Pledge']['is_allow_over_funding'])) || ($project['Project']['collected_amount'] >= $project['Project']['needed_amount'] && strtotime($project['Project']['project_end_date'] . ' 23:55:59') <= strtotime(date('Y-m-d H:i:s'))) || (strtotime($project['Project']['project_end_date'] . ' 23:55:59') <= strtotime(date('Y-m-d H:i:s')) && $project['Project']['payment_method_id'] == ConstPaymentMethod::KiA)) {
        //         if (empty($project['Project']['project_fund_count'])) {
        //             /*$this->Pledge->updateStatus(ConstPledgeProjectStatus::FundingExpired, $project['Project']['id']);*/
        //             $this->Pledge->updateStatus(ConstPledgeProjectStatus::PendingAction, $project['Project']['id']);
        //         } else {
        //             $this->Pledge->updateStatus(ConstPledgeProjectStatus::FundingClosed, $project['Project']['id']);
        //         }
        //     } elseif (strtotime($project['Project']['project_end_date'] . ' 23:55:59') <= strtotime(date('Y-m-d H:i:s'))) {
        //         /*$this->Pledge->updateStatus(ConstPledgeProjectStatus::FundingExpired, $project['Project']['id']);*/
        //         $this->Pledge->updateStatus(ConstPledgeProjectStatus::PendingAction, $project['Project']['id']);
        //     } else {
        //         // $this->Pledge->updateStatus(ConstPledgeProjectStatus::PendingAction, $project['Project']['id']);
        //     }
        // }
        // var_dump("main called!");
        App::import('Model', 'Pledge.PledgeProjectCategory');
        $this->PledgeProjectCategory = new PledgeProjectCategory();
        $pledgeProjectCategory = $this->PledgeProjectCategory->find('first');
        $pledgeProjectCategory['PledgeProjectCategory']['is_approved'] = $pledgeProjectCategory['PledgeProjectCategory']['is_approved'] == 0? 1: 0;      // !$pledgeProjectCategory['PledgeProjectCategory']['is_approved'];
        $this->PledgeProjectCategory->save($pledgeProjectCategory);     
    }
}

// echo (new PledgeCronComponent())->main();