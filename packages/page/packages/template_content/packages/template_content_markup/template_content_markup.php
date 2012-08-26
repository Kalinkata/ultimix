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
	*	\~english Displaying template content.
	*
	*	@author Dodonov A.A.
	*/
	class	template_content_markup_1_0_0{
		
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
		var					$TemplateContentAccess = false;
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
				$this->TemplateContentAccess = get_package( 'page::template_content::template_content_access' );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
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
				//TODO: mpve to auto_markup
				for( ; $Parameters = $this->String->get_macro_parameters( $ProcessingString , 'template_content' ) ; )
				{
					$this->BlockSettings->load_settings( $Parameters );
					$Content = $this->TemplateContentAccess->get_content_ex( $this->BlockSettings );
					$ProcessingString = str_replace( 
						"{template_content:$Parameters}" , $Content , $ProcessingString
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