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
	class	package_manager_controller_1_0_0{
	
		/**
		*	\~russian Функция установки пакета.
		*
		*	@param $Options - настройки работы модуля.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function installs package.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			install_package( $Options )
		{
			try
			{
				$Security = get_package( 'security' , 'last' , __FILE__ );
				$PackageAlgoritms = get_package( 'core::package_algorithms' , 'last' , __FILE__ );
				$MasterPackage = explode( '#' , $Security->get_gp( 'package_selection' , 'string' ) );
				$PackageAlgoritms->install_package( 
					$UploadFileAccess->UploadedFilePath , $MasterPackage[ 0 ] , $MasterPackage[ 1 ]
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Функция удаления пакета.
		*
		*	@param $Options - настройки работы модуля.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function deletes package.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			delete_package( $Options )
		{
			try
			{
				$Security = get_package( 'security' , 'last' , __FILE__ );
				$PackageName = $Security->get_gp( 'package_name' , 'string' );
				$PackageVersion = $Security->get_gp( 'package_version' , 'string' );
				
				$ROOT_DIR = _get_root_dir( $PackageName , $PackageVersion , INSTALL_DIR );
				$PackageDirectory = _get_package_path( $PackageName , $PackageVersion , $ROOT_DIR );
				
				_delete_package( $PackageName , $PackageVersion );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Контроллер компонента.
		*
		*	@param $Options - настройки работы модуля.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Controller of the component.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			controller( $Options )
		{
			try
			{
				$Context = get_package( 'gui::context' , 'last' , __FILE__ );
				
				$Context->load_config( dirname( __FILE__ ).'/conf/cfcx_delete_package' );
				if( $Context->execute( $Options , $this ) )return;
				
				$Context->load_config( dirname( __FILE__ ).'/conf/cfcx_install_package' );
				if( $Context->execute( $Options , $this ) )return;
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>