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
		var					$ErrorLogAccess = false;
		var					$ErrorLogView = false;
		var					$Options = false;
		
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
			$this->ErrorLogAccess = get_package( 'error_log::error_log_access' , 'last' , __FILE__ );
			$this->ErrorLogView = get_package( 'error_log::error_log_view' , 'last' , __FILE__ );
			$this->Options = get_package_object( 'settings::settings' , 'last' , __FILE__ );
		}
	
		/**
		*	\~russian Тестирование генерации страницы и вывода списка записей.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing page generation with list of records.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author  Dodonov A.A.
		*/
		function			test_simple_view()
		{
			try
			{
				//TODO: copy this unit-test to all *_view packages and test simple view
				$this->ErrorLogAccess->add_message_to_log( 1 , 'title_of_testing_record' , 'description' );

				$this->Options->load_settings( 'view=1;list_of_messages=1' );
				$Page = $this->ErrorLogView->view( $this->Options );

				if( strpos( $Page , 'title_of_testing_record' ) !== false )
				{
					$Result = 'TEST PASSED';
				}
				else
				{
					$Result = 'ERROR';
				}

				$Messages = $this->ErrorLogAccess->unsafe_select_messages( '1 ORDER BY id DESC LIMIT 0 , 1' );
				$this->ErrorLogAccess->delete_error_log( $Messages[ 0 ]->id );

				return( $Result );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>