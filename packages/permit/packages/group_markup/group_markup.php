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
	*	\~russian Класс для обработки страниц с учетом доступов.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides permits dependent visualisation.
	*
	*	@author Dodonov A.A.
	*/
	class		group_markup_1_0_0{
		
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
		var					$GroupAccess = false;
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
				$this->GroupAccess = get_package( 'permit::group_access' , 'last' , __FILE__ );
				$this->PermitAlgorithms = get_package( 'permit::permit_algorithms' , 'last' , __FILE__ );
				$this->UserAlgorithms = get_package( 'user::user_algorithms' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции макроса 'group_list'.
		*
		*	@param $Settings - Параметры компиляции.
		*
		*	@return Widget.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'group_list'.
		*
		*	@param $Settings - Compilation parameters.
		*
		*	@return Widget.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_group_list( &$Settings )
		{
			try
			{
				$this->Database->query_as( DB_OBJECT );
				$Items = $this->Database->select( 'title' , '`umx_group`' , '1' );
				$c = count( $Items );
				$AllGroups = '';
				foreach( $Items as $k => $i )
				{
					$AllGroups .= $i->title;
					if( $k + 1 != $c )
					{
						$AllGroups .= ', ';
					}
				}
				return( $AllGroups );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции макроса 'group_list'.
		*
		*	@param $Settings - Параметры компиляции.
		*
		*	@return Widget.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'group_list'.
		*
		*	@param $Settings - Compilation parameters.
		*
		*	@return Widget.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_group_list_for_object( &$Settings )
		{
			try
			{
				$GroupList = '';

				if( $this->PermitAlgorithms->object_has_permit( false , 'user' , 'permit_manager' ) )
				{
					list( $Object , $Type ) = $Settings->get_settings( 'object,type' , 'public,' );

					$GroupList = $this->GroupAccess->get_groups_for_object( $Object , $Type );
					sort( $GroupList );
					$GroupList = implode( ', ' , $GroupList );
				}

				return( $GroupList );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение групп для виджета.
		*
		*	@param $Settings - Параметры обработки.
		*
		*	@return array( $ObjectGroupList , $AllGroupList ).
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns gruops for widget.
		*
		*	@param $Settings - Processing options.
		*
		*	@return array( $ObjectGroupList , $AllGroupList ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_groups( &$Settings )
		{
			try
			{
				$AllGroupList = $Settings->get_setting( 'all' , '' );
				if( strlen( $AllGroupList ) == 0 )
				{
					$AllGroupList = array();
				}
				else
				{
					$AllGroupList = explode( ', ' , $AllGroupList );
				}

				$ObjectGroupList = $Settings->get_setting( 'object_groups' , 'public' );
				if( strlen( $ObjectGroupList ) == 0 )
				{
					$ObjectGroupList = array();
				}
				else
				{
					$ObjectGroupList = explode( ', ' , $ObjectGroupList );
				}

				return( array( $ObjectGroupList , $AllGroupList ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция компиляции списка групп.
		*
		*	@param $ObjectGroupList - Группы.
		*
		*	@param $GroupListWidget - Обрабатывемая строка.
		*
		*	@return Список групп.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles groups list.
		*
		*	@param $ObjectGroupList - Groups.
		*
		*	@param $GroupListWidget - Processing string.
		*
		*	@return List of groups.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_object_groups( $ObjectGroupList , $GroupListWidget )
		{
			try
			{
				sort( $ObjectGroupList );

				foreach( $ObjectGroupList as $key => $Group )
				{
					$Template = $this->CachedMultyFS->get_template( __FILE__ , 'object_group.tpl' );
					$Template = str_replace( '{group}' , $Group , $Template );
					$GroupListWidget = str_replace( '{object_groups}' , $Template , $GroupListWidget );
				}

				return( $GroupListWidget );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция компиляции списка групп.
		*
		*	@param $AllGroupList - Группы.
		*
		*	@param $ObjectGroupList - Группы.
		*
		*	@param $GroupListWidget - Обрабатывемая строка.
		*
		*	@return Список групп.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles groups list.
		*
		*	@param $AllGroupList - Groups.
		*
		*	@param $ObjectGroupList - Groups.
		*
		*	@param $GroupListWidget - Processing string.
		*
		*	@return List of groups.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_all_groups( $AllGroupList , $ObjectGroupList , $GroupListWidget )
		{
			try
			{
				sort( $AllGroupList );
				
				foreach( $AllGroupList as $key => $Group )
				{
					if( in_array( $Group , $ObjectGroupList ) === false )
					{
						$Template = $this->CachedMultyFS->get_template( __FILE__ , 'rest_groups.tpl' );
						$Template = str_replace( '{group}' , $Group , $Template );
						$GroupListWidget = str_replace( '{rest_groups}' , $Template , $GroupListWidget );
					}
				}
				
				return( $GroupListWidget );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции макроса 'group_list_widget'.
		*
		*	@param $Settings - Параметры компиляции.
		*
		*	@return Widget.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'group_list_widget'.
		*
		*	@param $Settings - Compilation parameters.
		*
		*	@return Widget.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_group_list_widget( &$Settings )
		{
			try
			{
				list( $ObjectGroupList , $AllGroupList ) = $this->get_groups( $Settings );

				$GroupListWidget = $this->CachedMultyFS->get_template( __FILE__ , 'group_list.tpl' );
				$Object = $Settings->get_setting( 'object' );
				$GroupListWidget = str_replace( '{object}' , $Object , $GroupListWidget );

				$GroupListWidget = $this->compile_object_groups( $ObjectGroupList , $GroupListWidget );

				return( $this->compile_all_groups( $AllGroupList , $ObjectGroupList , $GroupListWidget ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции макроса 'group_list_widget'.
		*
		*	@param $Settings - Параметры компиляции.
		*
		*	@return Widget.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'group_list_widget'.
		*
		*	@param $Settings - Compilation parameters.
		*
		*	@return Widget.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_group_select( &$Settings )
		{
			try
			{
				list( $Name , $Class ) = $Settings->get_settings( 'name,class',  'group,flat width_160' );

				$Code = "{select:name=$Name;class=$Class;".
						"query=SELECT id , title AS value FROM `umx_group` ORDER BY title}";

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>