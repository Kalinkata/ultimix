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
	class		group_controller_1_0_0{
		
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
		function			set_group( $Options )
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

				$this->PermitAccess->set_group_for_object( $Permit , $MasterId , $MasterType );
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
		function			delete_group( $Options )
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

				$this->PermitAccess->delete_group_for_object( $Permit , $MasterId , $MasterType );
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
		function			toggle_group( $Options )
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

				$this->PermitAccess->toggle_group_for_object( $Permit , $MasterId , $MasterType );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Удаление групп для объекта.
		*
		*	@param $MasterId - Id объекта.
		*
		*	@param $MasterType - Тип объекта.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function deletes groups for object.
		*
		*	@param $MasterId - Id of the object.
		*
		*	@param $MasterType - Object's type.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	clear_groups_for_object( $MasterId , $MasterType )
		{
			try
			{
				$GroupList = $this->Security->get_gp( 'group_list' , 'string' );
				$GroupList = explode( ',' , $GroupList );
				
				foreach( $GroupList as $i => $Title )
				{
					$GroupAccess->delete_group_for_object( $Title , $MasterId , $MasterType );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Установка единственной группы для пользователя.
		*
		*	@param $Parameters - Параметры вызова.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sets single group for user.
		*
		*	@param $Parameters - Call parameters.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			on_set_single_group_for_object( $Parameters )
		{
			try
			{
				if( $this->Security->get_gp( 'group_name' , 'set' , false ) &&
					$this->PermitAlgorithms->object_has_all_permits( false , 'user' , 'permit_manager' ) )
				{
					$GroupAccess = get_package( 'permit::group_access' , 'last' , __FILE__ );

					$MasterId = get_field( $Parameters , 'master_id' );
					$MasterType = get_field( $Parameters , 'master_type' );

					$this->clear_groups_for_object( $MasterId , $MasterType );

					$GroupName = $this->Security->get_gp( 'group_name' , 'command' );

					$GroupAccess->add_group_for_object( $GroupName , $MasterId , $MasterType );
				}
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
		function			controller( &$Options )
		{
			try
			{
				$ContextSet = get_package_object( 'gui::context_set' , 'last' , __FILE__ );

				$ContextSet->add_context( dirname( __FILE__ ).'/conf/cfcx_set_group' );

				$ContextSet->add_context( dirname( __FILE__ ).'/conf/cfcx_delete_group' );

				$ContextSet->add_context( dirname( __FILE__ ).'/conf/cfcx_toggle_group' );

				$ContextSet->execute( $Options , $this , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>