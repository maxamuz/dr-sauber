This module allows you to convert your pagers to AJAX instead of full page reloads.  There is no fancy GUI or page in Drupal to do this.  This is intended for developers who are writing code and using the theme("pager"); functionality.

To use:

1.  Install module.
2.  Replace theme("pager") with theme("ajax_pager", array("parameters" => array("selector" => "ID_OF_CONTAINER_TO_REPLACE")));
3.  Observe AJAX pagination.

Note:  You must pass the ID of the container so the module knows where to replace content when handling the AJAX response.