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
		var					$Access = false;
		var					$DatabaseAlgorithms = false;
		var					$DefaultControllers = false;
		var					$PageComposer = false;
		var					$Security = false;
		var					$Settings = false;
		var					$Testing = false;

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
				$this->Access = get_package( 'site::site_access' , 'last' , __FILE__ );
				$this->DatabaseAlgorithms = get_package( 'database::database_algorithms' );
				$this->DefaultControllers = get_package( 'gui::context_set::default_controllers' );
				$this->PageComposer = get_package_object( 'page::page_composer' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->Testing = get_package( 'testing' , 'last' , __FILE__ );
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
		function			set_up()
		{
			$this->Settings->clear();
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
		function			tear_down()
		{
		}

		/**
		*	\~russian ��������� ������������ ��������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Processing illegal macro.
		*
		*	@author Dodonov A.A.
		*/
		function			test_load_package()
		{
			get_package( 'site::site_manager' , 'last' , __FILE__ );

			return( 'TEST PASSED' );
		}

		/**
		*	\~russian ������� �������� �������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Function creates testing record.
		*
		*	@author Dodonov A.A.
		*/
		function			create_test_record()
		{
			$this->Security->set_g( 'domain' , 'test_domain' );
			$this->Security->set_g( 'comemnt' , 'test_comment' );

			$Controller = get_package( 'site::site_manager' , 'last' , __FILE__ );

			$this->Testing->setup_create_controller( $this->Settings , 'site' );

			$Controller->controller( $this->Settings );
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
		function			test_delete_record()
		{
			$this->create_test_record();

			if( $this->DatabaseAlgorithms->record_exists( 'umx_site' , '`domain` LIKE "test_domain"' ) )
			{
				$Controller = get_package( 'site::site_manager' , 'last' , __FILE__ );

				$this->Testing->setup_delete_controller( $this->Settings , 'site' , $this->DefaultControllers->id );

				$Controller->controller( $this->Settings );

				if( $this->DatabaseAlgorithms->record_exists( 'umx_site' , '`domain` LIKE "test_domain"' ) === false )
				{
					return( 'TEST PASSED' );
				}
			}

			return( 'ERROR' );
		}

		/**
		*	\~russian ������������ ����.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Testing view.
		*
		*	@author Dodonov A.A.
		*/
		function			test_create_record()
		{
			return( $this->Testing->test_create_record( $this , 'code' , 'test_code' ) );
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
		function			test_update_record()
		{
			return( $this->Testing->test_update_record( $this , 'code' , 'test_code2' ) );
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
			return( $this->Testing->test_display_list_form( 'site' , 'ultimix.sf.net' ) );
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
			return( $this->Testing->test_create_form( 'site' ) );
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
			return( $this->Testing->test_update_form( 'site' ) );
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
			$this->Security->set_p( 'search_string' , 'ultimix.sf.net' );
			$PageContent = $this->PageComposer->get_page( 'site_manager' );
			$Exists = strpos( $PageContent , 'ultimix.sf.net' ) !== false;

			$this->Security->reset_p( 'search_string' , 'unexisting_search_string' );
			$PageContent = $this->PageComposer->get_page( 'site_manager' );
			$NotExists = strpos( $PageContent , 'ultimix.sf.net' ) === false;

			if( $Exists && $NotExists )
			{
				return( 'TEST PASSED' );
			}
			else
			{
				return( 'ERROR' );
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
			$this->Security->set_g( 'site_context_action' , 'copy_record_form' );
			$this->Security->set_g( 'site_record_id' , '1' );

			$PageContent = $this->PageComposer->get_page( 'site_manager' );

			if( stripos( $PageContent , 'create_site_form' ) === false )
			{
				return( 'ERROR: copy site form was not displayed'.$PageContent );
			}

			return( 'TEST PASSED' );
		}
	}

?>