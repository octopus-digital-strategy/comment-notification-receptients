<div class="wrapper">

    <h1><?php echo $pageTitle; ?></h1>
    <p><?php echo $description; ?></p>

    <form method="post">
        <?php foreach ($fields as $field) { ?>
            <p>
                <?php if (isset($field->properties['label'])) { ?>
                    <label for="<?php echo $field->properties['ID']; ?>"><?php echo $field->properties['label']; ?></label>
                <?php } ?>
                <?php echo $field->html; ?>
            </p>

        <?php } ?>
        <p>
            <input type="submit" value="Save" class="button button-primary button-large"/>
        </p>
    </form>

    <script>
        jQuery(document).ready(function(){
            var mails = jQuery('input[id=checked_users]').val();
            var allMails = mails.split(',');
            for(var i=0; i< allMails.length; i++){
                jQuery('input[type=checkbox]').each(function(ix, item){
                    if(jQuery(item).attr('email') == allMails[i]){
                        jQuery(item).attr('checked', 'checked');
                    }
                });
            }
        });


        emails = '';
        jQuery('input[type=checkbox]').change(function () {
            jQuery('input[id=checked_users]').val('');
            emails = '';
            jQuery('input[type=checkbox]').each(function(){
                if (jQuery(this).prop('checked')){
                    email = jQuery(this).attr('email');
                    emails = emails.concat(email).concat(',');
                }
            });
            jQuery('input[id=checked_users]').val(emails);
        });
    </script>

</div>