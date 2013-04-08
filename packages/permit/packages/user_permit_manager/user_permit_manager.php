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
	*	\~russian Класс для управления компонентом.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english This class controls component.
	*
	*	@author Додонов А.А.
	*/
	class		user_permit_manager_1_0_0{

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
		var					$CachedMultyFS = false;
		var					$GroupAccess = false;
		var					$Link = false;
		var					$PermitAccess = false;
		var					$PermitAlgorithms = false;
		var					$Security = false;
		var					$UserAccess = false;
		var					$UserAlgorithms = false;

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
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->GroupAccess = get_package( 'permit::group_access' , 'last' , __FILE__ );
				$this->Link = get_package( 'link' , 'last' , __FILE__ );
				$this->PermitAccess = get_package( 'permit::permit_access' , 'last' , __FILE__ );
				$this->PermitAlgorithms = get_package( 'permit::permit_algorithms' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->UserAccess = get_package( 'user::user_access' , 'last' , __FILE__ );
				$this->UserAlgorithms = get_package( 'user::user_algorithms' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция котроллера компонента.
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
		function			change_permits_controller( $Options )
		{
			try
			{
				$UserId = $this->Security->get_p( 'record_id' , 'integer' );
				$Permits = $this->Security->get_p( 'permits' , 'command' , array() );

				$HasPermits = $this->PermitAlgorithms->get_permits_for_object( $UserId , 'user' , false );
				foreach( $HasPermits as $p )
				{
					if( in_array( $p , $Permits ) === false )
					{
						$p = $this->PermitAccess->get_permit_by_name( $p );
						$this->Link->delete_link( $UserId , $p->id , 'user' , 'permit' );
					}
				}

				foreach( $Permits as $p )
				{
					$this->PermitAccess->add_permit_for_object( $p , $UserId , 'user' );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция котроллера компонента.
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
		function			change_groups_controller( $Options )
		{
			try
			{
				$UserId = $this->Security->get_p( 'record_id' , 'integer' );
				$Groups = $this->Security->get_p( 'groups' , 'command' , array() );

				$HasGroups = $this->GroupAccess->get_groups_for_object( $UserId , 'user' );
				foreach( $HasGroups as $g )
				{
					if( in_array( $g , $Groups ) === false )
					{
						$g = $this->GroupAccess->get_group_by_name( $g );
						$this->Link->delete_link( $UserId , $g->id , 'user' , 'group' );
					}
				}

				foreach( $Groups as $p )
				{
					$this->GroupAccess->add_group_for_object( $p , $UserId , 'user' );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отрисовки компонента.
		*
		*	@param $Options - настройки работы модуля.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws component.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			change_permits_view( &$Options )
		{
			try
			{
				$User = $this->UserAlgorithms->get_by_id( 
					$this->Security->get_p( 'user_permit_record_id' , 'integer' )
				);
				$this->Output = $this->CachedMultyFS->get_template( __FILE__ , 'permits_view.tpl' );
				$this->Output = str_replace( '{path}' , dirname( __FILE__ ) , $this->Output );
				$this->Output = str_replace( '{login}' , $User->login , $this->Output );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отрисовки компонента.
		*
		*	@param $Options - настройки работы модуля.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws component.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			change_groups_view( &$Options )
		{
			try
			{
				$User = $this->UserAlgorithms->get_by_id( 
					$this->Security->get_p( 'user_permit_record_id' , 'integer' )
				);
				$this->Output = $this->CachedMultyFS->get_template( __FILE__ , 'groups_view.tpl' );
				$this->Output = str_replace( '{path}' , dirname( __FILE__ ) , $this->Output );
				$this->Output = str_replace( '{login}' , $User->login , $this->Output );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отрисовки компонента.
		*
		*	@param $Options - настройки работы модуля.
		*
		*	@return HTML код компонента.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws component.
		*
		*	@param $Options - Settings.
		*
		*	@return HTML code of the компонента.
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
				
				$ContextSet->add_context( dirname( __FILE__ ).'/conf/cfcx_change_permits_controller' );
				$ContextSet->add_context( dirname( __FILE__ ).'/conf/cfcx_change_groups_controller' );
				$ContextSet->execute( $Options , $this , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отрисовки компонента.
		*
		*	@param $Options - настройки работы модуля.
		*
		*	@return HTML код компонента.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws component.
		*
		*	@param $Options - Settings.
		*
		*	@return HTML code of the компонента.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			view( $Options )
		{
			try
			{
				$ContextSet = get_package_object( 'gui::context_set' , 'last' , __FILE__ );
				
				$ContextSet->add_context( dirname( __FILE__ ).'/conf/cfcx_change_permits_view' );
				$ContextSet->add_context( dirname( __FILE__ ).'/conf/cfcx_change_groups_view' );
				$ContextSet->execute( $Options , $this , __FILE__ );
				
				return( $this->Output );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>