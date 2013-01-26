<?php

	chdir( '../../' );

	require_once( 'include/php/startup.php' );

	start_php_script();

	/* this code can be found in the 'demo8.php' file */
	$AutoMarkup = get_package( 'page::auto_markup' , 'last' , __FILE__ );

	$Str = '{lang:main_page}';
	$Str = $AutoMarkup->compile_string( $Str );

	print( 'The macro {lang:main_page} will be replaced with "'.$Str.'" string' );

?>