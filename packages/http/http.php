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
	*	\~russian ���������� ������� ��� ������ � HTTP ���������.
	*
	*	@author ������� �.�.
	*/
	/**
	*	\~english Simple utilities for http requests.
	*
	*	@author Dodonov A.A.
	*/
	class	http_1_0_0
	{
		/**
		*	\~russian ��������� ����.
		*
		*	@param $FieldName - ��� ����.
		*
		*	@param $FieldValue - �������� ����.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Function sets field.
		*
		*	@param $FieldName - Field name.
		*
		*	@param $FieldValue - Field value.
		*
		*	@author Dodonov A.A.
		*/
		function			set( $FieldName , $FieldValue )
		{
			$this->$FieldName = $FieldValue;
		}
		
		/**
		*	\~russian ����.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Host.
		*
		*	@author Dodonov A.A.
		*/
		var					$host = 'localhost';
		
		/**
		*	\~russian URL.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english URL.
		*
		*	@author Dodonov A.A.
		*/
		var					$url = '/';
		
		/**
		*	\~russian ��� �������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Request type.
		*
		*	@author Dodonov A.A.
		*/
		var					$type = 'POST';
		
		/**
		*	\~russian �������� �������.
		*
		*	@param $Data - ������������ ������.
		*
		*	@exception Exception - �������� ��������� ����� ���� � ��������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Sending requests.
		*
		*	@param $Data - Data to send.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function				http_request( $Data = '' )
		{
			try
			{
				$Curl = curl_init();

				curl_setopt( $Curl , CURLOPT_URL , "$this->host$this->url" );
				curl_setopt( $Curl , CURLOPT_FAILONERROR , 1 );
				curl_setopt( $Curl , CURLOPT_RETURNTRANSFER , 1 );
				curl_setopt( $Curl , CURLOPT_TIMEOUT , 20 );
				if( $this->type == 'POST' )
				{
					curl_setopt( $Curl , CURLOPT_POST , 1 );
				}
				if( $Data != '' )
				{
					curl_setopt( $Curl , CURLOPT_POSTFIELDS , "$Data" );
				}

				$RequestData = curl_exec( $Curl );

				curl_close( $Curl );

				return( $RequestData );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian ��������� ����������.
		*
		*	@param $RequestData - ���������� ������.
		*
		*	@return ���������.
		*
		*	@exception Exception - �������� ��������� ����� ���� � ��������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Getting headers.
		*
		*	@param $RequestData - Received data.
		*
		*	@return Header.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			fetch_request_header( $RequestData )
		{
			try
			{
				$RequestParts = explode( "\r\n\r\n" , $RequestData );
				
				return( $RequestParts[ 0 ] );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian ��������� ���� �������.
		*
		*	@param $RequestData - ���������� ������.
		*
		*	@return ���� �������.
		*
		*	@exception Exception - �������� ��������� ����� ���� � ��������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Getting request body.
		*
		*	@param $RequestData - Received data.
		*
		*	@return Request body.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			fetch_request_body( $RequestData )
		{
			try
			{
				$RequestParts = explode( "\r\n\r\n" , $RequestData );
				
				$Start = strpos( $RequestParts[ 1 ] , "\r\n" );
				
				return( substr( $RequestParts[ 1 ] , $Start + 2 ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>