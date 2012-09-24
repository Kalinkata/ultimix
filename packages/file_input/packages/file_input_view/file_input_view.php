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
	*	\~russian Класс вида.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english View.
	*
	*	@author Dodonov A.A.
	*/
	class	file_input_view_1_0_0{

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
		var					$PageCSS = false;
		var					$PageJS = false;
		var					$Security = false;

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
				$this->PageCSS = get_package( 'page::page_css' , 'last' , __FILE__ );
				$this->PageJS = get_package( 'page::page_js' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Загрузка плагинов.
		*
		*	@param $Path - Путь.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function laods plugins.
		*
		*	@param $Path - Path.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	upload_plugins( $Path )
		{
			try
			{
				$this->PageJS->add_javascript( $Path.'/include/plugins/swfupload.cookies.js' );
				$this->PageJS->add_javascript( $Path.'/include/plugins/swfupload.queue.js' );
				$this->PageJS->add_javascript( $Path.'/include/plugins/swfupload.speed.js' );
				$this->PageJS->add_javascript( $Path.'/include/plugins/fileprogress.js' );
				$this->PageJS->add_javascript( $Path.'/include/plugins/handlers.js' );
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
				$Path = '{http_host}/'._get_package_relative_path_ex( 'file_input::file_input_view' , '1.0.0' );
				$this->PageJS->add_javascript( $Path.'/include/swfupload.js' );
				$this->upload_plugins( $Path );
				$this->PageJS->add_javascript( $Path.'/include/js/file_input_view.js' );

				$this->PageCSS->add_stylesheet( $Path.'/res/css/default.css' );

				$Lang = get_package( 'lang' , 'last' , __FILE__ );
				$Lang->include_strings_js( 'file_input::file_input_view' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция определения заголовков.
		*
		*	@param $FileSize - Размер файла.
		*
		*	@param $FileName - Название файла.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function outputs headers.
		*
		*	@param $FileSize - File size.
		*
		*	@param $FileName - File name.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	file_headers( $FileSize , $FileName )
		{
			try
			{
				header( 'HTTP/1.0 200 OK' );
				header( 'Content-type: application/octet-stream' );
				header( "Content-Length: $FileSize" );
				header( "Content-Disposition: attachment; filename=\"$FileName\"" );
				header( 'Connection: close' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция запуска загрузки файла.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function starts file download.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			download( $Options )
		{
			try
			{
				$Fid = $this->Security->get_gp( 'fid' , 'integer' , false );

				if( $Fid !== false )
				{
					$FileInputAlgorithms = get_package( 'file_input::file_input_algorithms' , 'last' , __FILE__ );
					$File = $FileInputAlgorithms->get_by_id(  );

					$FileSize = filesize( get_field( $File , 'file_path' ) );
					$FileName = get_field( $File , 'original_file_name' );

					$this->file_headers( $FileSize , $FileName );

					readfile( get_field( $File , 'file_path' ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция отображения компонента.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Component's view.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			view( $Options )
		{
			try
			{
				if( $Options->get_setting( 'download' , false ) )
				{
					$this->download( $Options );
				}

				return( '' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>