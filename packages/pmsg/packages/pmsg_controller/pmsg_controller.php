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
	*	\~russian Работа с личными сообщениями.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Working with private messages.
	*
	*	@author Dodonov A.A.
	*/
	class	pmsg_controller_1_0_0{
		
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
		var					$MessageAccess = false;
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
				$this->MessageAccess = get_package( 'pmsg::pmsg_access' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Отметка о прочтении.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Setting 'read' mark.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_read()
		{
			try
			{
				$id = $this->Security->get_gp( 'id' , 'integer' , 0 );
				
				$PmsgAlgorithms = get_package( 'pmsg::pmsg_algorithms' , 'last' , __FILE__ );
				$PmsgAlgorithms->set_read( $id );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отправки отзыва.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sends feedback.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function		send_feedback()
		{
			try
			{
				$SecurityParser = get_package( 'security::security_parser' , 'last' , __FILE__ );

				$Captcha = get_package( 'captcha' , 'last' , __FILE__ );

				if( $Captcha->validate_captcha( $this->Security->get_p( 'captcha' , 'command' ) ) )
				{
					$Params = $SecurityParser->parse_http_parameters( 'message:string' );

					$this->MessageAccess->create( 
						'guest' , $this->MessageAccess->get_feedback_admin() , $Params->message
					);

					$this->Security->reset_p( 'message' , '' );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Функция управления компонентом.
		*
		*	@param $Options - настройки работы модуля.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function controls component.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			controller( &$Options )
		{
			try
			{				
				$ContextSet = get_package( 'gui::context_set' , 'last' , __FILE__ );
				
				$ContextSet->add_context( dirname( __FILE__ ).'/conf/cfcx_feedback' );
				$ContextSet->add_context( dirname( __FILE__ ).'/conf/cfcx_read' );
				$ContextSet->add_context( dirname( __FILE__ ).'/conf/cfcx_cleanup' );
				
				$ContextSet->execute( $Options , $this , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>