<?php

function fullConvertDown($string)
{
	return htmlspecialchars(nl2br2($string), ENT_QUOTES, "UTF-8");
}
function fullConvertUp($string)
{
	echo br2nl(html_entity_decode($out, ENT_QUOTES));			 
}
function br2nl ( $string )
{
    return preg_replace('/\<br(\s*)?\/?\>/i', PHP_EOL, $string);
    
}
function nl2br2 ( $string )
{
    
    return str_replace(["\r\n", "\r", "\n"], '<br/>', $string);
}

?>