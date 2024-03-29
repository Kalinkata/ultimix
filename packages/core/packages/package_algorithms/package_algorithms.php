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
	*	\~russian Класс для управления пакетами.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english This manager helps to manage packages.
	*
	*	@author Dodonov A.A.
	*/
	class	package_algorithms_1_0_0{

		/**
		*	\~russian Закэшированный объект.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cached object.
		*
		*	@author Dodonov A.A.
		*/
		var					$PackageAccess = false;
		var					$Utilities = false;

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
				$this->PackageAccess = get_package( 'core::package_access' , 'last' , __FILE__ );
				$this->Utilities = get_package( 'utilities' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение названия и версии мастер-пакета.
		*
		*	@param $PackageFilePath - Путь к архиву устанавливаемого пакета.
		*
		*	@param $MasterPackageName - Название мастер-пакета, в который будем устанавливать пакет.
		*
		*	@param $MasterPackageVersion - Версия мастер-пакета, в который будем устанавливать пакет.
		*
		*	@return array( $PackageName , $PackageVersion ).
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function fetches name and version of the master package.
		*
		*	@param $PackageFilePath - Path to the installing package's archive.
		*
		*	@param $MasterPackageName - Name of the master-package.
		*
		*	@param $MasterPackageVersion - Version of the master package.
		*
		*	@return array( $PackageName , $PackageVersion ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_master_package( $PackageFilePath , $MasterPackageName , $MasterPackageVersion )
		{
			try
			{
				if( $MasterPackageName === 'auto' )
				{
					$Zip = new ZipArchive;
					if( $Zip->open( $FileSource ) === true )
					{
						$Conf = $Zip->getFromName( './install/cf_install' );
						if( $Conf === false )
						{
							$Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
							$Settings->load_setings( $Conf );
							$MasterPackageName = $Settings->get_setting( 'master_package_name' , '/' );
							$MasterPackageVersion = $Settings->get_setting( 'master_package_version' , 'last' );
						}

						$Zip->close();
					}
				}

				return( array( $MasterPackageName , $MasterPackageVersion ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция получения корневой директории пакета
		*
		*	@param $MasterPackageName - Название мастер-пакета, в который будем устанавливать пакет.
		*
		*	@param $MasterPackageVersion - Версия мастер-пакета, в который будем устанавливать пакет.
		*
		*	@return Корневая директория.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function rturns root dir.
		*
		*	@param $MasterPackageName - Name of the master-package.
		*
		*	@param $MasterPackageVersion - Version of the master package.
		*
		*	@return Root directory.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_root_dir( $MasterPackageName , $MasterPackageVersion )
		{
			try
			{
				if( $MasterPackageName === '/' )
				{
					$ROOT_DIR = INSTALL_DIR;
				}
				else
				{
					$ROOT_DIR = _get_root_dir( $MasterPackageName , $MasterPackageVersion , INSTALL_DIR );
					$ROOT_DIR = _get_package_path( $MasterPackageName , $MasterPackageVersion , $ROOT_DIR );
				}

				return( $ROOT_DIR );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция установки пакета.
		*
		*	@param $PackageFilePath - Путь к архиву устанавливаемого пакета.
		*
		*	@param $MasterPackageName - Название мастер-пакета, в который будем устанавливать пакет.
		*
		*	@param $MasterPackageVersion - Версия мастер-пакета, в который будем устанавливать пакет.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function installs package.
		*
		*	@param $PackageFilePath - Path to the installing package's archive.
		*
		*	@param $MasterPackageName - Name of the master-package.
		*
		*	@param $MasterPackageVersion - Version of the master package.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			install_package( $PackageFilePath , $MasterPackageName , $MasterPackageVersion )
		{
			try
			{
				list( $MasterPackageName , $MasterPackageVersion ) = $this->get_master_package( 
					$PackageFilePath , $MasterPackageName , $MasterPackageVersion
				);

				$ROOT_DIR = $this->get_root_dir( $MasterPackageName , $MasterPackageVersion );

				$PackageFolder = _install_package( $PackageFilePath , $ROOT_DIR );

				$PageComposer = get_package( 'page::page_composer' , 'last' , __FILE__ );
				$PageComposer->add_success_message( 'package_was_installed' );

				_drop_core_cache();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Выборка всех пакетов в системе.
		*
		*	@return Список пакетов.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns all packages in the system.
		*
		*	@return List of packages.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_packages_list()
		{
			try
			{
				$List = _get_packages_list();

				foreach( $List as $i => $l )
				{
					$RootDir = _get_root_dir( $l[ 'package_name' ] , $l[ 'package_version' ] , INSTALL_DIR );
					$PackagePath = _get_package_path( $l[ 'package_name' ] , $l[ 'package_version' ] , $RootDir );

					$FileMTime = $this->get_package_time( $PackagePath , 'filemtime' );
					$List[ $i ][ 'modify_date' ] = date( 'Y-m-d&\nb\sp;G:i:s' , $FileMTime );

					$FileATime = $this->get_package_time( $PackagePath , 'fileatime' );
					$List[ $i ][ 'access_date' ] = date( 'Y-m-d&\nb\sp;G:i:s' , $FileATime );
				}

				return( $List );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Выборка мета-файлов пакета.
		*
		*	@param $PackageInfo - Имя и версия пакета.
		*
		*	@return Список meta файлов.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns meta-files of the package.
		*
		*	@param $PackageInfo - Package's name and version.
		*
		*	@return List of meta files.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_meta_files( $PackageInfo )
		{
			try
			{
				$PackagePath = _get_package_relative_path_ex( 
					$PackageInfo[ 'full_package_name' ] , $PackageInfo[ 'full_package_version' ]
				);

				return( $this->Utilities->get_files_from_directory( "$PackagePath/meta" , '/meta_.+/' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Выборка конфигов пакета.
		*
		*	@param $PackageInfo - Имя и версия пакета.
		*
		*	@return Список config файлов.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns configs of the package.
		*
		*	@param $PackageInfo - Package's name and version.
		*
		*	@return List of config files.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_config_files( $PackageInfo )
		{
			try
			{
				$PackagePath = _get_package_relative_path_ex( 
					$PackageInfo[ 'full_package_name' ] , $PackageInfo[ 'full_package_version' ]
				);

				return( $this->Utilities->get_files_from_directory( "$PackagePath/conf" , '/_.+/' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Выборка всех пакетов в системе.
		*
		*	@param $List - Список пакетов.
		*
		*	@return Список пакетов.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns all packages in the system.
		*
		*	@param $List - List of packages.
		*
		*	@return List of packages.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_packages_tree( $List = false )
		{
			try
			{
				if( $List === false )
				{
					$List = $this->PackageAccess->get_packages_tree();
				}

				foreach( $List as $i => $l )
				{
					$List[ $i ][ 'subpackages' ] = $this->get_packages_tree( $List[ $i ][ 'subpackages' ] );
					$List[ $i ][ 'meta' ] = $this->get_meta_files( $List[ $i ] );
					$List[ $i ][ 'conf' ] = $this->get_config_files( $List[ $i ] );
				}

				return( $List );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Существует ли пакет.
		*
		*	@param $PackageName - Название пакета.
		*
		*	@param $PackageVersion - Версия пакета.
		*
		*	@param $Path - Путь к вызывающему скрипту.
		*
		*	@return true/false.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Does package exists.
		*
		*	@param $PackageName - Package name.
		*
		*	@param $PackageVersion - Package version.
		*
		*	@param $Path - Path to the caller.
		*
		*	@return true/false.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			package_exists( $PackageName , $PackageVersion , $Path )
		{
			try
			{
				get_package( $PackageName , $PackageVersion , $Path );

				return( true );
			}
			catch( Exception $e )
			{
				return( false );
			}
		}
	}

?>