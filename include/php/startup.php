<?php

	/*
	*	This source code is a part of the Ultimix Project. 
	*	It is distributed under BSD licence. All other third side source code (like tinyMCE) is distributed under 
	*	it's own licence wich could be found from the corresponding files or sources. 
	*	This source code is provided "as is" without any warranties or garanties.
	*
	*	Have a nice day!
	*
	*	@url http://ultimix.sorceforge.net
	*
	*	@author Alexey "gdever" Dodonov
	*/

	require_once( dirname( __FILE__ ).'/settings.php' );
	require_once( dirname( __FILE__ ).'/../../packages/core/core.php' );

	/**
	*	\~russian Установка параметров сессии.
	*
	*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function sets session parameters.
	*
	*	@exception Exception - An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			set_session()
	{
		try
		{
			$Settings = get_package( 'settings::package_settings' , 'last::last' , __FILE__ );
			$SessionTimeout = $Settings->get_package_setting( 
				'core_data' , 'last' , 'cf_system' , 'session_timeout' , 600
			);

			ini_set( 'session.gc_maxlifetime' , $SessionTimeout );
			ini_set( 'session.cookie_lifetime' , $SessionTimeout );
			ini_set( 'session.save_path' , './packages/_core_data/data/session/' );

			global	$TIMEZONE;
			date_default_timezone_set( $TIMEZONE );
		}
		catch( Exception $e )
		{
			$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
		}
	}

	/**
	*	\~russian Функция подготовки к запуску основного кода.
	*
	*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function prepares script for the main processing.
	*
	*	@author Dodonov A.A.
	*/
	function			main_setup()
	{
		try
		{
			$Settings = get_package_object( 'settings::settings' , 'last::last' , __FILE__ );
			$Settings->load_file( './cf_settings' );

			$Settings->define( 
				'HTTP_HOST' , 
				rtrim( 'http://'.$_SERVER[ 'SERVER_NAME' ].dirname( $_SERVER[ 'REQUEST_URI' ].'a' ) , '/\\' )
			);
			$Settings->define( 'SERVER_NAME' , $_SERVER[ 'SERVER_NAME' ] );
			$Settings->define( 'DOMAIN' , $_SERVER[ 'HTTP_HOST' ] );
			$Settings->set_setting( 'GZIP_TRAFFIC' , $Settings->get_setting( 'GZIP_TRAFFIC' , 'true' ) == 'true' );
			$Settings->define( 'GZIP_TRAFFIC' );
		}
		catch( Exception $e )
		{
			$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
		}
	}

	/**
	*	\~russian Настройки.
	*
	*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Settings.
	*
	*	@exception Exception - An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			start_script_settings()
	{
		try
		{
			set_session();

			global 		$StartGenerationTime;
			$StartGenerationTime = microtime( true );

			main_setup();
		}
		catch( Exception $e )
		{
			$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
		}
	}

	/**
	*	\~russian Старт генерации страницы.
	*
	*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function starts page generation.
	*
	*	@exception Exception - An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			start_php_script()
	{
		try
		{
			start_script_settings();

			$_GET[ 'page_name' ] = basename( $_SERVER[ 'SCRIPT_NAME' ] , ".php" );
		}
		catch( Exception $e )
		{
			$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
		}
	}

	/**
	*	\~russian Отработка заданий.
	*
	*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function processes tasks.
	*
	*	@exception Exception - An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			run_cron_tasks()
	{
		try
		{
			$Schedule = get_package( 'schedule' , 'last' , __FILE__ );

			$Schedule->run_tasks();
		}
		catch( Exception $e )
		{
			$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
		}
	}
	
	/**
	*	\~russian Генерация страницы.
	*
	*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function generates page.
	*
	*	@exception Exception - An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			index_main()
	{
		try
		{
			start_script_settings();

			run_cron_tasks();
			
			$PageComposer = get_package( 'page::page_composer' , 'last' , __FILE__ );

			if( isset( $_GET[ 'page_name' ] ) === false )
			{
				$_GET[ 'page_name' ] = 'index';
			}

			print( $PageComposer->get_page( $_GET[ 'page_name' ] ) );
		}
		catch( Exception $e )
		{
			$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
		}
	}
	
	/**
	*	\~russian Отработка заданий.
	*
	*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function processes tasks.
	*
	*	@exception Exception - An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			cron_main()
	{
		try
		{
			main_setup();

			run_cron_tasks();
		}
		catch( Exception $e )
		{
			$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
		}
	}

	/**
	*	\~russian Обработка ошибок исполнения.
	*
	*	@param $Visualisation - Нужно ли скрипт отображения информации о трассировки выводить на экран.
	*
	*	@param $e - Объект исключения.
	*
	*	@return HTML контент сообщения об ошибке.
	*
	*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function processes execution errors.
	*
	*	@param $Visualisation - Should the trace info be outputted.
	*
	*	@param $e - Exception object.
	*
	*	@return HTML content of the error message.
	*
	*	@exception Exception - An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			common_error_message_processing( $Visualisation , $e )
	{
		try
		{
			$ErrorTemplate = file_get_contents( dirname( __FILE__ ).'/../../res/templates/exception.tpl' );
			$DownloadLinkTemplate = file_get_contents( dirname( __FILE__ ).'/../../res/templates/download_link.tpl' );
			$ErrorTemplate = str_replace( '{exception_message}' , $e->getMessage() , $ErrorTemplate );

			if( $Visualisation )
			{
				print( str_replace( '{download}' , $DownloadLinkTemplate , $ErrorTemplate ) );
			}

			return( $ErrorTemplate );
		}
		catch( Exception $e )
		{
			$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
		}
	}

	/**
	*	\~russian Обработка ошибок исполнения.
	*
	*	@param $ErrorMessage - Сообщение об ошибке.
	*
	*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function processes execution errors.
	*
	*	@param $ErrorMessage - Error message.
	*
	*	@exception Exception - An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			zip_exception( $ErrorMessage )
	{
		try
		{
			@unlink( dirname( __FILE__ ).'/../../log/exception.last.zip' );
			$zip = new ZipArchive();
			$zip->open( dirname( __FILE__ ).'/../../log/exception.last.zip' , ZIPARCHIVE::CREATE );
			$zip->addFromString( 'exception.html' , str_replace( '{download}' , '' , $ErrorMessage ) );
		}
		catch( Exception $e )
		{
			$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
		}
	}

	/**
	*	\~russian Обработка ошибок исполнения.
	*
	*	@param $Visualisation - Нужно ли скрипт отображения информации о трассировки выводить на экран.
	*
	*	@param $e - Объект исключения.
	*
	*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function processes execution errors.
	*
	*	@param $Visualisation - Should the trace info be outputted.
	*
	*	@param $e - Exception object.
	*
	*	@exception Exception - An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			handle_script_error( $Visualisation , $e )
	{
		try
		{
			global	$DEBUG;

			if( $DEBUG )
			{
				$ErrorTemplate = common_error_message_processing( $Visualisation , $e );

				$Handle = fopen( dirname( __FILE__ ).'/../../log/exception.log' , 'at' );
				fwrite( $Handle , $e->getMessage().'<hr width="90%">' );
				fclose( $Handle );

				$Handle = fopen( dirname( __FILE__ ).'/../../log/exception.last.html' , 'wt' );
				fwrite( $Handle , str_replace( '{download}' , '' , $ErrorTemplate ) );
				fclose( $Handle );

				zip_exception( $ErrorTemplate );
			}
		}
		catch( Exception $e )
		{
			$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
		}
	}

?>