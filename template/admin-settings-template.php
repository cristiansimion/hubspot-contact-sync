<?php \CristianSimion\Lib\EnqueueScripts::enqueue_scripts_and_styles(); ?>

<div class="ecbc-bootstrap-wrapper">

    <div class="container-fluid">
        <h2 class="mt-2">HubSpot API Key Settings</h2>
	    <?php \CristianSimion\Lib\AdminSettings::parse_submissions($_POST); ?>
        <div class="col-md-12 card">
            <p>Using the below setting will <strong>override</strong> the setting that you have in the index file of the plugin.<br/>This allows for fast Key switching without the need of editing files. This, however, is less secure since it has to deal with database saving. Use this as an emergency switch to the new key prior to changing the file.</p>
            <form class="hubspot-api-form" action="" method="post">
                <div class="form-group">
                    <label for="hubspot-key">Enter you hubspot API key</label>
                    <input id="hubspot-key" type="text" name="api_key" value="<?php echo get_option(API_KEY_OPTION_NAME); ?>" placeholder="Paste in your api key here"/>
                    <small id="emailHelp" class="form-text text-muted"><span style="color: #f00;">IMPORTANT!</span> Please remember to mark the default new contacts to be
                        marketing contacts if you're using marketing contacts.</small>
                </div>

                <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('cristiansimion_hubspot_key_nonce'); ?>"/>
                <input type="hidden" name="action" value="update_hubspot_key"/>
                <input type="submit" class="btn btn-primary" value="Save settings"/>
            </form>
        </div>
    </div>
</div>