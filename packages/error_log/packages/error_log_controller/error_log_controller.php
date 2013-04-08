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
	*	\~russian Подключение error log'а.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Error log' implementation.
	*
	*	@author Dodonov A.A.
	*/
	class	error_log_controller_1_0_0{
	
		/**
		*	\~russian Сохранение 404 сообщения.
		*
		*	@param $Options - настройки работы модуля.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function stores 404 page not found message.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			store_404_error_message( $Options )
		{
			try
			{
				$Security = get_package( 'security' , 'last' , __FILE__ );
				$ErrorLog = get_package( 'error_log::error_log_access' , 'last' , __FILE__ );
				$ErrorLog->add_message_to_log( 
					5 , '404' , '{lang:page_was_not_found} '.$Security->get_srv( 'REQUEST_URI' , 'string' )
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Удаление сообщений лога.
		*
		*	@param $Options - настройки работы модуля.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Deleting error logs.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			delete_error( $Options )
		{
			try
			{
				$SecurityUtilities = get_package( 'security::security_utilities' , 'last' , __FILE__ );
				$ErrorLogAccess = get_package( 'error_log::error_log_access' , 'last' , __FILE__ );
				
				$Ids = $SecurityUtilities->get_global( '_id_' , 'integer' , POST | PREFIX_NAME | KEYS );
				foreach( $Ids as $k => $id )
				{
					$ErrorLogAccess->delete_error_log( $id );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Функция работы с компонентом.
		*
		*	@param $Options - настройки работы модуля.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes components.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			controller( &$Options )
		{
			try
			{
				$ContextSet = get_package( 'gui::context_set' , 'last' , __FILE__ );

				$ContextSet->add_context( dirname( __FILE__ ).'/conf/cfcx_404' );			
				$ContextSet->add_context( dirname( __FILE__ ).'/conf/cfcx_massive_delete' );

				if( $ContextSet->execute( $Options , $this , __FILE__ ) )
				{
					return;
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>