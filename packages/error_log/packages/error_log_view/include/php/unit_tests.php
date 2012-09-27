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
		*	\~russian �������������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Cached object.
		*
		*	@author Dodonov A.A.
		*/
		var					$ErrorLogAccess = false;
		var					$ErrorLogView = false;
		var					$Options = false;

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
			$this->ErrorLogAccess = get_package( 'error_log::error_log_access' , 'last' , __FILE__ );
			$this->ErrorLogView = get_package( 'error_log::error_log_view' , 'last' , __FILE__ );
			$this->Options = get_package_object( 'settings::settings' , 'last' , __FILE__ );
		}

		//TODO: create unit-test with simple create form view
		//TODO: create unit-test with simple update form view
		//TODO: create unit-test with simple copy form view

		//TODO: create unit-test with simple create controller
		//TODO: create unit-test with simple update controller
		//TODO: create unit-test with simple delete controller
	}

?>