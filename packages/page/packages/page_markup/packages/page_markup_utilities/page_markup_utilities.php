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
	*	\~russian Класс обработки макросов страницы.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class processes page's macro.
	*
	*	@author Dodonov A.A.
	*/
	class	page_markup_utilities_1_0_0
	{

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
		var					$Security = false;
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
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->Trace = get_package( 'trace' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция добавления метапараметров.
		*
		*	@param $Options - Настройки работы функции.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function adds meta parameters.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			add_meta_parameters( &$Options )
		{
			try
			{
				$PackageName = $Options->get_setting( 'package_name' );
				$PackageVersion = $Options->get_setting( 'package_version' , 'last' );

				if( $Options->get_setting( 'meta' , false ) !== false )
				{
					$PackagePath = _get_package_relative_path_ex( $PackageName , $PackageVersion );
					$MetaFileName = $Options->get_setting( 'meta' );
					$MetaSettings = $this->CachedMultyFS->file_get_contents( "$PackagePath/meta/$MetaFileName" );
					$Options->append_settings( $MetaSettings );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция вызова контроллера.
		*
		*	@param $Package - Пакет.
		*
		*	@param $Options - Настройки работы функции.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function calls component's controller.
		*
		*	@param $Package - Package.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	call_controller( &$Package , &$Options )
		{
			try
			{
				if( method_exists( $Package , 'controller' ) === false )
				{
					throw( new Exception( 'Function "controller" was not found for class '.get_class( $Package ) ) );
				}
				else
				{
					$Class = get_class( $Package );
					$this->Trace->add_trace_string( "{lang:running_direct_controller} for the class $Class" , COMMON );

					$Package->controller( $Options );

					$this->Trace->add_trace_string( "{lang:ending_direct_controller} for the class $Class" , COMMON );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция контроллера компонента.
		*
		*	@param $Options - Настройки работы функции.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function calls component's controller.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			direct_controller( &$Options )
		{
			try
			{
				$this->Security->reset_s( 'direct_controller' , 1 );

				$this->Trace->add_trace_string( '{lang:processing_direct_controller}' , COMMON );

				$PackageName = $Options->get_setting( 'package_name' );
				$PackageVersion = $Options->get_setting( 'package_version' , 'last' );
				$Package = get_package( $PackageName , $PackageVersion , __FILE__ );

				$this->add_meta_parameters( $Options );

				$this->call_controller( $Package , $Options );

				$this->Security->reset_s( 'direct_controller' , 0 );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Оборачивание вида в div.
		*
		*	@param $Options - Настройки генерации.
		*
		*	@param $ControlView - Сгенерированный контрол.
		*
		*	@return HTML код контрола.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Wrapping control in it's own div.
		*
		*	@param $Options - Generation settings.
		*
		*	@param $ControlView - Generated control.
		*
		*	@return Control's HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			wrap_control_view( &$Options , $ControlView )
		{
			try
			{
				$Class = $Options->get_setting( 'wrapper_class' , false );
				if( $Class !== false )
				{
					$Class = " class=\"$Class\"";
				}

				$Id = $Options->get_setting( 'wrapper_id' , false );
				if( $Id !== false )
				{
					$Id = " id=\"$Id\"";
				}

				if( $Id || $Class )
				{
					$PlaceHolders = array( '{id}' , '{class}' , '{control_view}' );
					$ViewWrapper = $this->CachedMultyFS->get_template( __FILE__ , 'view_wrapper.tpl' );
					$ControlView = str_replace( $PlaceHolders , array( $Id , $Class , $ControlView ) , $ViewWrapper );
				}
				
				return( $ControlView );
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
		function			direct_view( &$Options )
		{
			try
			{
				$PackageName = $Options->get_setting( 'package_name' );
				$PackageVersion = $Options->get_setting( 'package_version' , 'last' );
				$Package = get_package( $PackageName , $PackageVersion , __FILE__ );

				$this->add_meta_parameters( $Options );

				if( method_exists( $Package , 'view' ) === false )
				{
					throw( new Exception( 'Function "view" was not found for class '.get_class( $Package ) ) );
				}
				else
				{
					$ControlView = $Package->view( $Options );
					$ControlView = $this->wrap_control_view( $Options , $ControlView );
					return( $ControlView );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>