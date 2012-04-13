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
	*	\~russian ����� ��� ����������� �������� jquery.
	*
	*	@author ������� �.�.
	*/
	/**
	*	\~english Class loads jquery macroes.
	*
	*	@author Dodonov A.A.
	*/
	class	yandex_markup_1_0_0{

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
		var					$CachedMultyFS = false;

		/**
		*	\~russian �������������� ���������� � ��������� ��������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Cached info about created packages.
		*
		*	@author Dodonov A.A.
		*/
		var					$Dialogs = array();
		
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
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		/**
		*	\~russian ������� ��������� ������� 'add_iframe_tab'.
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
		*	\~english Function processes macro 'add_iframe_tab'.
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
		function			process_regions( $Str , $Changed )
		{
			try
			{
				if( strpos( $Str , '{regions}' ) !== false )
				{
					$Str = str_replace( 
						'{regions}' , $this->CachedMultyFS->get_template( __FILE__ , 'regions.tpl' ) , $Str
					);
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
				list( $Str , $Changed ) = $this->process_regions( $Str , $Changed );

				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>