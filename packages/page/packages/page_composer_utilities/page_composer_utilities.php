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
	class	page_composer_utilities_1_0_0{

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
		var					$PageCSS = false;
		var					$PageJS = false;
		var					$Security = false;
		var					$String = false;
		var					$Tags = false;
		var					$TemplateManager = false;
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
				$this->PageCSS = get_package( 'page::page_css' , 'last' , __FILE__ );
				$this->PageJS = get_package( 'page::page_js' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
				$this->Tags = get_package( 'string::tags' , 'last' , __FILE__ );
				$this->TemplateManager = get_package( 'template_manager' , 'last' , __FILE__ );
				$this->Trace = get_package( 'trace' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Редирект.
		*
		*	@param $Options - Настройки.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Redirect.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			redirect_using_map( &$Options )
		{
			try
			{
				$PageName = $this->Security->get_gp( 'page_name' , 'command' );
				$RedirectPage = $Options->get_setting( $PageName , false );
				if( $RedirectPage === false )
				{
					$RedirectPage = $Options->get_setting( '*' , false );
				}
				if( $RedirectPage === false )
				{
					return;
				}
				header( "HTTP/1.1 301 Moved Permanently" );
				if( $RedirectPage == 'self' )
				{
					header( "Location: $PageName.html" );
				}
				else
				{
					header( "Location: ".$this->Security->get_srv( 'REQUEST_URI' , 'string' ) );
				}
				exit( 0 );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Вывод трассировки (при необходимости).
		*
		*	@param $PageComposer - Компоновщик страниц.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function outputs trace if necessary.
		*
		*	@param $PageComposer - Page composer.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			output_trace_if_necessary( &$PageComposer )
		{
			try
			{
				$AutoMarkup = get_package( 'page::auto_markup' , 'last' , __FILE__ );

				if( $this->Security->get_gp( 'trace' , 'integer' , 0 ) )
				{
					$String = $PageComposer->Template->get_template();
					$String = str_replace( '{trace}' , $this->Trace->compile_trace() , $String );
					$String = $AutoMarkup->compile_string( $String );
					$PageComposer->Template->set_template( $String );
				}
				elseif( $this->Security->get_gp( 'trace_only' , 'integer' , 0 ) )
				{
					$String = $this->Trace->compile_trace();
					$String = $AutoMarkup->compile_string( $String );
					print( $String );
					exit( 0 );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Проверка доступов.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Validating permits.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			page_permit_validation( &$Options )
		{
			try
			{
				$this->Trace->add_trace_string( 'page_permit_validation' );

				if( $Options->get_setting( 'page_permit_validation' , false ) )
				{
					$Permits = get_package( 'permit::permit_algorithms' , 'last' , __FILE__ );
					$PageName = $this->Security->get_g( 'page_name' , 'command' );
					
					if( $Permits->validate_permits( false , 'user' , $PageName , 'page' ) === false )
					{
						header( 'Location: ./no_permits.html' );
						exit( 1 );
					}
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Загрузка шаблона.
		*
		*	@param $PageDescription - Описание страницы.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function gets template.
		*
		*	@param $PageDescription - Page description.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_template_for_package( $PageDescription )
		{
			try
			{
				$this->TemplateName = $PageDescription[ 'template' ];
				$this->TemplateVersion = $PageDescription[ 'template_version' ];

				return( $this->TemplateManager->get_template( $this->TemplateName , $this->TemplateVersion ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение информации о шаблоне.
		*
		*	@param $PageComposer - Компоновщик страниц.
		*
		*	@param $PageDescription - Описание страницы.
		*
		*	@return Описание страницы.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function loads template info.
		*
		*	@param $PageComposer - Page composer.
		*
		*	@param $PageDescription - Page description.
		*
		*	@return Page description.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			translate_template_name( &$PageComposer , &$PageDescription )
		{
			try
			{
				$Default = $PageDescription[ 'template' ] == 'default';
				$DefaultAdmin = $PageDescription[ 'template' ] == 'default_admin';
				
				if( $Default || $DefaultAdmin )
				{
					$PageComposer->Template = $Default ? 
										$this->TemplateManager->get_default_template_name() : 
										$this->TemplateManager->get_default_admin_template_name();

					$Data = array( $PageComposer->Template[ 'name' ] , $PageComposer->Template[ 'version' ] );
					list( $PageDescription[ 'template' ] , $PageDescription[ 'template_version' ] ) = $Data;
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>