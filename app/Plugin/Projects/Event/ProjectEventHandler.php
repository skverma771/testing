<?php
class ProjectEventHandler extends UtObject implements CakeEventListener
{
    /**
     * implementedEvents
     *
     * @return array
     */
    public function implementedEvents() 
    {
        return array(
            'View.AdminDasboard.onActionToBeTaken' => array(
                'callable' => 'onActionToBeTakenRender'
            )
        );
    }
    public function onActionToBeTakenRender($event) 
    {
        $view = $event->subject();
        App::import('Model', 'Projects.Message');
        $Message = new Message();
        $data['system_flagged_message_count'] = $Message->find('count', array(
            'conditions' => array(
                'MessageContent.is_system_flagged = ' => 1,
                'Message.is_sender' => 1,
                'Message.project_id' => 0
            ) ,
            'recursive' => 0
        ));
        $data['system_flagged_project_comment_count'] = $Message->find('count', array(
            'conditions' => array(
                'MessageContent.is_system_flagged = ' => 1,
                'Message.is_sender' => 1,
                'Message.is_activity' => 0,
                'NOT' => array(
                    'Message.project_id' => 0
                )
            ) ,
            'recursive' => 0
        ));
        $event->data['content']['SystemFlagged'].= $view->element('Projects.admin_action_taken', $data);
    }
}
?>