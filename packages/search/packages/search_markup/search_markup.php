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
	*	\~russian Класс поиска по сайту.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides site search routine.
	*
	*	@author Dodonov A.A.
	*/
	class	search_markup_1_0_0{
	
		/**
		*	\~russian Закешированные пакеты.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cached packages.
		*
		*	@author Dodonov A.A.
		*/
		var					$BlockSettings = false;
		var					$CachedMultyFS = false;
		var					$Security = false;
		var					$String = false;
		
		/**
		*	\~russian Результат работы функций отображения.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Display function's result.
		*
		*	@author Dodonov A.A.
		*/
		var					$Output = false;
	
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
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Компиляция формы.
		*
		*	@param $Settings - Параметры компиляции.
		*
		*	@return HTML код формы.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles search form.
		*
		*	@param $Settings - Compilation parameters.
		*
		*	@return HTML code of the widget.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_search_form( &$Settings )
		{
			try
			{
				list( $Speed , $Prefix , $FormId , $Action ) = $this->BlockSettings->get_settings( 
					'speed,prefix,form_id,action' , '500,common,search_form,'
				);
				
				$TemplateFileName = $Prefix == 'common' ? 'common_search_form.tpl' : 'custom_search_form.tpl';
				
				$Code = $this->CachedMultyFS->get_template( __FILE__ , $TemplateFileName );
				
				$Code = str_replace( 
					array( '{speed}' , '{prefix}' , '{form_id}' , '{action}' ) , 
					array( $Speed , $Prefix , $FormId , $Action ) , 
					$Code
				);
				
				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'search_form'.
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
		*	\~english Function processes macro 'search_form'.
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
		function			process_search_form( $Str , $Changed )
		{
			try
			{
				if( strpos( $Str , '{search_form}' ) !== false )
				{
					$Str = str_replace( '{search_form}' , '{search_form:prefix=common}' , $Str );
				}

				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'search_form' ) ; )
				{
					$this->BlockSettings->load_settings( $Parameters );
					
					$Code = $this->compile_search_form( $this->BlockSettings );
					
					$Str = str_replace( "{search_form:$Parameters}" , $Code , $Str );
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
		*	\~russian Функция обработки макроса 'public_search_form'.
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
		*	\~english Function processes macro 'public_search_form'.
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
		function			process_public_search_form( $Str , $Changed )
		{
			try
			{
				if( strpos( $Str , '{public_search_form}' ) !== false )
				{
					$Str = str_replace( '{public_search_form}' , '{public_search_form:prefix=custom}' , $Str );
				}

				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'public_search_form' ) ; )
				{
					$this->BlockSettings->load_settings( $Parameters );
					$this->BlockSettings->set_undefined( 'prefix' , 'custom' );

					$Code = $this->compile_search_form( $this->BlockSettings );

					$Str = str_replace( "{public_search_form:$Parameters}" , $Code , $Str );
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
		*	\~russian Функция обработки строки.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@param $Str - Строка требуюшщая обработки.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@return Обработанная строка.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes string.
		*
		*	@param $Options - Settings.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return Processed string.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_string( $Options , $Str , &$Changed )
		{
			try
			{
				list( $Str , $Changed ) = $this->process_search_form( $Str , $Changed );
				
				list( $Str , $Changed ) = $this->process_public_search_form( $Str , $Changed );
				
				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
?>