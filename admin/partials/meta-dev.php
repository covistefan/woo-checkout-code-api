<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

echo isset($dataset['dev'])?'<pre>'.esc_html(var_export($dataset['dev'], true)).'</pre>':'';

?>
