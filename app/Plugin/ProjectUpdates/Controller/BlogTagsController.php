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
class BlogTagsController extends AppController
{
    public $name = 'BlogTags';
    public function index() 
    {
        $this->pageTitle = __l('Update Tags');
        $blogTag = $this->BlogTag->find('all', array(
            'recursive' => 1,
            'contain' => array(
                'Blog' => array(
                    'fields' => array(
                        'id'
                    )
                )
            )
        ));
        $tag_arr = array();
        foreach($blogTag as $blogTag) {
            $tag_arr[$blogTag['BlogTag']['slug']] = count($blogTag['Blog']);
            $tag_name_arr[$blogTag['BlogTag']['slug']] = $blogTag['BlogTag']['name'];
        }
        $this->set('tag_arr', $tag_arr);
        $this->set('tag_name_arr', $tag_name_arr);
    }
}
?>