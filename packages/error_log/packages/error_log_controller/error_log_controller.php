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
	*	\~russian ����������� error log'�.
	*
	*	@author ������� �.�.
	*/
	/**
	*	\~english Error log' implementation.
	*
	*	@author Dodonov A.A.
	*/
	class	error_log_controller_1_0_0{
	
		/**
		*	\~russian ���������� 404 ���������.
		*
		*	@param $Options - ��������� ������ ������.
		*
		*	@exception Exception - �������� ��������� ����� ���� � ��������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Function stores 404 page not found message.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			store_404_error_message( $Options )
		{
			try
			{
				$Security = get_package( 'security' , 'last' , __FILE__ );
				$ErrorLog = get_package( 'error_log::error_log_access' , 'last' , __FILE__ );
				$ErrorLog->add_message_to_log( 
					5 , '404' , '{lang:page_was_not_found} '.$Security->get_srv( 'REQUEST_URI' , 'string' )
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian �������� ��������� ����.
		*
		*	@param $Options - ��������� ������ ������.
		*
		*	@exception Exception - �������� ��������� ����� ���� � ��������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Deleting error logs.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			delete_error( $Options )
		{
			try
			{
				$SecurityUtilities = get_package( 'security::security_utilities' , 'last' , __FILE__ );
				$ErrorLogAccess = get_package( 'error_log::error_log_access' , 'last' , __FILE__ );
				
				$Ids = $SecurityUtilities->get_global( '_id_' , 'integer' , POST | PREFIX_NAME | KEYS );
				foreach( $Ids as $k => $id )
				{
					$ErrorLogAccess->delete_error_log( $id );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian ������� ������ � �����������.
		*
		*	@param $Options - ��������� ������ ������.
		*
		*	@exception Exception - �������� ��������� ����� ���� � ��������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Function processes components.
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
				$Context = get_package( 'gui::context' , 'last' , __FILE__ );
				
				$Context->load_config( dirname( __FILE__ ).'/conf/cfcx_404' );
				if( $Context->execute( $Options , $this ) )return;
				
				$Context->load_config( dirname( __FILE__ ).'/conf/cfcx_massive_delete' );
				if( $Context->execute( $Options , $this ) )return;
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>