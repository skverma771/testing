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
class TwitterConsumer extends AbstractConsumer
{
    public function __construct() 
    {
        parent::__construct(Configure::read('twitter.consumer_key') , Configure::read('twitter.consumer_secret'));
    }
}
?>