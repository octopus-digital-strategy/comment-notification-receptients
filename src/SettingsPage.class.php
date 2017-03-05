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
        parent::__construct(__('Comment Notification Recipients', 'commentnot'));
        parent::setCustomTemplatePath( SetupPlugin::getResourceDirectory('','templates') );
        parent::setPageDescription(__('Select the specific administrators you want to send custom notifications or add custom emails in the text input below', 'commentnot'));
        $this->customNotificationUsers();
        $this->customNotificationEmails();
    }

    public function customNotificationUsers()
    {
        $users = self::getUsers();

        foreach ($users as $user) {
            $this->fields->addCheckBox($user['ID'])->setAttribute('name',$user['user_login'])->addLabel($user['display_name'] . ' ('. $user['user_email'] . ') ');
        }
    }

    public function customNotificationEmails()
    {
        $this->fields->addTextInput('csv_emails')->addLabel(__('Add custom emails that do not have a user on the site as Comma Separated Values','commentnot'));
    }

    private static function getUsers()
    {
        $users = get_users(array(
            'role__in' => 'administrator',
            'fields' => array('display_name', 'ID', 'user_email', 'user_login')
        ));

        return json_decode(json_encode($users), true);
    }
}