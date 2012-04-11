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
	*	\~russian Утилиты компоновки страниц.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Page composer utilities.
	*
	*	@author Dodonov A.A.
	*/
	class	page_meta_1_0_0{

		/**
		*	\~russian Тайтл страницы.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Page's title.
		*
		*	@author Dodonov A.A.
		*/
		var					$PageTitle = '';

		/**
		*	\~russian Ключевые слова страницы.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Page's keywords.
		*
		*	@author Dodonov A.A.
		*/
		var					$PageKeywords = '';

		/**
		*	\~russian Описание страницы.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Page's description.
		*
		*	@author Dodonov A.A.
		*/
		var					$PageDescription = '';

		/**
		*	\~russian Закэшированный объект.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cached object.
		*
		*	@author Dodonov A.A.
		*/
		var					$Cache = false;
		var					$CachedMultyFS = false;
		var					$PageComposer = false;
		var					$PageMarkupUtilities = false;
		var					$Settings = false;
		var					$String = false;
		var					$Tags = false;
		var					$Trace = false;

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
				$this->Cache = get_package( 'cache' , 'last' , __FILE__ );
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->PageMarkupUtilities = get_package( 
					'page::page_markup::page_markup_utilities' , 'last' , __FILE__
				);
				$this->Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
				$this->Tags = get_package( 'string::tags' , 'last' , __FILE__ );
				$this->Trace = get_package( 'trace' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Установка тайтла страницы.
		*
		*	@param $NewTitle - Новый тайтл страницы.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sets page's title.
		*
		*	@param $NewTitle - New page's title.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_page_title( $NewTitle )
		{
			try
			{
				$this->PageTitle = $NewTitle;
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Установка дополнительных ключевых слов страницы.
		*
		*	@param $NewKeywords - Дополнительные ключевые слова страницы.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function adds page's keywords.
		*
		*	@param $NewKeywords - Additional page's keywords.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			add_page_keywords( $NewKeywords )
		{
			try
			{
				if( strlen( $this->PageKeywords ) )
				{
					$this->PageKeywords .= ' '.$NewKeywords;
				}
				else
				{
					$this->PageKeywords = $NewKeywords;
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Установка дополнительных описаний страницы.
		*
		*	@param $NewDescription - Дополнительные описания страницы.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function adds page's description.
		*
		*	@param $NewDescription - Additional page's description.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			add_page_description( $NewDescription )
		{
			try
			{
				if( strlen( $this->PageDescription ) )
				{
					$this->PageDescription .= ' '.$NewDescription;
				}
				else
				{
					$this->PageDescription = $NewDescription;
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Вставка информации о странице.
		*
		*	@param $Str - Постобрабатывемая строка.
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
		*	\~english Function sets info about the page.
		*
		*	@param $Str - Postprocessing string.
		*
		*	@param $Changed - Was the processing completed.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_page_info( $Str , $Changed )
		{
			try
			{
				if( strpos( $Str , '{title}' ) )
				{
					$Str = str_replace( '{title}' , $this->PageTitle , $Str );
					$Changed = true;
				}

				if( strpos( $Str , '{keywords}' ) )
				{
					$Str = str_replace( '{keywords}' , $this->PageKeywords , $Str );
					$Changed = true;
				}

				if( strpos( $Str , '{description}' ) )
				{
					$Str = str_replace( 
						'{description}' , $this->PageDescription , $Str 
					);
					$Changed = true;
				}

				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>