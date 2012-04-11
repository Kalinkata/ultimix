<?php

	/*
	*	This source code is a part of the Ultimix Project. 
	*	It is distributed under BSD licence. All other third side source code (like tinyMCE) is distributed under 
	*	it's own licence wich could be found from the corresponding files or sources. 
	*	This source code is provided "as is" without any warranties or garanties.
	*
	*	Have a nice day!
	*
	*	@url http://ultimix.sorceforge.net
	*
	*	@author Alexey "gdever" Dodonov
	*/
	
	try
	{
		require_once( './include/php/startup.php' );

		index_main();
	}
	catch( Exception $e )
	{
		process_script_error( true , $e );
	}

?>