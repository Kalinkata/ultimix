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
	*	\~russian Класс утилит.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class with context_set utilities.
	*
	*	@author Dodonov A.A.
	*/
	class	context_set_configs_1_0_0{

		/**
		*	\~russian Закешированные пакеты.
		*
		*	@author Dodonov A.A.
		*/
		/**
		*	\~english Cached packages.
		*
		*	@author Dodonov A.A.
		*/
		var					$CachedMultyFS = false;
		var					$ContextSetConfig = false;
		var					$Trace = false;

		/**
		*	\~russian Конструктор.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
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
				$this->ContextSetConfig = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->Trace = get_package( 'trace' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция загрузки конфига.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@param $FilePath - Путь к компоненту. Должен быть __FILE__
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method loads config.
		*
		*	@param $Options - Execution parameters.
		*
		*	@param $FilePath - Path tp the component. Must be equal to __FILE__
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			load_context_set_config( &$ContextSetSettings , &$Options , $FilePath )
		{
			try
			{
				$FileName = $Options->get_setting( 'common_settings_config' , 'cfcxs_context_set' );
				$FilePath = dirname( $FilePath )."/conf/$FileName";

				if( $this->CachedMultyFS->file_exists( $FilePath ) )
				{
					$File = $this->CachedMultyFS->file_get_contents( $FilePath );
					$this->Trace->add_trace_string( '{lang:common_settings_config} : '.$File , COMMON );
					$ContextSetSettings->load_settings( $File );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Загрузка конфига стейта для соответствующей кнопки.
		*
		*	@param $Settings - Настройки стейтов.
		*
		*	@param $SettingName - Название настройки.
		*
		*	@param $Default - Дефолтовое значение настройки.
		*
		*	@param $ComponentPath - Путь к компоненту.
		*
		*	@return Конфиг. false если файл не загружен.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function load state's config (for the corresponding button).
		*
		*	@param $Settings - States settings.
		*
		*	@param $SettingName - Setting's name.
		*
		*	@param $Default - Default value of the setting.
		*
		*	@param $ComponentPath - Path to the component.
		*
		*	@return Config. false if the config was not loaded.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_common_state_config( &$Settings , $SettingName , $Default , $ComponentPath )
		{
			try
			{
				$Message = "{lang:attempt_to_load_config} : \"$SettingName\" or default \"$Default\"";

				$this->Trace->add_trace_string( $Message , COMMON );

				$Config = $Settings->get_setting( $SettingName , $Default );

				$this->Trace->add_trace_string( "{lang:searching_file} : \"$Config\"" , COMMON );

				$Path = dirname( $ComponentPath )."/conf/$Config";

				if( $this->CachedMultyFS->file_exists( $Path ) === false )
				{
					return( false );
				}

				$Config = $this->CachedMultyFS->file_get_contents( $Path );

				$Config = str_replace( '{prefix}' , $Settings->get_setting( 'prefix' , '' ) , $Config );

				return( $Config );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Загрузка конфига стейта для соответствующей кнопки.
		*
		*	@param $Settings - Настройки набора контекстов.
		*
		*	@param $SettingName - Название настройки.
		*
		*	@param $Default - Дефолтовое значение настройки.
		*
		*	@param $ComponentPath - Путь к компоненту.
		*
		*	@return true если настройки ыли згружены.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function load state's config (for the corresponding button).
		*
		*	@param $Settings - Set of contexts settings.
		*
		*	@param $SettingName - Setting's name.
		*
		*	@param $Default - Default value of the setting.
		*
		*	@param $ComponentPath - Path to the component.
		*
		*	@return true if the config was loaded.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			load_common_state_config( &$Settings , $SettingName , $Default , $ComponentPath )
		{
			try
			{
				$Config = $this->get_common_state_config( $Settings , $SettingName , $Default , $ComponentPath );

				$Config = get_package_object( 'settings::settings' , 'last' , __FILE__ );

				$Config->load_settings( $Config );

				return( $Config );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение префикса.
		*
		*	@param $PackageName - Название пакета.
		*
		*	@param $PackageVersion - Версия пакета.
		*
		*	@return Префикс.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns prefix.
		*
		*	@param $PackageName - Package name.
		*
		*	@param $PackageVersion - Package version.
		*
		*	@return Prefix.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_context_set_prefix( $PackageName , $PackageVersion = 'last' )
		{
			try
			{
				$this->ContextSetConfig->clear();

				$FilePath = _get_package_relative_path_ex( $PackageName , $PackageVersion ).'/unexisting_script';

				$this->load_context_set_config( $this->ContextSetConfig , $this->ContextSetConfig , $FilePath );

				return( $this->ContextSetConfig->get_setting( 'prefix' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение префикса.
		*
		*	@param $PackageName - Название пакета.
		*
		*	@param $PackageVersion - Версия пакета.
		*
		*	@return Префикс.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns prefix.
		*
		*	@param $PackageName - Package name.
		*
		*	@param $PackageVersion - Package version.
		*
		*	@return Prefix.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_context_permits( $Context , $PackageName , $PackageVersion = 'last' )
		{
			try
			{
				$this->ContextSetConfig->clear();

				$FilePath = _get_package_relative_path_ex( $PackageName , $PackageVersion ).'/unexisting_script';

				$this->load_context_set_config( $this->ContextSetConfig , $this->ContextSetConfig , $FilePath );

				$CommonStateConfig = $this->load_common_state_config( 
					$this->ContextSetConfig , 'common_state_config_'.$Context.'_form' , 
					'cfcxs_'.$Context.'_form' , $FilePath
				);

				$PermitsFilter = $CommonStateConfig->get_setting( 'permits_filter' , 'admin' );
				return( $CommonStateConfig->get_setting( 'permits_validation' , $PermitsFilter ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>