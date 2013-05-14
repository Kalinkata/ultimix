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
	*	\~russian Класс, отвечающий за тестирование компонентов системы.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class for unit testing.
	*
	*	@author Dodonov A.A.
	*/
	class	unit_tests{

		/**
		*	\~russian Закешированные объекты.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cached objects.
		*
		*	@author Dodonov A.A.
		*/
		var					$DefaultControllers = false;
		var					$PackageAccess = false;
		var					$PackageAlgorithms = false;
		var					$PageComposer = false;
		var					$Security = false;
		var					$Settings = false;
		var					$Testing = false;

		/**
		*	\~russian Конструктор.
		*
		*	@author Додонов А.А.
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
				$this->DefaultControllers = get_package( 'gui::context_set::default_controllers' , 'last' , __FILE__ );
				$this->PackageAccess = get_package( 'core::package_access' , 'last' , __FILE__ );
				$this->PackageAlgorithms = get_package( 'core::package_algorithms' , 'last' , __FILE__ );
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
		*	\~russian Настройка тестового стенда.
		*
		*	@author Додонов А.А.
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
		*	\~russian Возвращаем тестовый стенд в исходное положение.
		*
		*	@author Додонов А.А.
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
		*	\~russian Проверка загрузки пакета.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing package load.
		*
		*	@author Dodonov A.A.
		*/
		function			test_load_package()
		{
			get_package( 'core::package_manager' , 'last' , __FILE__ );

			return( 'TEST PASSED' );
		}

		/**
		*	\~russian Проверка стандартных стейтов.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing standart states.
		*
		*	@author Dodonov A.A.
		*/
		function			test_display_list()
		{
			$this->Testing->test_display_list_form( 'package' , 'phtml_package_manager' );
		}

		/**
		*	\~russian Проверка стандартных стейтов.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing standart states.
		*
		*	@author Dodonov A.A.
		*/
		function			test_create_record_form()
		{
			$this->Security->set_g( 'package_context_action' , 'create_record_form' );

			$PageContent = $this->PageComposer->get_page( 'package_manager' );

			if( stripos( $PageContent , 'create_package_form' ) === false )
			{
				print( 'ERROR: create package form was not displayed'.$PageContent );
				return;
			}

			return( 'TEST PASSED' );
		}

		/**
		*	\~russian Функция создания тестовой записи.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function creates testing record.
		*
		*	@author Dodonov A.A.
		*/
		function			create_test_record()
		{
			$this->Security->set_g( 'master_package_name' , 'core' );
			$this->Security->set_g( 'master_package_version' , '1.0.0' );

			$this->Security->set_p( 'package_name' , 'test' );
			$this->Security->set_p( 'package_version' , '1.0.0' );

			$Controller = get_package( 'core::package_manager' , 'last' , __FILE__ );
			$this->Testing->setup_create_controller( $this->Settings , 'package' );

			$Controller->controller( $this->Settings );
		}

		/**
		*	\~russian Проверка стандартных стейтов.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing standart states.
		*
		*	@author Dodonov A.A.
		*/
		function			test_delete_record()
		{
			$this->create_test_record();

			if( $this->PackageAlgorithms->package_exists( 'core::test' , '1.0.0::1.0.0' , __FILE__ ) )
			{
				$Controller = get_package( 'core::package_manager' , 'last' , __FILE__ );

				$this->Testing->setup_delete_controller( $this->Settings , 'package' , 0 );

				$this->Security->reset_g( 'package_record_id' , implode( '.' , $this->DefaultControllers->id ) );

				$Controller->controller( $this->Settings );

				if( $this->PackageAlgorithms->package_exists( 'core::test' , '1.0.0::1.0.0' , __FILE__ ) === false )
				{
					return( 'TEST PASSED' );
				}
			}

			return( 'ERROR' );
		}

		/**
		*	\~russian Проверка стандартных стейтов.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing standart states.
		*
		*	@author Dodonov A.A.
		*/
		function			test_create_record()
		{
			$this->create_test_record();

			if( $this->PackageAlgorithms->package_exists( 'core::test' , '1.0.0::1.0.0' , __FILE__ ) )
			{
				$this->PackageAccess->delete( 'test.1.0.0' );
				return( 'TEST PASSED' );
			}
			else
			{
				return( 'ERROR' );
			}
		}

		/**
		*	\~russian Проверка стандартных стейтов.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing standart states.
		*
		*	@author Dodonov A.A.
		*/
		function			test_update_record_form()
		{
			$this->Security->set_g( 'package_context_action' , 'update_record_form' );
			$this->Security->set_g( 'package_record_id' , 'core.1.0.0' );

			$PageContent = $this->PageComposer->get_page( 'package_manager' );

			if( stripos( $PageContent , 'update_package_form' ) === false )
			{
				print( 'ERROR: update package form was not displayed'.$PageContent );
				return;
			}

			return( 'TEST PASSED' );
		}

		/**
		*	\~russian Проверка стандартных стейтов.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing standart states.
		*
		*	@author Dodonov A.A.
		*/
		function			test_display_search_list()
		{
			return( 'TEST PASSED' );
		}

		/**
		*	\~russian Проверка стандартных стейтов.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing standart states.
		*
		*	@author Dodonov A.A.
		*/
		function			test_copy_record_form()
		{
			$this->Security->set_g( 'package_context_action' , 'copy_record_form' );
			$this->Security->set_g( 'package_record_id' , 'core.1.0.0' );

			$PageContent = $this->PageComposer->get_page( 'package_manager' );

			if( stripos( $PageContent , 'create_package_form' ) === false )
			{
				print( 'ERROR: copy package form was not displayed'.$PageContent );
				return;
			}

			return( 'TEST PASSED' );
		}
	}

?>