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
	*	\~russian Вид компонента.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Component's view.
	*
	*	@author Dodonov A.A.
	*/
	class	settings_view_1_0_0{
		
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
		var					$PackageSettings = false;
		var					$PageComposerUtilities = false;
		var					$Security = false;
		var					$Settings = false;
		var					$String = false;
	
		/**
		*	\~russian Результат работы функций отображения.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Display method's result.
		*
		*	@author Dodonov A.A.
		*/
		var					$Output = false;
	
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
				$this->DBSettings = get_package( 'settings::db_settings' , 'last' , __FILE__ );
				$this->PackageSettings = get_package( 'settings::package_settings' , 'last' , __FILE__ );
				$this->PageComposerUtilities = get_package( 'page::page_composer_utilities' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения настройки из конфига.
		*
		*	@param $Manifest - Загруженный конфиг.
		*
		*	@return array( setting_name , setting_value , label ).
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function gets setting name and value for the config line.
		*
		*	@param $Manifest - Loaded config.
		*
		*	@return array( setting_name , setting_value , label ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_db_setting( &$Manifest )
		{
			try
			{
				$SettingName = $Manifest->get_setting( 'setting_name' );
				$DefaultValue = $Manifest->get_setting( 'default_value' , '' );
					
				$SettingValue = $this->DBSettings->get_setting( $SettingName , $DefaultValue );
				
				$SettingValue = $this->Security->get( $SettingValue , 'script' );
				
				return( array( $SettingName , $SettingValue , $Manifest->get_setting( 'label' ) ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения настройки из конфига.
		*
		*	@param $Manifest - Загруженный конфиг.
		*
		*	@return array( setting_name , setting_value , label ).
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function gets setting name and value for the config line.
		*
		*	@param $Manifest - Loaded config.
		*
		*	@return array( setting_name , setting_value , label ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_package_setting( &$Manifest )
		{
			try
			{
				$PackageName = $Manifest->get_setting( 'package_name' );
				$PackageVersion = $Manifest->get_setting( 'package_version' , 'last' );
				list( $ConfigFileName , $SettingName ) = $Manifest->get_settings( 'config_file_name,setting_name' );
				$DefaultValue = $Manifest->get_setting( 'default_value' , '' );

				$SettingValue = $this->PackageSettings->get_package_setting( 
					$PackageName , $PackageVersion , $ConfigFileName , $SettingName , $DefaultValue 
				);

				$SettingValue = $this->Security->get( $SettingValue , 'script' );

				return( array( $SettingName , $SettingValue , $Manifest->get_setting( 'label' ) ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения настройки из конфига.
		*
		*	@param $Manifest - Загруженный конфиг.
		*
		*	@return array( setting_name , setting_value , label ).
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function gets setting name and value for the config line.
		*
		*	@param $Manifest - Loaded config.
		*
		*	@return array( setting_name , setting_value , label ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_setting( &$Manifest )
		{
			try
			{
				$PackageName = $Manifest->get_setting( 'package_name' , false );
				
				if( $PackageName === false )
				{
					return( $this->get_db_setting( $Manifest ) );
				}
				else
				{
					return( $this->get_package_setting( $Manifest ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Компиляция строки формы.
		*
		*	@param $SettingName - Название настройки.
		*
		*	@param $SettingValue - Значение настройки.
		*
		*	@param $Label - Подпись.
		*
		*	@return HTML код.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles form line.
		*
		*	@param $SettingName - Setting name.
		*
		*	@param $SettingValue - Setting value.
		*
		*	@param $Label - Label.
		*
		*	@return HTML code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_input_setting( $SettingName , $SettingValue , $Label )
		{
			try
			{
				$Template = $this->CachedMultyFS->get_template( __FILE__ , 'input_setting.tpl' );
				
				$PlaceHolders = array( '{name}' , '{value}' , '{label}' );
				$Data = array( $SettingName , $SettingValue , $Label );
				
				$Template = str_replace( $PlaceHolders , $Data , $Template );
				
				return( $Template );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Компиляция строки формы.
		*
		*	@param $SettingName - Название настройки.
		*
		*	@param $SettingValue - Значение настройки.
		*
		*	@param $Label - Подпись.
		*
		*	@return HTML код.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles form line.
		*
		*	@param $SettingName - Setting name.
		*
		*	@param $SettingValue - Setting value.
		*
		*	@param $Label - Label.
		*
		*	@return HTML code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_checkbox_setting( $SettingName , $SettingValue , $Label )
		{
			try
			{
				$Template = $this->CachedMultyFS->get_template( __FILE__ , 'checkbox_setting.tpl' );
				
				$PlaceHolders = array( '{name}' , '{value}' , '{label}' );
				$Data = array( $SettingName , intval( $SettingValue ) ? 'checked' : '' , $Label );
				
				$Template = str_replace( $PlaceHolders , $Data , $Template );
				
				return( $Template );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Компиляция строки формы.
		*
		*	@param $SettingName - Название настройки.
		*
		*	@param $SettingValue - Значение настройки.
		*
		*	@param $Label - Подпись.
		*
		*	@return HTML код.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles form line.
		*
		*	@param $SettingName - Setting name.
		*
		*	@param $SettingValue - Setting value.
		*
		*	@param $Label - Label.
		*
		*	@return HTML code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_textarea_setting( $SettingName , $SettingValue , $Label )
		{
			try
			{
				$Template = $this->CachedMultyFS->get_template( __FILE__ , 'textarea_setting.tpl' );
				
				$PlaceHolders = array( '{name}' , '{value}' , '{label}' );
				$Data = array( $SettingName , $SettingValue , $Label );
				
				$Template = str_replace( $PlaceHolders , $Data , $Template );
				
				return( $Template );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки строки конфига.
		*
		*	@param $SettingName - Название настройки.
		*
		*	@param $SettingValue - Значение.
		*
		*	@param $Label - Метка.
		*
		*	@return HTML код.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes config line.
		*
		*	@param $SettingName - Name.
		*
		*	@param $SettingValue - Values.
		*
		*	@param $Label - Label.
		*
		*	@return HTML code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_controllers( $SettingName , $SettingValue , $Label )
		{
			try
			{
				switch( $this->Settings->get_setting( 'type' , 'input' ) )
				{
					case( 'input' ):
						return( $this->compile_input_setting( $SettingName , $SettingValue , $Label ) );
					case( 'checkbox' ):
						return( $this->compile_checkbox_setting( $SettingName , $SettingValue , $Label ) );
					case( 'textarea' ):
						return( $this->compile_textarea_setting( $SettingName , $SettingValue , $Label ) );
					default:
						$this->PageComposerUtilities->add_error_message( 'illegal_setting_type' );
						return( '' );
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
		*	@return HTML код.
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
		*	@return HTML code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_config_line( $ConfigLine )
		{
			try
			{
				$this->Settings->load_settings( $ConfigLine );

				list( $SettingName , $SettingValue , $Label ) = $this->get_setting( $this->Settings );

				return( $this->compile_controllers( $SettingName , $SettingValue , $Label ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отрисовки одной вкладки.
		*
		*	@param $FormName - Файл формы.
		*
		*	@param $ConfigPath - Путь к конфигу.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws tab control with settings.
		*
		*	@param $FormName - Form file name.
		*
		*	@param $ConfigPath - Path to the config.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_settings_form( $FormName , $ConfigPath )
		{
			try
			{
				$this->Output = $this->CachedMultyFS->get_template( __FILE__ , 'settings_form_header.tpl' );
				$this->Output = str_replace( '{name}' , $FormName , $this->Output );

				$Config = $this->CachedMultyFS->file_get_contents( $ConfigPath , 'exploded' );
				foreach( $Config as $i => $ConfigLine )
				{
					$this->Output .= $this->process_config_line( $ConfigLine );
				}
				
				$this->Output .= $this->CachedMultyFS->get_template( __FILE__ , 'settings_form_footer.tpl' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отрисовки одной вкладки.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws tab control with settings.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			settings_form( $Options )
		{
			try
			{
				$FormName = $Options->get_setting( 'form_name' );

				$ConfigPath = dirname( __FILE__ )."/conf/cf_$FormName";
				if( $this->CachedMultyFS->file_exists( $ConfigPath ) )
				{
					$this->compile_settings_form( $FormName , $ConfigPath );
				}
				else
				{
					$this->Output = '{lang:tab_manifest_was_not_found}';
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отрисовки компонента.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@return HTML код компонента.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Component's view.
		*
		*	@param $Options - Settings.
		*
		*	@return HTML code of the component.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			view( $Options )
		{
			try
			{
				$Context = get_package( 'gui::context' , 'last' , __FILE__ );

				$Context->load_config( dirname( __FILE__ ).'/conf/cfcx_settings_form' );
				if( $Context->execute( $Options , $this ) )return( $this->Output );
				
				return( '' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'settings'.
		*
		*	@param $Str - Обрабатывемая строка.
		*
		*	@param $Changed - Была ли осуществлена обработка.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'settings'.
		*
		*	@param $Str - Processing string.
		*
		*	@param $Changed - Was the processing completed.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_settings( $Str , $Changed )
		{
			try
			{
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'settings' ) ; )
				{
					$this->Settings->load_settings( $Parameters );
					$Str = str_replace( 
						"{settings:$Parameters}" , 
						$this->PackageSettings->get_package_setting( 
							$this->Settings->get_setting( 'package_name' ) , 
							$this->Settings->get_setting( 'package_version' , 'last' ) , 
							$this->Settings->get_setting( 'config_file_name' ) , 
							$this->Settings->get_setting( 'name' ) , $this->Settings->get_setting( 'default' , '' ) 
						) , 
						$Str
					);
					$Changed = true;
				}

				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'db_settings'.
		*
		*	@param $Str - Обрабатывемая строка.
		*
		*	@param $Changed - Была ли осуществлена обработка.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'db_settings'.
		*
		*	@param $Str - Processing string.
		*
		*	@param $Changed - Was the processing completed.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_db_settings( $Str , $Changed )
		{
			try
			{
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'db_settings' ) ; )
				{
					$this->Settings->load_settings( $Parameters );
					
					$SettingName = $this->Settings->get_setting( 'name' );
					$DefaultValue = $this->Settings->get_setting( 'default' , '' );
					
					$Value = $this->DBSettings->get_setting( $SettingName , $DefaultValue );
					
					$Str = str_replace( "{db_settings:$Parameters}" , $Value , $Str );
					
					$Changed = true;
				}
				
				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки строки.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@param $Str - Обрабатываемая строка.
		*
		*	@param $Changed - Была ли обработана строка.
		*
		*	@return HTML код компонента.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes string.
		*
		*	@param $Options - Settings.
		*
		*	@param $Str - Processing string.
		*
		*	@param $Changed - Was the string processed.
		*
		*	@return HTML code of the component.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_string( $Options , $Str , &$Changed )
		{
			try
			{
				list( $Str , $Changed ) = $this->process_settings( $Str , $Changed );
				
				list( $Str , $Changed ) = $this->process_db_settings( $Str , $Changed );
				
				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>