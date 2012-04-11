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
	*	\~russian Функция бросает эксепшен.
	*
	*	@param $Message - Сообщение об ошибке.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function throws exception.
	*
	*	@param $Message - Exception's message.
	*
	*	@author Dodonov A.A.
	*/
	function			throw_exception( $Message )
	{
		throw( new Exception( $Message ) );
	}
	
	/**
	*	\~russian Функция создания директории (также создается пустой index.html).
	*
	*	@param $Path - Путь к создаваемой директории.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english This function creates directory (empty index.html is also created).
	*
	*	@param $Path - Path to the creating directory.
	*
	*	@author Dodonov A.A.
	*/
	function				mkdir_ex( $Path )
	{
		@mkdir( $Path );
		file_put_contents( rtrim( $Path , "/\\" ).'/index.html' , '<html><head></head><body></body></html>' );
	}
	
	/**
	*	\~russian Функция склейки полей объектов/массивов.
	*
	*	@param $ClassName - Имя класса.
	*
	*	@return - Версия пакета.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function joins object's/array's fields.
	*
	*	@param $ClassName - Class name.
	*
	*	@return - Package version.
	*
	*	@author Dodonov A.A.
	*/
	function				get_package_version_s( $ClassName )
	{
		$ClassVersion = explode( '_' , $ClassName );
		$ClassVersionRet = '';
		$ClassVersionRet = array_pop( $ClassVersion ).$ClassVersionRet;
		$ClassVersionRet = array_pop( $ClassVersion ).'.'.$ClassVersionRet;
		$ClassVersionRet = array_pop( $ClassVersion ).'.'.$ClassVersionRet;
		return( $ClassVersionRet );
	}
	
	/**
	*	\~russian Выбор инстанса пакета.
	*
	*	@param $Key - Ключ в кэше.
	*
	*	@return Ссылка на объект класса пакета.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Selecting instance of package.
	*
	*	@param $Key - Cache key.
	*
	*	@return Reference on package's object.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_get_package_from_cache( $Key )
	{
		try
		{
			global		$ObjectLabel;
			global		$PackageCache;
			global		$PackagePathsCache;
			$ObjectLabel = 'default';
			return( $PackageCache[ $PackagePathsCache[ $Key ][ 'path' ] ] );
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}
	
	/**
	*	\~russian Выбор инстанса пакета.
	*
	*	@param $PackageName - Имя пакета.
	*
	*	@param $PackageVersion - Версия пакета.
	*
	*	@param $PackageScriptPath - Путь к файлу скрипта пакета.
	*
	*	@return Ссылка на объект класса пакета.
	*
	*	@note Функция сбрасывает значение $ObjectLabel на 'default'. Если файл срипта не был найден, то будет 
	*	возвращено false.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Selecting instance of package.
	*
	*	@param $PackageName - Name of the package.
	*
	*	@param $PackageVersion - Package's version.
	*
	*	@param $PackageScriptPath - Path to the package's script.
	*
	*	@return Reference on package's object.
	*
	*	@note Function sets value of the $ObjectLabel to 'default'. If the script file was not found then false will 
	*	be returned.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			get_package( $PackageName , $PackageVersion = 'last' , $PackageScriptPath = false )
	{
		try
		{
			list( $Fetched , $Object ) = _try_fetch_from_cache( $PackageName , $PackageVersion );
		
			global		$ObjectLabel;
			if( $Fetched )
			{
				$ObjectLabel = 'default';
				return( $Object );
			}
			
			_fill_package_paths_cache( $PackageName , $PackageVersion , $PackageScriptPath );
			_store_package_path( $PackageName , $PackageVersion );
			$PackageClassName = _package_script_fast_load( $PackageName , $PackageVersion );
			
			$Key = "$PackageName $PackageVersion $ObjectLabel";
			_store_package_object( $PackageClassName , $Key );

			return( _get_package_from_cache( $Key ) );
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}
	
	$GetPackageObjectCache = array();
	
	/**
	*	\~russian Выбор копии объекта пакета.
	*
	*	@param $PackageName - имя пакета.
	*
	*	@param $PackageVersion - версия пакета. Если last, функция вернет самую последнюю версию.
	*
	*	@param $PackageScriptPath - путь к файлу скрипта пакета.
	*
	*	@return Ссылка на объект класса пакета.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Selecting copy of package object.
	*
	*	@param $PackageName - name of the package.
	*
	*	@param $PackageVersion - package's version. In case string 'last' is passed, then function returns 
	*	the latest version.
	*
	*	@param $PackageScriptPath - path to the package's script.
	*
	*	@return Reference on package's object.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			get_package_object( $PackageName , $PackageVersion = 'last' , $PackageScriptPath = false )
	{
		try
		{
			list( $PackageName , $PackageVersion ) = _get_package_info_after_rewrites( 
				$PackageName , $PackageVersion , $PackageScriptPath
			);

			global		$GetPackageObjectCache;
			$Key = "$PackageName $PackageVersion";

			if( isset( $GetPackageObjectCache[ $Key ] ) === false )
			{
				get_package( $PackageName , $PackageVersion , $PackageScriptPath );

				$GetPackageObjectCache[ $Key ] = _get_requested_class_name();
			}

			$ClassName = $GetPackageObjectCache[ $Key ];

			return( new $ClassName() );
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}
?>