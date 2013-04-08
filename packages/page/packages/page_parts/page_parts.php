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
	*	\~russian Утилиты компоновки страниц.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Page composer utilities.
	*
	*	@author Dodonov A.A.
	*/
	class	page_parts_1_0_0{

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
		var					$Cache = false;
		var					$CachedMultyFS = false;
		var					$PageComposer = false;
		var					$PageMarkupUtilities = false;
		var					$Settings = false;
		var					$String = false;
		var					$Trace = false;

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
				$this->Cache = get_package( 'cache' , 'last' , __FILE__ );
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->PageMarkupUtilities = get_package( 
					'page::page_markup::page_markup_utilities' , 'last' , __FILE__
				);
				$this->Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
				$this->Trace = get_package( 'trace' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Выбрасывание исключения о ненайденном методе.
		*
		*	@param $p - Информация о пакете.
		*
		*	@param $FunctionName - Название функции.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function throws exception that method was not found.
		*
		*	@param $p - Package data.
		*
		*	@param $FunctionName - Function name.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			throw_method_was_not_found_exception( $p , $FunctionName )
		{
			$ClassName = $p[ 'fetched_package' ] !== false ? get_class( $p[ 'fetched_package' ] ) : 'false';

			$PackageFullName = $p[ 'package' ].'.'.$p[ 'package_version' ];

			throw( 
				new Exception( 
					'Function "'.$FunctionName.'" was not found in class "'.$ClassName.
						'" from package '.$PackageFullName
				)
			);
		}

		/**
		*	\~russian Получение глобальных настроек пакета.
		*
		*	@param $PackageName - Название пакета.
		*
		*	@param $PackageVersion - Версия пакета.
		*
		*	@return строка с настройками.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Getting global settings of the package.
		*
		*	@param $PackageName - Package name.
		*
		*	@param $PackageVersion - Package version.
		*
		*	@return string with settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_settings_for_package( $PackageName , $PackageVersion )
		{
			try
			{
				$PackageDirectory = _get_package_relative_path_ex( $PackageName , $PackageVersion );

				if( $this->CachedMultyFS->file_exists( "$PackageDirectory/conf/cf_global_settings" ) )
				{
					return( $this->CachedMultyFS->file_get_contents( "$PackageDirectory/conf/cf_global_settings" ) );
				}
				else
				{
					return( '' );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение контроллера.
		*
		*	@param $PackageName - название пакета.
		*
		*	@param $PackageVersion - версия пакета.
		*
		*	@return объект контроллера.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns controller.
		*
		*	@param $PackageName - package name.
		*
		*	@param $PackageVersion - package version.
		*
		*	@return controller object.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_controller( $PackageName , $PackageVersion )
		{
			try
			{
				$Package = get_package( $PackageName , $PackageVersion , __FILE__ );

				if( $Package === false )
				{
					$Package = get_package_object( 'page::auto_controller' , 'last' , __FILE__ );
					$Package->set_path( _get_package_relative_path_ex( 
						$PackageName , $PackageVersion ).'/unexisting_controller.php'
					);
				}

				return( $Package );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение вида.
		*
		*	@param $PackageName - название пакета.
		*
		*	@param $PackageVersion - версия пакета.
		*
		*	@return объект вида.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns view.
		*
		*	@param $PackageName - package name.
		*
		*	@param $PackageVersion - package version.
		*
		*	@return view object.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_view( $PackageName , $PackageVersion )
		{
			try
			{
				$Package = get_package( $PackageName , $PackageVersion , __FILE__ );
				if( $Package === false )
				{
					$Package = get_package_object( 'page::auto_view' , 'last' , __FILE__ );
					$Package->set_path( 
						_get_package_relative_path_ex( $PackageName , $PackageVersion ).'/unexisting_view.php'
					);
				}
				return( $Package );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция возвращает список пакетов, применяемых к странице.
		*
		*	@param $Page - Объект page::page_access.
		*
		*	@param $PageName - Имя компонуемой страницы.
		*
		*	@param $PageOptions - Настройки генерации.
		*
		*	@return HTML код скомпонованной страницы.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns list of packages.
		*
		*	@param $Page - Object of the page::page_access class.
		*
		*	@param $PageName - Name of the composing page.
		*
		*	@param $PageOptions - Generation options.
		*
		*	@return HTML code of the composed page.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_predefined_packages( $PageOptions )
		{
			try
			{
				$this->Settings->load_settings( $PageOptions );
				$PredefinedPackages = array();
				if( $this->Settings->get_setting( 'predefined_packages' , false ) )
				{
					$Raw = $this->CachedMultyFS->file_get_contents( 
						dirname( __FILE__ ).'/conf/cf_predefined_packages' , 'exploded'
					);
					foreach( $Raw as $Value )
					{
						$Tmp = explode( '#' , $Value );
						$PredefinedPackages [] = array( 
							'package' => $Tmp[ 0 ] , 'package_version' => $Tmp[ 1 ] , 
							'options' => $Tmp[ 2 ] , 'placeholder' => $Tmp[ 3 ]
						);
					}
				}
				return( $PredefinedPackages );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция возвращает список пакетов, применяемых к странице.
		*
		*	@param $Page - Объект page::page_access.
		*
		*	@param $PageName - Имя компонуемой страницы.
		*
		*	@param $PageOptions - Настройки генерации.
		*
		*	@return HTML код скомпонованной страницы.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns list of packages.
		*
		*	@param $Page - Object of the page::page_access class.
		*
		*	@param $PageName - Name of the composing page.
		*
		*	@param $PageOptions - Generation options.
		*
		*	@return HTML code of the composed page.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_package_appliance( $Page , $PageName , $PageOptions )
		{
			try
			{
				$PagePackages = $Page->get_package_appliance( $PageName );
				$PredefinedPackages = $this->get_predefined_packages( $PageOptions );

				return( array_merge( $PredefinedPackages , $PagePackages ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция загрузки настроек.
		*
		*	@param $Package - Пакет.
		*
		*	@param $Template - Шаблон.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function loads package's settings.
		*
		*	@param $Package - Package.
		*
		*	@param $Template - Template.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			load_settings_for_package( &$Package , &$Template )
		{
			try
			{
				$Package[ 'settings' ] = get_package_object( 'settings::settings' , 'last' , __FILE__ );

				$GlobalSettings = $this->get_settings_for_package( 
					$Package[ 'package' ] , $Package[ 'package_version' ]
				);

				$Package[ 'settings' ]->load_settings( $GlobalSettings );
				$Package[ 'settings' ]->append_settings( $Package[ 'options' ] );

				$PlaceHolderParameters = $Template->get_placeholder_parameters( $Package[ 'placeholder' ] );

				if( $PlaceHolderParameters !== false )
				{
					$Package[ 'settings' ]->append_settings( $PlaceHolderParameters );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция выборки пакетов страницы.
		*
		*	@param $p - Пакеты.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function fetches packages for the generating page.
		*
		*	@param $p - Packages.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function		get_package_for_description( &$p )
		{
			try
			{
				if( $p[ 'settings' ]->get_setting( 'controller' , false ) == '1' )
				{
					$p[ 'fetched_package' ] = $this->get_controller( $p[ 'package' ] , $p[ 'package_version' ] );
				}
				elseif( $p[ 'settings' ]->get_setting( 'view' , false ) == '1' )
				{
					$p[ 'fetched_package' ] = $this->get_view( $p[ 'package' ] , $p[ 'package_version' ] );
				}
				else
				{
					$p[ 'fetched_package' ] = get_package( $p[ 'package' ] , $p[ 'package_version' ] , __FILE__ );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция выборки пакетов страницы.
		*
		*	@param $Packages - Пакеты.
		*
		*	@param $Template - Шаблон.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function fetches packages for the generating page.
		*
		*	@param $Packages - Packages.
		*
		*	@param $Template - Template.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			fetch_packages( &$Packages , &$Template )
		{
			try
			{
				foreach( $Packages as $i => $p )
				{
					$this->load_settings_for_package( $Packages[ $i ] , $Template );

					if( $Packages[ $i ][ 'settings' ]->get_setting( 'meta' , false ) !== false )
					{
						$PackagePath = _get_package_relative_path_ex( $p[ 'package' ] , $p[ 'package_version' ] );
						$MetaFileName = $Packages[ $i ][ 'settings' ]->get_setting( 'meta' );
						$MetaSettings = $this->CachedMultyFS->file_get_contents( "$PackagePath/meta/$MetaFileName" );
						$Packages[ $i ][ 'settings' ]->append_settings( $MetaSettings );
					}

					$this->get_package_for_description( $Packages[ $i ] );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Обработка генераторов.
		*
		*	@param $Packages - Пакеты.
		*
		*	@param $Type - Тип генератора для запуска.
		*
		*	@param $Template - Шаблон.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function runs generators.
		*
		*	@param $Packages - Packages.
		*
		*	@param $Type - Generator type.
		*
		*	@param $Template - Template.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			execute_generators( &$Packages , $Type , &$Template )
		{
			try
			{
				$this->Trace->start_group( $Type );

				$Template->add_stylesheets();
				foreach( $Packages as $i => $p )
				{
					if( $p[ 'settings' ]->get_setting( $Type , false ) )
					{
						if( method_exists( $p[ 'fetched_package' ] , $Type ) )
						{
							$this->Trace->start_group( get_class( $p[ 'fetched_package' ] ) );
							$Caller = array( $p[ 'fetched_package' ] , $Type );
							$Tmp = &$p[ 'settings' ];
							call_user_func( $Caller , $Tmp );
							$this->Trace->end_group();
							continue;
						}
						$this->throw_method_was_not_found_exception( $p , $Type );
					}
				}

				$this->Trace->end_group();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Обработка контроллера.
		*
		*	@param $p - Пакет.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes controller.
		*
		*	@param $p - Package.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	run_single_controller( &$p )
		{
			try
			{
				$ClassName = get_class( $p[ 'fetched_package' ] );

				$this->Trace->start_group( "controller : $ClassName" );

				$p[ 'fetched_package' ]->controller( $p[ 'settings' ] );

				$this->Trace->end_group();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Обработка контроллеров.
		*
		*	@param $Packages - Пакеты.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes controllers.
		*
		*	@param $Packages - Packages.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_controllers( &$Packages )
		{
			try
			{
				$this->Trace->start_group( "controllers" );

				foreach( $Packages as $i => $p )
				{
					if( $p[ 'settings' ]->get_setting( 'controller' , false ) )
					{
						if( method_exists( $p[ 'fetched_package' ] , 'controller' ) )
						{
							$this->run_single_controller( $p );
						}
						else
						{
							$this->throw_method_was_not_found_exception( $p , 'controller' );
						}
					}
				}

				$this->Trace->end_group();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Обработка вида.
		*
		*	@param $p - Пакет.
		*
		*	@param $Template - Шаблон.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes view.
		*
		*	@param $p - Package.
		*
		*	@param $Template - Template.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	run_single_view( &$p , &$Template )
		{
			try
			{
				if( $p[ 'settings' ]->get_setting( 'cached' , false ) == 1 && 
					$this->Cache->data_exists( $p[ 'options' ] ) )
				{
					$View = $this->Cache->get_data( $p[ 'options' ] );
				}
				else
				{
					$this->Trace->start_group( "view : ".get_class( $p[ 'fetched_package' ] ) );

					$View = $p[ 'fetched_package' ]->view( $p[ 'settings' ] );

					$View = $this->PageMarkupUtilities->wrap_control_view( 
						$p[ 'settings' ] , $View
					);

					$this->Cache->add_data( $p[ 'options' ] , $View );

					$this->Trace->end_group();
				}

				$Template->parse( $p[ 'placeholder' ] , $View );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Обработка видов.
		*
		*	@param $Packages - Пакеты.
		*
		*	@param $Template - Шаблон.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes views.
		*
		*	@param $Packages - Packages.
		*
		*	@param $Template - Template.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_views( &$Packages , &$Template )
		{
			try
			{
				$this->Trace->start_group( "views" );

				foreach( $Packages as $i => $p )
				{
					if( $p[ 'placeholder' ] != '' )
					{
						if( $p[ 'settings' ]->get_setting( 'view' , false ) )
						{
							if( $p[ 'fetched_package' ] !== false && method_exists( $p[ 'fetched_package' ] , 'view' ) )
							{
								$this->run_single_view( $p , $Template );
							}
							else
							{
								$this->throw_method_was_not_found_exception( $p , 'view' );
							}
						}
					}
				}

				$this->Trace->end_group();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>