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
	*	\~russian Класс для работы с рекламной системой Sape.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides integration with the Sape system.
	*
	*	@author Dodonov A.A.
	*/
	class	sape_utilities_1_0_0{

		/**
		*	\~russian Вызов метода.
		*
		*	@param $Client - Клиент.
		*
		*	@param $MethodName - Название метода.
		*
		*	@param $Parameters - Параметры.
		*
		*	@param $ErrorMessage - Сообщения об ошибке.
		*
		*	@return Результат.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Function calls method.
		*
		*	@param $Client - Client.
		*
		*	@param $MethodName - Method's name.
		*
		*	@param $Parameters - Parameters.
		*
		*	@param $ErrorMessage - Error message.
		*
		*	@return Server response.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			call_method( &$Client , $MethodName , $Parameters , $ErrorMessage )
		{
			try
			{
				$Message = new xmlrpcmsg( $MethodName , $Parameters );
				
				$Response = $Client->send( $Message );
				
				if( $Response->faultCode() )
				{
					throw( 
						new Exception( $ErrorMessage.' : '.$Response->faultString().' ('.$Response->faultCode().')' )
					);
				}
				
				return( $Response );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>