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
		var					$ContentAccess = false;
		var					$DatabaseAlgorithms = false;
		var					$DefaultControllers = false;
		var					$Security = false;
		var					$Settings = false;
		var					$SiteAccess = false;
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
		*	\~russian Обработка некорректных макросов.
		*
		*	@author Додонов А.А.
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
			$this->Security->set_g( 'category' , '0' );
			$this->Security->set_g( 'demo_content' , 'test_demo_content' );
			$this->Security->set_g( 'main_content' , 'test_main_content' );
			$this->Security->set_g( 'keywords' , 'test_keywords' );
			$this->Security->set_g( 'description' , 'test_description' );
			$this->Security->set_g( 'print_content' , 'test_print_content' );
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