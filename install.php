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

	require_once( './packages/core/core.php' );
	require_once( './include/php/startup.php' );
	
	@unlink( './packages/cache/data/cache' );
	@unlink( './packages/cache/data/table' );
	
	/**
	*	Первый шаг.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	First step.
	*
	*	@author Dodonov A.A.
	*/
	function			install_step_1()
	{
		$CachedFS = get_package( 'cached_fs' );
		$Page = $CachedFS->file_get_contents( "./install/res/templates/install_template_1.tpl" );
		print( $Page );
		exit( 0 );
	}
	
	/**
	*	Обработка ситуации, когда не удалось подключиться к базе данных.
	*
	*	@param $Silent - Тихая обработка.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	Function process connection errors.
	*
	*	@param $Silent - Silent processing.
	*
	*	@author Dodonov A.A.
	*/
	function			handle_connection_error( $Silent )
	{
		if( $Silent === false )
		{
			$CachedFS = get_package( 'cached_fs' );
			$Page = $CachedFS->file_get_contents( "./install/res/templates/install_template_2.tpl" );
			$Page = str_replace( '{error_message}' , 'An error occured while database connection' , $Page );

			$Security = get_package( 'security' );

			$PlaceHolders = array( '{host}' , '{database}' , '{prefix}' , '{user}' , '{password}' );
			$Data = array( 
				$Security->get_gp( 'host' , 'string' , '' ) , $Security->get_gp( 'database' , 'string' , '' ) , 
				$Security->get_gp( 'prefix' , 'string' , '' ) , $Security->get_gp( 'user' , 'string' , '' ) , 
				$Security->get_gp( 'password' , 'string' , '' )
			);
			$Page = str_replace( $PlaceHolders , $Data , $Page );

			print( $Page );
			exit( 0 );
		}
	}
	
	/**
	*	Функция обработки второго шага.
	*
	*	@param $Host - Хост.
	*
	*	@param $Database - База данных.
	*
	*	@param $Prefix - Префикс таблиц.
	*
	*	@param $User - Пользователь.
	*
	*	@param $Password - Пароль.
	*
	*	@param $Silent - Тихая обработка.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	Function process step 2.
	*
	*	@param $Host - Host.
	*
	*	@param $Database - Database.
	*
	*	@param $Prefix - Tables'es prefix.
	*
	*	@param $User - User.
	*
	*	@param $Password - Password.
	*
	*	@param $Silent - Silent processing.
	*
	*	@author Dodonov A.A.
	*/
	function			handle_step_2( $Host , $Database , $Prefix , $User , $Password , $Silent = false )
	{
		$DatabaseAlgorithms = get_package( 'database::database_algorithms' , 'last' , __FILE__ );
		$CachedFS = get_package( 'cached_fs' );
		$CachedFS->file_put_contents( 
			"packages/_core_data/conf/cf_mysql_database" , "$Host#$User#$Password#$Database#$Prefix"
		);
		
		if( $DatabaseAlgorithms->try_connect() )
		{
			$DBScript = file_get_contents( './install/sql/data.sql' , 'cleaned' );
			$DBScript = str_replace( '{prefix}' , $Prefix , $DBScript );
			$DatabaseAlgorithms->execute_query_set( $DBScript );
			if( $Silent === false )
			{
				header( 'Location: ./install.php?page=3' );
				exit( 0 );
			}
		}
		else
		{
			handle_connection_error( $Silent );
		}
	}
	
	/**
	*	Показать форму для второго шага.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	Show form for the second step.
	*
	*	@author Dodonov A.A.
	*/
	function				show_step_2_form()
	{
		$CachedFS = get_package( 'cached_fs' );
		$Page = $CachedFS->file_get_contents( "./install/res/templates/install_template_2.tpl" );
		
		$Needles = array( '{host}' , '{user}' , '{password}' , '{database}' , '{prefix}' , '{error_message}' );
		
		$Config = $CachedFS->file_get_contents( "packages/_core_data/conf/cf_mysql_database" );
		$Replacements = array_merge( explode( '#' , $Config ) , array( '' ) );
		
		print( str_replace( $Needles , $Replacements , $Page ) );
		exit( 0 );
	}
	
	/**
	*	Второй шаг.
	*
	*	@param $Silent - Тихая обработка.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	Second step.
	*
	*	@param $Silent - Silent processing.
	*
	*	@author Dodonov A.A.
	*/
	function			install_step_2( $Silent = false )
	{
		$Security = get_package( 'security' );

		if( $Security->get_gp( 'setup_db' ) )
		{
			handle_step_2( 
				$Security->get_gp( 'host' , 'string' , '' ) , $Security->get_gp( 'database' , 'string' , '' ) , 
				$Security->get_gp( 'prefix' , 'string' , '' ) , $Security->get_gp( 'user' , 'string' , '' ) , 
				$Security->get_gp( 'password' , 'string' , '' ) , $Silent
			);
		}
		else
		{
			show_step_2_form();
		}
	}
	
	/**
	*	Функция обработки третьего шага.
	*
	*	@param $HttpHost - Хост.
	*
	*	@param $Silent - Тихая обработка.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	Function process step 3.
	*
	*	@param $HttpHost - Host.
	*
	*	@param $Silent - Silent processing.
	*
	*	@author Dodonov A.A.
	*/
	function			handle_step_3( $HttpHost , $Silent = false )
	{
		$HttpHost = rtrim( $HttpHost , '/\\' );
		$HtAccess = file_get_contents( './install/res/templates/tpl.htaccess' );
		$HtAccess = str_replace( '{http_host}' , $HttpHost , $HtAccess );
		file_put_contents( '.htaccess' , $HtAccess );
		
		file_put_contents( 
			'./packages/_core_data/conf/cf_settings' , "HTTP_HOST=$HttpHost\r\nGZIP_TRAFFIC=false"
		);
		
		if( $Silent === false )
		{
			header( 'Location: ./install.php?page=4' );
			exit( 0 );
		}
	}
	
	/**
	*	Третий шаг.
	*
	*	@param $HttpHost - Хост.
	*
	*	@param $Silent - Тихая обработка.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	Third step.
	*
	*	@param $HttpHost - Host.
	*
	*	@param $Silent - Silent processing.
	*
	*	@author Dodonov A.A.
	*/
	function			install_step_3( $HttpHost , $Silent = false )
	{
		$CachedFS = get_package( 'cached_fs' );
		$Security = get_package( 'security' );
		
		if( $HttpHost === false )
		{
			if( $Silent === false )
			{
				$Page = $CachedFS->file_get_contents( "./install/res/templates/install_template_3.tpl" );
				$Page = str_replace( 
					'{http_root}' , 
					rtrim( 'http://'.$_SERVER[ 'SERVER_NAME' ].dirname( $_SERVER[ 'REQUEST_URI' ] ) , '/\\' ) , 
					$Page
				);
				print( $Page );
				exit( 0 );
			}
		}
		else
		{
			handle_step_3( $HttpHost , $Silent );
		}
	}
	
	/**
	*	Четвёртый шаг.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	Forth step.
	*
	*	@author Dodonov A.A.
	*/
	function			install_step_4()
	{
		$CachedFS = get_package( 'cached_fs' );
		$Page = $CachedFS->file_get_contents( "./install/res/templates/install_template_4.tpl" );
		print( $Page );
		exit( 0 );
	}
	
	/**
	*	Шаги инсталлятора.
	*
	*	@param $HttpHost - Хост.
	*
	*	@param $Silent - Тихая обработка.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	Third step.
	*
	*	@param $HttpHost - Host.
	*
	*	@param $Silent - Silent processing.
	*
	*	@author Dodonov A.A.
	*/
	function			handle_installation_steps()
	{
		$Security = get_package( 'security' );
		$Page = $Security->get_gp( 'page' , 'integer' , 1 );
		
		switch( $Page )
		{
			case( 1 ):install_step_1();
			
			case( 2 ):install_step_2( false );
			
			case( 3 ):
				install_step_3( $Security->get_gp( 'http_root' , 'string' , false ) , false );
			break;
			
			case( 4 ):install_step_4();
		}
	}
	
	/**
	*	Отображение визарда установки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	Function runs installation wizard.
	*
	*	@author Dodonov A.A.
	*/
	function			run_installation_wizard()
	{
		try
		{
			if( isset( $_GET[ 'auto_install' ] ) === true )
			{
				$DBS = file_get_contents( './install/conf/cf_db_settings' );
				$DBS = explode( '#' , $DBS );
				
				install_step_2( $DBS[ 0 ] , $DBS[ 1 ] , $DBS[ 2 ] , $DBS[ 3 ] , $DBS[ 4 ] , true );
				
				$HttpHost = rtrim( 'http://'.$_SERVER[ 'SERVER_NAME' ].dirname( $_SERVER[ 'REQUEST_URI' ] ) , '/\\' );
				install_step_3( $HttpHost , true );
			}
			else
			{
				handle_installation_steps();
			}
		}
		catch( Exception $e )
		{
			handle_script_error( true , $e );
		}
	}
	
	/* running wizard */
	run_installation_wizard();
?>