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
	class	error_log_access_1_0_0{
	
		/**
		*	\~russian �������������� ����������� �� ������� ��������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~russian Additional limitations of the processing data.
		*
		*	@author Dodonov A.A.
		*/
		var					$AddLimitations = '1 = 1';
		
		/**
		*	\~russian ��������� �������������� �����������.
		*
		*	@param $theAddLimitation - �������������� �����������.
		*
		*	@exception Exception - �������� ���������� ����� ���� � ��������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Function sets additional limitations.
		*
		*	@param $theAddLimitation - Additional limitations.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_add_limitations( $theAddLimitation )
		{
			try
			{
				if( $this->AddLimitations === '1 = 1' )
				{
					$this->AddLimitations = $theAddLimitation;
				}
				else
				{
					throw( new Exception( '"AddLimitations" was already set' ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian ���������� ���������.
		*
		*	@param $Severity - ����������� ��������� �� ������.
		*
		*	@param $Title - �������� ���������.
		*
		*	@param $Description - ����� ��������� �� ������.
		*
		*	@exception Exception - �������� ��������� ����� ���� � ��������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Function creates error message.
		*
		*	@param $Severity - Error log item's severity.
		*
		*	@param $Title - Error log item's title.
		*
		*	@param $Description - Error log item's message.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			add_message_to_log( $Severity , $Title , $Description )
		{
			try
			{
				$Security = get_package( 'security' , 'last' , __FILE__ );
				$Severity = $Security->get( $Severity , 'integer' );
				$Title = $Security->get( $Title , 'command' );
				$Description = $Security->get( $Description , 'raw' );
				
				$Database = get_package( 'database' , 'last' , __FILE__ );
				$Database->insert( 
					'umx_error_log' , 'severity , title , description , error_date' , 
					"$Severity , '$Title' , '$Description' , NOW()"
				);
				$Database->commit();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian ������� ������� �������.
		*
		*	@param $Condition - ������� ������ �������.
		*
		*	@exception Exception - �������� ��������� ����� ���� � ��������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Function selects records.
		*
		*	@param $Condition - Records selection filter.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			unsafe_select_messages( $Condition = '1 = 1' )
		{
			try
			{			
				$Database = get_package( 'database' , 'last' , __FILE__ );
				$Database->query_as( DB_OBJECT );
				$Results = $Database->select( '*' , 'umx_error_log' , "( $this->AddLimitations ) AND $Condition" );
				return( $Results );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian ������� �������� ������.
		*
		*	@param $id - ������������� �������� ������.
		*
		*	@exception Exception - �������� ��������� ����� ���� � ��������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Function deletes record.
		*
		*	@param $id - ������������� �������� ������.
		*
		*	@exception Exception - �������� ��������� ����� ���� � ��������� ������.
		*
		*	@author ������� �.�.
		*/
		function			delete_error_log( $id )
		{
			try
			{
				$Database = get_package( 'database' , 'last' , __FILE__ );
				$Security = get_package( 'security' , 'last' , __FILE__ );
				
				$id = $Security->get( $id , 'integer' );
				$Database->delete( 'umx_error_log' , "( $this->AddLimitations ) AND id = $id" );
				$Database->commit();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>