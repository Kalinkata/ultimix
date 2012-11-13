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
		var					$ContentAccess = false;
		var					$DatabaseAlgorithms = false;
		var					$DefaultControllers = false;
		var					$Security = false;
		var					$Settings = false;
		var					$SiteAccess = false;
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
				$this->ContentAccess = get_package( 'content::content_access' , 'last' , __FILE__ );
				$this->DatabaseAlgorithms = get_package( 'database::database_algorithms' );
				$this->DefaultControllers = get_package( 'gui::context_set::default_controllers' );
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
			get_package( 'content::content_controller' , 'last' , __FILE__ );

			return( 'TEST PASSED' );
		}

		/**
		*	\~russian ��������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Setting data.
		*
		*	@author Dodonov A.A.
		*/
		private function	set_demo_data_for_creation()
		{
			$this->Security->set_g( 'author' , '1' );
			$this->Security->set_g( 'title' , 'test_title' );
			$this->Security->set_g( 'category' , '0' );
			$this->Security->set_g( 'demo_content' , 'test_demo_content' );
			$this->Security->set_g( 'main_content' , 'test_main_content' );
			$this->Security->set_g( 'keywords' , 'test_keywords' );
			$this->Security->set_g( 'description' , 'test_description' );
			$this->Security->set_g( 'print_content' , 'test_print_content' );
		}

		/**
		*	\~russian ������������ �����������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Testing controller.
		*
		*	@author Dodonov A.A.
		*/
		function			test_create_record()
		{
			$this->set_demo_data_for_creation();

			$Controller = get_package( 'content::content_controller' , 'last' , __FILE__ );

			$this->Testing->setup_controller( $this->Settings , 'content' );

			$Controller->controller( $this->Settings );

			if( $this->DatabaseAlgorithms->record_exists( 'umx_content' , 'demo_content LIKE "test_demo_content"' ) )
			{
				$this->ContentAccess->delete( $this->DefaultControllers->id );
				return( 'TEST PASSED' );
			}
			else
			{
				return( 'ERROR' );
			}
		}
	}

?>