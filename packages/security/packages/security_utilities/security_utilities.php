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
	*	\~russian Класс дополнительных алгоритмов выборки данных.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class with additional algorithms.
	*
	*	@author Dodonov A.A.
	*/
	class	security_utilities_1_0_0{

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
		var					$Security = false;
		var					$SecurityParser = false;
		var					$Settings = false;
		var					$String = false;
		var					$SupportedDataTypes = false;

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
				$this->SecurityParser = get_package( 'security::security_parser' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
				$this->SupportedDataTypes = get_package( 'security::supported_data_types' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Выборка из массива.
		*
		*	@param $Prefix - Строка поиска.
		*
		*	@param $Mode - Откуда брать данные.
		*
		*	@param $Array - Массив.
		*
		*	@return - Массив с названиями полей.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Selecting fields from the array.
		*
		*	@param $Prefix - Search string.
		*
		*	@param $Mode - Data resource.
		*
		*	@param $Array - Array.
		*
		*	@return - Array with fields names.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_fields_from_array( $Prefix , $Mode , &$Array )
		{
			try
			{
				$Fields = array();

				foreach( $Array as $k => $v )
				{
					if( strpos( $k , $Prefix ) !== false )
					{
						$Fields [] = $k;
					}
				}

				return( $Fields );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Выборка полей.
		*
		*	@param $Prefix - Строка поиска.
		*
		*	@param $Mode - Откуда брать данные.
		*
		*	@return - Массив с названиями полей.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Selecting fields.
		*
		*	@param $Prefix - Search string.
		*
		*	@param $Mode - Data resource.
		*
		*	@return - Array with fields names.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_fields( $Prefix , $Mode )
		{
			try
			{
				$Fields = array();

				if( $Mode & POST )
				{
					$Fields = array_merge( $this->get_fields_from_array( $Prefix , $Mode , $_POST ) , $Fields );
				}
				if( $Mode & GET )
				{
					$Fields = array_merge( $this->get_fields_from_array( $Prefix , $Mode , $_GET ) , $Fields );
				}
				if( $Mode & COOKIE )
				{
					$Fields = array_merge( $this->get_fields_from_array( $Prefix , $Mode , $_COOKIE ) , $Fields );
				}
				if( $Mode & SESSION )
				{
					$Fields = array_merge( $this->get_fields_from_array( $Prefix , $Mode , $_SESSION ) , $Fields );
				}

				return( $Fields );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Выборка данных из массива.
		*
		*	@param $Array - Массив с данными.
		*
		*	@param $Field - Поле, из которого будут выбираться данные.
		*
		*	@param $Type - Тип данных.
		*
		*	@param $DefaultValue - Дефолтовое значение.
		*
		*	@return Данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Selecting data from the array.
		*
		*	@param $Array - Data array.
		*
		*	@param $Field - Field name in array $_GET.
		*
		*	@param $Type - Data type.
		*
		*	@param $DefaultValue - Default value.
		*
		*	@return Data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_value( &$Array , $Field , $Type = 'set' , $DefaultValue = '_throw_exception' )
		{
			try
			{
				if( isset( $Array[ $Field ] ) && $Type !== 'set' )
				{
					if( $this->Security === false )
					{
						$this->Security = get_package( 'security' , 'last' , __FILE__ );
					}
					return( $this->Security->get( $Array[ $Field ] , $Type ) );
				}

				return( $this->handle_default_set( $Array , $Field , $Type , $DefaultValue ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Выборка данных.
		*
		*	@param $Mode - Откуда брать данные.
		*
		*	@return Данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Selecting data.
		*
		*	@param $Mode - Data resource.
		*
		*	@return Data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	merge_globals( $Mode )
		{
			try
			{
				$Data = array();

				$Data = $Mode & GET ? array_merge( $Data , $_GET ) : $Data;

				$Data = $Mode & POST ? array_merge( $Data , $_POST ) : $Data;

				$Data = $Mode & COOKIE ? array_merge( $Data , $_COOKIE ) : $Data;

				$Data = $Mode & SESSION ? array_merge( $Data , $_SESSION ) : $Data;

				$Data = $Mode & SERVER ? array_merge( $Data , $_SERVER ) : $Data;

				return( $Data );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Выборка данных.
		*
		*	@param $Data - Данные.
		*
		*	@param $Field - Поле, из которого будут выбираться данные.
		*
		*	@param $Type - Тип данных.
		*
		*	@param $DefaultValue - Дефолтовое значение.
		*
		*	@return Данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Selecting data.
		*
		*	@param $Data - Data.
		*
		*	@param $Field - Field name.
		*
		*	@param $Type - Data type.
		*
		*	@param $DefaultValue - Default value.
		*
		*	@return Data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	handle_default_set( &$Data , $Field , $Type , $DefaultValue )
		{
			try
			{
				if( $Type === 'set' )
				{
					return( isset( $Data[ $Field ] ) );
				}
				else
				{
					if( $DefaultValue === '_throw_exception' )
					{
						throw( new Exception( "Field '$Field' was not found" ) );
					}
					else
					{
						return( $DefaultValue );
					}
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Выборка данных.
		*
		*	@param $Field - Поле, из которого будут выбираться данные.
		*
		*	@param $Mode - Откуда брать данные.
		*
		*	@return Данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Selecting data.
		*
		*	@param $Field - Field name.
		*
		*	@param $Mode - Data resource.
		*
		*	@return Data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	handle_get( $Field , $Mode )
		{
			try
			{
				if( ( $Mode & GET ) && isset( $_GET[ $Field ] ) )
				{
					return( $_GET[ $Field ] );
				}
				elseif( ( $Mode & POST ) && isset( $_POST[ $Field ] ) )
				{
					return( $_POST[ $Field ] );
				}
				elseif( ( $Mode & COOKIE ) && isset( $_COOKIE[ $Field ] ) )
				{
					return( $_COOKIE[ $Field ] );
				}
				elseif( ( $Mode & SESSION ) && isset( $_SESSION[ $Field ] ) )
				{
					return( $_SESSION[ $Field ] );
				}
				elseif( ( $Mode & SERVER ) && isset( $_SERVER[ $Field ] ) )
				{
					return( $_SERVER[ $Field ] );
				}
				return( false );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Выборка данных.
		*
		*	@param $Field - Поле, из которого будут выбираться данные.
		*
		*	@param $Data - Данные.
		*
		*	@param $Mode - Режим.
		*
		*	@param $Return - Результат.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Selecting data.
		*
		*	@param $Field - Field name.
		*
		*	@param $Data - Data.
		*
		*	@param $Mode - Mode.
		*
		*	@param $Return - Return.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	fetch_data( $Field , $Data , $Mode , &$Return )
		{
			try
			{
				if( $Mode & KEYS )
				{
					$Data = array_keys( $Data );
					$FilterFunction = create_function( '$e' , "return( strpos( \$e , '$Field' ) === 0 );" );
					$Data = array_filter( $Data , $FilterFunction );
					foreach( $Data as $d )
					{
						$Return [] = str_replace( $Field , '' , $d );
					}
				}
				else
				{
					foreach( $Data as $k => $v )
					{
						if( strpos( $k , $Field ) === 0 )
						{
							$Return[ str_replace( $Field , '' , $k ) ] = $v;
						}
					}
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Выборка данных.
		*
		*	@param $Field - Поле, из которого будут выбираться данные.
		*
		*	@param $Type - Тип данных.
		*
		*	@param $Mode - Откуда брать данные.
		*
		*	@param $DefaultValue - Дефолтовое значение.
		*
		*	@return Данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Selecting data.
		*
		*	@param $Field - Field name.
		*
		*	@param $Type - Data type.
		*
		*	@param $Mode - Data resource.
		*
		*	@param $DefaultValue - Default value.
		*
		*	@return Data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_global( $Field , $Type , $Mode , $DefaultValue = '_throw_exception' )
		{
			try
			{
				if( $this->Security === false )
				{
					$this->Security = get_package( 'security' , 'last' , __FILE__ );
				}
				if( $Mode & PREFIX_NAME )
				{
					$Data = $this->merge_globals( $Mode );
					$Return = array();

					$this->fetch_data( $Field , $Data , $Mode , $Return );

					return( $this->Security->get( $Return , $Type ) );
				}
				if( $Type !== 'set' && ( $Value = $this->handle_get( $Field , $Mode ) ) !== false )
				{
					return( $this->Security->get( $Value , $Type ) );
				}
				$Data = $this->merge_globals( $Mode );

				return( $this->handle_default_set( $Data , $Field , $Type , $DefaultValue ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получениt всех данных из $_POST.
		*
		*	@return Безопасный $_POST.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns all data from $_POST.
		*
		*	@return Secure $_POST.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_all_posted_data()
		{
			try
			{
				if( $this->Security === false )
				{
					$this->Security = get_package( 'security' , 'last' , __FILE__ );
				}

				return( $this->Security->get( $_POST , 'string' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>