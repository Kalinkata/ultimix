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
	*	\~russian Класс для подключения библиотеки джаваскриптов.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class loads java script libraries.
	*
	*	@author Dodonov A.A.
	*/
	class	jsdialogs_1_0_0{
		
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
		var					$PageCSS = false;
		var					$PageJS = false;
		var					$Settings = false;
		var					$String = false;
		
		/**
		*	\~russian Конструктор.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Constructor.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			__construct()
		{
			try
			{
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->PageCSS = get_package( 'page::page_css' , 'last' , __FILE__ );
				$this->PageJS = get_package( 'page::page_js' , 'last' , __FILE__ );
				$this->Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
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
				$Path = _get_package_relative_path_ex( 'jsdialogs' , '1.0.0' );
				$this->PageCSS->add_stylesheet( "{http_host}/$Path/res/css/jsdialogs.css" );
				$this->PageJS->add_javascript( "{http_host}/$Path/include/js/dialogs.js" );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Добавление опенера.
		*
		*	@param $Settings - Параметры макроса.
		*
		*	@param $Template - Шаблон.
		*
		*	@return HTML код для отображения.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function adds opener.
		*
		*	@param $Settings - Macro settings.
		*
		*	@param $Template - Template.
		*
		*	@return HTML code to display.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	add_opener( &$Settings , $Template )
		{
			try
			{
				$OpenerId = $Settings->get_setting( 'opener_id' , false );
				if( $OpenerId )
				{
					$Template = str_replace( '{opener_selector}' , 'opener=#visible_{opener_id};' , $Template );
					$Template = str_replace( '{opener_id}' , $OpenerId , $Template );
				}
				
				return( $Template );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Создание диалога выбора записи.
		*
		*	@param $FilePath - Путь к файлу пакета.
		*
		*	@param $EntityName - Название сущности.
		*
		*	@param $Str - Обрабатываемая строка.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@return HTML код для отображения.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function creates record selection dialog.
		*
		*	@param $FilePath - Path to the package.
		*
		*	@param $EntityName - Name of the entity.
		*
		*	@param $Str - Processing string.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return HTML code to display.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			selection_dialog( $FilePath , $EntityName , $Str , &$Changed )
		{
			try
			{
				$MacroName = $EntityName.'_selection_dialog';

				for( ; $MacroParameters = $this->String->get_macro_parameters( $Str , $MacroName ) ; )
				{
					$this->Settings->load_settings( $MacroParameters );
					$Template = $this->CachedMultyFS->get_template( $FilePath , "$MacroName.tpl" );
					$Template = $this->add_opener( $Settings , $Template );

					$id = $this->Settings->get_setting( 'id' , md5( microtime( true ) ) );
					$Template = str_replace( '{id}' , $id , $Template );

					$Str = str_replace( '{'."$MacroName:$MacroParameters}" , $Template , $Str );
					$Changed = true;
				}

				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Вид для скриптовой библиотеки (отвечает за подключение библиотеки).
		*
		*	@param $Options - не используется.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english View for the scripting library.
		*
		*	@param $Options - not used.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			view( &$Options )
		{
			try
			{
				return( '' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>