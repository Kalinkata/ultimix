<?php

	chdir( '../../' );

	require_once( 'include/php/startup.php' );

	start_script();

	/* loading package */
	$Lang = get_package( 'lang' , 'last' , __FILE__ );

	print( 'Hello from '.$Lang->get_string( 'ultimix' ) );
?>