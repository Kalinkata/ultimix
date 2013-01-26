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
	class	package_access_1_0_0{

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
		var					$Security = false;
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
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->Utilities = get_package( 'utilities' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение установочного пути.
		*
		*	@param $Record - Информация о создаваемом пакете.
		*
		*	@return Путь для установки.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function gets install directory.
		*
		*	@param $Record - Creating package's description.
		*
		*	@return Installation directory.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_install_dir( &$Record )
		{
			try
			{
				$MasterPackageName = get_field( $Record , 'master_package_name' );
				$MasterPackageVersion = get_field( $Record , 'master_package_version' , 'last' );

				if( $MasterPackageName === 'ultimix' )
				{
					$PackagePath = '.';
				}
				else
				{
					$PackagePath = _get_package_relative_path_ex( $MasterPackageName , $MasterPackageVersion );
				}

				return( $PackagePath );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Создание директорий пакета.
		*
		*	@param $PackagePath - Путь к пакету.
		*
		*	@param $PackageName - Название пакета.
		*
		*	@param $PackageVersion - Версия пакета.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function creates package drectories.
		*
		*	@param $PackagePath - Package path.
		*
		*	@param $PackageName - Package name.
		*
		*	@param $PackageVersion - Package version.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	create_main_directories( $PackagePath , $PackageName , $PackageVersion )
		{
			try
			{
				$Dir = "_$PackageName.$PackageVersion";
				mkdir_ex( "$PackagePath/packages/$Dir" );
				mkdir_ex( "$PackagePath/packages/$Dir/conf" );
				mkdir_ex( "$PackagePath/packages/$Dir/data" );
				mkdir_ex( "$PackagePath/packages/$Dir/data/page" );
				mkdir_ex( "$PackagePath/packages/$Dir/data/permit" );
				mkdir_ex( "$PackagePath/packages/$Dir/packages" );
				mkdir_ex( "$PackagePath/packages/$Dir/packages/core" );
				mkdir_ex( "$PackagePath/packages/$Dir/packages/core/data" );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Создание директорий пакета.
		*
		*	@param $PackagePath - Путь к пакету.
		*
		*	@param $PackageName - Название пакета.
		*
		*	@param $PackageVersion - Версия пакета.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function creates package drectories.
		*
		*	@param $PackagePath - Package path.
		*
		*	@param $PackageName - Package name.
		*
		*	@param $PackageVersion - Package version.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	create_package_directories( $PackagePath , $PackageName , $PackageVersion )
		{
			try
			{
				$this->create_main_directories( $PackagePath , $PackageName , $PackageVersion );

				$Dir = "_$PackageName.$PackageVersion";

				mkdir_ex( "$PackagePath/packages/$Dir/res" );
				mkdir_ex( "$PackagePath/packages/$Dir/res/images" );
				mkdir_ex( "$PackagePath/packages/$Dir/res/lang" );
				mkdir_ex( "$PackagePath/packages/$Dir/res/templates" );
				mkdir_ex( "$PackagePath/packages/$Dir/res/css" );
				
				mkdir_ex( "$PackagePath/packages/$Dir/include" );
				mkdir_ex( "$PackagePath/packages/$Dir/include/php" );
				mkdir_ex( "$PackagePath/packages/$Dir/include/js" );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Создание пакета.
		*
		*	@param $Record - Информация о создаваемом пакете.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function creates package.
		*
		*	@param $Record - Creating package's description.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			create( &$Record )
		{
			try
			{
				$PackageName = get_field( $Record , 'package_name' );
				$PackageVersion = get_field( $Record , 'package_version' );

				$PackagePath = $this->get_install_dir( $Record );

				$this->create_package_directories( $PackagePath , $PackageName , $PackageVersion );

				file_put_contents( 
					"$PackagePath/packages/core/data/package_list" , 
					"\r\n$PackageName.$PackageVersion#_$PackageName.$PackageVersion" , FILE_APPEND
				);

				_drop_core_cache();

				return( array( 'package_name' => $PackageName , 'package_version' => $PackageVersion ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция возвращает список пакетов.
		*
		*	@param $ROOT_DIR - Имя корневой директории, внутри которой будем осуществлять работу с пакетами.
		*
		*	@param $p - Информация об обрабатываемом пакете.
		*
		*	@param $PackageNamePrefix - Префикс названия пакета.
		*
		*	@param $PackageVersionPrefix - Префикс версии пакета.
		*
		*	@return Список пакетов.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns a list of installed packages.
		*
		*	@param $ROOT_DIR - Root directory path.
		*
		*	@param $p - Processing package's info.
		*
		*	@param $PackageNamePrefix - Package name prefix.
		*
		*	@param $PackageVersionPrefix - Package version prefix.
		*
		*	@return List of packages.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			fetch_subpackages( $ROOT_DIR , $p , $PackageNamePrefix , $PackageVersionPrefix )
		{
			try
			{
				$InfoParts = explode( '.' , $p[ 0 ] );

				$SubPackages = array();

				if( file_exists( $ROOT_DIR.'/packages/'.$p[ 1 ].'/packages/core/data/package_list' ) )
				{
					$Name = $PackageNamePrefix.$InfoParts[ 0 ];
					$Version = $PackageVersionPrefix.$InfoParts[ 1 ].'.'.$InfoParts[ 2 ].'.'.$InfoParts[ 3 ];
					$SubPackages = $this->get_packages_tree( $ROOT_DIR.'/packages/'.$p[ 1 ] , $Name , $Version );
				}

				return( $SubPackages );
			}
			catch( Exception $e )
			{
				$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
			}
		}

		/**
		*	\~russian Функция возвращает список пакетов.
		*
		*	@param $RetArray - Уже выбранные пакеты.
		*
		*	@param $ROOT_DIR - Имя корневой директории, внутри которой будем осуществлять работу с пакетами.
		*
		*	@param $p - Информация об обрабатываемом пакете.
		*
		*	@param $PackageNamePrefix - Префикс названия пакета.
		*
		*	@param $PackageVersionPrefix - Префикс версии пакета.
		*
		*	@return Список пакетов.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns a list of installed packages.
		*
		*	@param $RetArray - Already fetched packages.
		*
		*	@param $ROOT_DIR - Root directory path.
		*
		*	@param $p - Processing package's info.
		*
		*	@param $PackageNamePrefix - Package name prefix.
		*
		*	@param $PackageVerPrefix - Package version prefix.
		*
		*	@return List of packages.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			fetch_subpackages_tree( $RetArray , $ROOT_DIR , $p , 
																			$PackageNamePrefix , $PackageVerPrefix )
		{
			try
			{
				$SubPackages = $this->fetch_subpackages( $ROOT_DIR , $p , $PackageNamePrefix , $PackageVerPrefix );

				$InfoParts = explode( '.' , $p[ 0 ] );

				$RetArray [] = array( 
					'package_signature' => $p[ 0 ] , 
					'package_name' => $InfoParts[ 0 ] , 
					'package_version' => $InfoParts[ 1 ].'.'.$InfoParts[ 2 ].'.'.$InfoParts[ 3 ] , 
					'subpackages' => $SubPackages , 
					'full_package_name' => $PackageNamePrefix.$InfoParts[ 0 ] , 
					'full_package_version' => $PackageVerPrefix.$InfoParts[ 1 ].'.'.$InfoParts[ 2 ].'.'.
											  $InfoParts[ 3 ]
				);
				return( $RetArray );
			}
			catch( Exception $e )
			{
				$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
			}
		}

		/**
		*	\~russian Функция возвращает список пакетов.
		*
		*	@param $ROOT_DIR - Имя корневой директории, внутри которой будем осуществлять работу с пакетами.
		*
		*	@param $RootPackage - Внешний пакет.
		*
		*	@param $RootVersion - Версия внешнего пакета.
		*
		*	@return Список пакетов в формате array( 0 => 'id' , 1 => 'package_name' , 2 => 'package_version' ).
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns a list of installed packages.
		*
		*	@param $ROOT_DIR - Name of the root directory. In this directory all package processing will be run.
		*
		*	@param $RootPackage - Root package.
		*
		*	@param $RootVersion - Version of the root package
		*
		*	@return List of packages.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_packages_tree( $ROOT_DIR = INSTALL_DIR , $RootPackage = '' , $RootVersion = '' )
		{
			try
			{
				$PackageList = _load_packages_list( $ROOT_DIR );

				list( $PackageNamePrefix , $PackageVersionPrefix ) = _get_name_and_version( 
					$RootPackage , $RootVersion
				);

				$RetArray = array();

				foreach( $PackageList as $p )
				{
					$RetArray = $this->fetch_subpackages_tree( 
						$RetArray , $ROOT_DIR , $p ,  $PackageNamePrefix , $PackageVersionPrefix
					);
					
					rsort_by_field( $RetArray , 'package_signature' );
				}

				return( $RetArray );
			}
			catch( Exception $e )
			{
				$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
			}
		}

		/**
		*	\~russian Получение информации о пакете по идентификатору.
		*
		*	@param $id - id пакета.
		*
		*	@param $AllPackages - Пакеты.
		*
		*	@return Информация о пакете.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method returns package info.
		*
		*	@param $id - Package's id.
		*
		*	@param $AllPackages - Packages.
		*
		*	@return Package info.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_package_info_by_id( $id , $AllPackages = false )
		{
			try
			{
				if( is_array( $id ) )
				{
					$id = $id[ 'package_name' ].'.'.$id[ 'package_version' ];
				}

				if( $AllPackages === false )
				{
					$AllPackages = $this->get_packages_tree();
				}

				$Info = array_filter_ex( 
					$AllPackages , 
					'is_array( $Element ) && get_field( $Element , "package_signature" , false ) === "'.$id.'"'
				);

				if( isset( $Info[ 0 ] ) )
				{
					return( $Info[ 0 ] );
				}

				throw( new Exception( "The package '$id' was not found" ) );
			}
			catch( Exception $e )
			{
				$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
			}
		}
		
		/**
		*	\~russian Получение путь пакета по идентификатору.
		*
		*	@param $id - id пакета.
		*
		*	@return Путь к пакету.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method returns path to the package.
		*
		*	@param $id - Package's id.
		*
		*	@return Path to package.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_path_from_id( $id )
		{
			try
			{
				$Info = $this->get_package_info_by_id( $id );

				$Path = _get_package_relative_path_ex( 
					$Info[ 'full_package_name' ] , $Info[ 'full_package_version' ]
				);

				return( $Path );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение информации о дочерних пакетах.
		*
		*	@param $ROOT_DIR - Имя корневой директории, внутри которой будем осуществлять работу с пакетами.
		*
		*	@return Информация о дочерних пакетах.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns data from the packages_list file.
		*
		*	@param $ROOT_DIR - Name of the root directory. In this directory all package processing will be run.
		*
		*	@return Data from the packages_list file.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_packages_info( $ROOT_DIR = INSTALL_DIR )
		{
			try
			{
				$File = _file_get_contents( $ROOT_DIR.'/packages/core/data/package_list' );

				if( $File === false )
				{
					throw( 
						new Exception( 
							'An error occured while loading file '.$ROOT_DIR.'/packages/core/data/package_list'
						)
					);
				}

				$File = str_replace( "\r" , "\n" , $File );
				$File = str_replace( "\n\n" , "\n" , $File );

				return( explode( "\n" , $File ) );
			}
			catch( Exception $e )
			{
				$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
			}
		}

		/**
		*	\~russian Удаление пакета из списка.
		*
		*	@param $id - id пакета.
		*
		*	@param $Path - Путь к пакету.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Deleting package from list.
		*
		*	@param $id - Package's id.
		*
		*	@param $Path - Path to the package.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			unregister_package( $id , $Path )
		{
			try
			{
				$Records = $this->get_packages_info( "$Path/../../" );

				$Content = array();

				foreach( $Records as $i => $Record )
				{
					if( strpos( $Record , $id ) === 0 )
					{
						/* nop */
					}
					else
					{
						$Content [] = $Record;
					}
				}

				$Content = implode( "\r\n" , $Content );

				file_put_contents( "$Path/../../packages/core/data/package_list" , $Content );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Удаление пакета по имени и версии.
		*
		*	@param $id - id пакета.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Delete package by given name and version.
		*
		*	@param $id - Package's id.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			delete( $id )
		{
			try
			{
				$Path = $this->get_path_from_id( $id );

				$this->Utilities->rmdir( $Path );

				$this->unregister_package( $id , $Path );

				_drop_core_cache();
			}
			catch( Exception $e )
			{
				$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
			}
		}

		/**
		*	\~russian Выборка массива объектов.
		*
		*	@param $id - Список идентификаторов удаляемых данных, разделённых запятыми.
		*
		*	@return Массив записей.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function selects list of objects.
		*
		*	@param $id - Comma separated list of record's id.
		*
		*	@return Array of records.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			select_list( $id )
		{
			try
			{
				$id = $this->Security->get( $id , 'string' );

				return( array( $this->get_package_info_by_id( $id ) ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>