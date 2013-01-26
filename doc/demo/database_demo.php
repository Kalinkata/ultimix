<?php

	chdir( '../../' );

	require_once( 'include/php/startup.php' );

	start_php_script();

	/* this code can be found in the 'demo10.php' file */
	$Database = get_package( 'database' , 'last' , __FILE__ );

	/* selecting all users */
	$Result = $Database->query( 'SELECT * FROM umx_user' );
	
	var_dump( $Database->fetch_results( $Result ) );
	
	/* selecting all users in the other way */
	var_dump( $Database->select( '*' , 'umx_user' ) );
	
	/* selecting exact user in the other way */
	var_dump( $Database->select( '*' , 'umx_user' , 'id = 1' ) );
	
	/* inserting record */
	$Database->insert( 'umx_user' , array( 'login' , 'password' ) , array( 'test_user' , 'test_pass' ) );
	/* commit changes */
	$Database->commit();
	
	/* deleting record */
	$Database->delete( 'umx_user' , 'id = 1234567' );
	/* commit changes */
	$Database->commit();
	
	/* updating record */
	$Database->insert( 'umx_user' , array( 'password' ) , array( 'new_pass' ) , 'login LIKE "test_user"' );
	/* commit changes */
	$Database->commit();

?>