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
	*	\~russian Класс для подключения библиотеки jquery.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class loads jquery library.
	*
	*	@author Dodonov A.A.
	*/
	class	jstree_1_0_0{

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
		var					$PageJS = false;
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
				$this->PageJS = get_package( 'page::page_js' , 'last' , __FILE__ );
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
		*	@param $Options - Настройки работы модуля.
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
				$Path = '{http_host}/'._get_package_relative_path_ex( 'jstree' , get_package_version_s( __CLASS__ ) );

				$this->PageJS->add_javascript( "$Path/include/js/jquery.jstree.js" );
				$this->PageJS->add_javascript( "$Path/include/js/jquery.jstree.buttons.js" );
				$this->PageJS->add_javascript( "$Path/include/js/jquery.jstree.autorun.default.js" );
				$this->PageJS->add_javascript( "$Path/include/js/jquery.jstree.extractor.js" );

				$Lang = get_package( 'lang' , 'last' , __FILE__ );
				$Lang->include_strings_js( 'jstree' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции макроса 'tree_control'.
		*
		*	@param $Settings - Настройки.
		*
		*	@return HTML код.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'tree_control'.
		*
		*	@param $Settings - Options.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_tree_control( &$Settings )
		{
			try
			{
				$Selector = $Settings->get_setting( 'selector' , false );
				if( $Selector === false )
				{
					$Path = _get_package_relative_path_ex( 'jstree' , get_package_version_s( __CLASS__ ) );
					$Path = "{http_host}/$Path/include/js";
					$this->PageJS->add_javascript( "$Path/jquery.jstree.autorun.default.js" );
					$Control = '';
				}
				else
				{
					$Control = $this->CachedMultyFS->get_template( __FILE__ , 'tree_control.tpl' );
					$Control = str_replace( '{selector}' , $Selector );
				}
				return( $Control );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		//TODO move this package to the GUI package

		/**
		*	\~russian Функция компиляции макроса 'tree_control_buttons'.
		*
		*	@param $Settings - Настройки.
		*
		*	@return HTML код.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'tree_control_buttons'.
		*
		*	@param $Settings - Options.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_tree_control_buttons( &$Settings )
		{
			try
			{
				$Code = $this->CachedMultyFS->get_template( __FILE__ , 'tree_control_buttons.tpl' );

				$Selector = $Settings->get_setting( 'tree_control_selector' , '.tree_control' );
				$Code = str_replace( '{tree_control_selector}' , $Selector , $Code );

				$DirectCategory = $Settings->get_setting( 'direct_category' , '14' );
				$Code = str_replace( '{direct_category}' , $DirectCategory , $Code );

				$Code = $this->String->print_record( $Code , $Settings );

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>