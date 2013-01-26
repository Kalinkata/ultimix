<?php

	chdir( '../../' );

	require_once( 'include/php/startup.php' );

	start_php_script();

	/* this code can be found in the 'demo9.php' file */
	$AutoMarkup = get_package( 'page::auto_markup' , 'last' , __FILE__ );

	$Str = '{date:value=now}';
	$Str = $AutoMarkup->compile_string( $Str );

	print( 'The macro {date:value=now} will be replaced with "'.$Str.'" string' );

?>