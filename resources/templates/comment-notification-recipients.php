<div class="wrapper">

    <h1><?php echo $pageTitle; ?></h1>
    <p><?php echo $description; ?></p>

    <form method="post">
        <?php foreach ($fields as $field) { ?>
            <p>
                <?php if (isset($field->properties['label'])) { ?>
                    <label for="<?php echo $field->properties; ?>"><?php echo $field->properties['label']; ?></label>
                <?php } ?>
                <?php echo $field->html; ?>
            </p>

        <?php } ?>
        <p>
            <input type="submit" value="Save" class="button button-primary button-large"/>
        </p>
    </form>

    <script>
        id = '';
        jQuery('input[type=checkbox]').change(function () {
            document.getElementById('checked_users').value = '';
            IDs = '';
            jQuery('input[type=checkbox]').each(function(){
                if (jQuery(this).prop('checked')){
                    id = jQuery(this).prop('id');
                    IDs = IDs.concat(id).concat(',');
                }
            });
        });
    </script>

</div>