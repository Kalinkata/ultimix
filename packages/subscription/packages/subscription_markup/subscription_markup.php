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
	*	\~russian ����� ��� ��������� ��������.
	*
	*	@author ������� �.�.
	*/
	/**
	*	\~english Class processes macro.
	*
	*	@author Dodonov A.A.
	*/
	class	subscription_markup_1_0_0{
	
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
		var					$String = false;
		var					$SubscriptionAlgorithms = false;

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
				$this->String = get_package_object( 'string' , 'last' , __FILE__ );
				$this->SubscriptionAlgorithms = get_package( 
					'subscription::subscription_algorithms' , 'last' , __FILE__
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian ������� ���������� ������� 'browser'.
		*
		*	@param $Settings - ���������.
		*
		*	@return ��� �������.
		*
		*	@exception Exception - �������� ��������� ����� ���� � ��������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Function compiles macro 'browser'.
		*
		*	@param $Settings - Parameters.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_unsubscribe_url( &$Settings )
		{
			try
			{
				$UserId = $Settings->get_setting( 'user_id' );
				$SubscriptionId = $Settings->get_setting( 'subscription_id' );

				$Hash = $this->SubscriptionAlgorithms->calculate_hash( $UserId , $SubscriptionId );

				return( "{http_host}/unsubscribe.html?user_id[eq]$UserId&hash[eq]$Hash" );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
?>