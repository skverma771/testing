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
class SudopayEventHandler extends UtObject implements CakeEventListener
{
    /**
     * implementedEvents
     *
     * @return array
     */
    public function implementedEvents()
    {
        return array(
            'View.Payment.GetGatewayList' => array(
                'callable' => 'onGetGatewayList'
            ) ,
        );
    }
    public function onGetGatewayList($event)
    {
        App::import('Model', 'Sudopay.Sudopay');
        $this->Sudopay = new Sudopay();
        $s = $this->Sudopay->getSudoPayObject();
        $view = $event->subject();		
		$gateway_response = $s->callGateways();
		
        /*if($view->request->named['project_type'] == "Pledge" || $view->request->named['project_type'] == "pledge"){
        	$gateway_response = $s->callGateways(array("supported_actions"=>"marketplace-auth"));
        }
        else{
        	$gateway_response = $s->callGateways();
        }*/
		if (empty($gateway_response['error']['code'])) {
			$event->gatewayGroups = $this->Sudopay->getGatewayGroups($gateway_response);
			$event->gateways = $this->Sudopay->getGateways($gateway_response);
			$event->form_fields_tpls = $gateway_response['_form_fields_tpls'];
		}
    }
}
?>