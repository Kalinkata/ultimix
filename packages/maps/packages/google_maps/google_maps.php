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
	*	\~russian ����� ��� ������ � Google-�������.
	*
	*	@author ������� �.�.
	*/
	/**
	*	\~english Class processes Google.Maps processing routine.
	*
	*	@author Dodonov A.A.
	*/
	class	google_maps_1_0_0{
	
		/**
		*	\~russian �������������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Cached packages.
		*
		*	@author Dodonov A.A.
		*/
		var					$BlockSettings = false;
		var					$Settings = false;
		var					$String = false;

		/**
		*	\~russian �����������.
		*
		*	@exception Exception �������� ��������� ����� ���� � ��������� ������.
		*
		*	@author  ������� �.�.
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
				$this->BlockSettings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->Settings = get_package_object( 'settings::package_settings' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian ������� ����������������� ��������.
		*
		*	@param $Options - ��������� ������ ������.
		*
		*	@exception Exception - �������� ���������� ����� ���� � ��������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Function executes before any page generating actions took place.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			pre_generation( $Options )
		{
			try
			{
				$PageJS = get_package( 'page::page_js' , 'last' , __FILE__ );
				
				$Path = _get_package_relative_path_ex( 'maps::google_maps' , '1.0.0' );
				$PageJS->add_javascript( "{http_host}/$Path/include/js/google_maps.js" );
				
				$Key = $this->Settings->get_package_setting( 
					'maps::google_maps' , '1.0.0::1.0.0' , 'cf_google_maps' , 'google_maps_api_key'
				);
				
				$URL = 'http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true&amp;key='.$Key;
				$PageJS->add_javascript( $URL , false );
			}
			catch( Exception $e )
			{
				$Args = func_get_args();throw( _get_exception_object( __METHOD__ , $Args , $e ) );
			}
		}
		
		/**
		*	\~russian ������� ���������� ������� 'google_map'.
		*
		*	@param $BlockSettings - ��������� ���������.
		*
		*	@return HTML ���.
		*
		*	@exception Exception �������� ��������� ����� ���� � ��������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Function compiles macro 'google_map'.
		*
		*	@param $BlockSettings - Compilation options.
		*
		*	@return HTML code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_google_map( &$BlockSettings )
		{
			try
			{
				$BlockSettings->set_undefined( 'id' , md5( microtime( true ) ) );
				$BlockSettings->set_undefined( 'height' , '300px' );
				$BlockSettings->set_undefined( 'width' , '500px' );
				$BlockSettings->set_undefined( 'class' , 'google_map' );
				$Code = $this->CachedMultyFS->get_template( __FILE__ , 'google_map_frame.tpl' );
				return( $this->String->print_record( $Code , $BlockSettings->get_raw_settings() ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian ������� ��������� ������� 'google_map'.
		*
		*	@param $Str - ������������� ������.
		*
		*	@param $Changed - ���� �� ������������ ���������.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception �������� ��������� ����� ���� � ��������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Function processes macro 'google_map'.
		*
		*	@param $Str - Processing string.
		*
		*	@param $Changed - Was the processing completed.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_google_map( $Str , $Changed )
		{
			try
			{
				if( strpos( $Str , '{google_map}' ) !== false )
				{
					$Str = str_replace( '{google_map}' , '{google_map:p=1}' , $Str );
				}
				
				$Limitations = array( 'width' => TERMINAL_VALUE , 'height' => TERMINAL_VALUE );
				
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'google_map' , $Limitations ) ; )
				{
					$this->BlockSettings->load_settings( $Parameters );
					
					$Code = $this->compile_google_map( $this->BlockSettings );
					
					$Str = str_replace( "{google_map:$Parameters}" , $Code , $Str );
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
		*	\~russian ������� ���������� �� ��������� ������.
		*
		*	@param $Options - ��������� �����������.
		*
		*	@param $Str - ������������� ������.
		*
		*	@param $Changed - ���� �� ������������ ���������.
		*
		*	@return HTML ��� ��� �����������.
		*
		*	@exception Exception �������� ��������� ����� ���� � ��������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Function processes string.
		*
		*	@param $Options - Options of drawing.
		*
		*	@param $Str - Processing string.
		*
		*	@param $Changed - Was the processing completed.
		*
		*	@return HTML code to display.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_string( $Options , $Str , &$Changed )
		{
			try
			{
				list( $Str , $Changed ) = $this->process_google_map( $Str , $Changed );
				
				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
?>