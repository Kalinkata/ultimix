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
	*	\~russian �����, ���������� �� ������������ ����������� �������.
	*
	*	@author ������� �.�.
	*/
	/**
	*	\~english Class for unit testing.
	*
	*	@author Dodonov A.A.
	*/
	class	unit_tests{

		/**
		*	\~russian �������������� �������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Cached objects.
		*
		*	@author Dodonov A.A.
		*/
		var				$PageComposer = false;
		var				$Security = false;

		/**
		*	\~russian �����������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Constructor.
		*
		*	@author Dodonov A.A.
		*/
		function			__construct()
		{
			try
			{
				$this->PageComposer = get_package_object( 'page::page_composer' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian ��������� ��������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Setting up testing mashine.
		*
		*	@author Dodonov A.A.
		*/
		function	set_up()
		{
		}

		/**
		*	\~russian ���������� �������� ����� � �������� ���������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Function restores default settings.
		*
		*	@author Dodonov A.A.
		*/
		function	tear_down()
		{
		}

		/**
		*	\~russian �������� �������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Testing package load.
		*
		*	@author Dodonov A.A.
		*/
		function			test_load_package()
		{
			get_package( 'subscription::subscription_view' , 'last' , __FILE__ );

			return( 'TEST PASSED' );
		}

		/**
		*	\~russian �������� ����������� �������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Testing standart states.
		*
		*	@author Dodonov A.A.
		*/
		function			test_display_list()
		{
			$PageContent = $this->PageComposer->get_page( 'subscription_manager' );

			if( stripos( $PageContent , 'Main Subscription Description' ) === false )
			{
				print( 'ERROR: subscription list was not displayed' );
				return;
			}

			return( 'TEST PASSED' );
		}

		/**
		*	\~russian �������� ����������� �������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Testing standart states.
		*
		*	@author Dodonov A.A.
		*/
		function			test_create_record_form()
		{
			$this->Security->set_g( 'subscription_context_action' , 'create_record_form' );

			$PageContent = $this->PageComposer->get_page( 'subscription_manager' );

			if( stripos( $PageContent , 'create_subscription_form' ) === false )
			{
				print( 'ERROR: create subscription form was not displayed'.$PageContent );
				return;
			}

			return( 'TEST PASSED' );
		}

		/**
		*	\~russian �������� ����������� �������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Testing standart states.
		*
		*	@author Dodonov A.A.
		*/
		function			test_update_record_form()
		{
			$this->Security->set_g( 'subscription_context_action' , 'update_record_form' );
			$this->Security->set_g( 'subscription_record_id' , '1' );

			$PageContent = $this->PageComposer->get_page( 'subscription_manager' );

			if( stripos( $PageContent , 'update_subscription_form' ) === false )
			{
				print( 'ERROR: update subscription form was not displayed'.$PageContent );
				return;
			}

			return( 'TEST PASSED' );
		}

		/**
		*	\~russian �������� ����������� �������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Testing standart states.
		*
		*	@author Dodonov A.A.
		*/
		function			test_display_search_list()
		{
			$this->Security->set_p( 'search_string' , 'Main Subscription Title' );
			$PageContent = $this->PageComposer->get_page( 'subscription_manager' );
			$Exists = strpos( $PageContent , 'Main Subscription Title' ) !== false;

			$this->Security->reset_p( 'search_string' , 'unexisting_search_string' );
			$PageContent = $this->PageComposer->get_page( 'subscription_manager' );
			$NotExists = strpos( $PageContent , 'Main Subscription Title' ) === false;

			if( $Exists && $NotExists )
			{
				return( 'TEST PASSED' );
			}
			else
			{
				print( 'ERROR' );
				return;
			}
		}

		/**
		*	\~russian �������� ����������� �������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Testing standart states.
		*
		*	@author Dodonov A.A.
		*/
		function			test_copy_record_form()
		{
			$this->Security->set_g( 'subscription_context_action' , 'copy_record_form' );
			$this->Security->set_g( 'subscription_record_id' , '1' );

			$PageContent = $this->PageComposer->get_page( 'subscription_manager' );

			if( stripos( $PageContent , 'create_subscription_form' ) === false )
			{
				print( 'ERROR: copy subscription form was not displayed'.$PageContent );
				return;
			}

			return( 'TEST PASSED' );
		}
	}

?>