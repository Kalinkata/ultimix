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
		var					$CachedMultyFS = false;
		var					$CategoryAlgorithms = false;
		var					$ContentAccess = false;
		var					$ContentAlgorithms = false;
		var					$ContentView = false;
		var					$Security = false;
		var					$String = false;

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
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->CategoryAlgorithms = get_package( 'category::category_algorithms' , 'last' , __FILE__ );
				$this->ContentAccess = get_package( 'content::content_access' , 'last' , __FILE__ );
				$this->ContentAlgorithms = get_package( 'content::content_algorithms' , 'last' , __FILE__ );
				$this->ContentView = get_package( 'content::content_view' , 'last' , __FILE__ );
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
		*	@param $Settings - Параметры.
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
		*	@param $Settings - Parameters.
		*
		*	@return Articles.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_articles( &$Settings )
		{
			try
			{
				$CategoryNames = $Settings->get_setting( 'category' );

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
		*	@param $Settings - Параметры компиляции.
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
		*	@param $Settings - Compilation parameters.
		*
		*	@return HTML code of the list.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_content_links( &$Settings )
		{
			try
			{
				$Articles = $this->get_articles( $Settings );

				$Code = '{lang:no_articles_were_found}';

				if( isset( $Articles[ 0 ] ) )
				{
					$TemplateName = $Settings->get_setting( 'template' , 'content_link.tpl' );
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
		*	\~russian Функция отвечающая за обработку строки.
		*
		*	@param $Settings - Gараметры отображения.
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
		*	@param $Settings - Options of drawing.
		*
		*	@return HTML code to display.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_content( &$Settings )
		{
			try
			{
				$ContentId = $Settings->get_setting( 'content_id' );
				$Settings->set_setting( 'content_view' , 1 );
				$this->Security->set_g( 'content_id' , $ContentId );

				$Code = $this->ContentView->view( $Settings );

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция отвечающая за обработку строки.
		*
		*	@param $Settings - Gараметры отображения.
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
		*	@param $Settings - Options of drawing.
		*
		*	@return HTML code to display.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_print_content_url( &$Settings )
		{
			try
			{
				$ContentId = $Settings->get_setting( 'content_id' );
				$Code = $this->CachedMultyFS->get_template( __FILE__ , 'print_content_url.tpl' );
				$Code = str_replace( '{content_id}' , $ContentId , $Code );

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>