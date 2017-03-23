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
        add_filter( 'comment_moderation_recipients', array($this, 'commentModerationEmails'), 11, 2 );
        add_filter( 'comment_notification_recipients', array($this, 'commentModerationEmails'), 11, 2 );
        return $this;
    }

    public function commentModerationEmails($emails, $comment_id)
    {
        $emails = self::customCommentsEmailsNotifications();
        return $emails;
    }

    private static function customCommentsEmailsNotifications()
    {
        $emails = new SettingsPage();

        $csv_emails = $emails->getOptionValue('csv_emails');
        if ($csv_emails != false) {
            $csv_emails = explode(',', $csv_emails);
        }

        $checked_users = $emails->getOptionValue('checked_users');
        if ($checked_users != false) {
            $checked_users = explode(',', $checked_users);
        }

        $csv_emails = array_merge($csv_emails, $checked_users);

        //$siteAdminEmail = array( get_bloginfo('admin_email') );

        //$csv_emails = array_merge($csv_emails, $siteAdminEmail);

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