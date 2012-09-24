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
	*	\~russian Работа с доступами.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Working with worker's registry cards.
	*
	*	@author Dodonov A.A.
	*/
	class	permit_algorithms_1_0_0{
	
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
		var					$Link = false;
		var					$PermitAccess = false;
		var					$Security = false;
		var					$String = false;
		var					$UserAlgorithms = false;
	
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
				$this->Link = get_package( 'link' , 'last' , __FILE__ );
				$this->PermitAccess = get_package( 'permit::permit_access' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->UserAlgorithms = get_package( 'user::user_algorithms' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian ДОступы для пользователя.
		*
		*	@param $Object - Объект, к которому получается доступ.
		*
		*	@param $AddGroupPermits - Добавлять ли групповые доступы.
		*
		*	@note Если по каким-либо причинам не найден файл с доступами, 
		*	то считается что на объект установлен доступ admin.
		*
		*	@return Список доступов, которыми должен обладать пользователь для работы с объектом.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns permits user.
		*
		*	@param $Object - Object to be accessed.
		*
		*	@param $AddGroupPermits - Should be group permits processed.
		*
		*	@note if the file with permits was not found, all permits for that object are defaulted to 'admin'.
		*
		*	@return List of permits.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_permits_for_user( $Object , $AddGroupPermits = true )
		{
			try
			{
				$SessionId = $this->UserAlgorithms->get_id();
				$Object = ( $Object === false ) ? $SessionId : $this->Security->get( $Object , 'integer' );
				$Permits = $this->PermitAccess->get_permits_for_object( $Object , 'user' , array( 'public' ) );

				if( $AddGroupPermits )
				{
					$Permits = array_merge( 
						$Permits , $this->PermitAccess->get_permits_for_user_group( $Object )
					);
				}

				return( $Permits );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Получение доступов для объекта минуя кэш.
		*
		*	@param $Object - Объект, к которому получается доступ.
		*
		*	@param $ObjectType - Тип объекта, к которому получаются доступы.
		*
		*	@param $AddGroupPermits - Добавлять ли групповые доступы.
		*
		*	@note Если по каким-либо причинам не найден файл с доступами, 
		*	то считается что на объект установлен доступ admin.
		*
		*	@return Список доступов, которыми должен обладать пользователь для работы с объектом.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns permits for object not using cache.
		*
		*	@param $Object - Object to be accessed.
		*
		*	@param $ObjectType - Type of the accessed object (may be menu, user, page).
		*
		*	@param $AddGroupPermits - Should be group permits processed.
		*
		*	@note if the file with permits was not found, all permits for that object are defaulted to 'admin'.
		*
		*	@return List of permits.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			fetch_permits_for_object( $Object , $ObjectType = 'page' , $AddGroupPermits = true )
		{
			try
			{
				switch( $ObjectType )
				{
					case( 'group' ):
						$Permits = $this->PermitAccess->get_permits_for_object( $Object , 'group' , array() );
					break;
					case( 'menu' ):
						$Permits = $this->PermitAccess->get_permits_for_object( $Object , 'menu' , array( 'admin' ) );
					break;
					case( 'page' ):$Permits = $this->PermitAccess->get_permits_for_page( $Object );break;
					case( 'user' ):$Permits = $this->get_permits_for_user( $Object , $AddGroupPermits );break;
				}

				return( $Permits );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Получение доступов для объекта.
		*
		*	@param $Object - Объект, к которому получается доступ.
		*
		*	@param $ObjectType - Тип объекта, к которому получаются доступы.
		*
		*	@param $AddGroupPermits - Добавлять ли групповые доступы.
		*
		*	@note Если по каким-либо причинам не найден файл с доступами, 
		*	то считается что на объект установлен доступ admin.
		*
		*	@return Список доступов, которыми должен обладать пользователь для работы с объектом.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns permits for object.
		*
		*	@param $Object - Object to be accessed.
		*
		*	@param $ObjectType - Type of the accessed object (may be menu, user, page).
		*
		*	@param $AddGroupPermits - Should be group permits processed.
		*
		*	@note if the file with permits was not found, all permits for that object are defaulted to 'admin'.
		*
		*	@return List of permits.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_permits_for_object( $Object , $ObjectType = 'page' , $AddGroupPermits = true )
		{
			try
			{
				$Key = md5( $Object.$ObjectType.$AddGroupPermits );
				
				if( isset( $this->PermitAccess->PermitsCache[ $Key ] ) )
				{
					return( $this->PermitAccess->PermitsCache[ $Key ] );
				}
			
				$Permits = $this->fetch_permits_for_object( $Object , $ObjectType , $AddGroupPermits );
				
				$this->PermitAccess->PermitsCache[ $Key ] = $Permits;
				
				return( $this->PermitAccess->PermitsCache[ $Key ] );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Проверка есть ли у пользователя доступы.
		*
		*	@param $Object - Название проверяемого объекта.
		*
		*	@param $ObjectType - Тип объекта.
		*
		*	@param $Permit - Название доступа.
		*
		*	@return true если валидация прошла успешно, иначе false.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function validates permit's existance for object.
		*
		*	@param $Object - Name of the validating object.
		*
		*	@param $ObjectType - Type of the object.
		*
		*	@param $Permit - Permit's title.
		*
		*	@return true if validation was passed, false otherwise
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			object_has_permit( $Object , $ObjectType , $Permit )
		{
			try
			{
				if( $Object === false && $ObjectType == 'user' )
				{
					$Object = $this->UserAlgorithms->get_id();
				}
				
				$ObjectsPermits = $this->get_permits_for_object( $Object , $ObjectType );
				
				return( in_array( $Permit , $ObjectsPermits ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Проверка есть ли у пользователя доступы.
		*
		*	@param $Object - Название проверяемого объекта.
		*
		*	@param $ObjectType - Тип объекта.
		*
		*	@param $Permits - Строка с доступами, например "public,admin,reader".
		*
		*	@return true если валидация прошла успешно, иначе false.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function validates permit's existance for object.
		*
		*	@param $Object - Name of the validating object.
		*
		*	@param $ObjectType - Type of the object.
		*
		*	@param $Permits - List of permits, for example "public,admin,reader".
		*
		*	@return true if validation was passed, false otherwise
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			object_has_all_permits( $Object , $ObjectType , $Permits )
		{
			try
			{
				$ObjectsPermits = $this->get_permits_for_object( $Object , $ObjectType );

				if( is_array( $Permits ) === false )
				{
					$Permits = explode( "," , $Permits );
				}

				if( count( $Permits ) === count( array_intersect( $ObjectsPermits , $Permits ) ) )
				{
					return( true );
				}
				else
				{
					return( false );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Имет ли первый объект необходимые права для доступа ко второму объекту.
		*
		*	@param $Object1 - Объект, получающий доступ.
		*
		*	@param $ObjectType1 - Тип объекта, получающего доступ.
		*
		*	@param $Object2 - Объект, к которому получается доступ.
		*
		*	@param $ObjectType2 - Тип объекта, к которому получается доступ.
		*
		*	@return true если валидация прошла успешно, иначе false.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Validate if the first object has access to the second object.
		*
		*	@param $Object1 - This object requests for permits.
		*
		*	@param $ObjectType1 - Type of the object (may be menu, user, page).
		*
		*	@param $Object2 - Object to be accessed.
		*
		*	@param $ObjectType2 - Type of the accessed object (may be menu, user, page).
		*
		*	@return true if validation was passed, false otherwise
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			validate_permits_ex( $Object1 , $ObjectType1 , $Object2 , $ObjectType2 )
		{
			try
			{
				$Permits1 = $this->get_permits_for_object( $Object1 , $ObjectType1 );

				$Permits2 = $this->get_permits_for_object( $Object2 , $ObjectType2 );

				if( count( $Permits2 ) === count( array_intersect( $Permits1 , $Permits2 ) ) )
				{
					return( true );
				}
				else
				{
					return( false );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка всех пользователей с указанным доступом.
		*
		*	@param $PermitName - Название доступа.
		*
		*	@return Список объектов пользователей, которые имеют доступ $PermitName.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns all users who have permit $PermitName.
		*
		*	@param $PermitName - Permit's title.
		*
		*	@return List of the user objects wuch have permit $PermitName.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_users_for_permit( $PermitName )
		{
			try
			{
				$PermitName = $this->Security->get( $PermitName , 'command' );

				$PermitObject = $this->PermitAccess->get_permit_by_name( $PermitName );

				$Links1 = $this->Link->get_links( false , get_field( $PermitObject , 'id' ) , 'user' , 'permit' );
				$Links2 = $this->Link->get_links( false , get_field( $PermitObject , 'id' ) , 'group' , 'permit' );
				$Links3 = $this->Link->get_links( false , get_field_ex( $Links2 , 'object1_id' ) , 'user' , 'group' );

				$Users = array_merge( get_field_ex( $Links1 , 'object1_id' ) , get_field_ex( $Links3 , 'object1_id' ) );
				$Users = array_unique( $Users );

				return( $Users );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
?>