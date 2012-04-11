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
		*	\~russian Закешированные пакеты.
		*
		*	@author Dodonov A.A.
		*/
		/**
		*	\~english Cached packages.
		*
		*	@author Dodonov A.A.
		*/
		var					$ErrorLogController = false;
		var					$ErrorLogAccess = false;
		var					$Security = false;
		var					$Options = false;

		/**
		*	\~russian Конструктор.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Constructor.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			__construct()
		{
			try
			{
				$this->ErrorLogController = get_package( 'error_log::error_log_controller' , 'last' , __FILE__ );
				$this->ErrorLogAccess = get_package( 'error_log::error_log_access' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->Options = get_package_object( 'settings::settings' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Проверка.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Validation.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	validate_test_controller_delete()
		{
			try
			{
				$Messages2 = $this->ErrorLogAccess->unsafe_select_messages( '1 ORDER BY id DESC LIMIT 0 , 1' );

				if( $Messages2[ 0 ]->title == 'title_of_testing_record' )
				{
					$ErrorLogAccess->delete_error_log( $Messages2[ 0 ]->id );
					return( 'ERROR' );
				}

				return( 'TEST PASSED' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Тестирование удаления записей.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing records deletion.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			test_controller_delete()
		{
			try
			{
				$this->ErrorLogAccess->add_message_to_log( 1 , 'title_of_testing_record' , 'description' );
				$Messages1 = $this->ErrorLogAccess->unsafe_select_messages( '1 ORDER BY id DESC LIMIT 0 , 1' );
				$this->Security->reset_p( '_id_'.$Messages1[ 0 ]->id , '_id_'.$Messages1[ 0 ]->id );
				$this->Security->reset_p( 'error_action' , 'massive_delete' );
				$Options->load_settings( 'delete_error=1;controller=1' );
				$this->ErrorLogController->controller( $Options );
				
				return( $this->validate_test_controller_delete() );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>