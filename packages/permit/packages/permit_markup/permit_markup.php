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
		var					$PermitAccess = false;
		var					$PermitAlgorithms = false;
		var					$Settings = false;
		var					$String = false;
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
				$this->PermitAccess = get_package( 'permit::permit_access' , 'last' , __FILE__ );
				$this->PermitAlgorithms = get_package( 'permit::permit_algorithms' , 'last' , __FILE__ );
				$this->Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
				$this->UserAlgorithms = get_package( 'user::user_algorithms' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'permit'.
		*
		*	@param $Options - Параметры обработки.
		*
		*	@param $Str - Обрабатывемая строка.
		*
		*	@param $Changed - Была ли осуществлена обработка.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'permit'.
		*
		*	@param $Options - Processing options.
		*
		*	@param $Str - Processing string.
		*
		*	@param $Changed - Was the processing completed.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_permit( $Options , $Str , $Changed )
		{
			try
			{
				$UserId = $this->UserAlgorithms->get_id();
					
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'permit' ) ; )
				{
					if( in_array( $Parameters , $this->Permits[ $UserId ] ) )
					{
						$Str = $this->String->show_block( 
							$Str , 'permit:'.$Parameters , 'permit:~'.$Parameters , $Changed
						);
					}
					else
					{
						$Str = $this->String->hide_block( 
							$Str , 'permit:'.$Parameters , 'permit:~'.$Parameters , $Changed
						);
					}
					
					$Changed = true;
				}
				
				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'permit'.
		*
		*	@param $Options - Параметры обработки.
		*
		*	@param $Str - Обрабатывемая строка.
		*
		*	@param $Changed - Была ли осуществлена обработка.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'permit'.
		*
		*	@param $Options - Processing options.
		*
		*	@param $Str - Processing string.
		*
		*	@param $Changed - Was the processing completed.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_no_permit( $Options , $Str , $Changed )
		{
			try
			{
				$UserId = $this->UserAlgorithms->get_id();
				
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'no_permit' ) ; )
				{
					if( in_array( $Parameters , $this->Permits[ $UserId ] ) )
					{
						$Str = $this->String->hide_block( 
							$Str , 'no_permit:'.$Parameters , 'no_permit:~'.$Parameters , $Changed
						);
					}
					else
					{
						$Str = $this->String->show_block( 
							$Str , 'no_permit:'.$Parameters , 'no_permit:~'.$Parameters , $Changed
						);
					}
					
					$Changed = true;
				}
				
				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'permit_list'.
		*
		*	@param $Options - Параметры обработки.
		*
		*	@param $Str - Обрабатывемая строка.
		*
		*	@param $Changed - Была ли осуществлена обработка.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'permit_list'.
		*
		*	@param $Options - Processing options.
		*
		*	@param $Str - Processing string.
		*
		*	@param $Changed - Was the processing completed.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_permit_list( $Options , $Str , $Changed )
		{
			try
			{
				/* printing list of all available permits */
				if( strpos( $Str , '{permit_list}' ) !== false )
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
					$Str = str_replace( '{permit_list}' , $AllPermits , $Str );
				}
				
				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции списка доступов.
		*
		*	@param $Parameters - Параметры компиляции.
		*
		*	@return Список доступов.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'permit_list_for_object'.
		*
		*	@param $Parameters - Compilation options.
		*
		*	@return List of permits.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_permits_list( $Parameters )
		{
			try
			{
				$PermitList = '';
				
				if( $this->PermitAlgorithms->object_has_permit( false , 'user' , 'permit_manager' ) )
				{
					$this->Settings->load_settings( $Parameters );
					
					list( $Object , $Type ) = $this->Settings->get_settings( 'object,type' , 'public,' );
					$PermitList = $this->PermitAlgorithms->get_permits_for_object( $Object , $Type , false );

					sort( $PermitList );
					$PermitList = implode( ', ' , $PermitList );
				}
				
				return( $PermitList );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'permit_list_for_object'.
		*
		*	@param $Options - Параметры обработки.
		*
		*	@param $Str - Обрабатывемая строка.
		*
		*	@param $Changed - Была ли осуществлена обработка.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'permit_list_for_object'.
		*
		*	@param $Options - Processing options.
		*
		*	@param $Str - Processing string.
		*
		*	@param $Changed - Was the processing completed.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_permit_list_for_object( $Options , $Str , $Changed )
		{
			try
			{
				$Rules = array( 'object' => TERMINAL_VALUE , 'type' => TERMINAL_VALUE );
				
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'permit_list_for_object' , $Rules ) ; )
				{
					$PermitList = $this->compile_permits_list( $Parameters );

					$Str = str_replace( "{permit_list_for_object:$Parameters}" , $PermitList , $Str );
					$Changed = true;
				}
				
				return( array( $Str , $Changed ) );
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
				$AllPermitList = $this->Settings->get_setting( 'all' , 'public' );
				if( strlen( $AllPermitList ) == 0 )
				{
					$AllPermitList = array();
				}
				else
				{
					$AllPermitList = explode( ', ' , $AllPermitList );
				}
				
				$ObjectPermitList = $this->Settings->get_setting( 'object_permits' , 'public' );
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
		*	@param $Parameters - Параметры обработки.
		*
		*	@return Список доступов.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles permit list.
		*
		*	@param $Parameters - Processing options.
		*
		*	@return Permit list.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_permit_list_widget( $Parameters )
		{
			try
			{
				$this->Settings->load_settings( $Parameters );

				list( $ObjectPermitList , $AllPermitList ) = $this->get_permits( $this->Settings );

				$PermitListWidget = $this->CachedMultyFS->get_template( __FILE__ , 'permit_list.tpl' );
				$Object = $this->Settings->get_setting( 'object' );
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
		*	\~russian Функция обработки макроса 'permit_list_widget'.
		*
		*	@param $Options - Параметры обработки.
		*
		*	@param $Str - Обрабатывемая строка.
		*
		*	@param $Changed - Была ли осуществлена обработка.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'permit_list_widget'.
		*
		*	@param $Options - Processing options.
		*
		*	@param $Str - Processing string.
		*
		*	@param $Changed - Was the processing completed.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_permit_list_widget( $Options , $Str , $Changed )
		{
			try
			{
				$Rules = array( 'all' => TERMINAL_VALUE , 'object_permits' => TERMINAL_VALUE );
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'permit_list_widget' , $Rules ) ; )
				{
					if( $this->PermitAlgorithms->object_has_permit( false , 'user' , 'permit_manager' ) )
					{
						$PermitListWidget = $this->compile_permit_list_widget( $Parameters );
					}
					else
					{
						$PermitListWidget = '';
					}

					$Str = str_replace( "{permit_list_widget:$Parameters}" , $PermitListWidget , $Str );
					$Changed = true;
				}

				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция обработки макроса 'permit_select'.
		*
		*	@param $Options - Параметры обработки.
		*
		*	@param $Str - Обрабатывемая строка.
		*
		*	@param $Changed - Была ли осуществлена обработка.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'permit_select'.
		*
		*	@param $Options - Processing options.
		*
		*	@param $Str - Processing string.
		*
		*	@param $Changed - Was the processing completed.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_permit_select( $Options , $Str , $Changed )
		{
			try
			{
				$Rules = array( 'name' => TERMINAL_VALUE );
				
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'permit_select' , $Rules ) ; )
				{
					$this->Settings->load_settings( $Parameters );
					
					list( $Name , $Class ) = $this->Settings->get_settings( 'name,class',  'permit,flat width_160' );
										
					$Code = "{select:name=$Name;class=$Class;".
							"query=SELECT id , title AS value FROM `umx_permit` ORDER BY title}";
					
					$Str = str_replace( "{permit_select:$Parameters}" , $Code , $Str );
					$Changed = true;
				}
				
				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция загрузки доступов.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function loads permits.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	load_permits()
		{
			try
			{
				$UserId = $this->UserAlgorithms->get_id();
				
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
		*	\~russian Функция обработки страницы.
		*
		*	@param $Options - Параметры обработки.
		*
		*	@param $Str - Строка требуюшщая обработки.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@return Обработанная строка.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes page.
		*
		*	@param $Options - Processing options.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return Processed string.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_string( $Options , $Str , &$Changed )
		{
			try
			{
				$this->load_permits();

				list( $Str , $Changed ) = $this->process_permit( $Options , $Str , $Changed );

				list( $Str , $Changed ) = $this->process_no_permit( $Options , $Str , $Changed );

				list( $Str , $Changed ) = $this->process_permit_list( $Options , $Str , $Changed );

				list( $Str , $Changed ) = $this->process_permit_list_for_object( $Options , $Str , $Changed );

				list( $Str , $Changed ) = $this->process_permit_list_widget( $Options , $Str , $Changed );

				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>