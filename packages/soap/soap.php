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

	require_once( dirname( __FILE__ ).'/include/nusoap.php' );
	require_once( dirname( __FILE__ ).'/include/class.wsdlcache.php' );
	
	/**
	*	\~russian Класс для подключения библиотеки nuSOAP.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class loads nuSOAP library.
	*
	*	@author Dodonov A.A.
	*/
	class	nusoap_0_9_5{

		/**
		*	\~russian Конструктор.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Constructor.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			__construct()
		{
			try
			{
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция создания объекта клиента.
		*
		*	@param $URL - адрес вебсервиса.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function creates SOAP client object.
		*
		*	@param $URL - web service object.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_coap_client( $URL )
		{
			try
			{
				return( new nusoap_client( $URL , 'wsdl' , '' , '' , '' , '' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>