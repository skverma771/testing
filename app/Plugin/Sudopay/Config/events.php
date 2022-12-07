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
$config = array(
    'EventHandlers' => array(
        'Sudopay.SudopayEventHandler' => array(
            'options' => array(
                'priority' => 1,
            ) ,
        ) ,
    ) ,
);
?>