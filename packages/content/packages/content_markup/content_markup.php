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
	*	\~russian Класс для обработки макросов.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class processes macro.
	*
	*	@author Dodonov A.A.
	*/
	class	content_markup_1_0_0{
	
		/**
		*	\~russian Закэшированные пакеты.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cached packages.
		*
		*	@author Dodonov A.A.
		*/
		var					$MacroSettings = false;
		var					$CachedMultyFS = false;
		var					$CategoryAlgorithms = false;
		var					$ContentAccess = false;
		var					$ContentAlgorithms = false;
		var					$ContentView = false;
		var					$Security = false;
		var					$String = false;

		/**
		*	\~russian Загрузка пакетов.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Package loader.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	load_content_packages()
		{
			try
			{
				$this->ContentAccess = get_package( 'content::content_access' , 'last' , __FILE__ );
				$this->ContentAlgorithms = get_package( 'content::content_algorithms' , 'last' , __FILE__ );
				$this->ContentView = get_package( 'content::content_view' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Конструктор.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Constructor.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			__construct()
		{
			try
			{
				$this->MacroSettings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->CategoryAlgorithms = get_package( 'category::category_algorithms' , 'last' , __FILE__ );
				$this->load_content_packages();
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение статьи для указанного объекта.
		*
		*	@param $MacroSettings - Параметры.
		*
		*	@return Статьи.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns all articles for the object.
		*
		*	@param $MacroSettings - Parameters.
		*
		*	@return Articles.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_articles( &$MacroSettings )
		{
			try
			{
				$CategoryNames = $MacroSettings->get_setting( 'category' );

				$CategoryIds = $this->CategoryAlgorithms->get_category_ids( $CategoryNames );

				return( $this->ContentAccess->select_content_by_category( $CategoryIds ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Компиляция списка ссылок.
		*
		*	@param $MacroSettings - Параметры компиляции.
		*
		*	@return HTML код списка.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles articles.
		*
		*	@param $MacroSettings - Compilation parameters.
		*
		*	@return HTML code of the list.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_content_links( &$MacroSettings )
		{
			try
			{
				$Articles = $this->get_articles( $MacroSettings );

				$Code = '{lang:no_articles_were_found}';

				if( isset( $Articles[ 0 ] ) )
				{
					$TemplateName = $MacroSettings->get_setting( 'template' , 'content_link.tpl' );
					$Code = '';

					foreach( $Articles as $Item )
					{
						$Code .= $this->CachedMultyFS->get_template( __FILE__ , $TemplateName );
						$Code = $this->String->print_record( $Code , $Item );
					}
				}

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'comment_line'.
		*
		*	@param $Str - Обрабатывемая строка.
		*
		*	@param $Changed - Была ли осуществлена обработка.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'comment_line'.
		*
		*	@param $Str - Processing string.
		*
		*	@param $Changed - Was the processing completed.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_content_links( $Str , $Changed )
		{
			try
			{
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'content_links' ) ; )
				{
					$this->MacroSettings->load_settings( $Parameters );

					$Code = $this->compile_content_links( $this->MacroSettings );

					$Str = str_replace( "{content_links:$Parameters}" , $Code , $Str );
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
		*	\~russian Функция обработки макроса 'conten'.
		*
		*	@param $Str - Обрабатывемая строка.
		*
		*	@param $Changed - Была ли осуществлена обработка.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'conten'.
		*
		*	@param $Str - Processing string.
		*
		*	@param $Changed - Was the processing completed.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_content( $Str , $Changed )
		{
			try
			{
				$Rules = array( 'content_id' => TERMINAL_VALUE );
				
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'content' , $Rules ) ; )
				{
					$this->MacroSettings->load_settings( $Parameters );
					
					$ContentId = $this->MacroSettings->get_setting( 'content_id' );
					$this->MacroSettings->set_setting( 'content_view' , 1 );
					$this->Security->set_g( 'content_id' , $ContentId );
					
					$Code = $this->ContentView->view( $this->MacroSettings );

					$Str = str_replace( "{content:$Parameters}" , $Code , $Str );
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
		*	\~russian Функция обработки макроса 'print_content_url'.
		*
		*	@param $Str - Обрабатывемая строка.
		*
		*	@param $Changed - Была ли осуществлена обработка.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'print_content_url'.
		*
		*	@param $Str - Processing string.
		*
		*	@param $Changed - Was the processing completed.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_print_content_url( $Str , $Changed )
		{
			try
			{
				$Rules = array( 'content_id' => TERMINAL_VALUE );
				
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'print_content_url' , $Rules ) ; )
				{
					$this->MacroSettings->load_settings( $Parameters );

					$ContentId = $this->MacroSettings->get_setting( 'content_id' );
					$Code = $this->CachedMultyFS->get_template( __FILE__ , 'print_content_url.tpl' );
					$Code = str_replace( '{content_id}' , $ContentId , $Code );

					$Str = str_replace( "{print_content_url:$Parameters}" , $Code , $Str );
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
		*	\~russian Функция отвечающая за обработку строки.
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
		*	\~english Function processes string.
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
		function			process_string( $Options , $Str , &$Changed )
		{
			try
			{
				list( $Str , $Changed ) = $this->process_content_links( $Str , $Changed );

				list( $Str , $Changed ) = $this->process_content( $Str , $Changed );

				list( $Str , $Changed ) = $this->process_print_content_url( $Str , $Changed );

				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
?>