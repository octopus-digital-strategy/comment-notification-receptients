#Comment Notification Receptients

If you manage different sites for your clients or even if you are the site admin but no the site moderator, you may want to add different emails that receive the comments notifications.

The default WP functionality is that the site admin receives all site notifications, this plugin uses different hooks to let you add more emails that receive those notifications.

##Installation

Just install the plugin and go to the settings page so you can add all the emails you want to as CSV.

##Changelog

###Version 0.2

- Refactoring code to use javascript in the settings page
- Creating the javascript code to add the correct IDs to the hidden input.
- Setting the correct filters. Plugin ready for production testing.
- Modifying javascript on settings page.
- Updating emails to get site admin email too.

###Version 0.1

- Adding necesary plugin files.
- Adding WPExpress.
- Adding Settings Page for the plugin.
- Creating a function to return all admin users.
- Showing all administrators using checkboxes on the frontend.
- Establishing filters for comment moderation
- Wrapping up the final function to merge the emails

###TODO

-TODO: Get if the checkbox is checked using getOptionValue function.