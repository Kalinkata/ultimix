<?php

	chdir( '../../' );

	require_once( 'include/php/startup.php' );

	start_php_script();

	/* loading package */
	/* this code can be found in the 'demo6.php' file */
	$Trace = get_package( 'trace' , 'last' , __FILE__ );

	/* these function calls output trace strings with different severity */
	$Trace->add_trace_string( 'Some string' , 'ERROR' );
	$Trace->add_trace_string( 'Some string' , 'NOTIFICATION' );
	$Trace->add_trace_string( 'Some string' , 'COMMON' );
	$Trace->add_trace_string( 'Some string' , 'QUERY' );
	
	/* all trace strings can be groupped */
	/* starting group with name 'Group 1' */
	$Trace->start_group( 'Group 1' );
	
	$Trace->add_trace_string( 'Groupped string 1' , 'COMMON' );
	$Trace->add_trace_string( 'Groupped string 2' , 'COMMON' );
	
	/* groups may be nested */
	/* starting nested group with name 'Group 2' */
	$Trace->start_group( 'Group 2' );
	
	$Trace->add_trace_string( 'Groupped string 3' , 'COMMON' );
	
	/* closing nested group with name 'Group 2' */
	$Trace->end_group();
	
	/* closing group with name 'Group 1' */
	$Trace->end_group();
	
	print( $Trace->compile_trace() );

?>