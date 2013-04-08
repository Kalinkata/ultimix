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
	*	\~russian Обработчик компонента.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Component's controller.
	*
	*	@author Dodonov A.A.
	*/
	class	settings_controller_1_0_0{
		
		/**
		*	\~russian Закешированные пакеты.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cached packages.
		*
		*	@author Dodonov A.A.
		*/
		var					$CachedMultyFS = false;
		var					$DBSettings = false;
		var					$Security = false;
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
				$this->DBSettings = get_package_object( 'settings::db_settings' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->Settings = get_package_object( 'settings::package_settings' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения новой настройки.
		*
		*	@param $Manifest - Загруженный конфиг.
		*
		*	@return Значение настройки.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function gets new setting value.
		*
		*	@param $Manifest - Loaded config.
		*
		*	@return Setting value.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_posted_setting( &$Manifest )
		{
			try
			{
				$SettingName = $Manifest->get_setting( 'setting_name' );
				
				switch( $Manifest->get_setting( 'type' , 'input' ) )
				{
					case( 'input' ):
						return( $this->Security->get_gp( $SettingName , 'string' , '' ) );
						
					case( 'checkbox' ):
						return( intval( $this->Security->get_gp( $SettingName , 'integer' ) ) );
						
					case( 'textarea' ):
						return( $this->Security->get_gp( $SettingName , 'string' , '' ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция установки настройки.
		*
		*	@param $Manifest - Загруженный конфиг.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sets setting value.
		*
		*	@param $Manifest - Loaded config.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_db_setting( &$Manifest )
		{
			try
			{
				$SettingName = $Manifest->get_setting( 'setting_name' );
				$DefaultValue = $Manifest->get_setting( 'default_value' , '' );
					
				$SettingValue = $this->DBSettings->get_setting( $SettingName , $DefaultValue );
				$NewSettingValue = $this->get_posted_setting( $Manifest );
				
				if( $SettingValue != $NewSettingValue )
				{
					$this->DBSettings->set_setting( $SettingName , $NewSettingValue );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция установка настройки.
		*
		*	@param $Manifest - Загруженный конфиг.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sets setting value.
		*
		*	@param $Manifest - Loaded config.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_package_setting( &$Manifest )
		{
			try
			{
				$Version = $Manifest->get_setting( 'package_version' , 'last' );
				list( $Name , $ConfigFileName , $SettingName ) = 
					$Manifest->get_settings( 'package_name,config_file_name,setting_name' );

				$SettingValue = $this->Settings->get_package_setting( $Name , $Version , 
									$ConfigFileName , $SettingName , $Manifest->get_setting( 'default_value' , '' ) );
				$NewSettingValue = $this->get_posted_setting( $Manifest );

				if( $SettingValue != $NewSettingValue )
				{
					$this->Settings->set_package_setting( 
						$Name , $Version , $ConfigFileName , $SettingName , $NewSettingValue
					);
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки строки конфига.
		*
		*	@param $ConfigLine - Строка конфига.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes config line.
		*
		*	@param $ConfigLine - Config's line.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			handle_config_line( $ConfigLine )
		{
			try
			{
				$Manifest = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$Manifest->load_settings( $ConfigLine );
						
				$PackageName = $Manifest->get_setting( 'package_name' , false );
				if( $PackageName === false )
				{
					$this->set_db_setting( $Manifest );
				}
				else
				{
					$this->set_package_setting( $Manifest );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция сохранения настроек.
		*
		*	@param $Options - настройки работы модуля.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function saves settings.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			save_settings( $Options )
		{
			try
			{
				$FormsName = explode( ',' , $Options->get_setting( 'form_name' ) );

				foreach( $FormsName as $i => $FormName )
				{
					$ConfigPath = _get_package_relative_path_ex( 'settings::settings_view' , 'last' ).
						"/conf/cf_$FormName";
					if( $this->CachedMultyFS->file_exists( $ConfigPath ) )
					{
						$Config = $this->CachedMultyFS->file_get_contents( $ConfigPath , 'exploded' );
						
						foreach( $Config as $i => $ConfigLine )
						{
							
							$this->handle_config_line( $ConfigLine );
						}
					}
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Обработка компонента.
		*
		*	@param $Options - настройки работы модуля.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Component's controller.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			controller( &$Options )
		{
			try
			{
				$ContextSet = get_package( 'gui::context_set' , 'last' , __FILE__ );

				$ContextSet->add_context( dirname( __FILE__ ).'/conf/cfcx_save_settings' );
				
				if( $ContextSet->execute( $Options , $this , __FILE__ ) )return;
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>