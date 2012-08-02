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
	*	\~russian Класс обработки контролов.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class processes controls macro.
	*
	*	@author Dodonov A.A.
	*/
	class	date_picker_1_0_0
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
		var					$CachedMultyFS = false;
		var					$Database = false;
		var					$Security = false;
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
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->Database = get_package( 'database' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции макроса 'date_picker'.
		*
		*	@param $Name - Название.
		*
		*	@param $Value - Значение.
		*
		*	@param $SetFormat - Фотрамат возвращаемой даты.
		*
		*	@return Код макроса.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'date_picker'.
		*
		*	@param $Name - Name.
		*
		*	@param $Value - Value.
		*
		*	@param $SetFormat - Date format.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	set_date_picker_parameters( $Name , $Value , $SetFormat )
		{
			try
			{
				$Code = $this->CachedMultyFS->get_template( __FILE__ , 'date_picker.tpl' );

				$Code = str_replace( 
					array( '{name}' , '{value}' , '{set_format}' ) , array( $Name , $Value , $SetFormat ) , $Code
				);

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция компиляции макроса 'date_picker'.
		*
		*	@param $Settings - Параметры.
		*
		*	@return Код макроса.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'date_picker'.
		*
		*	@param $Settings - Parameters.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_date_picker( &$Settings )
		{
			try
			{
				$Name = $Settings->get_setting( 'name' );
				$Format = $Settings->get_setting( 'display_date_format' , 'Y-m-d' );
				$SetFormat = str_replace( array( 'Y' , 'm' , 'd' ) , array( 'yy' , 'mm' , 'dd' ) , $Format );

				if( $this->Security->get_gp( $Name , 'set' ) )
				{
					$Value = $this->Security->get_gp( $Name , 'string' );
				}
				else
				{
					$Default = date( $Format , strtotime( $Settings->get_setting( 'default' , 'now' ) ) );
					$Value = $Settings->get_setting( 'value' , $Default );
				}

				return( $this->set_date_picker_parameters( $Name , $Value , $SetFormat ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>