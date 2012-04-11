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

	require_once( dirname( __FILE__ ).'/include/php/xmlrpc.inc' );
	
	/**
	*	\~russian Класс для подключения библиотеки XML-RPC.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class loads XML-RPC library.
	*
	*	@author Dodonov A.A.
	*/
	class	xml_rpc_2_2_2{

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
				$GLOBALS[ 'xmlrpc_defencoding' ] = "UTF8";
				
				$GLOBALS[ 'xmlrpc_internalencoding' ] = "UTF-8";  
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция создания объекта клиента.
		*
		*	@param $Server - Сервер.
		*
		*	@param $Query - Параметры запроса.
		*
		*	@param $Host - Хост.
		*
		*	@return Клиент.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function creates XML-RPC client object.
		*
		*	@param $Server - Server.
		*
		*	@param $Query - Request parameters.
		*
		*	@param $Host - Host.
		*
		*	@return Client.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_xml_rpc_client( $Server , $Query , $Host = 80 )
		{
			try
			{
				return( new xmlrpc_client( $Query , $Server , $Host ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>