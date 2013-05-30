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
		var					$Access = false;
		var					$DatabaseAlgorithms = false;
		var					$DefaultControllers = false;
		var					$Entity = 'content';
		var					$PageComposer = false;
		var					$PackageName = 'content::content_manager';
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
				$this->Access = get_package( 'content::content_access' );
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
			get_package( 'content::content_manager' , 'last' , __FILE__ );

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
			return( $this->Testing->test_display_list_form( 'content' , 'content' ) );
		}

		/**
		*	\~russian Установка данных.
		*
		*	@author Додонов А.А.
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
			$this->Security->set_g( 'category' , '1' );
			$this->Security->set_g( 'demo_content' , 'test_demo_content' );
			$this->Security->set_g( 'main_content' , 'test_main_content' );
			$this->Security->set_g( 'keywords' , 'test_keywords' );
			$this->Security->set_g( 'description' , 'test_description' );
			$this->Security->set_g( 'print_content' , 'test_print_content' );
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
			$this->set_demo_data_for_creation();

			$Controller = get_package( 'content::content_manager' , 'last' , __FILE__ );

			$this->Testing->setup_create_controller( $this->Settings , 'content' );

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

			if( $this->DatabaseAlgorithms->record_exists( 'umx_content' , 'demo_content LIKE "test_demo_content"' ) )
			{
				$Controller = get_package( 'content::content_manager' , 'last' , __FILE__ );

				$this->Testing->setup_delete_controller( $this->Settings , 'content' , $this->DefaultControllers->id );

				$Controller->controller( $this->Settings );

				$Exists = $this->DatabaseAlgorithms->record_exists( 
					'umx_content' , 'demo_content LIKE "test_demo_content"'
				);

				if( $Exists === false )
				{
					return( 'TEST PASSED' );
				}
			}

			return( 'ERROR' );
		}
		
		/**
		*	\~russian Тестирование контроллера.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing controller.
		*
		*	@author Dodonov A.A.
		*/
		function			test_create_record()
		{
			return( $this->Testing->test_create_record( $this , 'demo_content' , 'test_demo_content' ) );
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
		function			test_update_record()
		{
			return( $this->Testing->test_update_record( $this , 'demo_content' , 'test_demo_content2' ) );
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
			return( $this->Testing->test_create_form( 'content' ) );
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
			return( $this->Testing->test_update_form( 'content' ) );
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
			$this->Security->set_p( 'search_string' , 'the latest release of the Ultimix framework' );
			$PageContent = $this->PageComposer->get_page( 'content_manager' );
			$Exists = strpos( $PageContent , 'the latest release of the Ultimix framework' ) !== false;

			$this->Security->reset_p( 'search_string' , 'unexisting_search_string' );
			$PageContent = $this->PageComposer->get_page( 'content_manager' );
			$NotExists = strpos( $PageContent , 'the latest release of the Ultimix framework' ) === false;

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
			$this->Security->set_g( 'content_context_action' , 'copy_record_form' );
			$this->Security->set_g( 'content_record_id' , '1' );

			$PageContent = $this->PageComposer->get_page( 'content_manager' );

			if( stripos( $PageContent , 'create_content_form' ) === false )
			{
				return( 'ERROR: copy content form was not displayed'.$PageContent );
			}

			return( 'TEST PASSED' );
		}
	}

?>