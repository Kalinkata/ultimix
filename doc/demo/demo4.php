<?php

	chdir( '../../' );

	require_once( 'include/php/startup.php' );

	start_php_script();

	/* loading package */
	$Cache = get_package( 'cached_fs' , '1.0.0' , __FILE__ );

	/* reading entire file */
	$CachedFS->file_get_contentns( 'index.html' );

	/* writing entire file */
	$CachedFS->file_put_contentns( 'index.html' , 'Hello!' );

	/* remove data from cache */
	if( $CachedFS->file_exists( 'index.php' ) )
	{
		print( 'The file index.php exists!' );
	}
?>