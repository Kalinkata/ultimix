<?php

	chdir( '../../' );

	require_once( 'include/php/startup.php' );

	start_script();

	/* loading package */
	$Cache = get_package( 'cache' , '1.0.0' , __FILE__ );

	/* This function call adds data to the cache */
	$Cache->add_data( 'first_string' , 'String to be cached!' );

	/* was the data cached? */
	if( $Cache->data_exists( 'first_string' ) === true )
	{
		print( 'data was found in cache ' );
	}

	if( $Cache->data_exists( 'second_string' ) === false )
	{
		print( 'data was not found in cache ' );
	}

	print( $Cache->get_data( 'first_string' ) );

	/* update data */
	$Cache->set_data( 'first_string' , 'Updated string' );

	/* remove data from cache */
	$Cache->delete_data( 'first_string' );

	/* This function call adds data to the cache */
	$Cache->add_data( 'first_string' , 'String to be cached!' , array( 'tag1' , 'tag2' , 'tag3' ) );

	/* remove data from cache */
	$Cache->delete_data_by_tag( 'tag2' );

?>