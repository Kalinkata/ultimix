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
	*	\~russian Класс манипулирования пакетами.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class for manipulating objects.
	*
	*	@author Dodonov A.A.
	*/
	class	template_manager_1_0_0{
	
		/**
		*	\~russian Функция регистрации пакета с шаблоном.
		*
		*	@param $TemplateName - название шаблона.
		*
		*	@param $TemplateVersion - версия шаблона.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function registers new template.
		*
		*	@param $TemplateName - template name.
		*
		*	@param $TemplateVersion - template version.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			register_template( $TemplateName , $TemplateVersion )
		{
			try
			{
				$Security = get_package( 'security' , 'last' , __FILE__ );
				$TemplateName = $Security->get( $TemplateName , 'string' );
				$TemplateVersion = $Security->get( $TemplateVersion , 'string' );
				
				$Handle = fopen( dirname( __FILE__ ).'/data/template_list' , 'a+' );
				
				if( $Handle === false )
				{
					return( false );
				}
				
				$TemplateInfo = $TemplateName.'#'.$TemplateVersion."\r\n";
				
				fwrite( $Handle , $TemplateInfo , strlen( $TemplateInfo ) );
				
				fclose( $Handle );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция возвращает список шаблонов.
		*
		*	@return Список шаблонов в формате array( 'name' => 'template_name' , 'version' => 'template_version' ).
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns a list of templates.
		*
		*	@return List of templates.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_template_list()
		{
			try
			{
				$RawTemplateList = $this->CachedMultyFS->file_get_contents( 
					dirname( __FILE__ ).'/data/template_list' , 'exploded'
				);
				
				$TemplateList = array();
				
				foreach( $RawTemplateList as $rtl )
				{
					$rtl = str_replace( "\r" , '' , $rtl );
					$rtl = str_replace( "\n" , '' , $rtl );
					
					$Trinity = explode( '#' , $rtl );
					
					$TemplateList [] = array( 
						'name' => $Trinity[ 0 ] , 'version' => $Trinity[ 1 ] , 'default' => $Trinity[ 2 ]
					);
				}
				
				return( $TemplateList );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция компиляции формы со списком шаблонов.
		*
		*	@param $Templates - Шаблоны.
		*
		*	@return ХТМЛ с со списком шаблонов.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles list of templates.
		*
		*	@param $Templates - Template.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_template_list( $Templates )
		{
			try
			{
				$List = $this->CachedMultyFS->get_template( __FILE__ , 'templates_list_header.tpl' );

				foreach( $TemplateList as $tl )
				{
					$Template = $this->CachedMultyFS->get_template( __FILE__ , 'templates_list_item.tpl' );
					$PlaceHolders = array( '{name}' , '{version}' );
					$Data = array( $tl[ 'name' ] , $tl[ 'version' ] );
					$Template = str_replace( $PlaceHolders , $Data , $Template );
					$List .= $Template;
				}
				
				$List .= $this->CachedMultyFS->get_template( __FILE__ , 'templates_list_footer.tpl' );
				
				return( $List );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция для отрисовки формы со списком шаблонов.
		*
		*	@return ХТМЛ с со списком шаблонов.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws list of templates.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			draw_template_list()
		{
			try
			{
				if( ( $TemplateList = $this->get_template_list() ) === false )
				{
					return( false );
				}

				return( $this->compile_template_list( $Templates ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция возвращает имя дефолтного шаблона.
		*
		*	@return массив array( name => 'template name' , version => 'template version' ).
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns name of the default template.
		*
		*	@return array( name => 'template name' , version => 'template version' ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_default_template_name()
		{
			try
			{
				$Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				
				$Settings->load_file( dirname( __FILE__ ).'/conf/cf_template_manager_settings' );
				
				$Name = $Settings->get_setting( 'default_template_name' );
				$Version = $Settings->get_setting( 'default_template_version' , 'last' );
				
				return( array( 'name' => $Name , 'version' => $Version ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция возвращает имя дефолтного шаблона админки.
		*
		*	@return массив array( name => 'template name' , version => 'template version' ).
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns name of the default admin template.
		*
		*	@return array( name => 'template name' , version => 'template version' ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_default_admin_template_name()
		{
			try
			{
				$Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				
				$Settings->load_file( dirname( __FILE__ ).'/conf/cf_template_manager_settings' );
				
				$Name = $Settings->get_setting( 'default_admin_template_name' );
				$Version = $Settings->get_setting( 'default_admin_template_version' , 'last' );
				
				return( array( 'name' => $Name , 'version' => $Version ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция возвращает версию дефолтного шаблона.
		*
		*	@return версия дефолтного шаблона.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns version of the default template.
		*
		*	@return version of the default template.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_default_template_version()
		{
			try
			{
				$TemplateList = $this->get_template_list();
				
				foreach( $TemplateList as $tl )
				{
					if( $tl[ 'default' ] === 'default' )
					{
						return( $tl[ 'version' ] );
					}
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция возвращает указанный шаблон.
		*
		*	@param $TemplateName - название загружаемого шаблона.
		*
		*	@param $TemplateVersion -  версия загружаемого шаблона.
		*
		*	@return Объект шаблона.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns template package.
		*
		*	@param $TemplateName - name of the template.
		*
		*	@param $TemplateVersion - version of the loading template.
		*
		*	@return Object of the template.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_template( $TemplateName , $TemplateVersion )
		{
			try
			{
				$Template = get_package( "$TemplateName" , "$TemplateVersion" , __FILE__ );
				
				if( $Template === false )
				{
					$PackageDirectory = $this->get_template_path( $TemplateName , $TemplateVersion );
					
					$Template = get_package( 'template_manager::default_template_script' , 'last' , __FILE__ );
					$Template->set_template_path( $PackageDirectory."/unexisting_script.php" );
					
					return( $Template );
				}
				else
				{
					return( $Template );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция возвращает путь к шаблону страницы.
		*
		*	@param $TemplateName - name of the template.
		*
		*	@param $TemplateVersion - version of the loading template.
		*
		*	@return Путь к шаблону.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns path to the template package.
		*
		*	@param $TemplateName - name of the template.
		*
		*	@param $TemplateVersion - version of the loading template.
		*
		*	@return Path to the template.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_template_path( $TemplateName , $TemplateVersion )
		{
			try
			{
				return( _get_package_relative_path_ex( $TemplateName , $TemplateVersion ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>