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
	*	\~russian Класс обработки макросов доступа к данным.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class processes data access macro.
	*
	*	@author Dodonov A.A.
	*/
	class	db_markup_1_0_0
	{
		
		/**
		*	\~russian Закешированные объекты.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cached objects.
		*
		*	@author Dodonov A.A.
		*/
		var					$Database = false;
		var					$Utilities = false;
		
		/**
		*	\~russian Конструктор.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Constructor.
		*
		*	@author Dodonov A.A.
		*/
		function			__construct()
		{
			try
			{
				$this->Database = get_package( 'database' , 'last' , __FILE__ );
				$this->Utilities = get_package( 'utilities' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения значения поля из записи.
		*
		*	@param $Settings - Параметры извлечения.
		*
		*	@return Значение поля.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns field value.
		*
		*	@param $Settings - Extraction parameters.
		*
		*	@return Field value.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_query_field( &$Settings )
		{
			try
			{
				$Result = $this->Database->query( $Settings->get_setting( 'query' ) );
				$Result = $this->Database->fetch_results( $Result );

				if( isset( $Result[ 0 ] ) )
				{
					$Result = $Result[ 0 ];
				}
				else
				{
					throw( new Exception( "No data found for the query \"$Query\"" ) );
				}

				return( get_field( $Result , $Settings->get_setting( 'field' ) ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция получения значения поля из записи.
		*
		*	@param $Settings - Параметры извлечения.
		*
		*	@return Значение поля.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns field value.
		*
		*	@param $Settings - Extraction parameters.
		*
		*	@return Field value.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_record_field( &$Settings )
		{
			try
			{
				$Value = '';
				$id = $Settings->get_setting( 'id' );

				if( $id != '0' )
				{
					$PackageObject = $this->Utilities->get_package( $Settings , __FILE__ , 'access_' );

					if( method_exists( $PackageObject , 'get_by_id' ) == false )
					{
						$Message = 'The method "get_by_id" was not found in class '.get_class( $PackageObject );
						throw( new Exception( $Message ) );
					}

					$Record = call_user_func( array( $PackageObject , 'get_by_id' ) , $id );

					$Field = $Settings->get_setting( 'field' );
					$Value = get_field( $Record , $Field );
				}

				return( $Value );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>