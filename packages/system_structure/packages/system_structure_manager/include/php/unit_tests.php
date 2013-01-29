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
		var					$DatabaseAlgorithms = false;
		var					$DefaultControllers = false;
		var					$PageComposer = false;
		var					$Security = false;
		var					$Settings = false;
		var					$SystemStructureAccess = false;
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
				$this->DatabaseAlgorithms = get_package( 'database::database_algorithms' );
				$this->DefaultControllers = get_package( 'gui::context_set::default_controllers' );
				$this->PageComposer = get_package_object( 'page::page_composer' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->SystemStructureAccess = get_package( 
					'system_structure::system_structure_access' , 'last' , __FILE__
				);
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
		function			set_up()
		{
			$this->Settings->clear();
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
		function			tear_down()
		{
		}

		/**
		*	\~russian Проверка загрузки пакета.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing package loading.
		*
		*	@author Dodonov A.A.
		*/
		function			test_load_package()
		{
			get_package( 'system_structure::system_structure_manager' , 'last' , __FILE__ );

			return( 'TEST PASSED' );
		}

		/**
		*	\~russian Тестирование вида.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing view.
		*
		*	@author Dodonov A.A.
		*/
		function			test_create_record()
		{
			$this->Security->set_g( 'page' , 'test_page' );
			$this->Security->set_g( 'root_page' , 'test_root_page' );
			$this->Security->set_g( 'navigation' , 'test_navigation' );
			$this->Security->set_g( 'auto_redirect' , 0 );

			$Controller = get_package( 'system_structure::system_structure_manager' , 'last' , __FILE__ );

			$this->Testing->setup_controller( $this->Settings , 'system_structure' );

			$Controller->controller( $this->Settings );

			if( $this->DatabaseAlgorithms->record_exists( 'umx_system_structure' , 'page LIKE "test_page"' ) )
			{
				$this->SystemStructureAccess->delete( $this->DefaultControllers->id );
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
		function			test_display_list()
		{
			$PageContent = $this->PageComposer->get_page( 'system_structure_manager' );

			if( stripos( $PageContent , 'site_manager' ) === false )
			{
				print( 'ERROR: system structure list was not displayed' );
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
		function			test_create_record_form()
		{
			$this->Security->set_g( 'system_structure_context_action' , 'create_record_form' );

			$PageContent = $this->PageComposer->get_page( 'system_structure_manager' );

			if( stripos( $PageContent , 'create_system_structure_form' ) === false )
			{
				print( 'ERROR: system structure create form was not displayed'.$PageContent );
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
		function			test_update_record_form()
		{
			$this->Security->set_g( 'system_structure_context_action' , 'update_record_form' );
			$this->Security->set_g( 'system_structure_record_id' , '1' );

			$PageContent = $this->PageComposer->get_page( 'system_structure_manager' );

			if( stripos( $PageContent , 'update_system_structure_form' ) === false )
			{
				print( 'ERROR: update system structure form was not displayed'.$PageContent );
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
			$this->Security->set_p( 'search_string' , 'system_structure_manager' );
			$PageContent = $this->PageComposer->get_page( 'system_structure_manager' );
			$Exists = strpos( $PageContent , 'system_structure_manager' ) !== false;

			$this->Security->reset_p( 'search_string' , 'unexisting_search_string' );
			$PageContent = $this->PageComposer->get_page( 'system_structure_manager' );
			$NotExists = strpos( $PageContent , 'system_structure_manager' ) === false;

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
			$this->Security->set_g( 'system_structure_context_action' , 'copy_record_form' );
			$this->Security->set_g( 'system_structure_record_id' , '1' );

			$PageContent = $this->PageComposer->get_page( 'system_structure_manager' );

			if( stripos( $PageContent , 'create_system_structure_form' ) === false )
			{
				print( 'ERROR: copy system structure form was not displayed'.$PageContent );
				return;
			}

			return( 'TEST PASSED' );
		}
	}

?>