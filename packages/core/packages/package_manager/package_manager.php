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
	class				package_manager_1_0_0{

		/**
		*	\~russian Результат работы функций отображения
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english View output.
		*
		*	@author Dodonov A.A.
		*/
		var					$Output = false;

		/**
		*	\~russian Закешированные объекты.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cached objects.
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
				$ContextSet = get_package( 'gui::context_set' , 'last' , __FILE__ );

				$ContextSet->add_context( dirname( __FILE__ ).'/conf/cfcx_delete_package' );
				$ContextSet->add_context( dirname( __FILE__ ).'/conf/cfcx_install_package' );

				if( $ContextSet->execute( $Options , $this , __FILE__ ) )
				{
					return;
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Компиляция ветки.
		*	
		*	@param $Branch - Код ветки.
		*
		*	@param $Package - Пакет.
		*
		*	@return HTML код ветки дерева.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles branch.
		*	
		*	@param $Branch - Branch code.
		*
		*	@param $Package - Package.
		*
		*	@return HTML code of the tree branch.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_package_tree_branch( $Branch , $Package )
		{
			try
			{
				$Title = $Package[ 'package_name' ].'.'.$Package[ 'package_version' ];

				$Branch .= $this->CachedMultyFS->get_template( __FILE__ , 'package_item_start.tpl' );

				$Branch = str_replace( '{title}' , $Title , $Branch );

				$Branch .= $this->show_package_tree_rec( $Package[ 'subpackages' ] );

				$Branch .= $this->CachedMultyFS->get_template( __FILE__ , 'package_item_end.tpl' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция отрисовки компонента.
		*
		*	@param $Packages - Пакеты.
		*
		*	@return HTML код ветки дерева.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws component.
		*
		*	@param $Packages - Packages.
		*
		*	@return HTML code of the tree branch.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			show_package_tree_rec( $Packages )
		{
			try
			{
				if( isset( $Packages[ 0 ] ) == false )
				{
					return( '' );
				}

				$Branch = $this->CachedMultyFS->get_template( __FILE__ , 'package_branch_start.tpl' );

				foreach( $Packages as $i => $Package )
				{
					$Branch = $this->compile_package_tree_branch( $Branch , $Package );
				}

				return( $Branch.$this->CachedMultyFS->get_template( __FILE__ , 'package_branch_end.tpl' ) );
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
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws component.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			show_package_tree( $Options )
		{
			try
			{
				$PackageAlgorithms = get_package( 'core::package_algorithms' , 'last' , __FILE__ );
				$Packages = $PackageAlgorithms->get_packages_tree();

				$this->Output = $this->CachedMultyFS->get_template( __FILE__ , 'package_start.tpl' );

				foreach( $Packages as $i => $Package )
				{
					$this->Output = $this->compile_package_tree_branch( $this->Output , $Package );
				}

				$this->Output .= $this->CachedMultyFS->get_template( __FILE__ , 'package_end.tpl' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция отрисовки мета файлов.
		*
		*	@param $MetaFiles - Мета-файлы.
		*
		*	@return HTML код ветки дерева.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws meta files.
		*
		*	@param $MetaFiles - Meta-files.
		*
		*	@return HTML code of the tree branch.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			show_system_tree_meta_rec( $MetaFiles )
		{
			try
			{
				if( isset( $MetaFiles[ 0 ] ) == false )
				{
					return( '' );
				}

				$Branch = $this->CachedMultyFS->get_template( __FILE__ , 'package_meta_start.tpl' );

				foreach( $MetaFiles as $i => $File )
				{
					$Title = basename( $File );

					$Branch .= $this->CachedMultyFS->get_template( __FILE__ , 'package_meta_item.tpl' );

					$Branch = str_replace( '{title}' , $Title , $Branch );
				}

				return( $Branch.$this->CachedMultyFS->get_template( __FILE__ , 'package_meta_end.tpl' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция отрисовки конфиг файлов.
		*
		*	@param $MetaFiles - Конфиги.
		*
		*	@return HTML код ветки дерева.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws config files.
		*
		*	@param $MetaFiles - Config files.
		*
		*	@return HTML code of the tree branch.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			show_system_tree_conf_rec( $ConfigFiles )
		{
			try
			{
				if( isset( $ConfigFiles[ 0 ] ) == false )
				{
					return( '' );
				}

				$Branch = $this->CachedMultyFS->get_template( __FILE__ , 'package_conf_start.tpl' );

				foreach( $ConfigFiles as $i => $File )
				{
					$Title = basename( $File );

					$Branch .= $this->CachedMultyFS->get_template( __FILE__ , 'package_conf_item.tpl' );

					$Branch = str_replace( '{title}' , $Title , $Branch );
				}

				return( $Branch.$this->CachedMultyFS->get_template( __FILE__ , 'package_conf_end.tpl' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Компиляция ветки.
		*	
		*	@param $Branch - Код ветки.
		*
		*	@param $Package - Пакет.
		*
		*	@return HTML код ветки дерева.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles branch.
		*	
		*	@param $Branch - Branch code.
		*
		*	@param $Package - Package.
		*
		*	@return HTML code of the tree branch.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_system_tree_branch( $Branch , $Package )
		{
			try
			{
				$Title = $Package[ 'package_name' ].'.'.$Package[ 'package_version' ];

				$Branch .= $this->CachedMultyFS->get_template( __FILE__ , 'package_system_item_start.tpl' );

				$Branch  = str_replace( '{title}' , $Title , $Branch );

				$Branch .= $this->show_system_tree_rec( $Package[ 'subpackages' ] );

				$Branch .= $this->show_system_tree_meta_rec( $Package[ 'meta' ] );

				$Branch .= $this->show_system_tree_conf_rec( $Package[ 'conf' ] );

				$Branch .= $this->CachedMultyFS->get_template( __FILE__ , 'package_system_item_end.tpl' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция отрисовки компонента.
		*
		*	@param $Packages - Пакеты.
		*
		*	@return HTML код ветки дерева.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws component.
		*
		*	@param $Packages - Packages.
		*
		*	@return HTML code of the tree branch.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			show_system_tree_rec( $Packages )
		{
			try
			{
				if( isset( $Packages[ 0 ] ) == false )
				{
					return( '' );
				}

				$Branch = $this->CachedMultyFS->get_template( __FILE__ , 'package_system_start.tpl' );

				foreach( $Packages as $i => $Package )
				{
					$Branch = $this->compile_system_tree_branch( $Branch , $Package );
				}

				return( $Branch.$this->CachedMultyFS->get_template( __FILE__ , 'package_system_end.tpl' ) );
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
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws component.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			show_system_tree( $Options )
		{
			try
			{
				$PackageAlgorithms = get_package( 'core::package_algorithms' , 'last' , __FILE__ );
				$Packages = $PackageAlgorithms->get_packages_tree();

				$this->Output = $this->CachedMultyFS->get_template( __FILE__ , 'system_start.tpl' );

				foreach( $Packages as $i => $Package )
				{
					$this->Output = $this->compile_system_tree_branch( $this->Output , $Package );
				}

				$this->Output .= $this->CachedMultyFS->get_template( __FILE__ , 'system_end.tpl' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция отрисовки компонента.
		*
		*	@param $Options - настройки работы модуля.
		*
		*	@return HTML код компонента.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws component.
		*
		*	@param $Options - Settings.
		*
		*	@return HTML code of the компонента.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			view( $Options )
		{
			try
			{				
				$ContextSet = get_package( 'gui::context_set' , 'last' , __FILE__ );

				$ContextSet->add_context( dirname( __FILE__ ).'/conf/cfcx_show_package_tree' );				
				$ContextSet->add_context( dirname( __FILE__ ).'/conf/cfcx_show_system_tree' );

				if( $ContextSet->execute( $Options , $this , __FILE__ ) )
				{
					return( $this->Output );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>