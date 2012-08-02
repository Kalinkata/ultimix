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
	
	// TODO why string.php is excluded from unit-tests?
	
	/**
	*	\~russian Класс, отвечающий за безопасную работу с вводимыми данными.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class for safe data processing.
	*
	*	@author Dodonov A.A.
	*/
	class	security_1_0_0{
		
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
		var					$SecurityUtilities = false;
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
				if( session_id() == '' )
				{
					@session_start();
				}
				
				$this->SecurityUtilities = get_package( 'security::security_utilities' , 'last' , __FILE__ );
				
				$this->SupportedDataTypes = get_package( 'security::supported_data_types' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Установка значения в массиве $_GET.
		*
		*	@param $Field - Устанавливаемое поле.
		*
		*	@param $Value - Данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sets value in array $_GET.
		*
		*	@param $Field - Field to set.
		*
		*	@param $Value - Data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_g( $Field , $Value )
		{
			try
			{
				if( isset( $_GET[ $Field ] ) === false )
				{
					$_GET[ $Field ] = $Value;
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Установка значения в массиве $_POST.
		*
		*	@param $Field - Устанавливаемое поле.
		*
		*	@param $Value - Данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sets value in array $_POST.
		*
		*	@param $Field - Field to set.
		*
		*	@param $Value - Data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_p( $Field , $Value )
		{
			try
			{
				if( isset( $_POST[ $Field ] ) === false )
				{
					$_POST[ $Field ] = $Value;
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Установка значения в массиве $_COOKIE.
		*
		*	@param $Field - Устанавливаемое поле.
		*
		*	@param $Value - Данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sets value in array $_COOKIE.
		*
		*	@param $Field - Field to set.
		*
		*	@param $Value - Data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_c( $Field , $Value )
		{
			try
			{
				if( isset( $_COOKIE[ $Field ] ) === false )
				{
					$_COOKIE[ $Field ] = $Value;
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Установка значения в массиве $_SESSION.
		*
		*	@param $Field - Устанавливаемое поле.
		*
		*	@param $Value - Данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sets value in array $_SESSION.
		*
		*	@param $Field - Field to set.
		*
		*	@param $Value - Data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_s( $Field , $Value )
		{
			try
			{
				if( isset( $_SESSION[ $Field ] ) === false )
				{
					$_SESSION[ $Field ] = $Value;
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Установка значения в массиве $_SESSION.
		*
		*	@param $Field - Устанавливаемое поле.
		*
		*	@param $Value - Данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sets value in array $_SESSION.
		*
		*	@param $Field - Field to set.
		*
		*	@param $Value - Data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			reset_s( $Field , $Value )
		{
			try
			{
				$_SESSION[ $Field ] = $Value;
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Удаление значения в массиве $_SESSION.
		*
		*	@param $Field - Устанавливаемое поле.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function deletes value in array $_SESSION.
		*
		*	@param $Field - Field to set.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			unset_s( $Field )
		{
			try
			{
				unset( $_SESSION[ $Field ] );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Установка значения в массиве $_GET.
		*
		*	@param $Field - Устанавливаемое поле.
		*
		*	@param $Value - Данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sets value in array $_GET.
		*
		*	@param $Field - Field to set.
		*
		*	@param $Value - Data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			reset_g( $Field , $Value )
		{
			try
			{
				$_SESSION[ $Field ] = $Value;
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Удаление значения в массиве $_GET.
		*
		*	@param $Field - Устанавливаемое поле.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function deletes value in array $_GET.
		*
		*	@param $Field - Field to set.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			unset_g( $Field )
		{
			try
			{
				unset( $_GET[ $Field ] );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Установка значения в массиве $_COOKIE.
		*
		*	@param $Field - Устанавливаемое поле.
		*
		*	@param $Value - Данные.
		*
		*	@param $Expire - Время когда истекает срок действия печенек (в секундах).
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sets value in array $_COOKIE.
		*
		*	@param $Field - Field to set.
		*
		*	@param $Value - Data.
		*
		*	@param $Expire - Expiration date (in seconds).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			reset_c( $Field , $Value , $Expire = 0 )
		{
			try
			{
				setcookie( $Field , $Value , $Expire === 0 ? 0 : time() + $Expire );
				$_COOKIE[ $Field ] = $Value;
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Удаление значения в массиве $_COOKIE.
		*
		*	@param $Field - Устанавливаемое поле.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function deletes value in array $_COOKIE.
		*
		*	@param $Field - Field to set.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			unset_c( $Field )
		{
			try
			{
				unset( $_COOKIE[ $Field ] );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Установка значения в массиве $_POST.
		*
		*	@param $Field - Устанавливаемое поле.
		*
		*	@param $Value - Данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sets value in array $_POST.
		*
		*	@param $Field - Field to set.
		*
		*	@param $Value - Data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			reset_p( $Field , $Value )
		{
			try
			{
				$_POST[ $Field ] = $Value;
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Удаление значения в массиве $_POST.
		*
		*	@param $Field - Устанавливаемое поле.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function deletes value in array $_POST.
		*
		*	@param $Field - Field to set.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			unset_p( $Field )
		{
			try
			{
				unset( $_POST[ $Field ] );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка данных из $_GET.
		*
		*	@param $Field - Поле, из которого будут выбираться данные.
		*
		*	@param $Type - Тип данных.
		*
		*	@param $Default - Дефолтовое значение.
		*
		*	@return Данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Selecting data from $_GET.
		*
		*	@param $Field - Field name in array $_GET.
		*
		*	@param $Type - Data type.
		*
		*	@param $Default - Default value.
		*
		*	@return Data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_g( $Field , $Type = 'set' , $Default = '_throw_exception' )
		{
			try
			{
				return( $this->SecurityUtilities->get_value( $_GET , $Field , $Type , $Default ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка данных из $_POST.
		*
		*	@param $Field - Поле, из которого будут выбираться данные.
		*
		*	@param $Type - Тип данных.
		*
		*	@param $Default - Дефолтовое значение.
		*
		*	@return - Данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Selecting data from $_POST.
		*
		*	@param $Field - Field name in array $_POST.
		*
		*	@param $Type - Data type.
		*
		*	@param $Default - Default value.
		*
		*	@return - Data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_p( $Field , $Type = 'set' , $Default = '_throw_exception' )
		{
			try
			{
				return( $this->SecurityUtilities->get_value( $_POST , $Field , $Type , $Default ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка данных из $_SESSION.
		*
		*	@param $Field - Поле, из которого будут выбираться данные.
		*
		*	@param $Type - Тип данных.
		*
		*	@param $Default - Дефолтовое значение.
		*
		*	@return - Данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Selecting data from $_SESSION.
		*
		*	@param $Field - Field name in array $_SESSION.
		*
		*	@param $Type - Data type.
		*
		*	@param $Default - Default value.
		*
		*	@return - Data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_s( $Field , $Type = 'set' , $Default = '_throw_exception' )
		{
			try
			{
				return( $this->SecurityUtilities->get_value( $_SESSION , $Field , $Type , $Default ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка данных из $_SERVER.
		*
		*	@param $Field - Поле, из которого будут выбираться данные.
		*
		*	@param $Type - Тип данных.
		*
		*	@param $Default - Дефолтовое значение.
		*
		*	@return - Данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Selecting data from $_SERVER.
		*
		*	@param $Field - Field name in array $_SERVER.
		*
		*	@param $Type - Data type.
		*
		*	@param $Default - Default type.
		*
		*	@return - Data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_srv( $Field , $Type = 'set' , $Default = '_throw_exception' )
		{
			try
			{
				return( $this->SecurityUtilities->get_value( $_SERVER , $Field , $Type , $Default ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка данных из $_COOKIE.
		*
		*	@param $Field - Поле, из которого будут выбираться данные.
		*
		*	@param $Type - Тип данных.
		*
		*	@param $Default - Дефолтовое значение.
		*
		*	@return Данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Selecting data from $_COOKIE.
		*
		*	@param $Field - Field name in array $_COOKIE.
		*
		*	@param $Type - Data type.
		*
		*	@param $Default - Default value.
		*
		*	@return Data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_c( $Field , $Type = 'set' , $Default = '_throw_exception' )
		{
			try
			{
				return( $this->SecurityUtilities->get_value( $_COOKIE , $Field , $Type , $Default ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка данных из $_POST или $_GET.
		*
		*	@param $Field - Поле, из которого будут выбираться данные.
		*
		*	@param $Type - Тип данных.
		*
		*	@param $DefaultValue - Значение по-умолчанию.
		*
		*	@return - Данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Selecting data from $_POST or $_GET.
		*
		*	@param $Field - Field name in array $_POST or $_GET.
		*
		*	@param $Type - Data type.
		*
		*	@param $DefaultValue - Default value.
		*
		*	@return - Data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_gp( $Field , $Type = 'set' , $DefaultValue = '_throw_exception' )
		{
			try
			{
				return( $this->SecurityUtilities->get_global( $Field , $Type , GET | POST , $DefaultValue ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция обработки данных.
		*
		*	@param $Data - данные, подлежащие обработке.
		*
		*	@param $Type - тип обработки.
		*
		*	@return Обработанные данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Data processing function.
		*
		*	@param $Data - Data to process.
		*
		*	@param $Type - Type of the processing.
		*
		*	@return Processed data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get( $Data , $Type )
		{
			try
			{
				if( is_array( $Data ) || is_object( $Data ) )
				{
					return( $this->SupportedDataTypes->dispatch_complex_data( $Data , $Type ) );
				}
				
				return( $this->SupportedDataTypes->compile_data( $Data , $Type ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>