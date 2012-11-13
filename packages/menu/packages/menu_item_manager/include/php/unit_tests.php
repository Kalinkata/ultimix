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
		var					$DatabaseAlgorithms = false;
		var					$DefaultControllers = false;
		var					$MenuItemAccess = false;
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
				$this->DatabaseAlgorithms = get_package( 'database::database_algorithms' );
				$this->DefaultControllers = get_package( 'gui::context_set::default_controllers' );
				$this->MenuItemAccess = get_package( 'menu::menu_item_access' , 'last' , __FILE__ );
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
		function	set_up()
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
		function	tear_down()
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
			get_package( 'menu::menu_item_manager' , 'last' , __FILE__ );

			return( 'TEST PASSED' );
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
		function			test_display_list()
		{
			$PageContent = $this->PageComposer->get_page( 'menu_item_manager' );

			if( stripos( $PageContent , '>main<' ) === false )
			{
				print( 'ERROR: menu item list was not displayed' );
				return;
			}

			return( 'TEST PASSED' );
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
		function			test_create_record_form()
		{
			$this->Security->set_g( 'menu_item_context_action' , 'create_record_form' );

			$PageContent = $this->PageComposer->get_page( 'menu_item_manager' );

			if( stripos( $PageContent , 'menu_item_create_form' ) === false )
			{
				print( 'ERROR: menu item create form was not displayed'.$PageContent );
				return;
			}

			return( 'TEST PASSED' );
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
			$this->Security->set_g( 'name' , 'test_name' );
			$this->Security->set_g( 'menu' , 'test_menu' );
			$this->Security->set_g( 'href' , 'test_href' );

			$Controller = get_package( 'menu::menu_item_manager' , 'last' , __FILE__ );

			$this->Testing->setup_controller( $this->Settings , 'menu_item' );

			$Controller->controller( $this->Settings );

			if( $this->DatabaseAlgorithms->record_exists( 'umx_menu_item' , 'name LIKE "test_name"' ) )
			{
				$this->MenuItemAccess->delete( $this->DefaultControllers->id );
				return( 'TEST PASSED' );
			}
			else
			{
				return( 'ERROR' );
			}
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
		function			test_update_record_form()
		{
			$this->Security->set_p( 'menu_item_context_action' , 'update_record_form' );
			$this->Security->set_p( '_id_2' , 'on' );
			$this->Security->set_p( 'menu_item_record_id' , '-1' );

			$PageContent = $this->PageComposer->get_page( 'menu_item_manager' );

			if( stripos( $PageContent , 'menu_item_update_form' ) === false )
			{
				print( 'ERROR: menu item update form was not displayed'.$PageContent );
				return;
			}

			return( 'TEST PASSED' );
		}
	}

?>