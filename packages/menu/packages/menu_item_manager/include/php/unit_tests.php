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

		var				$CacheSwitch;

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
			$PageComposer = get_package_object( 'page::page_composer' );
			$PageContent = $PageComposer->get_page( 'menu_item_manager' );

			if( stripos( $PageContent , 'index.html' ) === false )
			{
				print( 'ERROR: menu item list was not displayed' );
				return;
			}

			return( 'TEST PASSED' );
		}
	}

?>