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
		*	\~russian Закэшированный объект.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cached object.
		*
		*	@author Dodonov A.A.
		*/
		var					$Utilities = false;

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
			$this->Utilities = get_package( 'utilities' , 'last' , __FILE__ );
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
			get_package( 'testing' , 'last' , __FILE__ );

			return( 'TEST PASSED' );
		}

		/**
		*	\~russian Проверка стайта.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing state.
		*
		*	@author Dodonov A.A.
		*/
		function			test_smth_display_list()
		{
			$Files = $this->Utilities->get_files_from_directory( '.' , '/.+\.php/' , true );

			for( $i = 0 , $Errors = 0 ; $i < count( $Files ) ; $i++ )
			{
				if( strpos( $Files[ $i ] , '_manager.php' ) !== false && 
					strpos( $Files[ $i ] , 'event_manager.php' ) === false )
				{
					$Content = file_get_contents( dirname( $Files[ $i ] )."/include/php/unit_tests.php" );
					if( strpos( $Content , 'test_display_list' ) === false )
					{
						$Errors++;
						print( '<nobr>'.$Files[ $i ].'</nobr><'.'br>' );
					}
				}
			}

			return( $Errors == 0 ? 'TEST PASSED' : "ERROR( $Errors )" );
		}

		/**
		*	\~russian Проверка стайта.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing state.
		*
		*	@author Dodonov A.A.
		*/
		function			test_smth_delete_record()
		{
			$Files = $this->Utilities->get_files_from_directory( '.' , '/.+\.php/' , true );

			for( $i = 0 , $Errors = 0 ; $i < count( $Files ) ; $i++ )
			{
				$Content = file_get_contents( $Files[ $i ] );
				if( strpos( $Content , 'test_create_record' ) !== false && 
					strpos( $Content , 'test_copy_record' ) === false )
				{
					$Errors++;
					print( '<nobr>'.$Files[ $i ].'</nobr><'.'br>' );
				}
			}

			return( $Errors == 0 ? 'TEST PASSED' : "ERROR( $Errors )" );
		}

		/**
		*	\~russian Проверка стайта.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing state.
		*
		*	@author Dodonov A.A.
		*/
		function			test_smth_display_search_list()
		{
			$Files = $this->Utilities->get_files_from_directory( '.' , '/.+\.php/' , true );

			for( $i = 0 , $Errors = 0 ; $i < count( $Files ) ; $i++ )
			{
				$Content = file_get_contents( $Files[ $i ] );
				if( strpos( $Content , 'test_display_list' ) !== false && 
					strpos( $Content , 'test_smth_display_search_list' ) === false )
				{
					$Errors++;
					print( '<nobr>'.$Files[ $i ].'</nobr><'.'br>' );
				}
			}

			return( $Errors == 0 ? 'TEST PASSED' : "ERROR( $Errors )" );
		}

		/**
		*	\~russian Проверка стайта.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing state.
		*
		*	@author Dodonov A.A.
		*/
		function			test_smth_display_create_record_form()
		{
			$Files = $this->Utilities->get_files_from_directory( '.' , '/.+\.php/' , true );

			for( $i = 0 , $Errors = 0 ; $i < count( $Files ) ; $i++ )
			{
				$Content = file_get_contents( $Files[ $i ] );
				if( strpos( $Content , 'test_display_list' ) !== false && 
					strpos( $Content , 'test_create_record_form' ) === false )
				{
					$Errors++;
					print( '<nobr>'.$Files[ $i ].'"</nobr><'.'br>' );
				}
			}

			return( $Errors == 0 ? 'TEST PASSED' : "ERROR( $Errors )" );
		}

		/**
		*	\~russian Проверка стайта.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing state.
		*
		*	@author Dodonov A.A.
		*/
		function			test_smth_create_record()
		{
			$Files = $this->Utilities->get_files_from_directory( '.' , '/.+\.php/' , true );

			for( $i = 0 , $Errors = 0 ; $i < count( $Files ) ; $i++ )
			{
				$Content = file_get_contents( $Files[ $i ] );
				if( strpos( $Content , 'test_create_record_form' ) !== false && 
					strpos( $Content , 'test_create_record' ) === false )
				{
					$Errors++;
					print( '<nobr>'.$Files[ $i ].'</nobr><'.'br>' );
				}
			}

			return( $Errors == 0 ? 'TEST PASSED' : "ERROR( $Errors )" );
		}

		/**
		*	\~russian Проверка стайта.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing state.
		*
		*	@author Dodonov A.A.
		*/
		function			test_smth_display_update_record_form()
		{
			$Files = $this->Utilities->get_files_from_directory( '.' , '/.+\.php/' , true );

			for( $i = 0 , $Errors = 0 ; $i < count( $Files ) ; $i++ )
			{
				$Content = file_get_contents( $Files[ $i ] );
				if( strpos( $Content , 'test_display_list' ) !== false && 
					strpos( $Content , 'test_update_record_form' ) === false )
				{
					$Errors++;
					print( '<nobr>'.$Files[ $i ].'</nobr><'.'br>' );
				}
			}

			return( $Errors == 0 ? 'TEST PASSED' : "ERROR( $Errors )" );
		}

		/**
		*	\~russian Проверка стайта.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing state.
		*
		*	@author Dodonov A.A.
		*/
		function			test_smth_update_record()
		{
			$Files = $this->Utilities->get_files_from_directory( '.' , '/.+\.php/' , true );

			for( $i = 0 , $Errors = 0 ; $i < count( $Files ) ; $i++ )
			{
				$Content = file_get_contents( $Files[ $i ] );
				if( strpos( $Content , 'test_create_record' ) !== false && 
					strpos( $Content , 'test_update_record' ) === false )
				{
					$Errors++;
					print( '<nobr>'.$Files[ $i ].'</nobr><'.'br>' );
				}
			}

			return( $Errors == 0 ? 'TEST PASSED' : "ERROR( $Errors )" );
		}

		/**
		*	\~russian Проверка стайта.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing state.
		*
		*	@author Dodonov A.A.
		*/
		function			test_smth_display_copy_record_form()
		{
			$Files = $this->Utilities->get_files_from_directory( '.' , '/.+\.php/' , true );

			for( $i = 0 , $Errors = 0 ; $i < count( $Files ) ; $i++ )
			{
				$Content = file_get_contents( $Files[ $i ] );
				if( strpos( $Content , 'test_display_list' ) !== false && 
					strpos( $Content , 'test_copy_record_form' ) === false )
				{
					$Errors++;
					print( '<nobr>'.$Files[ $i ].'</nobr><'.'br>' );
				}
			}

			return( $Errors == 0 ? 'TEST PASSED' : "ERROR( $Errors )" );
		}

		/**
		*	\~russian Проверка стайта.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing state.
		*
		*	@author Dodonov A.A.
		*/
		function			test_smth_copy_record()
		{
			$Files = $this->Utilities->get_files_from_directory( '.' , '/.+\.php/' , true );

			for( $i = 0 , $Errors = 0 ; $i < count( $Files ) ; $i++ )
			{
				$Content = file_get_contents( $Files[ $i ] );
				if( strpos( $Content , 'test_create_record' ) !== false && 
					strpos( $Content , 'test_copy_record' ) === false )
				{
					$Errors++;
					print( '<nobr>'.$Files[ $i ].'</nobr><'.'br>' );
				}
			}

			return( $Errors == 0 ? 'TEST PASSED' : "ERROR( $Errors )" );
		}
	}

?>