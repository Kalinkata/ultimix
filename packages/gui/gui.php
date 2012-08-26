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
	*	\~russian Класс для отрисовки контролов.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class draws controls.
	*
	*	@author Dodonov A.A.
	*/
	class	gui_1_0_0{

		/**
		*	\~russian Набор переменных.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Set of variables.
		*
		*	@author Dodonov A.A.
		*/
		var					$Vars = array();

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
		var					$Settings = false;
		var					$String = false;

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
				$this->Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция установки переменной.
		*
		*	@param $VarName - Название переменной.
		*
		*	@param $VarValue - Значение переменной.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sets variable.
		*
		*	@param $VarName - Variable name.
		*
		*	@param $VarValue - Variable value.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_var( $VarName , $VarValue )
		{
			try
			{
				$this->Vars[ $VarName ] = $VarValue;
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция предгенерационных действий.
		*
		*	@param $Options - настройки работы модуля.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function executes before any page generating actions took place.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			pre_generation( $Options )
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
		*	\~russian Функция обработки макроса 'set_var'.
		*
		*	@param $Settings - Настройки.
		*
		*	@return Код.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'set_var'.
		*
		*	@param $Settings - Settings.
		*
		*	@return Code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_set_var( &$Settings )
		{
			try
			{
				$Name = $Settings->get_setting( 'name' );
				$Value = $Settings->get_setting( 'value' );

				$this->Vars[ $Name ] = $Value;

				return( '' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция обработки макроса 'get_var'.
		*
		*	@param $Settings - Настройки.
		*
		*	@return Значение.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'get_var'.
		*
		*	@param $Settings - Settings.
		*
		*	@return Value.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_get_var( &$Settings )
		{
			try
			{
				$Name = $Settings->get_setting( 'name' );

				return( $this->Vars[ $Name ] );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция обработки макроса 'date'.
		*
		*	@param $Settings - Параметры обработки.
		*
		*	@return Значение.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'date'.
		*
		*	@param $Settings - Processing parameters.
		*
		*	@return Value.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_date( &$Settings )
		{
			try
			{
				$Format = $Settings->get_setting( 'format' , 'Y-m-d' );

				if( $Settings->get_setting( 'value' , false ) !== false )
				{
					$Now = $Settings->get_setting( 'now' , time() );
					$Value = date( $Format , strtotime( $Settings->get_setting( 'value' , 'now' ) , $Now ) );
				}
				else
				{
					$Value = date( $Format , intval( $Settings->get_setting( 'timestamp' , time() ) ) );
				}

				return( $Value );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции макроса 'composer'.
		*
		*	@param $Settings - Параметры компиляции.
		*
		*	@param $Data - Данные.
		*
		*	@return Widget.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'composer'.
		*
		*	@param $Settings - Compilation parameters.
		*
		*	@param $Data - Data.
		*
		*	@return Widget.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_composer( &$Settings , $Data )
		{
			try
			{
				$Condition = intval( $Settings->get_setting( 'condition' ) );

				if( $Condition )
				{
					return( $Data );
				}
				else
				{
					return( '' );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция конвертации объекта в строку.
		*
		*	@return Строка с описанием объекта.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function converts object to string.
		*
		*	@return String with the object's description.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			__toString()
		{
			try
			{
				return( "" );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>