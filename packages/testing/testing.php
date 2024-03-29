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
	class	testing_1_0_0{

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
		var					$Security = false;

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
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Объект с юнит-тестами.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Object with unit-tests.
		*
		*	@author Dodonov A.A.
		*/
		var					$TestingObject = false;

		/**
		*	\~russian Подготовка среды к запуску контроллера создания.
		*
		*	@param $Settings - Параметры запуска.
		*
		*	@param $Prefix - Префикс.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Prepearing environment for creting controller startup.
		*
		*	@param $Settings - Settings.
		*
		*	@param $Prefix - Prefix.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			setup_create_controller( &$Settings , $Prefix )
		{
			try
			{
				$this->Security->reset_g( $Prefix.'_context_action' , 'create_record_form' );
				$this->Security->reset_g( $Prefix.'_action' , 'create_record' );

				$Settings->clear();
				$Settings->set_setting( 'create_'.$Prefix , 1 );
				$Settings->set_setting( 'controller' , 1 );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Подготовка среды к запуску контроллера создания.
		*
		*	@param $UnitTests - Объект теста.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Prepearing environment for creating controller startup.
		*
		*	@param $UnitTests - Testing object.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			setup_update_controller( &$UnitTests )
		{
			try
			{
				$this->Security->reset_g( $UnitTests->Entity.'_context_action' , 'update_record_form' );
				$this->Security->reset_g( $UnitTests->Entity.'_action' , 'update_record' );
				$this->Security->reset_g( $UnitTests->Entity.'_record_id' , $UnitTests->DefaultControllers->id );

				$UnitTests->Settings->clear();
				$UnitTests->Settings->set_setting( 'update_'.$UnitTests->Entity , 1 );
				$UnitTests->Settings->set_setting( 'controller' , 1 );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Подготовка среды к запуску контроллера удаления.
		*
		*	@param $Settings - Параметры запуска.
		*
		*	@param $Prefix - Префикс.
		*
		*	@param $id - Идентификатор удаляемой записи.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Prepearing environment for deleting controller startup.
		*
		*	@param $Settings - Settings.
		*
		*	@param $Prefix - Prefix.
		*
		*	@param $id - id of the deleting record.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			setup_delete_controller( &$Settings , $Prefix , $id )
		{
			try
			{
				$this->Security->reset_g( $Prefix.'_context_action' , '' );
				$this->Security->reset_g( $Prefix.'_action' , 'delete_record' );
				$this->Security->reset_g( $Prefix.'_record_id' , '-1' );
				$this->Security->reset_g( '_id_'.$id , 'on' );

				$Settings->clear();
				$Settings->set_setting( 'delete_'.$Prefix , 1 );
				$Settings->set_setting( 'controller' , 1 );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Тестирование формы создания.
		*
		*	@param $Prefix - Префикс.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing create form.
		*
		*	@param $Prefix - Prefix.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			test_create_form( $Prefix )
		{
			try
			{
				$this->Security->reset_g( $Prefix.'_context_action' , 'create_record_form' );

				$PageComposer = get_package_object( 'page::page_composer' , 'last' , __FILE__ );
				$PageContent = $PageComposer->get_page( $Prefix.'_manager' );

				if( stripos( $PageContent , 'create_'.$Prefix.'_form' ) === false )
				{
					return( 'ERROR: '.$Prefix.' create form was not displayed'.$PageContent );
				}

				return( 'TEST PASSED' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Тестирование формы создания.
		*
		*	@param $Prefix - Префикс.
		*
		*	@param $id - id записи, на которой проверяем.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing update form.
		*
		*	@param $Prefix - Prefix.
		*
		*	@param $id - id of the record.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			test_update_form( $Prefix , $id = 1 )
		{
			try
			{
				$this->Security->reset_g( $Prefix.'_context_action' , 'update_record_form' );
				$this->Security->reset_g( $Prefix.'_record_id' , -1 );
				$this->Security->reset_g( '_id_'.$id , 'on' );

				$PageComposer = get_package_object( 'page::page_composer' , 'last' , __FILE__ );
				$PageContent = $PageComposer->get_page( $Prefix.'_manager' );

				if( stripos( $PageContent , 'update_'.$Prefix.'_form' ) === false )
				{
					return( 'ERROR: '.$Prefix.' update form was not displayed'.$PageContent );
				}

				return( 'TEST PASSED' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Тестирование списка записей.
		*
		*	@param $Prefix - Префикс.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing list form.
		*
		*	@param $Prefix - Prefix.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			test_display_list_form( $Prefix , $Str )
		{
			try
			{
				$PageComposer = get_package_object( 'page::page_composer' , 'last' , __FILE__ );
				$PageContent = $PageComposer->get_page( $Prefix.'_manager' );

				if( stripos( $PageContent , $Str ) === false )
				{
					return( 'ERROR: '.$Prefix.' list was not displayed' );
				}

				return( 'TEST PASSED' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Запуск контроллера.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function runs controller.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	run_update_controller( &$UnitTests )
		{
			try
			{
				$Controller = get_package( $UnitTests->PackageName , 'last' , __FILE__ );

				$Controller->controller( $UnitTests->Settings );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Проверка обновления записи.
		*
		*	@param $UnitTests - Объект тестов.
		*
		*	@param $Query - Запрос.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function tests update.
		*
		*	@param $UnitTests - Testing object.
		*
		*	@param $Query - Query.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	test_record_was_updated( &$UnitTests , $Query )
		{
			try
			{
				$Exists = $UnitTests->DatabaseAlgorithms->record_exists( 'umx_'.$UnitTests->Entity , $Query );
				$UnitTests->Access->delete( $UnitTests->DefaultControllers->id );

				if( $Exists )
				{
					return( 'TEST PASSED' );
				}
				else
				{
					return( 'ERROR' );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Проверка создания записи.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function tests create state.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			test_create_record( &$UnitTests , $Field , $Value )
		{
			try
			{
				$UnitTests->create_test_record();
				$Exists = $UnitTests->DatabaseAlgorithms->record_exists( 
					'umx_'.$UnitTests->Entity , $Field.' LIKE "'.$Value.'"'
				);

				if( $Exists )
				{
					$UnitTests->Access->delete( $UnitTests->DefaultControllers->id );
					return( 'TEST PASSED' );
				}
				else
				{
					return( 'ERROR' );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Проверка редактирования записи.
		*
		*	@param $UnitTests - Объект теста.
		*
		*	@param $Field - Изменяемое поле.
		*
		*	@param $Value - Значение поля.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function tests update state.
		*
		*	@param $UnitTests - Unit-testing object.
		*
		*	@param $Field - Field to be changed.
		*
		*	@param $Value - Value to be set.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			test_update_record( &$UnitTests , $Field , $Value )
		{
			try
			{
				$UnitTests->create_test_record();

				$this->Security->reset_g( $Field , $Value );

				$this->setup_update_controller( $UnitTests );

				$this->run_update_controller( $UnitTests );

				return( $this->test_record_was_updated( $UnitTests , $Field.' LIKE "'. $Value.'"' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение директории пакета.
		*
		*	@return Путь к пакету.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Getting package directory.
		*
		*	@return Package path.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_package_directory()
		{
			try
			{
				$Security = get_package( 'security' , 'last' );

				$PackageDirectory = _get_package_relative_path_ex( 
					$Security->get_gp( 'testing_package_name' , 'command' ) , 
					$Security->get_gp( 'testing_package_version' , 'command' , 'last' )
				);

				return( $PackageDirectory );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение объекта с тестами.
		*
		*	@return Объект с юнит-тестами.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Getting object with tests.
		*
		*	@return Object with unit-tests.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_testing_object()
		{
			try
			{
				if( $this->TestingObject === false )
				{
					$PackageDirectory = $this->get_package_directory();

					if( file_exists( "$PackageDirectory/include/php/unit_tests.php" ) === false )
					{
						return( false );
					}

					require_once( "$PackageDirectory/include/php/unit_tests.php" );
					$this->TestingObject = new unit_tests();
				}

				if( $this->TestingObject === false )
				{
					throw( new Exception( "Testing class was not found" ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Безопасность запуска вида.
		*
		*	@param $Options - Параметры отображения.
		*
		*	@return false если все нормально.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Security validations.
		*
		*	@param $Options - Display options.
		*
		*	@return false if everyting is OK.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			security_check( &$Options )
		{
			try
			{
				$UserController = get_package( 'user::user_controller' , 'last' , __FILE__ );
				$UserController->login( $Options );

				$Permits = get_package( 'permit::permit_algorithms' , 'last' , __FILE__ );
				if( $Permits->object_has_all_permits( false , 'user' , 'tester' ) === false )
				{
					$UserAlgorithms = get_package( 'user::user_algorithms' , 'last' , __FILE__ );
					print( $UserAlgorithms->get_login() );
					return( 'No permits' );
				}

				return( false );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение количества подтестов.
		*
		*	@return Количество подтестов.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns subtests count.
		*
		*	@return Subtests count.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_sub_test_count()
		{
			try
			{
				/* gettting count of tests */
				$this->get_testing_object();

				$Methods = get_class_methods( get_class( $this->TestingObject ) );

				$Counter = 0;
				foreach( $Methods as $key => $m )
				{
					if( strpos( $m , 'test' ) === 0 )
					{
						$Counter++;
					}
				}

				return( $Counter );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение названия подтеста.
		*
		*	@return Название подтеста.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns subtest's name.
		*
		*	@return Subtest's name.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_sub_test_name()
		{
			try
			{
				$this->get_testing_object();

				$Methods = get_class_methods( get_class( $this->TestingObject ) );

				$Counter = 0;
				$Security = get_package( 'security' , 'last' );
				foreach( $Methods as $key => $m )
				{
					if( strpos( $m , 'test' ) === 0 )
					{
						if( $Counter == $Security->get_gp( 'test_id' , 'integer' ) )
						{
							return( $m );
						}
						$Counter++;
					}
				}
				if( $Security->get_gp( 'test_id' , 'integer' , 0 ) >= $Counter )
				{
					return( 'Value test_id is too big. It mast be less than '.$Counter );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Запуск конкретного теста.
		*
		*	@return Результат работы теста.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function runs exact test.
		*
		*	@return Test's result.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			run_exact_test( $Methods , $m )
		{
			try
			{
				if( in_array( 'set_up' , $Methods ) )
				{
					call_user_func_array( array( $this->TestingObject , 'set_up' ) , array() );
				}

				$Result = call_user_func_array( array( $this->TestingObject , $m ) , array() );

				if( in_array( 'tear_down' , $Methods ) )
				{
					call_user_func_array( array( $this->TestingObject , 'tear_down' ) , array() );
				}

				return( $Result );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Поиск нового теста и запуск.
		*
		*	@param $Methods - Функции-тесты.
		*
		*	@return Результат работы теста.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function finds test and run it.
		*
		*	@param $Methods - Test class'es methods.
		*
		*	@return Test's result.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			find_test_and_run( $Methods )
		{
			try
			{
				$Counter = 0;
				$Security = get_package( 'security' , 'last' );

				foreach( $Methods as $key => $m )
				{
					if( strpos( $m , 'test' ) === 0 && $Counter++ == $Security->get_gp( 'test_id' , 'integer' ) )
					{
						return( $this->run_exact_test( $Methods , $m ) );
					}
				}

				if( $Security->get_gp( 'test_id' , 'integer' , 0 ) >= $Counter )
				{
					return( 'Value test_id is too big. It mast be less than '.$Counter );
				}
				else
				{
					return( 'Test was not called' );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Запуск теста.
		*
		*	@return Результат работы теста.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function runs test.
		*
		*	@return Test's result.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			run_sub_test()
		{
			try
			{
				/* running subtest */
				$this->get_testing_object();
				$Methods = get_class_methods( get_class( $this->TestingObject ) );

				if( isset( $Methods[ 0 ] ) == false )
				{
					return( 'No test were found' );
				}

				return( $this->find_test_and_run( $Methods ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Запуск функций вида.
		*
		*	@return Результат работы функции.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function runs viwe's functions.
		*
		*	@return Result.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			run_views()
		{
			try
			{
				$Security = get_package( 'security' , 'last' );

				if( $Security->get_gp( 'action' , 'command' , 'none' ) === 'get_sub_test_count' )
				{					
					return( $this->get_sub_test_count() );
				}

				if( $Security->get_gp( 'action' , 'command' , 'none' ) === 'get_sub_test_name' )
				{
					return( $this->get_sub_test_name() );
				}

				if( $Security->get_gp( 'action' , 'command' , 'none' ) === 'run_sub_test' )
				{
					return( $this->run_sub_test() );
				}

				return( 'Illegal request parameters' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Вид компонента.
		*
		*	@param $Options - Параметры отображения.
		*
		*	@return HTML код компонента.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Components view.
		*
		*	@param $Options - Display options.
		*
		*	@return HTML code of the component.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			view( &$Options )
		{
			try
			{
				if( ( $Result = $this->security_check( $Options ) ) !== false )
				{
					return( $Result );
				}

				return( $this->run_views() );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>