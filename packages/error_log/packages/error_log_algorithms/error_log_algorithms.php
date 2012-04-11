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
	class	error_log_algorithms_1_0_0{
		
		/**
		*	\~russian Выборка записей.
		*
		*	@param $Start - Номер первой записи.
		*
		*	@param $Limit - Количество выбираемых записей.
		*
		*	@param $Field - Поле, по которому будет осуществляться сортировка.
		*
		*	@param $Order - порядок сортировки.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function selects records.
		*
		*	@param $Start - Cursor of the first record.
		*
		*	@param $Limit - Count of the selecting records.
		*
		*	@param $Field - Field to sort by.
		*
		*	@param $Order - Sorting order.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function	select_messages( $Start , $Limit , $Field = false , $Order = false )
		{
			try
			{
				$Database = get_package( 'database' , 'last' , __FILE__ );
				$DatabaseAlgorithms = get_package( 'database::database_algorithms' , 'last' , __FILE__ );

				$Condition = $DatabaseAlgorithms->select_condition( 
					$Start , $Limit , $Field , $Order , '1 = 1'
				);

				$Results = $Database->select( 
					'*' , 'umx_error_log' , $Condition
				);

				return( $Results );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>