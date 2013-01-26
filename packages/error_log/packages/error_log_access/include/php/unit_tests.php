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
		}
	
		/**
		*	\~russian Тестирование добавления записи.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing add_message_to_log method.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			test_add()
		{
			try
			{
				$this->ErrorLogAccess->add_message_to_log( 1 , 'title' , 'description' );
				$Messages = $this->ErrorLogAccess->unsafe_select_messages( '1 ORDER BY id DESC LIMIT 0 , 1' );

				if( count( $Messages ) != 1 )
				{
					return( 'Illegal messages count' );
				}

				$Message = $Messages[ 0 ];
				if( $Message->severity != 1 || $Message->title != 'title' || $Message->description != 'description' )
				{
					return( 'Illegal field value' );
				}

				$this->ErrorLogAccess->delete_error_log( $Message->id );

				return( 'TEST PASSED' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Тестирование удаления записи.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing delete_error_log method.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			test_delete()
		{
			try
			{
				$this->ErrorLogAccess->add_message_to_log( 1 , 'title' , 'description' );
				$Messages = $this->ErrorLogAccess->unsafe_select_messages( '1 ORDER BY id DESC LIMIT 0 , 1' );

				if( count( $Messages ) != 1 )
				{
					return( 'Illegal messages count' );
				}

				$this->ErrorLogAccess->delete_error_log( $Messages[ 0 ]->id );

				$id = $Messages[ 0 ]->id;

				$Messages = $this->ErrorLogAccess->unsafe_select_messages( '1 ORDER BY id DESC LIMIT 0 , 1' );

				if( isset( $Messages[ 0 ] ) !== false && $Messages[ 0 ]->id > $id )
				{
					return( 'Message was not deleted' );
				}

				return( 'TEST PASSED' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>