## Functionality  

### Filters

### `hs_get_user_meta_fields`  
This hook will allow you to map properties to user custom meta fields and generate the properties automatically on user creation.
```
add_filter('hs_get_user_meta_fields', 'your_custom_function', 10, 1);
function your_custom_function( $fields ) {

    // add more fields here
    // fields are in the format $fields[$property_name] = $field_name;

    return $fields;
}
```
---
### `hs_get_user_customfields`  
Similar to the hook above, you can use this hook to add any type of custom data. Custom data is not appropriate for the hook above as it will try to map it to the user's custom metadata and it will not result into anything useful.
```
add_filter('hs_get_user_customfields', 'your_custom_function', 10, 1);
function your_custom_function( $fields ) {

    // add more fields here
    // fields are in the format $fields[$property_name] = $custom_value;

    return $fields;
}
```

Actions  
---

### `hs_register_user_hook`  
This hook will allow you to trigger custom actions before or after sending the user to hubspot. You will have access to the user object as well as properties that have been set using the filters in the next section.
```
add_action('hs_register_user_hook', 'your_custom_function', 10, 2);
function your_custom_function( $user, $properties ) {

    // Actions you want to perform
    // Below is just an example, it's already a running hook

    $contact = HubSpotWrapper::create_or_update(
        $user->user_email,
        $properties
    );
}
```
## Changelog

#### Version 1.0.0
- sync contact to hubspot on wp user creation
- create contact functionality for hubspot
- update contact functionality (this might be especially useful when integrating with woocommerce hooks)
- create_or_update contact function that will automatically either create or update the contact record.
- get_contact by email function added for easy contact record fetching from HubSpot.
- wp admin menu option to be able to set the api key
- api key also has a setting in the index.php file of this plugin. Leaving the api key field empty in the wp-admin area will resolve to this API key settings. It's been built to aid on urgent changes without having to deal with FTP/SFTP or file editing. 
