<?php
function cfd_reg_function{
  $form_id = '4';
  $form = GFAPI::get_form( $form_id );
  var_dump( $form );
}
add_shortcode('cfd_reg', 'cfd_reg_function');

?>
