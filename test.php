<?php
if( function_exists('apache_get_modules') && in_array('mod_rewrite',apache_get_modules()) )
    $mod_rewrite = TRUE;
elseif( isset($_SERVER['IIS_UrlRewriteModule']) )
    $mod_rewrite = TRUE;
else
    $mod_rewrite = FALSE;

echo $mod_rewrite;
//define('MOD_REWRITE', $mod_rewrite);

echo phpinfo();
//test
?>