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
	*	\~russian Класс для работы с событиями.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class for event processing.
	*
	*	@author Dodonov A.A.
	*/
	class	event_manager_1_0_0{
		
		var					$LoadedBindings = array();
		
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
		var					$CachedMultyFS = false;
		var					$String = false;
		var					$Settings = false;
		
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
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				
				$this->register_events( dirname( __FILE__ ).'/conf/cf_event_manager_binded_events' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Добавление обработчика события.
		*
		*	@param $Event - Название события.
		*
		*	@param $PackageName - Название пакета.
		*
		*	@param $PackageVersion - Версия пакета.
		*
		*	@param $Handler - Обработчик события.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function registers event handler.
		*
		*	@param $Event - Event's name.
		*
		*	@param $PackageName - Package's name.
		*
		*	@param $PackageVersion - Package's version.
		*
		*	@param $Handler - Event's handler.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			register_event( $Event , $PackageName , $PackageVersion , $Handler = false )
		{
			try
			{
				if( isset( $this->LoadedBindings[ $Event ] ) === false )
				{
					$this->LoadedBindings[ $Event ] = array();
				}
				
				if( isset( $this->LoadedBindings[ $Event ][ $PackageName ] ) === false )
				{
					$this->LoadedBindings[ $Event ][ $PackageName ] = array();
				}
				
				if( isset( $this->LoadedBindings[ $Event ][ $PackageName ][ $PackageVersion ] ) === false )
				{
					$this->LoadedBindings[ $Event ][ $PackageName ][ $PackageVersion ] = array();
				}
				
				$this->LoadedBindings[ $Event ][ $PackageName ][ $PackageVersion ] [] = $Handler;
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Добавление обработчиков событий.
		*
		*	@param $ConfigPath - Путь к файлу с описанием биндингов.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function registers event handlers.
		*
		*	@param $ConfigPath - Path to the config with event bindings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			register_events( $ConfigPath )
		{
			try
			{
				$Bindings = $this->CachedMultyFS->file_get_contents( $ConfigPath , 'cleaned' );

				if( $Bindings != '' )
				{
					$Bindings = explode( "\n" , $Bindings );
					
					foreach( $Bindings as $k => $v )
					{
						$this->Settings->load_settings( $v );
						$this->register_event(  $this->Settings->get_setting( 'event' ) , 
												$this->Settings->get_setting( 'package_name' ) , 
												$this->Settings->get_setting( 'package_version' ) , 
												$this->Settings->get_setting( 'handler' , false ) );
					}
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки собятия.
		*
		*	@param $Event - Название события.
		*
		*	@param $Parameters - Параметры работы события.
		*
		*	@return Результат работы события.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function runs event handler.
		*
		*	@param $Event - Event's name.
		*
		*	@param $Parameters - Event's parameters.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			trigger_event( $Event , $Parameters )
		{
			try
			{
				$Ret = array();
				if( isset( $this->LoadedBindings[ $Event ] ) )
				{
					foreach( $this->LoadedBindings[ $Event ] as $PackageName => $PackageVersions )
					{
						foreach( $PackageVersions as $PackageVersion => $FunctionNames )
						{
							foreach( $FunctionNames as $k => $FuncName )
							{
								$Object = get_package( $PackageName , $PackageVersion , __FILE__ );
								if( $Object === false )
								{
									throw( new Exception( 'Event handler is false' ) );
								}
								$Ret [] = call_user_func( array( $Object , $FuncName ) , $Parameters );
							}
						}
					}
				}
				return( $Ret );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>