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

	global $CachedFiles;
	$CachedFiles = array();

	/**
	*	\~russian Очистка кэша.
	*
	*	@author Dodonov A.A.
	*/
	/**
	*	\~english Clear cache.
	*
	*	@author Dodonov A.A.
	*/
	function			_drop_cached_package_files()
	{
		global	$CachedFiles;
		$CachedFiles = array();
	}

	/**
	*	\~russian Получение содержимого файла с кэшированием.
	*
	*	@param $FilePath - Загружаемый файл.
	*
	*	@return Содержимое загружаемого файла.
	*
	*	@author Dodonov A.A.
	*/
	/**
	*	\~english Function loads file and cache it.
	*
	*	@param $FilePath - Path to the loading file.
	*
	*	@return Content of the loaded file.
	*
	*	@author Dodonov A.A.
	*/
	function			_file_get_contents( $FilePath )
	{
		global	$CachedFiles;

		if( isset( $CachedFiles[ $FilePath ] ) === false )
		{
			$CachedFiles[ $FilePath ] = @file_get_contents( $FilePath );
		}

		return( $CachedFiles[ $FilePath ] );
	}

	global	$LoadedPackagesPaths;
	$LoadedPackagesPaths = array();

	/**
	*	\~russian Функция вызвращает массив путей к загруженным пакетам.
	*
	*	@return Масив путей к загруженным пакетам.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~russian Function returns array of paths to the loaded packages.
	*
	*	@return Array of paths to the loaded packages.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_get_loaded_packages_paths()
	{
		try
		{
			global 	$LoadedPackagesPaths;

			return( $LoadedPackagesPaths );
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}

	global					$_parsed_objects;
	$_parsed_objects = array();

	/**
	*	\~russian Возвращение обработанных данных.
	*
	*	@param $k - Ключ.
	*
	*	@param $v - Данные для отображения.
	*
	*	@return Обработанные данные.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function prcesses data.
	*
	*	@param $k - Key.
	*
	*	@param $v - Data for displaying.
	*
	*	@return Processed data.
	*
	*	@author Dodonov A.A.
	*/
	function			_compile_data( $k , $v )
	{
		if( is_object( $v ) || is_array( $v ) )
		{
			global					$_parsed_objects;

			if( in_array( $k , $_parsed_objects ) === false || is_numeric( $k ) )
			{
				$_parsed_objects[] = $k;
				$Data = base64_encode( ' { '._collapse_params( $v ).' } ' );
			}
			else
			{
				$Data = base64_encode( ' {X} ' );
			}
		}
		else
		{
			$Data = base64_encode( _collapse_params( $v ).' ' );
		}

		return( $Data );
	}

	/**
	*	\~russian Возвращение обработанных параметров.
	*
	*	@param $Params - Параметры для отображения.
	*
	*	@return Обработанные параметры.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function processes parameters.
	*
	*	@param $Params - Parameters for displaying.
	*
	*	@return Processed parameters.
	*
	*	@author Dodonov A.A.
	*/
	function				_return_params( $Params )
	{
		if( $Params === false )
		{
			return( 'false' );
		}
		elseif( $Params === true )
		{
			return( 'true' );
		}
		else
		{
			return( $Params );
		}
	}

	global					$_collapse_span_id;
	$_collapse_span_id = 0;

	/**
	*	\~russian Возвращение скомпилированных параметров.
	*
	*	@param $Params - Параметры для компиляции.
	*
	*	@return Скомпилированные параметры.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function compiles parameters.
	*
	*	@param $Params - Parameters for displaying.
	*
	*	@return Compiled parameters.
	*
	*	@author Dodonov A.A.
	*/
	function			_compile_params( $Params )
	{
		global					$_collapse_span_id;

		$Str = ' ';

		foreach( $Params as $k => $v )
		{
			$Data = _compile_data( $k , $v );

			$_collapse_span_id += 1;
			$id = $_collapse_span_id;

			$PlaceHolders = array( '{id}' , '{data}' , '{k}' );

			$Template = _file_get_contents( dirname( __FILE__ ).'/../../res/templates/func_link.tpl' );

			$Str .= str_replace( $PlaceHolders , array( $id , $Data , $k ) , $Template );
		}

		return( $Str );
	}

	/**
	*	\~russian Функция свертывания параметров.
	*
	*	@param $Params - Параметры для отображения.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function collapses parameters.
	*
	*	@param $Params - Data for displaying.
	*
	*	@author Dodonov A.A.
	*/
	function				_collapse_params( &$Params )
	{
		if( is_array( $Params ) && count( $Params ) == 0 )
		{
			return( '' );
		}

		if( is_array( $Params ) || is_object( $Params ) )
		{
			return( _compile_params( $Params ) );
		}
		else
		{
			return( _return_params( $Params ) );
		}
	}

	/**
	*	\~russian Функция создания объекта исключения.
	*
	*	@param $Method - Метод.
	*
	*	@param $Args - Аргументы.
	*
	*	@param $ExceptionObject - Объект пойманного исключения.
	*
	*	@return Объект исключения.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function creates exception object.
	*
	*	@param $Method - Method.
	*
	*	@param $Args - Arguments.
	*
	*	@param $ExceptionObject - Object of the caught exception.
	*
	*	@return Exception object.
	*
	*	@author Dodonov A.A.
	*/
	function			_get_exception_object( $Method , $Args , $ExceptionObject )
	{
		$ExceptionMessage = $ExceptionObject->getMessage();

		return( new Exception( "$Method("._collapse_params( $Args ).")::$ExceptionMessage" ) );
	}

	/**
	*	\~russian Функция бросает эксепшен.
	*
	*	@param $Method - Метод.
	*
	*	@param $Args - Аргументы.
	*
	*	@param $ExceptionObject - Exception object.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function throws exception.
	*
	*	@param $Method - Method.
	*
	*	@param $Args - Arguments.
	*
	*	@param $ExceptionObject - Object of the caught exception.
	*
	*	@author Dodonov A.A.
	*/
	function			_throw_exception_object( $Method , $Args , $ExceptionObject )
	{
		throw( _get_exception_object( $Method , $Args , $ExceptionObject ) );
	}

	/**
	*	\~russian Функция единственной замены подстроки.
	*
	*	@param $Pattern - Заменяемая строка.
	*
	*	@param $Replacement - Замены.
	*
	*	@param $Str - Строка.
	*
	*	@return Обработанная строка.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function replaces substring only once.
	*
	*	@param $Pattern - String to be replaced with.
	*
	*	@param $Replacement - Replacement.
	*
	*	@param $Str - String.
	*
	*	@return Processed string.
	*
	*	@author Dodonov A.A.
	*/
	function 			str_replace_once( $Pattern , $Replacement , $Str )
	{
		if( strpos( $Str , $Pattern ) !== false )
		{
			return( substr_replace( $Str , $Replacement , strpos( $Str , $Pattern ) , strlen( $Pattern ) ) );
		}

		return( $Str );
    } 
	
?>