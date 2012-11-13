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
	*	\~russian Класс для обработки макросов.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides macro processing.
	*
	*	@author Dodonov A.A.
	*/
	class		permit_markup_1_0_0{

		/**
		*	\~russian Доступы пользователя.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Object permits.
		*
		*	@author Dodonov A.A.
		*/
		var					$Permits = array();

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
		var					$Database = false;
		var					$PermitAlgorithms = false;
		var					$UserAlgorithms = false;

		/**
		*	\~russian Добавлен ли контроллер.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Was the controller added.
		*
		*	@author Dodonov A.A.
		*/
		var					$ControllerWasAdded = false;

		/**
		*	\~russian Функция загрузки доступов.
		*
		*	@param $UserId - Идентификатор пользователя.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function loads permits.
		*
		*	@param $UserId - User id.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	load_permits_for_user( $UserId = false )
		{
			try
			{
				if( $UserId === false )
				{
					$UserId = $this->UserAlgorithms->get_id();
				}

				if( isset( $this->Permits[ $UserId ] ) === false )
				{
					$this->Permits[ $UserId ] = $this->PermitAlgorithms->get_permits_for_object( $UserId , 'user' );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

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
				$this->Database = get_package( 'database' , 'last' , __FILE__ );
				$this->PermitAlgorithms = get_package( 'permit::permit_algorithms' , 'last' , __FILE__ );
				$this->UserAlgorithms = get_package( 'user::user_algorithms' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Есть ли доступ у пользователя.
		*
		*	@param $Settings - Параметры.
		*
		*	@return true/false.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Does user have permit.
		*
		*	@param $Settings - Parameters.
		*
		*	@return true/false.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	has_premits( &$Settings )
		{
			try
			{
				$RawSettings = $Settings->get_raw_settings();
				$Parmit = array_shift( array_keys( $RawSettings ) );

				$UserId = $this->UserAlgorithms->get_id();
				$this->load_permits_for_user( $UserId );

				return( in_array( $Parmit , $this->Permits[ $UserId ] ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции макроса 'permit'.
		*
		*	@param $Settings - Параметры.
		*
		*	@param $Data - Данные.
		*
		*	@return Код макроса.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'permit'.
		*
		*	@param $Settings - Parameters.
		*
		*	@param $Data - Data.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_permit( &$Settings , $Data )
		{
			try
			{
				$Flag = $this->has_premits( $Settings , $Data );

				if( $Flag )
				{
					return( $Data );
				}
				else
				{
					return( '' );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции макроса 'no_permit'.
		*
		*	@param $Settings - Параметры.
		*
		*	@param $Data - Данные.
		*
		*	@return Код макроса.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'no_permit'.
		*
		*	@param $Settings - Parameters.
		*
		*	@param $Data - Data.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_no_permit( &$Settings , $Data )
		{
			try
			{
				$Flag = $this->has_premits( $Settings , $Data );

				if( $Flag )
				{
					return( '' );
				}
				else
				{
					return( $Data );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции макроса 'permit_list'.
		*
		*	@param $Settings - Параметры.
		*
		*	@return Код макроса.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'permit_list'.
		*
		*	@param $Settings - Parameters.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_permit_list( &$Settings )
		{
			try
			{
				$this->Database->query_as( DB_OBJECT );
				$Items = $this->Database->select( 'permit' , 'umx_permit' , '1 = 1' );
				$c = count( $Items );
				$AllPermits = '';
				foreach( $Items as $k => $i )
				{
					$AllPermits .= $i->permit;
					if( $k + 1 != $c )
					{
						$AllPermits .= ', ';
					}
				}

				return( $AllPermits );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции макроса 'permit_list_for_object'.
		*
		*	@param $Settings - Параметры.
		*
		*	@return Код макроса.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'permit_list_for_object'.
		*
		*	@param $Settings - Parameters.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_permit_list_for_object( &$Settings )
		{
			try
			{
				$PermitList = '';

				list( $Object , $Type ) = $Settings->get_settings( 'object,type' , 'public,' );
				$PermitList = $this->PermitAlgorithms->get_permits_for_object( $Object , $Type , false );

				sort( $PermitList );
				$PermitList = implode( ', ' , $PermitList );

				return( $PermitList );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции списка доступов.
		*
		*	@param $ObjectPermits - Доступы.
		*
		*	@param $PermitListWidget - Обрабатывемая строка.
		*
		*	@return Список доступов.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles permits list.
		*
		*	@param $ObjectPermits - Permits.
		*
		*	@param $PermitListWidget - Processing string.
		*
		*	@return List of permits.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_object_permits( $ObjectPermitList , $PermitListWidget )
		{
			try
			{
				sort( $ObjectPermitList );

				foreach( $ObjectPermitList as $key => $p )
				{
					$Template = $this->CachedMultyFS->get_template( __FILE__ , 'delete_permit_item.tpl' );
					$Template = str_replace( '{permit}' , $p , $Template );
					$PermitListWidget = str_replace( '{object_permits}' , $Template , $PermitListWidget );
				}

				$PermitListWidget = str_replace( '{object_permits}' , '' , $PermitListWidget );

				return( $PermitListWidget );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции списка доступов.
		*
		*	@param $AllPermitList - Доступы.
		*
		*	@param $PermitListWidget - Обрабатывемая строка.
		*
		*	@return Список доступов.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles permits list.
		*
		*	@param $AllPermitList - Permits.
		*
		*	@param $PermitListWidget - Processing string.
		*
		*	@return List of permits.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_all_permits( $AllPermitList , $ObjectPermitList , $PermitListWidget )
		{
			try
			{
				sort( $AllPermitList );

				foreach( $AllPermitList as $key => $p )
				{
					if( in_array( $p , $ObjectPermitList ) === false )
					{
						$Template = $this->CachedMultyFS->get_template( __FILE__ , 'add_permit_item.tpl' );
						$Template = str_replace( '{permit}' , $p , $Template );
						$PermitListWidget = str_replace( '{rest_permits}' , $Template , $PermitListWidget );
					}
				}

				return( $PermitListWidget );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение доступов для виджета.
		*
		*	@param $Settings - Параметры обработки.
		*
		*	@return array( $ObjectPermitList , $AllPermitList ).
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns permits for widget.
		*
		*	@param $Settings - Processing options.
		*
		*	@return array( $ObjectPermitList , $AllPermitList ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_permits( &$Settings )
		{
			try
			{
				$AllPermitList = $Settings->get_setting( 'all' , 'public' );
				if( strlen( $AllPermitList ) == 0 )
				{
					$AllPermitList = array();
				}
				else
				{
					$AllPermitList = explode( ', ' , $AllPermitList );
				}

				$ObjectPermitList = $Settings->get_setting( 'object_permits' , '' );
				$ObjectPermitList = strlen( $ObjectPermitList ) == 0 ? array() : 
										explode( ', ' , $ObjectPermitList );

				return( array( $ObjectPermitList , $AllPermitList ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции макроса 'permit_list_widget'.
		*
		*	@param $Settings - Параметры.
		*
		*	@return Код макроса.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'permit_list_widget'.
		*
		*	@param $Settings - Parameters.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_permit_list_widget( &$Settings )
		{
			try
			{
				list( $ObjectPermitList , $AllPermitList ) = $this->get_permits( $Settings );

				$PermitListWidget = $this->CachedMultyFS->get_template( __FILE__ , 'permit_list.tpl' );
				$Object = $Settings->get_setting( 'object' );
				$PermitListWidget = str_replace( '{object}' , $Object , $PermitListWidget );

				$PermitListWidget = $this->compile_object_permits( $ObjectPermitList , $PermitListWidget );

				return( $this->compile_all_permits( $AllPermitList , $ObjectPermitList , $PermitListWidget ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции макроса 'permit_select'.
		*
		*	@param $Settings - Параметры.
		*
		*	@return Код макроса.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'permit_select'.
		*
		*	@param $Settings - Parameters.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_permit_select( &$Settings )
		{
			try
			{

				list( $Name , $Class ) = $Settings->get_settings( 'name,class',  'permit,flat width_160' );

				$Code = "{select:name=$Name;class=$Class;".
						"query=SELECT id , title AS value FROM `umx_permit` ORDER BY title}";

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>