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
		*	\~russian Получение директории пакета.
		*
		*	@return Путь к пакету.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Getting package directory.
		*
		*	@return Package path.
		*
		*	@exception Exception An exception of this type is thrown.
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
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Getting object with tests.
		*
		*	@return Object with unit-tests.
		*
		*	@exception Exception An exception of this type is thrown.
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
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
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
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			security( $Options )
		{
			try
			{
				$UserController = get_package( 'user::user_controller' , 'last' , __FILE__ );
				$UserController->login( $Options );

				$Permits = get_package( 'permit::permit_algorithms' , 'last' , __FILE__ );
				if( $Permits->object_has_permit( false , 'user' , 'tester' ) === false )
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
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns subtests count.
		*
		*	@return Subtests count.
		*
		*	@exception Exception An exception of this type is thrown.
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
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns subtest's name.
		*
		*	@return Subtest's name.
		*
		*	@exception Exception An exception of this type is thrown.
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
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function runs exact test.
		*
		*	@return Test's result.
		*
		*	@exception Exception An exception of this type is thrown.
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
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
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
		*	@exception Exception An exception of this type is thrown.
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
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function runs test.
		*
		*	@return Test's result.
		*
		*	@exception Exception An exception of this type is thrown.
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
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function runs viwe's functions.
		*
		*	@return Result.
		*
		*	@exception Exception An exception of this type is thrown.
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
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
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
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			view( $Options )
		{
			try
			{
				if( ( $Result = $this->security( $Options ) ) !== false )
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