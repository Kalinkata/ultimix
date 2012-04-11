<?php

	/*
	*	This source code is a part of the Ultimix Project. 
	*	It is distributed under BSD license. All other third side source code (like tinyMCE) is distributed under 
	*	it's own license wich could be found from the corresponding files or sources. 
	*	This source code is provided "as is" without any warranties or garanties.
	*
	*	Have a nice day!
	*
	*	@url http://ultimix.sorceforge.net
	*
	*	@author Alexey "gdever" Dodonov
	*/
	
	/**
	*	\~russian Класс, отвечающий за тестирование компонентов системы.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class for unit testing.
	*
	*	@author Dodonov A.A.
	*/
	class	unit_tests{
	
		/**
		*	\~russian Тестирование простого запроса.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing simple request.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			test_simple_http()
		{
			try
			{
				$http = get_package( 'http' , 'last' , __FILE__ );
				
				$Response = $http->http_request( 'google.com' );
				
				if( strpos( $Response , 'google' ) !== false )
				{
					return( 'TEST PASSED' );
				}
				else
				{
					return( 'ERROR' );
				}
			}
			catch( Exception $e )
			{
				throw( new Exception( __METHOD__."()::".$e->getMessage() ) );
			}
		}
	}

?>