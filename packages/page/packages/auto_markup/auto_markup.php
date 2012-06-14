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
	*	\~russian ����� ��� ���������� �����������.
	*
	*	@author ������� �.�.
	*/
	/**
	*	\~english View.
	*
	*	@author Dodonov A.A.
	*/
	class	auto_markup_1_0_0{
		
		/**
		*	\~russian �������������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Cached object.
		*
		*	@author Dodonov A.A.
		*/
		var					$CachedMultyFS = false;
		var					$Config = false;
		var					$MacroSettings = false;
		var					$StaticContentAccess = false;
		var					$String = false;
		var					$Utilities = false;
		
		/**
		*	\~russian �������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Configs.
		*
		*	@author Dodonov A.A.
		*/
		var					$StaticContentConfigs = false;
		
		/**
		*	\~russian �����������.
		*
		*	@exception Exception - �������� ���������� ����� ���� � ��������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Constructor.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			__construct()
		{
			try
			{
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->Config = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->MacroSettings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->TemplateContentAccess = get_package( 
					'page::template_content::template_content_access' , 'last' , __FILE__
				);
				$this->String = get_package( 'string' , 'last' , __FILE__ );
				$this->Utilities = get_package( 'utilities' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian �������� ��������.
		*
		*	@exception Exception - �������� ��������� ����� ���� � ��������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Function loads configs.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	load_template_contents_configs()
		{
			try
			{
				if( $this->StaticContentConfigs === false )
				{
					$this->StaticContentConfigs = $this->CachedMultyFS->get_config( __FILE__ , 'cf_template_contents' );
					$this->StaticContentConfigs = explode( "\n" , $this->StaticContentConfigs );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian ������� ��������� ����������������� ��������.
		*
		*	@param $Config - ��������� ������ ������.
		*
		*	@param $MacroSettings - ��������� �������.
		*
		*	@return HTML ���.
		*
		*	@exception Exception - �������� ��������� ����� ���� � ��������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Function processes parametrized macroes.
		*
		*	@param $Config - Settings.
		*
		*	@param $MacroSettings - Macro settings.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_macro( &$Config , &$MacroSettings )
		{
			try
			{
				if( $Config->get_setting( 'template' , false ) )
				{
					$Content = $this->TemplateContentAccess->get_content_ex( $Config );
				}
				else
				{
					$Package = $this->Utilities->get_package( $Config , __FILE__ );
					$Function = $Config->get_setting( 'compilation_func' , false );
					$Content = call_user_func( array( $Package , $Function ) , $MacroSettings );
				}

				if( $MacroSettings !== false )
				{
					$Content = $this->String->print_record( $Content , $MacroSettings->get_raw_settings() );
				}

				return( $Content );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian ������� ��������� ������� ��������.
		*
		*	@param $Options - ��������� ������ ������.
		*
		*	@param $Str - ������ ���������� ���������.
		*
		*	@param $Changed - true ���� �����-�� �� ��������� �������� ��� �������������.
		*
		*	@return array( �������������� ������ , ���� �� ������ ���������� ).
		*
		*	@exception Exception - �������� ��������� ����� ���� � ��������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Function processes simple macroes.
		*
		*	@param $Options - Settings.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return array( Processed string , Was the string changed ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	process_simple_macroes( &$Options , $Str , $Changed )
		{
			try
			{
				foreach( $this->StaticContentConfigs as $k => $v )
				{
					$this->Config->load_settings( $v );
					$Name = $this->Config->get_setting( 'name' );

					if( strpos( $Str , '{'.$Name.'}' ) !== false )
					{
						$MacroSettings = false;
						$Content = $this->compile_macro( $this->Config , $MacroSettings );
						$Str = str_replace( '{'.$Name.'}' , $Content , $Str );
						$Changed = true;
					}
				}

				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian ������� ��������� ������ ��������� �������.
		*
		*	@param $Config - ������.
		*
		*	@return �������.
		*
		*	@exception Exception - �������� ��������� ����� ���� � ��������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Function returns rules.
		*
		*	@param $Config - Config.
		*
		*	@return Rules.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_rules( &$Config )
		{
			try
			{
				$Rules = array();

				if( $Config->get_setting( 'terminal_values' , false ) !== false )
				{
					$TerminalValues = explode( ',' , $Config->get_setting( 'terminal_values' ) );

					foreach( $TerminalValues as $i => $Name )
					{
						$Rules[ $Name ] = TERMINAL_VALUE;
					}
				}

				return( $Rules );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian ������� ��������� ����������������� ��������.
		*
		*	@param $Options - ��������� ������ ������.
		*
		*	@param $Str - ������ ���������� ���������.
		*
		*	@param $Changed - true ���� �����-�� �� ��������� �������� ��� �������������.
		*
		*	@return array( �������������� ������ , ���� �� ������ ���������� ).
		*
		*	@exception Exception - �������� ��������� ����� ���� � ��������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Function processes parametrized macroes.
		*
		*	@param $Options - Settings.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return array( Processed string , Was the string changed ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	process_parametrized_macroes( &$Options , $Str , $Changed )
		{
			try
			{
				foreach( $this->StaticContentConfigs as $k => $v )
				{
					$this->Config->load_settings( $v );
					$Name = $this->Config->get_setting( 'name' );
					$Rules = $this->get_rules( $this->Config );

					for( ; $Parameters = $this->String->get_macro_parameters( $Str , $Name , $Rules ) ; )
					{
						$this->MacroSettings->load_settings( $Parameters );

						$Content = $this->compile_macro( $this->Config , $this->MacroSettings );

						$Str = str_replace( '{'."$Name:$Parameters".'}' , $Content , $Str );
						$Changed = true;
					}
				}

				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian ������� ��������� ��������.
		*
		*	@param $Options - ��������� ������ ������.
		*
		*	@param $Str - ������ ���������� ���������.
		*
		*	@param $Changed - true ���� �����-�� �� ��������� �������� ��� �������������.
		*
		*	@return array( �������������� ������ , ���� �� ������ ���������� ).
		*
		*	@exception Exception - �������� ��������� ����� ���� � ��������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Function processes macroes.
		*
		*	@param $Options - Settings.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return array( Processed string , Was the string changed ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_template_contents( &$Options , $Str , $Changed )
		{
			try
			{
				$this->load_template_contents_configs();

				if( $this->StaticContentConfigs != '' )
				{
					list( $Str , $Changed ) = $this->process_simple_macroes( $Options , $Str , $Changed );

					list( $Str , $Changed ) = $this->process_parametrized_macroes( $Options , $Str , $Changed );
				}

				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian ������� ��������� ������.
		*
		*	@param $Options - ��������� ������ ������.
		*
		*	@param $Str - ������ ���������� ���������.
		*
		*	@param $Changed - true ���� �����-�� �� ��������� �������� ��� �������������.
		*
		*	@return ������������ ������.
		*
		*	@exception Exception - �������� ��������� ����� ���� � ��������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Function processes string.
		*
		*	@param $Options - Settings.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return Processed string.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_string( &$Options , $Str , &$Changed )
		{
			try
			{
				list( $Str , $Changed ) = $this->process_template_contents( $Options , $Str , $Changed );

				return( $Str );return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>