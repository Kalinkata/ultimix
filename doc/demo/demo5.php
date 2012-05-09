<?php

	chdir( '../../' );

	require_once( 'include/php/startup.php' );

	start_script();

	/* loading package */
	$CachedMultyFS = get_package( 'cached_multy_fs' , '1.0.0' , __FILE__ );
	
	/* reading entire file */
	$CachedMultyFS->file_get_contentns( 'index.html' );

	/* writing entire file */
	$CachedMultyFS->file_put_contentns( 'index.html' , 'Hello!' );

	/* remove data from cache */
	if( $CachedMultyFS->file_exists( 'index.php' ) )
	{
		print( 'The file index.php exists!' );
	}

?>