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
            $this->fields->addCheckBox($user['ID'])->setAttribute('id', $user['ID'])->setAttribute('name',$user['user_login'])->addLabel($user['display_name'] . ' ('. $user['user_email'] . ') ');
        }

        $this->fields->addHiddenInput('checked_users')->setAttribute('hidden');
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


    /*public function save()
    {
        if( is_admin() && !empty( $_POST ) ) {
            do_action('wpExpressSettingsPageBeforeSave', $this, $_POST);

            foreach( $this->fields->toArray() as $fieldName => $field ) {

                $optionName = "{$this->fieldPrefix}{$fieldName}";

                if( isset( $_POST[$fieldName] ) ) {

                    update_option($optionName, $_POST[$fieldName]);
                    // Update the field value :D
                    $this->fields($fieldName)->setValue($_POST[$fieldName]);
                }

            }


            foreach( self::getUsers() as $user ){
                $optionName = "{$this->fieldPrefix}user_login{$user['ID']}";
                $fieldName  = "user_login[{$user['ID']}]";
                delete_option($optionName);
                //$this->fields($fieldName)->setValue('');
            }


            foreach( $_POST['user_login'] as $id => $status ){
                if( 'on' === $status ){
                    $optionName = "{$this->fieldPrefix}user_login{$id}";
                    $fieldName  = "user_login[{$id}]";
                    update_option($optionName, 'on');
                    $this->fields($fieldName)->setValue('on');
                }
            }

            do_action('wpExpressSettingsPageAfterSave', $this, $_POST);
        }
    }*/
}