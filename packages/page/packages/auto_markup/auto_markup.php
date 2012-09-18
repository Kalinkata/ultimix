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
		var					$Cache = false;
		var					$CachedMultyFS = false;
		var					$ConfigSettings = false;
		var					$Settings = false;
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
		var					$TemplateContentConfigs = false;
		
		/**
		*	\~russian ����������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Parsed config.
		*
		*	@author Dodonov A.A.
		*/
		var					$ParsedConfig = false;

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
				$this->Cache = get_package( 'cache' , 'last' , __FILE__ );
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->ConfigSettings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->TemplateContentAccess = get_package( 
					'page::template_content::template_content_access' , 'last' , __FILE__ 
				);
				$this->String = get_package( 'string' , 'last' , __FILE__ );
				$this->Utilities = get_package( 'utilities' , 'last' , __FILE__ );
				$this->ParsedConfig = array();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian ��������� ������� ��� ����.
		*
		*	@param $Config - ������.
		*
		*	@return ������.
		*
		*	@exception Exception - �������� ��������� ����� ���� � ��������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Function returns hash cursor.
		*
		*	@param $Config - Config.
		*
		*	@return Cursor.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_name( &$Config )
		{
			try
			{
				if( ( $Name = $Config->get_setting( 'macro_name' , false ) ) !== false )
				{
					return( $Name );
				}
				elseif( ( $Name = $Config->get_setting( 'block_name' , false ) ) !== false )
				{
					return( $Name );
				}
				throw( new Exception( 'Macro name was not found' ) );
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
		private function	load_template_contents_configs_from_file()
		{
			try
			{
				$this->TemplateContentConfigs = $this->CachedMultyFS->get_config( __FILE__ , 'cf_template_contents' );
				$this->TemplateContentConfigs = explode( "\n" , $this->TemplateContentConfigs );

				foreach( $this->TemplateContentConfigs as $k => $v )
				{
					$this->ConfigSettings->load_settings( $v );

					$Name = $this->get_name( $this->ConfigSettings );

					$this->ParsedConfig[ $Name ] = $this->ConfigSettings->get_raw_settings();
				}

				$this->Cache->add_data( 'parsed_macro_config' , serialize( $this->ParsedConfig ) );
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
				if( count( $this->ParsedConfig ) == 0 )
				{
					if( $this->Cache->data_exists( 'parsed_macro_config' ) )
					{
						$this->ParsedConfig = unserialize( $this->Cache->get_data( 'parsed_macro_config' ) );
					}
					else
					{
						$this->load_template_contents_configs_from_file();
					}
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
		*	@param $Settings - ��������� �������.
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
		*	@param $Settings - Macro settings.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_macro( &$Config , &$Settings )
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
					$Content = call_user_func( array( $Package , $Function ) , $Settings );
				}

				if( $Settings !== false )
				{
					$Content = $this->String->print_record( $Content , $Settings->get_raw_settings() );
				}

				return( $Content );
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
		*	@param $Settings - ��������� �������.
		*
		*	@param $Data - ������ �����.
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
		*	@param $Settings - Macro settings.
		*
		*	@param $Data - Block content.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_block( &$Config , &$Settings , $Data )
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
					$Content = call_user_func( array( $Package , $Function ) , $Settings , $Data );
				}

				if( $Settings !== false )
				{
					$Content = $this->String->print_record( $Content , $Settings->get_raw_settings() );
				}

				return( $Content );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian ������� ��������� �������� �������.
		*
		*	@param $Config - ������.
		*
		*	@param $Str - ������ ��������� ���������.
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
		*	\~english Function processes simple macro.
		*
		*	@param $Config - Config.
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
		private function	compile_simple_macro( &$Config , $Str , $Changed )
		{
			try
			{
				$Name = $this->get_name( $Config );

				if( strpos( $Str , '{'.$Name.'}' ) !== false )
				{
					$this->Settings->clear();
					$this->set_default_values( $this->Settings , $Config );
					$Content = $this->compile_macro( $Config , $this->Settings );
					$Str = str_replace( '{'.$Name.'}' , $Content , $Str );
					$Changed = true;
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
		*	\~russian ��������� ���������� ��������.
		*
		*	@param $Settings - ��������� ������ ������.
		*
		*	@param $Config - ������.
		*
		*	@exception Exception - �������� ��������� ����� ���� � ��������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Function sets default values.
		*
		*	@param $Settings - Settings.
		*
		*	@param $Config - Config.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	set_default_values( &$Settings , &$Config )
		{
			try
			{
				if( $Config->get_setting( 'default_values' , false ) !== false )
				{
					$DefaultValues = explode( ',' , $Config->get_setting( 'default_values' , false ) );

					foreach( $DefaultValues as $i => $DefaultValue )
					{
						$DefaultValue = explode( ':' , $DefaultValue );
						$Settings->set_undefined( $DefaultValue[ 0 ] , $DefaultValue[ 1 ] );
					}
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian ������� ��������� ��������.
		*
		*	@param $Config - ��������� ������ ������.
		*
		*	@param $Str - ������ ��������� ���������.
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
		*	@param $Config - Settings.
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
		private function	compile_parametrized_macro( &$Config , $Str , $Changed )
		{
			try
			{
				$Name = $this->get_name( $Config );

				$Rules = $this->get_rules( $Config );

				for( ; $Params = $this->String->get_macro_parameters( $Str , $Name , $Rules ) ; )
				{
					$this->Settings->load_settings( $Params );
					$this->set_default_values( $this->Settings , $Config );
					$Content = $this->compile_macro( $Config , $this->Settings );
					$Str = str_replace( '{'."$Name:$Params".'}' , $Content , $Str );
					$Changed = true;
				}

				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian ������� ��������� ����������������� ������.
		*
		*	@param $Name - �������� �����.
		*
		*	@param $Str - ������ ��������� ���������.
		*
		*	@param $Params - ��������� �������.
		*
		*	@param $Config - ������.
		*
		*	@return array( �������������� ������ , ���� �� ������ ���������� ).
		*
		*	@exception Exception - �������� ��������� ����� ���� � ��������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Function processes parametrized blocks.
		*
		*	@param $Name - Block name.
		*
		*	@param $Str - String to process.
		*
		*	@param $Params - Macro params.
		*
		*	@param $Config - Config.
		*
		*	@return array( Processed string , Was the string changed ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_single_type_single_block( $Name , $Str , $Params , &$Config )
		{
			try
			{
				$this->Settings->load_settings( $Params );
				$this->set_default_values( $this->Settings , $Config );

				$Data = $this->String->get_block_data( $Str , "$Name:$Params" , "~$Name" );

				$Content = $this->compile_block( $Config , $this->Settings , $Data );

				$Str = substr_replace( 
					$Str , $Content.'{'."$Name:$Params".'}' , 
					strpos( $Str , '{'."$Name:$Params".'}' ) , strlen( '{'."$Name:$Params".'}' )
				);
				$Changed = false;

				return( array( $this->String->hide_block( $Str , "$Name:$Params" , "~$Name" , $Changed ) , true ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian ������� ��������� ������������������ �����.
		*
		*	@param $Config - ��������� ������ ������.
		*
		*	@param $Str - ������ ��������� ���������.
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
		*	\~english Function processes parametrized block.
		*
		*	@param $Config - Settings.
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
		private function	compile_parametrized_block( &$Config , $Str , $Changed )
		{
			try
			{
				$Name = $this->get_name( $Config );

				$Rules = $this->get_rules( $Config );

				for( ; $Params = $this->String->get_macro_parameters( $Str , $Name , $Rules ) ; )
				{
					list( $Str , $Changed ) = $this->compile_single_type_single_block(
						$Name , $Str , $Params , $Config
					);
				}

				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian ���� ��� ������.
		*
		*	@param $Config - ������.
		*
		*	@return true/false.
		*
		*	@exception Exception - �������� ��������� ����� ���� � ��������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Is it block or macro.
		*
		*	@param $Config - Config.
		*
		*	@return true/false.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	is_macro( &$Config )
		{
			try
			{
				if( ( $Name = $Config->get_setting( 'macro_name' , false ) ) !== false )
				{
					return( true );
				}
				elseif( ( $Name = $Config->get_setting( 'block_name' , false ) ) !== false )
				{
					return( false );
				}

				throw( new Exception( 'Undefined entity type' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian ������� ��������� ��������.
		*
		*	@param $Name - �������� �������.
		*
		*	@param $Str - ������ ��������� ���������.
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
		*	@param $Name - Name.
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
		private function	compile_named_macro( $Name , $Str , $Changed )
		{
			try
			{
				if( isset( $this->ParsedConfig[ $Name ] ) )
				{
					$this->ConfigSettings->load_raw_settings( $this->ParsedConfig[ $Name ] );
					if( $this->is_macro( $this->ConfigSettings ) )
					{
						list( $Str , $Changed ) = $this->compile_simple_macro( 
							$this->ConfigSettings , $Str , $Changed
						);

						list( $Str , $Changed ) = $this->compile_parametrized_macro( 
							$this->ConfigSettings , $Str , $Changed
						);
					}
					else
					{
						list( $Str , $Changed ) = $this->compile_parametrized_block(
							$this->ConfigSettings , $Str , $Changed
						);
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
		*	@param $Str - ������ ��������� ���������.
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
		function			compile_all_macroes( &$Options , $Str , $Changed )
		{
			try
			{
				$this->load_template_contents_configs();

				$Macroes = $this->String->find_all_macro( $Str );

				foreach( $Macroes as $i => $Name )
				{
					list( $Str , $Changed ) = $this->compile_named_macro( $Name , $Str , $Changed );
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
		*	@param $Str - ������ ��������� ���������.
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
		*	@param $Str - String to process.
		*
		*	@return Processed string.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_string( $Str )
		{
			try
			{
				$Changed = true;

				for( ; $Changed ; )
				{
					$Changed = false;

					list( $Str , $Changed ) = $this->compile_all_macroes( $this->Settings , $Str , $Changed );
				}

				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>