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
				$this->Access = get_package_object( 'report::report_access' , 'last' , __FILE__ );
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
		*	\~russian �������� �������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Testing package loading.
		*
		*	@author Dodonov A.A.
		*/
		function			test_load_package()
		{
			get_package( 'report::report_manager' , 'last' , __FILE__ );

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
			$this->Security->set_g( 'name' , 'test_title' );
			$this->Security->set_g( 'package_name' , 'package_name' );
			$this->Security->set_g( 'package_version' , 'package_version' );

			$Controller = get_package( 'report::report_manager' , 'last' , __FILE__ );

			$this->Testing->setup_create_controller( $this->Settings , 'report' );

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

			if( $this->DatabaseAlgorithms->record_exists( 'umx_report' , '`name` LIKE "test_title"' ) )
			{
				$Controller = get_package( 'report::report_manager' , 'last' , __FILE__ );

				$this->Testing->setup_delete_controller( $this->Settings , 'report' , $this->DefaultControllers->id );

				$Controller->controller( $this->Settings );

				if( $this->DatabaseAlgorithms->record_exists( 'umx_report' , '`name` LIKE "test_title"' ) === false )
				{
					return( 'TEST PASSED' );
				}
			}

			return( 'ERROR' );
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
			return( $this->Testing->test_display_list_form( 'report' , 'report' ) );
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
			return( $this->Testing->test_create_form( 'report' ) );
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
			return( $this->Testing->test_update_form( 'report' ) );
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
			$this->Security->set_p( 'search_string' , 'Main Report' );
			$PageContent = $this->PageComposer->get_page( 'report_manager' );
			$Exists = strpos( $PageContent , 'Main Report' ) !== false;

			$this->Security->reset_p( 'search_string' , 'unexisting_search_string' );
			$PageContent = $this->PageComposer->get_page( 'report_manager' );
			$NotExists = strpos( $PageContent , 'Main Report' ) === false;

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
			$this->Security->set_g( 'report_context_action' , 'copy_record_form' );
			$this->Security->set_g( 'report_record_id' , '1' );

			$PageContent = $this->PageComposer->get_page( 'report_manager' );

			if( stripos( $PageContent , 'create_report_form' ) === false )
			{
				return( 'ERROR: copy report form was not displayed'.$PageContent );
			}

			return( 'TEST PASSED' );
		}
	}

?>