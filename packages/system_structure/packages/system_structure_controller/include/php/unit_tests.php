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
			get_package( 'system_structure::system_structure_controller' , 'last' , __FILE__ );

			return( 'TEST PASSED' );
		}
	}

?>