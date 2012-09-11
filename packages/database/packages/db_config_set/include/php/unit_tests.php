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
		*	\~russian Функция эмулирующая поведение адаптера.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function emulates adapter behaviour.
		*
		*	@author Dodonov A.A.
		*/
		function		connect( $ConfigRow )
		{
			if( $ConfigRow == '1' )
			{
				return( true );
			}
			else
			{
				throw( new Exception( 'Connection failed' ) );
			}
		}

		/**
		*	\~russian Функция эмулирующая поведение адаптера.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function emulates adapter behaviour.
		*
		*	@author Dodonov A.A.
		*/
		function		get_connection()
		{
			return( true );
		}

		/**
		*	\~russian Проверка.
		*
		*	@return $MTime - Время модификации файла.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Test result validation.
		*
		*	@return $MTime - Modification time.
		*
		*	@author Dodonov A.A.
		*/
		function		validate_test_connection_without_errors( $MTime )
		{
			if( filemtime( dirname( __FILE__ ).'/cf_config' ) != $MTime )
			{
				return( 'ERROR: file was changed' );
			}
			else
			{
				return( 'TEST PASSED' );
			}

			unlink( dirname( __FILE__ ).'/cf_config' );
		}

		/**
		*	\~russian Подключение с первого раза.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Connecting without any errors.
		*
		*	@author Dodonov A.A.
		*/
		function		test_connection_without_errors()
		{
			try
			{
				$CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$CachedMultyFS->file_put_contents( dirname( __FILE__ ).'/cf_config' , "1\r\n2" );

				$MTime = filemtime( dirname( __FILE__ ).'/cf_config' );

				$DBConfigSet = get_package( 'database::db_config_set' , 'last' , __FILE__ );
				$DBConfigSet->load_config( dirname( __FILE__ ).'/cf_config' );

				$Connection = $DBConfigSet->connect( $this );

				return( $this->validate_test_connection_without_errors( $MTime ) );
			}
			catch( Exception $e )
			{
				unlink( dirname( __FILE__ ).'/cf_config' );
				return( 'ERROR: exception was thrown' );
			}
		}

		/**
		*	\~russian Проверка.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Test result validation.
		*
		*	@author Dodonov A.A.
		*/
		function		validate_test_connection_with_errors()
		{
			try
			{
				$CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$Content = $CachedMultyFS->file_get_contents( dirname( __FILE__ ).'/cf_config' );
				if( $Content != "1\r\n2\r\n" )
				{
					unlink( dirname( __FILE__ ).'/cf_config' );
					return( "ERROR: illegal config content : $Content" );
				}
				else
				{
					/* $DBConfigSet->connect эксепшена не кинула и файл конфига не изменился */
					unlink( dirname( __FILE__ ).'/cf_config' );
					return( 'TEST PASSED' );
				}
			}
			catch( Exception $e )
			{
				unlink( dirname( __FILE__ ).'/cf_config' );
				return( 'ERROR: exception was thrown' );
			}
		}

		/**
		*	\~russian Подключение не с первого раза.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Connecting with some errors.
		*
		*	@author Dodonov A.A.
		*/
		function		test_connection_with_errors()
		{
			try
			{
				$CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$CachedMultyFS->file_put_contents( dirname( __FILE__ ).'/cf_config' , "2\r\n1" );

				$DBConfigSet = get_package( 'database::db_config_set' , 'last' , __FILE__ );

				$DBConfigSet->load_config( dirname( __FILE__ ).'/cf_config' );

				$Connection = $DBConfigSet->connect( $this );

				return( $this->validate_test_connection_with_errors() );
			}
			catch( Exception $e )
			{
				unlink( dirname( __FILE__ ).'/cf_config' );
				return( 'ERROR: exception was thrown' );
			}
		}

		/**
		*	\~russian Подключение не удалось.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Connection failed.
		*
		*	@author Dodonov A.A.
		*/
		function		test_no_connection()
		{
			$Path = dirname( __FILE__ );
			try
			{
				$CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$CachedMultyFS->file_put_contents( $Path.'/cf_config' , "2\r\n3" );

				$DBConfigSet = get_package( 'database::db_config_set' , 'last' , __FILE__ );

				$DBConfigSet->load_config( $Path.'/cf_config' );

				$Connection = $DBConfigSet->connect( $this );

				unlink( $Path.'/cf_config' );
				return( 'ERROR: exception must be thrown' );
			}
			catch( Exception $e )
			{
				if( $CachedMultyFS->file_get_contents( $Path.'/cf_config' ) != "2\r\n3" )
				{
					unlink( $Path.'/cf_config' );
					return( 'ERROR: illegal config content' );
				}
				unlink( $Path.'/cf_config' );
				return( 'TEST PASSED' );
			}
		}
	}

?>