<div class="wrap">
    <h2>
        <?php echo __('KeyMedia integration settings'); ?>
    </h2>

    <form name="keymedia_settings" method="post" 
          action="options.php">
        <p>
            <?php settings_fields('keymedia_settings'); ?>
            <?php do_settings_sections('keymedia_settings'); ?>
        </p>
        <p>
            <input class="button button-primary" type="submit" name="Submit" value="<?php esc_attr_e('Save changes') ?>" />
        </p>
    </form>
</div>
