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
	*	\~russian Класс установки поля записей.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides record field set routine.
	*
	*	@author Dodonov A.A.
	*/
	class	set_field_1_0_0{
		
		/**
		*	\~russian Закэшированные пакеты.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cached packages.
		*
		*	@author Dodonov A.A.
		*/
		var					$Database = false;
		var					$Security = false;
		var					$PermitAlgorithms = false;
		
		/**
		*	\~russian Конструктор.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
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
				$this->Database = get_package( 'database' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->PermitAlgorithms = get_package( 'permit::permit_algorithms' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Установка поля.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method sets field.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private	function	set_field( &$Options )
		{
			try
			{
				$PackageName = $Options->get_setting( 'access_package_name' );
				$PackageVersion = $Options->get_setting( 'access_package_version' , 'last' );
				$Accessor = get_package( $PackageName , $PackageVersion , __FILE__ );
				$FunctionName = $Options->get_setting( 'update_func' );

				$Func = array( $Accessor , $FunctionName );

				$Ids = $this->Security->get_gp( 'ids' , '' );

				$UpdateRecord = array();
				$UpdateRecord[ $Options->get_setting( 'field' ) ] = $Options->get_setting( 'value' );

				call_user_func( $Func , implode( ',' , $Ids ) , $UpdateRecord , $Options );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция упраления компонентом.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Component's controller.
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
				$NotDirectControllerCall = $this->Security->get_s( 'direct_controller' , 'integer' , 0 ) == 0;
				$HasPermits = $this->PermitAlgorithms->object_has_permit( false , 'user' , $Permit );
				$GetPostParamsPassed = $this->Security->get_gp( 'set_field' , 'integer' , 1 );
				$Permit = $Options->get_setting( 'permit' , 'admin' );
				
				if( $NotDirectControllerCall && $HasPermits && $GetPostParamsPassed )
				{
					$this->set_field( $Options );
				}
			}
			catch( Exception $e )
			{
				$Args = func_get_args();_throw_exception_object( __METHOD__ , $Args , $e );
			}
		}
	}

?>