<?php
/**
 * Created by PhpStorm.
 * User: JCastro
 * Date: 01/03/17
 * Time: 22:13
 */

namespace CommentNot;


class CommentNotificationReceptients
{

    public function __construct()
    {
        $this->registerFilters();
    }

    public function registerFilters()
    {
        //add_filter( 'comment_moderation_recipients', array($this, 'commentModerationEmails'), 11, 2 );
        //add_filter( 'comment_notification_recipients', array($this, 'commentModerationEmails'), 11, 2 );
        self::customCommentsEmailsNotifications();
        return $this;
    }

    public function commentModerationEmails( $emails, $comment_id )
    {
        $emails = self::customCommentsEmailsNotifications();
        return $emails;
    }

    private static function customCommentsEmailsNotifications()
    {
        $emails = new SettingsPage();

        $csv_emails = $emails->getOptionValue('csv_emails');
        if ($csv_emails != false){
            $csv_emails = explode(',', $csv_emails);
        }

        $users = self::getUsers();

        foreach ($users as $user){
            //TODO: Get if the checkbox is checked using getOptionValue function.
            $the_user = $emails->getOptionValue($user['ID']);
            if ($the_user == 'checked' ){
                array_push($csv_emails, $the_user);
            }
        }

        return $csv_emails;
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