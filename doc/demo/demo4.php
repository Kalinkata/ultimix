<?php

	chdir( '../../' );

	require_once( 'include/php/startup.php' );

	start_script();

	/* loading package */
	$Cache = get_package( 'cached_fs' , '1.0.0' , __FILE__ );

?>