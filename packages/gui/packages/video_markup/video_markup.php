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
	*	\~russian Класс обработки видео макросов.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class processes video macro.
	*
	*	@author Dodonov A.A.
	*/
	class	video_markup_1_0_0
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
		var					$MacroSettings = false;
		var					$CachedMultyFS = false;
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
				$this->MacroSettings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Компиляция макроса 'rutube'.
		*
		*	@param $MacroSettings - Параметры выборки.
		*
		*	@return HTML код.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'rutube'.
		**
		*	@param $MacroSettings - Fetch settings.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compiles_rutube( &$MacroSettings )
		{
			try
			{
				$Hash = $this->MacroSettings->get_setting( 'hash' );
				$Width = $this->MacroSettings->get_setting( 'width' , '640' );
				$Height = $this->MacroSettings->get_setting( 'height' , '480' );
				$Autoplay = $this->MacroSettings->get_setting( 'autoplay' , '0' );

				$Code = $this->CachedMultyFS->get_template( __FILE__ , 'rutube.tpl' );

				$Code = str_replace( 
					array( '{hash}' , '{width}' , '{height}' , '{autoplay}' ) , 
					array( $Hash , $Width , $Height , $Autoplay ) , $Code
				);

				return( $Code );
			}
			catch( Exception $e )
			{
				$Args = func_get_args();_throw_exception_object( __METHOD__ , $Args , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'rutube'.
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
		*	\~english Function processes macro 'rutube'.
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
		function			process_rutube( $Str , $Changed )
		{
			try
			{
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'rutube' ) ; )
				{
					$this->MacroSettings->load_settings( $Parameters );

					$Code = $this->compiles_rutube( $this->MacroSettings );

					$Str = str_replace( "{rutube:$Parameters}" , $Code , $Str );
					$Changed = true;
				}
				
				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$Args = func_get_args();_throw_exception_object( __METHOD__ , $Args , $e );
			}
		}
		
		/**
		*	\~russian Компиляция макроса 'youtube'.
		*
		*	@param $MacroSettings - Параметры выборки.
		*
		*	@return HTML код.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'youtube'.
		**
		*	@param $MacroSettings - Fetch settings.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compiles_youtube( &$MacroSettings )
		{
			try
			{
				$Hash = $MacroSettings->get_setting( 'hash' );
				$Width = $MacroSettings->get_setting( 'width' , '640' );
				$Height = $MacroSettings->get_setting( 'height' , '480' );
				$Autoplay = $MacroSettings->get_setting( 'autoplay' , '0' );

				$Code = $this->CachedMultyFS->get_template( __FILE__ , 'youtube.tpl' );

				$Code = str_replace( 
					array( '{hash}' , '{width}' , '{height}' , '{autoplay}' ) , 
					array( $Hash , $Width , $Height , $Autoplay ) , $Code
				);
				
				return( $Code );
			}
			catch( Exception $e )
			{
				$Args = func_get_args();_throw_exception_object( __METHOD__ , $Args , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'youtube'.
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
		*	\~english Function processes macro 'youtube'.
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
		function			process_youtube( $Str , $Changed )
		{
			try
			{
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'youtube' ) ; )
				{
					$this->MacroSettings->load_settings( $Parameters );

					$Code = $this->compiles_youtube( $this->MacroSettings );

					$Str = str_replace( "{youtube:$Parameters}" , $Code , $Str );
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
				list( $Str , $Changed ) = $this->process_rutube( $Str , $Changed );
				
				list( $Str , $Changed ) = $this->process_youtube( $Str , $Changed );
				
				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>