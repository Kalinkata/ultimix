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
	*	\~russian Класс для работы с метериалами сайта.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides access to site materials.
	*
	*	@author Dodonov A.A.
	*/
	class	content_access_1_0_0{
		
		/**
		*	\~russian Таблица в которой хранятся объекты этой сущности.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Table name in wich objects of this entity are stored.
		*
		*	@author Dodonov A.A.
		*/
		var					$NativeTable = '`umx_content`';
		
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
		var					$Database = false;
		var					$DatabaseAlgorithms = false;
		var					$Security = false;
		var					$SecurityParser = false;
		var					$UserAccess = false;
		
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
				$this->Database = get_package( 'database' , 'last' , __FILE__ );
				$this->DatabaseAlgorithms = get_package( 'database::database_algorithms' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->SecurityParser = get_package( 'security::security_parser' , 'last' , __FILE__ );
				$this->UserAccess = get_package( 'user::user_access' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Дополнительные ограничения на рабочее множество данных.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~russian Additional limitations of the processing data.
		*
		*	@author Dodonov A.A.
		*/
		var					$AddLimitations = '1 = 1';
		
		/**
		*	\~russian Установка дополнительных ограничений.
		*
		*	@param $theAddLimitation - Дополнительные ограничения.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sets additional limitations.
		*
		*	@param $theAddLimitation - Additional limitations.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_add_limitations( $theAddLimitation )
		{
			try
			{
				if( $this->AddLimitations === '1 = 1' )
				{
					$this->AddLimitations = $theAddLimitation;
				}
				else
				{
					throw( new Exception( '"AddLimitations" was already set' ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция возвращает список записей.
		*
		*	@param $Start - Номер первой записи.
		*
		*	@param $Limit - Ограничение на количество записей
		*
		*	@param $Field - Поле, по которому будет осуществляться сортировка.
		*
		*	@param $Order - Порядок сортировки.
		*
		*	@param $Condition - Дополнительные условия отбора записей.
		*
		*	@param $Options - Дополнительные настройки выборки.
		*
		*	@return Список записей.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns list of records.
		*
		*	@param $Start - Number of the first record.
		*
		*	@param $Limit - Count of records limitation.
		*
		*	@param $Field - Field to sort by.
		*
		*	@param $Order - Sorting order.
		*
		*	@param $Condition - Additional conditions.
		*
		*	@param $Options - Additional options.
		*
		*	@return List of records.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			select( $Start = false , $Limit = false , $Field = false , $Order = false , 
																			$Condition = '1 = 1' , $Options = false )
		{
			try
			{
				$AddCondition = '';
				if( $Options !== false && $Options->get_setting( 'category_name' , false ) )
				{	
					$Category = get_package( 'category::category_algorithms' , 'last' , __FILE__ );
					$AddCondition = 'AND category IN ( '.implode( 
						',' , $Category->get_category_ids( $Options->get_setting( 'category_name' ) ) 
					).' )';
				}
				
				$Condition = $this->DatabaseAlgorithms->select_condition( 
					$Start , $Limit , $Field , $Order , $Condition
				);
				
				return( $this->unsafe_select( $Condition ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Обработика записей.
		*
		*	@param $Content - Материал.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function process records.
		*
		*	@param $Content - Content.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	process_print_content( &$Content )
		{
			try
			{
				$MainContent = $this->Security->get( get_field( $Content , 'main_content' ) , 'unsafe_string' );

				$PrintContent = $this->Security->get( get_field( $Content , 'print_content' ) , 'unsafe_string' );
				set_field( 
					$Content , 'print_content_unsafe' , 
					strlen( $PrintContent ) === 0 ? $MainContent : $PrintContent
				);

				set_field( $Content , 'has_print_content' , strlen( $PrintContent ) === 0 ? 0 : 1 );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Обработика записей.
		*
		*	@param $Content - Материалы.
		*
		*	@return Список доступных записей.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function process records.
		*
		*	@param $Content - Contents.
		*
		*	@return List of available records.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	process_selected_content( &$Content )
		{
			try
			{
				foreach( $Content as $k => $v )
				{
					$DemoContent = $this->Security->get( get_field( $v , 'demo_content' ) , 'unsafe_string' );
					set_field( $Content[ $k ] , 'demo_content_unsafe' , $DemoContent );

					$MainContent = $this->Security->get( get_field( $v , 'main_content' ) , 'unsafe_string' );
					set_field( $Content[ $k ] , 'main_content_unsafe' , $MainContent );

					$this->process_print_content( $Content[ $k ] );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция возвращает список записей.
		*
		*	@return Список доступных записей.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns list of records.
		*
		*	@return List of available records.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			unsafe_select( $Condition = ' 1 = 1 ' )
		{
			try
			{
				$this->Database->query_as( DB_OBJECT );
				
				$Content = $this->Database->select( 
					$this->NativeTable.'.* , umx_category.title AS category_title , user.login AS author_name' , 
					$this->NativeTable.' , umx_category , '.$this->UserAccess->NativeTable.' AS user' , 
					"author = user.id AND ( $this->AddLimitations ) AND umx_category.id = category AND $Condition"
				);
				
				$this->process_selected_content( $Content );
				
				return( $Content );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка массива объектов.
		*
		*	@param $id - Список идентификаторов удаляемых данных, разделённых запятыми.
		*
		*	@return Массив записей.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function selects list of objects.
		*
		*	@param $id - Comma separated list of record's id.
		*
		*	@return Array of records.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			select_list( $id )
		{
			try
			{
				$id = $this->Security->get( $id , 'integer_list' );
				
				return( $this->unsafe_select( $this->NativeTable.".id IN ( $id )" ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция удаления записи.
		*
		*	@param $id - Идентификатор записи.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function deletes record.
		*
		*	@param $id - Records's id.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			delete( $id )
		{
			try
			{
				$id = $this->Security->get( $id , 'integer_list' );
				
				$this->Database->delete( $this->NativeTable , "( $this->AddLimitations ) AND id IN ( $id )" );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение параметров создания записи.
		*
		*	@param $Record - Объект по чьему образцу будет создаваться запись.
		*
		*	@return array( $Fields , $Values ).
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns create data.
		*
		*	@param $Record - Example for creation.
		*
		*	@return array( $Fields , $Values ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	fetch_create_data( &$Record )
		{
			try
			{
				$Record = $this->SecurityParser->parse_parameters( 
					$Record , 
					'author:integer;title:string;category:integer;demo_content:string;'.
						'main_content:string;keywords:string;description:string;print_content:string'
				);

				return( 
					$this->DatabaseAlgorithms->compile_fields_values( 
						$Record , CREATION_DATE | PUBLICATION_DATE | MODIFICATION_DATE
					)
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Создание записи.
		*
		*	@param $Record - Объект по чьему образцу будет создаваться запись.
		*
		*	@return Идентификатор созданной записи.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Creating record.
		*
		*	@param $Record Example for creation.
		*
		*	@return id of the created record.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			create( &$Record )
		{
			try
			{
				list( $Fields , $Values ) = $this->fetch_create_data( $Record );

				$id = $this->DatabaseAlgorithms->create( $this->NativeTable , $Fields , $Values );

				$EventManager = get_package( 'event_manager' , 'last' , __FILE__ );
				$EventManager->trigger_event( 'on_after_create_content' , array( 'id' => $id ) );

				return( $id );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка контента по категориям.
		*
		*	@param $CategoryIds - Идентификаторы категорий.
		*
		*	@return Список материалов.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns a list of contents.
		*
		*	@param $CategoryIds - ids of the categories.
		*
		*	@return Array of content objects.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			select_content_by_category( $CategoryIds )
		{
			try
			{
				$CategoryIds = $this->Security->get( $CategoryIds , 'integer' );
				
				return( 
					$this->unsafe_select( 
						'category IN ( '.implode( ',' , $CategoryIds ).' ) ORDER BY publication_date ASC'
					)
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка структуры публикаций.
		*
		*	@param $CategoryIds - Идентификаторы категорий.
		*
		*	@return Структура публикаций.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns publication structure.
		*
		*	@param $CategoryIds - ids of the categories.
		*
		*	@return Publication structure.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_publication_structure( $CategoryIds )
		{
			try
			{
				$CategoryIds = $this->Security->get( $CategoryIds , 'integer' );
				
				return( 
					$this->Database->select( 
						'YEAR( publication_date ) AS publication_year , MONTH( publication_date ) AS publication_month'.
							' , COUNT( * ) AS publication_count' , 
						$this->NativeTable , 
						'category IN ( '.implode( ',' , $CategoryIds ).
							' ) GROUP BY publication_year , publication_month ORDER BY publication_date ASC'
					)
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка контента.
		*
		*	@param $Year - Год.
		*
		*	@param $Month - Месяц.
		*
		*	@param $CategoryIds - Идентификаторы категорий.
		*
		*	@return Публикации.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns contents.
		*
		*	@param $Year - Year.
		*
		*	@param $Month - Month.
		*
		*	@param $CategoryIds - ids of the categories.
		*
		*	@return Content.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_content_for_date( $Year , $Month , $CategoryIds )
		{
			try
			{
				$Year = $this->Security->get( $Year , 'integer' );
				$Month = $this->Security->get( $Month , 'integer' );
				$CategoryIds = $this->Security->get( $CategoryIds , 'integer' );
				
				return( 
					$this->unsafe_select( 
						"YEAR( publication_date ) = $Year AND MONTH( publication_date ) = $Month AND ".
							'category IN ( '.implode( ',' , $CategoryIds ).' ) ORDER BY publication_date ASC'
					)
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Обработка записи.
		*
		*	@param $Record - Объект по чьему образцу будет создаваться запись.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Processing record.
		*
		*	@param $Record - Example for update.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	process_record( &$Record )
		{
			try
			{
				$Record = $this->SecurityParser->parse_parameters( 
					$Record , 
					'author:integer;title:string;category:integer;demo_content:string;main_content:string;'.
						'keywords:string;description:string;print_content:string' , 'allow_not_set'
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Редактирование записи.
		*
		*	@param $id - Список идентификаторов удаляемых данных, разделённых запятыми.
		*
		*	@param $Record - Объект по чьему образцу будет создаваться запись.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Updating record.
		*
		*	@param $id - Comma separated list of record's id.
		*
		*	@param $Record - Example for update.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			update( $id , $Record )
		{
			try
			{
				$id = $this->Security->get( $id , 'integer_list' );
				
				$this->process_record( $Record );
				
				list( $Fields , $Values ) = $this->DatabaseAlgorithms->compile_fields_values( $Record );
				
				if( isset( $Fields[ 0 ] ) )
				{
					/* the modification_date will be changed only if the content was changed */
					$Fields [] = 'modification_date';
					$Values [] = 'now()';
					
					$Condition = "( $this->AddLimitations ) AND id IN ( $id )";
					$this->Database->update( $this->NativeTable , $Fields , $Values , $Condition );
					$this->Database->commit();
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция поиска записей.
		*
		*	@param $SearchString - Строка поиска.
		*
		*	@return Поля.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Searching records.
		*
		*	@param $SearchString - Search string.
		*
		*	@return Fields.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	search_fields( $SearchString )
		{
			try
			{
				$SearchString = $this->Security->get( $SearchString , 'string' );
				
				return(
				   "id , CONCAT( title , ' ' , demo_content , ' ' , main_content ) AS record_text , 
					CHAR_LENGTH( CONCAT( title , ' ' , demo_content , ' ' , main_content ) ) - CHAR_LENGTH( 
						REPLACE( CONCAT( title , ' ' , demo_content , ' ' , main_content ) , '$SearchString' , '' ) 
					) AS relevation , 
					CONCAT( './content_view.html?content_id=' , id ) AS source_page , 
					title AS source_page_title"
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция поиска записей.
		*
		*	@param $Start - Ограничение на поиск.
		*
		*	@param $SearchString - Строка поиска.
		*
		*	@return Найденные записи.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Searching records.
		*
		*	@param $Start - Search limitations.
		*
		*	@param $SearchString - Search string.
		*
		*	@return Records.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			search( $Start , $SearchString )
		{
			try
			{
				$Start = $this->Security->get( $Start , 'integer' );

				$this->Database->query_as( DB_OBJECT );

				$Records = $this->Database->select( 
					$this->search_fields( $SearchString ) , $this->NativeTable , 
					"( $this->AddLimitations ) ORDER BY relevation DESC LIMIT $Start , 10"
				);

				return( $Records );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>