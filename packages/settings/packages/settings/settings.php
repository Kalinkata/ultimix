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
	*	\~russian Работа с настройками.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Working with settings.
	*
	*	@author Dodonov A.A.
	*/
	class	settings_1_0_0{

		/**
		*	\~russian Массив с настроками.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Array with settings.
		*
		*	@author Dodonov A.A.
		*/
		var					$SettingsList = false;

		/**
		*	\~russian Кэш.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cache.
		*
		*	@author Dodonov A.A.
		*/
		var					$CachedMultyFS = false;

		/**
		*	\~russian Загрузка настроек.
		*
		*	@param $Settings - Данные с настройками.
		*
		*	@param $Separator - Разделитель.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function loads settings.
		*
		*	@param $Settings - Data with settings.
		*
		*	@param $Separator - Separator for keys.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			load_settings( $Settings , $Separator = ';' )
		{
			try
			{				
				$this->SettingsList = array();
				$this->append_settings( $Settings , $Separator );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Удаление настройки.
		*
		*	@param $Name - Название настройки.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function deletes setting.
		*
		*	@param $Name - Setting's title.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			delete_setting( $Name )
		{
			try
			{
				if( isset( $this->SettingsList[ $Name ] ) === false )
				{
					return;
				}

				$New = array();
				foreach( $this->SettingsList as $Key => $Value )
				{
					if( $Key !== $Name )
					{
						$New[ $Key ] = $Value;
					}
				}
				$this->SettingsList = $New;
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Преобразование строку настроек.
		*
		*	@param $Settings - Настройки.
		*
		*	@param $Separator - Разделитель.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function transforms settings string.
		*
		*	@param $Settings - Settings.
		*
		*	@param $Separator - Separator.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			transform_settings( $Settings , $Separator )
		{
			try
			{
				$Settings = str_replace( 
					array( "\r" , "\n" , $Separator.$Separator ) , 
					array( $Separator , $Separator , $Separator ) , 
					$Settings
				);

				return( explode( $Separator , $Settings ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Загрузка настроек.
		*
		*	@param $Settings - Настройки.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function loads settings.
		*
		*	@param $Settings - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_settings( $Settings )
		{
			try
			{
				foreach( $Settings as $s )
				{
					$Tmp = explode( '=' , $s );
					if( isset( $Tmp[ 1 ] ) === true )
					{
						$this->SettingsList[ $Tmp[ 0 ] ] = $Tmp[ 1 ];
					}
					elseif( isset( $Tmp[ 0 ] ) === true && isset( $Tmp[ 1 ] ) === false )
					{
						$this->SettingsList[ $Tmp[ 0 ] ] = true;
					}
					elseif( isset( $Tmp[ 0 ] ) === false )
					{
						$Settings = serialize( $Settings );
						$s = serialize( $s );
						$Tmp = serialize( $Tmp );
						throw_exception( "Settings : $Settings s : $s Tmp : $Tmp Illegal settings string" );
					}
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Загрузка дополнительных настроек.
		*
		*	@param $Settings - Данные с настройками.
		*
		*	@param $Separator - Разделитель пар.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function loads additional settings.
		*
		*	@param $Settings - Data with settings.
		*
		*	@param $Separator - Separator for keys.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			append_settings( $Settings , $Separator = ';' )
		{
			try
			{
				if( $Settings === false || $Settings === '' || $Settings === null )
				{
					return;
				}

				if( is_array( $Settings ) === false )
				{
					$Settings = $this->transform_settings( $Settings , $Separator );
				}

				$this->process_settings( $Settings );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция загрузки настроек из $_GET и $_POST.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function loads settings from $_GET and $_POST.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			load_from_http()
		{
			try
			{
				$this->SettingsList = array_merge( $_POST , $_GET );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция возвращает массив с настройками.
		*
		*	@return Массив с настройками. 
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns array with settings.
		*
		*	@return Array with settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_raw_settings()
		{
			try
			{
				return( $this->SettingsList );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция сохраняет настройки.
		*
		*	@param $Settings - Настройки. 
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function stores settings.
		*
		*	@param $Settings - Settings. 
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			add_settings_from_object( $Settings )
		{
			try
			{
				$this->SettingsList = array_merge( $this->SettingsList , $Settings->SettingsList );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция сохраняет настройки.
		*
		*	@param $Settings - Настройки. 
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function stores settings.
		*
		*	@param $Settings - Settings. 
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			load_raw_settings( $Settings )
		{
			try
			{
				$this->SettingsList = $Settings;
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция сохраняет настройки.
		*
		*	@param $Settings - Настройки. 
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function stores settings.
		*
		*	@param $Settings - Settings. 
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			append_raw_settings( $Settings )
		{
			try
			{
				$this->SettingsList = array_merge( $this->SettingsList , $Settings );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция возвращает закомпиленные настройки.
		*
		*	@return Настройки. 
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns compiled settings.
		*
		*	@return Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_all_settings()
		{
			try
			{
				$Str = array();

				foreach( $this->SettingsList as $Key => $Value )
				{
					$Str [] = "$Key=$Value";
				}

				$Str = implode( ';' , $Str );

				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Загрузка настроек из файла.
		*
		*	@param $FilePath - Путь к файлу.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function loads settings from file.
		*
		*	@param $FilePath - File path.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_config( $FilePath )
		{
			try
			{
				if( $this->CachedMultyFS === false )
				{
					$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				}

				return( $this->CachedMultyFS->file_get_contents( $FilePath ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
 	
		/**
		*	\~russian Загрузка настроек из файла.
		*
		*	@param $FilePath - путь к файлу.
		*
		*	@param $Separator - Разделитель.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function loads settings from file.
		*
		*	@param $FilePath - File path.
		*
		*	@param $Separator - Separator for keys.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			load_file( $FilePath , $Separator = ';' )
		{
			try
			{
				$this->load_settings( $this->get_config( $FilePath ) , $Separator );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Загрузка настроек из файла.
		*
		*	@param $FilePath - Путь к файлу.
		*
		*	@param $Separator - Разделитель.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function loads settings from file.
		*
		*	@param $FilePath - File path.
		*
		*	@param $Separator - Separator for keys.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			append_file( $FilePath , $Separator = ';' )
		{
			try
			{
				$this->append_settings( $this->get_config( $FilePath ) , $Separator );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Загрузка настроек пакета.
		*
		*	@param $PackageName - Имя пакета.
		*
		*	@param $PackageVersion - Версия пакета.
		*
		*	@param $FileName - Имя файла dв директории conf указанного пакета.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function loads settings for package.
		*
		*	@param $PackageName - Package's name.
		*
		*	@param $PackageVersion - Package's version.
		*
		*	@param $FileName - File's name from directory 'conf' for the specified package.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			load_package_settings( $PackageName , $PackageVersion , $FileName )
		{
			try
			{
				$PackageDirectory = _get_package_path_ex( $PackageName , $PackageVersion );

				$this->load_file( $PackageDirectory."/conf/$FileName" );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Создание дефайна по настройке.
		*
		*	@param $Name - Название настройки.
		*
		*	@param $DefaultValue - Дефолтовое значение настроки если она неустановлена.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Creating dfine by setting.
		*
		*	@param $Name - Setting title.
		*
		*	@param $DefaultValue - Default value for undefined setting.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			define( $Name , $DefaultValue = '_throw_exception' )
		{
			try
			{
				DEFINE( $Name , $this->get_setting( $Name , $DefaultValue ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения настроек.
		*
		*	@param $Name - Название настройки.
		*
		*	@param $ThrowException - Кидать исключение.
		*
		*	@return true если настройка существует, false если не существует.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function provides access to the loaded settings.
		*
		*	@param $Name - Setting title.
		*
		*	@param $ThrowException - Throw exception.
		*
		*	@return true if the setting exists, false otherwise
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			setting_exists( $Name , $ThrowException = false )
		{
			try
			{
				if( $this->SettingsList !== false && isset( $this->SettingsList[ $Name ] ) )
				{
					return( true );
				}

				if( $ThrowException )
				{
					throw( new Exception( "Setting \"$Name\" does not exist" ) );
				}

				return( false );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения настроек.
		*
		*	@param $Name - Название настройки.
		*
		*	@param $DefaultValue - Дефолтовое значение настроки если она неустановлена.
		*
		*	@return Значение настройки.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function provides access to the loaded settings.
		*
		*	@param $Name - Setting title.
		*
		*	@param $DefaultValue - Default value for undefined setting.
		*
		*	@return Setting's value.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_setting( $Name , $DefaultValue = '_throw_exception' )
		{
			try
			{
				if( $this->SettingsList !== false && isset( $this->SettingsList[ $Name ] ) )
				{
					return( $this->SettingsList[ $Name ] );
				}
				if( $DefaultValue === '_throw_exception' )
				{
					throw( new Exception( 'Setting "'.$Name.'" was not found' ) );
				}

				return( $DefaultValue );

			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения дефолтовых нзначений настроек.
		*
		*	@param $SettingsNames - Названия настроек.
		*
		*	@param $DefaultValues - Дефолтовые значения настроек если они неустановлены.
		*
		*	@return Дефолтовые значения настроек.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function provides access to the default values.
		*
		*	@param $SettingsNames - Settings titles.
		*
		*	@param $DefaultValues - Default values for undefined setting.
		*
		*	@return Settings'es default values.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_default_values( $SettingsNames , $DefaultValues )
		{
			try
			{
				$DefaultValues = explode( ',' , $DefaultValues );

				$c1 = count( $DefaultValues );
				$c2 = count( $SettingsNames );

				if( $c1 < $c2 )
				{
					for( $i = 0 ; $i < $c2 - $c1 ; $i++ )
					{
						$DefaultValues [] = '_throw_exception';
					}
				}

				return( $DefaultValues );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения настроек.
		*
		*	@param $SettingsNames - Названия настроек.
		*
		*	@param $DefaultValues - Дефолтовые значения настроек если они неустановлены.
		*
		*	@return Значения настроек.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function provides access to the loaded settings.
		*
		*	@param $SettingsNames - Settings titles.
		*
		*	@param $DefaultValues - Default values for undefined setting.
		*
		*	@return Settings'es values.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_settings( $SettingsNames , $DefaultValues = '_throw_exception' )
		{
			try
			{
				$Values = array();
				$SettingsNames = explode( ',' , $SettingsNames );

				$DefaultValues = $this->get_default_values( $SettingsNames , $DefaultValues );

				foreach( $SettingsNames as $i => $Name )
				{
					$Values [] = $this->get_setting( $Name , $DefaultValues[ $i ] );
				}

				return( $Values );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция установки настроек.
		*
		*	@param $Name - Название настройки.
		*
		*	@param $Value - Значение настроки.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function provides setting values for settings.
		*
		*	@param $Name - Setting title.
		*
		*	@param $Value - Default value for setting.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_setting( $Name , $Value )
		{
			try
			{
				if( $this->SettingsList !== false )
				{
					$this->SettingsList[ $Name ] = $Value;
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция установки неопределённых настроек.
		*
		*	@param $Name - Название настройки.
		*
		*	@param $Value - Значение настроки.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function provides setting of the undefined settings.
		*
		*	@param $Name - Setting title.
		*
		*	@param $Value - Default value for setting.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_undefined( $Name , $Value )
		{
			try
			{
				if( $this->SettingsList !== false && isset( $this->SettingsList[ $Name ] ) === false )
				{
					$this->SettingsList[ $Name ] = $Value;
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Очистка настроек.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function clears setings.
		*
		*	@return string with the object's description.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			clear()
		{
			try
			{
				$this->SettingsList = array();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция удаление настройки.
		*
		*	@param $Name - Название настройки.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function removes setting.
		*
		*	@param $Name - Setting title.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			remove_setting( $Name )
		{
			try
			{
				remove_fields( $this->SettingsList , array( $Name ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция конвертации объекта в строку.
		*
		*	@return Строка с описанием объекта.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function converts object to string.
		*
		*	@return string with the object's description.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			__toString()
		{
			try
			{
				return( serialize( $this->SettingsList ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>