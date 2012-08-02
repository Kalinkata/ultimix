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
	*	\~russian Класс для работы с Google-картами.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class processes Google.Maps processing routine.
	*
	*	@author Dodonov A.A.
	*/
	class	google_maps_1_0_0{
	
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
		var					$Settings = false;
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
				$this->Settings = get_package_object( 'settings::package_settings' , 'last' , __FILE__ );
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
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
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
				$PageJS = get_package( 'page::page_js' , 'last' , __FILE__ );
				
				$Path = _get_package_relative_path_ex( 'maps::google_maps' , '1.0.0' );
				$PageJS->add_javascript( "{http_host}/$Path/include/js/google_maps.js" );
				
				$Key = $this->Settings->get_package_setting( 
					'maps::google_maps' , '1.0.0::1.0.0' , 'cf_google_maps' , 'google_maps_api_key'
				);
				
				$URL = 'http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true&amp;key='.$Key;
				$PageJS->add_javascript( $URL , false );
			}
			catch( Exception $e )
			{
				$Args = func_get_args();throw( _get_exception_object( __METHOD__ , $Args , $e ) );
			}
		}
		
		/**
		*	\~russian Функция компиляции макроса 'google_map'.
		*
		*	@param $BlockSettings - Параметры комиляции.
		*
		*	@return HTML код.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'google_map'.
		*
		*	@param $BlockSettings - Compilation options.
		*
		*	@return HTML code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_google_map( &$Settings )
		{
			try
			{
				$Settings->set_undefined( 'id' , md5( microtime( true ) ) );
				$Settings->set_undefined( 'height' , '300px' );
				$Settings->set_undefined( 'width' , '500px' );
				$Settings->set_undefined( 'class' , 'google_map' );
				$Code = $this->CachedMultyFS->get_template( __FILE__ , 'google_map_frame.tpl' );
				return( $this->String->print_record( $Code , $Settings->get_raw_settings() ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
?>