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
	class	package_settings_1_0_0{
		
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
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Загрузка настройки пакета.
		*
		*	@param $PackageName - Имя пакета.
		*
		*	@param $PackageVersion - Версия пакета.
		*
		*	@param $FileName - Имя файла dв директории conf указанного пакета.
		*
		*	@param $SettingName - Название настройки.
		*
		*	@param $DefaultValue - Дефолтовое значение настроки если она неустановлена.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function loads setting for package.
		*
		*	@param $PackageName - Package's name.
		*
		*	@param $PackageVersion - Package's version.
		*
		*	@param $FileName - File's name from directory 'conf' for the specified package.
		*
		*	@param $SettingName - Setting title.
		*
		*	@param $DefaultValue - Default value for undefined setting.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_package_setting( $PackageName , $PackageVersion , $FileName , 
												 $SettingName , $DefaultValue = '_throw_exception' )
		{
			try
			{
				$S = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				
				$S->load_package_settings( $PackageName , $PackageVersion , $FileName );
				
				return( $S->get_setting( $SettingName , $DefaultValue ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Загрузка настройки пакета.
		*
		*	@param $PackageName - Имя пакета.
		*
		*	@param $PackageVersion - Версия пакета.
		*
		*	@param $FileName - Имя файла dв директории conf указанного пакета.
		*
		*	@param $SettingName - Название настройки.
		*
		*	@param $Value - Значение настроки.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function loads setting for package.
		*
		*	@param $PackageName - Package's name.
		*
		*	@param $PackageVersion - Package's version.
		*
		*	@param $FileName - File's name from directory 'conf' for the specified package.
		*
		*	@param $SettingName - Setting title.
		*
		*	@param $Value - Value for setting.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_package_setting( $PackageName , $PackageVersion , $FileName , $SettingName , $Value )
		{
			try
			{
				$S = get_package_object( 'settings::settings' , 'last' , __FILE__ );

				$S->load_package_settings( $PackageName , $PackageVersion , $FileName );

				$S->set_setting( $SettingName , $Value );

				$PackagePath = _get_package_path_ex( $PackageName , $PackageVersion );

				$this->CachedMultyFS->file_put_contents( "$PackagePath/conf/$FileName" , $S->get_all_settings() );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>