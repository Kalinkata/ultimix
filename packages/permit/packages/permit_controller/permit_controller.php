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
	*	\~russian Контроллер управления компонентом.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Controller.
	*
	*	@author Dodonov A.A.
	*/
	class		permit_controller_1_0_0{
		
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
		var					$PermitAccess = false;
		var					$PermitAlgorithms = false;
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
				$this->PermitAccess = get_package( 'permit::permit_access' , 'last' , __FILE__ );
				$this->PermitAlgorithms = get_package( 'permit::permit_algorithms' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция управлением компонентом.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function controlls component.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_permit( $Options )
		{
			try
			{
				$Permit = $this->Security->get_gp( 'permit' , 'command' );
				$MasterType = $this->Security->get_gp( 'master_type' , 'command' );
				
				if( $this->Security->get_gp( 'ids' , 'set' ) )
				{
					$MasterId = explode( ',' , $this->Security->get_gp( 'ids' , 'string' ) );
				}
				else
				{
					$MasterId = array( $this->Security->get_gp( 'master_id' , 'integer' ) );
				}

				$this->PermitAccess->set_permit_for_object( $Permit , $MasterId , $MasterType );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция управлением компонентом.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function controlls component.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			delete_permit( $Options )
		{
			try
			{
				$Permit = $this->Security->get_gp( 'permit' , 'command' );
				$MasterType = $this->Security->get_gp( 'master_type' , 'command' );
				
				if( $this->Security->get_gp( 'ids' , 'set' ) )
				{
					$MasterId = explode( ',' , $this->Security->get_gp( 'ids' , 'string' ) );
				}
				else
				{
					$MasterId = array( $this->Security->get_gp( 'master_id' , 'integer' ) );
				}

				$this->PermitAccess->delete_permit_for_object( $Permit , $MasterId , $MasterType );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция управлением компонентом.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function controlls component.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			toggle_permit( $Options )
		{
			try
			{
				$Permit = $this->Security->get_gp( 'permit' , 'command' );
				$MasterType = $this->Security->get_gp( 'master_type' , 'command' );
				
				if( $this->Security->get_gp( 'ids' , 'set' ) )
				{
					$MasterId = explode( ',' , $this->Security->get_gp( 'ids' , 'string' ) );
				}
				else
				{
					$MasterId = array( $this->Security->get_gp( 'master_id' , 'integer' ) );
				}

				$this->PermitAccess->toggle_permit_for_object( $Permit , $MasterId , $MasterType );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Обработчик события удаления страницы.
		*
		*	@param $Parameters - Параметры сообщения.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Page deletion event handler.
		*
		*	@param $Parameters - Event parameters.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			on_after_delete_page( $Parameters )
		{
			try
			{
				$Object = $this->Security->get( get_field( $Parameters , 'page_name' ) , 'command' );

				$this->PermitAccess->delete_permits_for_page( $Object );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция управлением компонентом.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function controlls component.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			controller( $Options )
		{
			try
			{
				$ContextSet = get_package_object( 'gui::context_set' , 'last' , __FILE__ );
				
				$ContextSet->add_context( dirname( __FILE__ ).'/conf/cfcx_set_permit' );
				
				$ContextSet->add_context( dirname( __FILE__ ).'/conf/cfcx_delete_permit' );
				
				$ContextSet->add_context( dirname( __FILE__ ).'/conf/cfcx_toggle_permit' );
				
				$ContextSet->execute( $Options , $this , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>