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
				$this->StaticContentAccess = get_package( 
					'page::static_content::static_content_access' , 'last' , __FILE__
				);
				$this->String = get_package( 'string' , 'last' , __FILE__ );
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
		private function	load_static_contents_configs()
		{
			try
			{
				if( $this->StaticContentConfigs === false )
				{
					$this->StaticContentConfigs = $this->CachedMultyFS->get_config( __FILE__ , 'cf_static_contents' );
					$this->StaticContentConfigs = explode( "\n" , $this->StaticContentConfigs );
				}
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
						$Content = $this->StaticContentAccess->get_content_ex( $this->Config );
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

					for( ; $Parameters = $this->String->get_macro_parameters( $Str , $Name ) ; )
					{
						$this->MacroSettings->load_settings( $Parameters );

						$Content = $this->StaticContentAccess->get_content_ex( $this->Config );
						$Content = $this->String->print_record( $Content , $this->MacroSettings->get_raw_settings() );
						
						$Str = str_replace( '{'."$Name:$Parameters".'}' , $Tab , $Str );
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
		function			process_static_contents( &$Options , $Str , $Changed )
		{
			try
			{
				$this->load_static_contents_configs();

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
				list( $Str , $Changed ) = $this->process_static_contents( $Options , $Str , $Changed );

				return( $Str );return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>