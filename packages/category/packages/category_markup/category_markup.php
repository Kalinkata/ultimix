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
	*	\~russian Обработчик макросов.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Processing macroes.
	*
	*	@author Dodonov A.A.
	*/
	class	category_markup_1_0_0{

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
		var					$BlockSettings = false;
		var					$CachedMultyFS = false;
		var					$CategoryAccess = false;
		var					$CategoryAlgorithms = false;
		var					$CategoryView = false;
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
				$this->BlockSettings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->CategoryAccess = get_package( 'category::category_access' , 'last' , __FILE__ );
				$this->CategoryAlgorithms = get_package( 'category::category_algorithms' , 'last' , __FILE__ );
				$this->CategoryView = get_package( 'category::category_view' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция получения пустой категории.
		*
		*	@param $Settings - Параметры.
		*
		*	@return SQL запрос для получения нулевой категории.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns null category.
		*
		*	@param $Settings - Settings.
		*
		*	@return SQL query for the null category.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_null_category( &$Settings )
		{
			try
			{
				$NullCategory = '';

				if( $Settings->get_setting( 'null_category' , false ) !== false )
				{
					$Id = $Settings->get_setting( 'null_category' );

					$Title = $Settings->get_setting( 'null_category_title' , '' );

					$NullCategory = "SELECT $Id AS id , '{lang:$Title}' AS value UNION ";
				}

				return( $NullCategory );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения кода селекта.
		*
		*	@param $BlockSettings - Параметры генерации.
		*
		*	@return Код селекта.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns select code.
		*
		*	@param $BlockSettings - Parameters.
		*
		*	@return Code of the select.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_select_category_code( &$BlockSettings )
		{
			try
			{
				list( $Name , $Default , $Class ) = $BlockSettings->get_settings( 
					'name,default,class' , 'category,0,width_160 flat'
				);

				$Default = $Default == 0 ? '' : "default=$Default;";
				$NullCategory = $this->get_null_category( $BlockSettings );
				$Id = $this->CategoryView->get_category_id( $BlockSettings );
				$Value = $BlockSettings->get_setting( 'value' , false );

				$Code = "{select:$Default"."class=$Class;name=$Name;query=$NullCategory SELECT id , title as ".
						"`value` FROM umx_category WHERE direct_category![eq]id AND direct_category IN ( $Id )".
						( $Value ? ";value=$Value" : '' )."}";

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'category'.
		*
		*	@param $Options - Параметры отображения.
		*
		*	@param $Str - Строка требуюшщая обработки.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@return array( Обрабатываемая строка , Была ли строка обработана ).
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'category'.
		*
		*	@param $Options - Options of drawing.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return array( Processed string , Was the string changed ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_category( &$Options , $Str , $Changed )
		{
			try
			{
				for( ; $Params = $this->String->get_macro_parameters( $Str , 'category' ) ; )
				{
					$this->BlockSettings->load_settings( $Params );

					$Code = $this->get_select_category_code( $this->BlockSettings );

					$Str = str_replace( "{category:$Params}" , $Code , $Str );
					$Changed = true;
				}

				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'category_id'.
		*
		*	@param $Options - Параметры отображения.
		*
		*	@param $Str - Строка требуюшщая обработки.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@return array( Обрабатываемая строка , Была ли строка обработана ).
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'category_id'.
		*
		*	@param $Options - Options of drawing.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return array( Processed string , Was the string changed ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_category_id( &$Options , $Str , $Changed )
		{
			try
			{
				$Rules = array( 'names' => TERMINAL_VALUE , 'name' => TERMINAL_VALUE );

				for( ; $Params = $this->String->get_macro_parameters( $Str , 'category_id' , $Rules ) ; )
				{
					$this->BlockSettings->load_settings( $Params );

					$Names = $this->BlockSettings->get_setting( 'names' , '' );

					$Names = $this->BlockSettings->get_setting( 'name' , $Names );

					$Ids = implode( ',' , $this->CategoryAlgorithms->get_category_ids( $Names ) );

					$Str = str_replace( "{category_id:$Params}" , $Ids , $Str );
					$Changed = true;
				}

				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'category_siblings_ids'.
		*
		*	@param $Options - Параметры отображения.
		*
		*	@param $Str - Строка требуюшщая обработки.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@return array( Обрабатываемая строка , Была ли строка обработана ).
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'category_siblings_ids'.
		*
		*	@param $Options - Options of drawing.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return array( Processed string , Was the string changed ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_category_siblings_ids( &$Options , $Str , $Changed )
		{
			try
			{
				$Rules = array( 'id' => TERMINAL_VALUE );

				for( ; $Params = $this->String->get_macro_parameters( $Str , 'category_siblings_ids' , $Rules ) ; )
				{
					$this->BlockSettings->load_settings( $Params );

					$CategoryId = $this->BlockSettings->get_setting( 'id' );

					$SiblingsIds = implode( ',' , $this->CategoryAccess->get_siblings_ids( $CategoryId ) );

					$Str = str_replace( "{category_siblings_ids:$Params}" , $SiblingsIds , $Str );
					$Changed = true;
				}

				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'category_name'.
		*
		*	@param $Options - Параметры отображения.
		*
		*	@param $Str - Строка требуюшщая обработки.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@return array( Обрабатываемая строка , Была ли строка обработана ).
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'category_name'.
		*
		*	@param $Options - Options of drawing.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return array( Processed string , Was the string changed ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_category_name( &$Options , $Str , $Changed )
		{
			try
			{
				$Rules = array( 'id' => TERMINAL_VALUE );

				for( ; $Params = $this->String->get_macro_parameters( $Str , 'category_name' , $Rules ) ; )
				{
					$this->BlockSettings->load_settings( $Params );

					$Category = $this->CategoryAlgorithms->get_by_id( $this->BlockSettings->get_setting( 'id' ) );

					$Title = get_field( $Category , 'title' );

					$Str = str_replace( "{category_name:$Params}" , $Title , $Str );
					$Changed = true;
				}

				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция отвечающая за обработку страницы.
		*
		*	@param $Options - Параметры отображения.
		*
		*	@param $Str - Обрабатывемая строка.
		*
		*	@param $Changed - Была ли осуществлена обработка.
		*
		*	@return HTML код для отображения.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes page.
		*
		*	@param $Options - Options of drawing.
		*
		*	@param $Str - Processing string.
		*
		*	@param $Changed - Was the processing completed.
		*
		*	@return HTML code to display.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_string( &$Options , $Str , &$Changed )
		{
			try
			{
				list( $Str , $Changed ) = $this->process_category( $Options , $Str , $Changed );

				list( $Str , $Changed ) = $this->process_category_id( $Options , $Str , $Changed );

				list( $Str , $Changed ) = $this->process_category_siblings_ids( $Options , $Str , $Changed );

				list( $Str , $Changed ) = $this->process_category_name( $Options , $Str , $Changed );

				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
?>