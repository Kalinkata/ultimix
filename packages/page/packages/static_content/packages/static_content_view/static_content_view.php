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
	*	\~russian Отображение статического контента.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Displaying static content.
	*
	*	@author Dodonov A.A.
	*/
	class	static_content_view_1_0_0{
		
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
		var					$Security = false;
		var					$StaticContentAccess = false;
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
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->StaticContentAccess = get_package( 'page::static_content::static_content_access' );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
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
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function executes before any page generating actions took place.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			pre_generation( $Options )
		{
			try
			{
				$PageJS = get_package( 'page::page_js' , 'last' , __FILE__ );
				$PackagePath = _get_package_relative_path_ex( 'page::static_content::static_content_view' , 'last' );
				$PageJS->add_javascript( "{http_host}/$PackagePath/include/js/site_view.js" );

				$Lang = get_package( 'lang' , 'last' , __FILE__ );
				$Lang->include_strings_js( 'page::static_content::static_content_view' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Вид, возвращающий статический контент.
		*
		*	@param $Options - название файла со статическим контентом.
		*
		*	@return статический контент.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english View loads and returns content.
		*
		*	@param $Options - Name of the file with the static ontent.
		*
		*	@return Static content.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			view( $Options )
		{
			try
			{
				if( $Options->get_setting( 'content' , false ) === false )
				{
					$ContextSet = get_package( 'gui::context_set' , 'last' , __FILE__ );

					$ContextSet->execute( $Options , $this , __FILE__ );

					return( $this->Output );
				}
				else
				{
					return( $this->StaticContentAccess->get_content_ex( $Options ) );
				}
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
		*	@param $ProcessingString - Обрабатывемая строка.
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
		*	@param $ProcessingString - Processing string.
		*
		*	@param $Changed - Was the processing completed.
		*
		*	@return HTML code to display.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_string( $Options , $ProcessingString , &$Changed )
		{
			try
			{
				$Parameters = '';
				for( ; $Parameters = $this->String->get_macro_parameters( $ProcessingString , 'static_content' ) ; )
				{
					$this->BlockSettings->load_settings( $Parameters );
					$StaticContent = $this->StaticContentAccess->get_content_ex( $this->BlockSettings );
					$ProcessingString = str_replace( 
						"{static_content:$Parameters}" , $StaticContent , $ProcessingString
					);
					$Changed = true;
				}
				
				return( $ProcessingString );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>