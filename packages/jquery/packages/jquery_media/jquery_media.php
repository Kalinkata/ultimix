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
	*	\~russian Класс для подключения проигрывателя audio.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class loads audio player scripts.
	*
	*	@author Dodonov A.A.
	*/
	class	jquery_media_1_0_0{

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
		function			pre_generation( &$Options )
		{
			try
			{
				$Path = '{http_host}/'._get_package_relative_path_ex( 'jquery::jquery_media' , 'last' );
				$this->PageJS->add_javascript( "$Path/include/js/jquery.media.js" );
				$this->PageJS->add_javascript( "$Path/include/js/jquery.media.autorun.js" );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'media'.
		*
		*	@param $Settings - Параметры обработки.
		*
		*	@return Переменные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'media'.
		*
		*	@param $Settings - Settings.
		*
		*	@return Variables.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_vars( &$Settings )
		{
			try
			{
				$Vars = array( 'file' => $Settings->get_setting( 'file' ) );
				$Vars[ 'width' ] = $Settings->get_setting( 'width' , 300 );
				$Vars[ 'height' ] = $Settings->get_setting( 'height' , 20 );
				$Vars[ 'autoplay' ] = $Settings->get_setting( 'autoplay' , 0 );

				return( $Vars );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'timer'.
		*
		*	@param $Settings - Параметры обработки.
		*
		*	@return Код.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'timer'.
		*
		*	@param $Settings - Compilation parameters.
		*
		*	@return Code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_media( &$Settings )
		{
			try
			{
				$Code = $this->CachedMultyFS->get_template( __FILE__ , 'media.tpl' );

				$Vars = $this->get_vars( $Settings );

				$Code = $this->String->print_record( $Code , $Vars );

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>