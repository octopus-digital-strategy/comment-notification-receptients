<?php
/**
 * Created by PhpStorm.
 * User: JCastro
 * Date: 01/03/17
 * Time: 22:12
 */

namespace CommentNot;


use WPExpress\Admin\BaseSettingsPage;

class SettingsPage extends BaseSettingsPage
{
    public function __construct()
    {
        parent::__construct(__('Comment Notification Receptients', 'commentnot'));
        parent::setCustomTemplatePath( SetupPlugin::getResourceDirectory('','templates') );
        $this->getUsers();
        $this->notificationEmails();
    }

    public function notificationEmails()
    {
        $this->fields->addTextInput('emails')->addLabel(__('Add the emails as CSV','commentnot'));
    }

    public function getUsers()
    {
        $users = get_users(array(
            'role__in' => 'administrator',
            'fields' => array('display_name', 'ID')
        ));

        return $users;
    }
}