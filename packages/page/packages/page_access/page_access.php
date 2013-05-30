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
	*	\~russian Класс для работы со страницами.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides access for data about pages.
	*
	*	@author Dodonov A.A.
	*/
	class	page_access_1_0_0{

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
		var					$NativeTable = '`umx_page`';

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
		var					$DatabaseAlgorithms = false;
		var					$EventManager = false;
		var					$PageFSAccess = false;
		var					$Security = false;
		var					$SecurityParser = false;

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
				$this->EventManager = get_package( 'event_manager' , 'last' , __FILE__ );
				$this->PageFSAccess = get_package( 'page::page_access::page_fs_access' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->SecurityParser = get_package( 'security::security_parser' , 'last' , __FILE__ );
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
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sets additional limitations.
		*
		*	@param $theAddLimitation - Additional limitations.
		*
		*	@exception Exception An exception of this type is thrown.
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
		*	\~russian Выборка списка пакетов, применённых к странице $PageName.
		*
		*	@param $PageName - Имя страницы, для которой выбирается информация о примененных пакетах.
		*
		*	@param $Parse - Выполнять ли парсинг.
		*
		*	@return Информация о примененных пакетах в формате array( array( 'package' , 'package_version' , 
		*	'options' , 'placeholder' ) )
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns list of packages wich are applied to the page $PageName.
		*
		*	@param $PageName - Name of the page.
		*
		*	@param $Parse - Parse data or not.
		*
		*	@return Information about all packages wich are applied to the page.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_package_appliance( $PageName , $Parse = true )
		{
			try
			{
				$RawData = $this->PageFSAccess->get_raw_page( $PageName );

				if( $Parse == true )
				{
					if( strlen( $RawData ) !== 0 )
					{
						return( $this->PageFSAccess->parse_raw_page( $RawData ) );
					}

					return( array() );
				}

				return( $RawData );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Установка пакетов, применённых к странице $PageName.
		*
		*	@param $PageName - Имя страницы, для которой выбирается информация о примененных пакетах.
		*
		*	@param $Packages - Пакеты.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sets list of packages wich are applied to the page $PageName.
		*
		*	@param $PageName - Name of the page.
		*
		*	@param $Packages - Packages.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_package_appliance( $PageName , $Packages )
		{
			try
			{
				$PageName = $this->Security->get( $PageName , 'command' );
				$Packages = $this->Security->get( $Packages , 'unsafe_string' );

				$this->CachedMultyFS->file_put_contents( dirname( __FILE__ ).'/data/pa_'.$PageName , $Packages );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Выборка записей.
		*
		*	@param $Condition - Условие отбора записей.
		*
		*	@return Массив объектов.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Selecting records.
		*
		*	@param $Condition - Records selection condition.
		*
		*	@return Array of objects.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			unsafe_select( $Condition )
		{
			try
			{
				if( $this->Database === false )
				{
					$this->Database = get_package( 'database' , 'last' , __FILE__ );
				}

				$this->Database->query_as( DB_OBJECT );

				return( 
					$this->Database->select( 
						$this->NativeTable.'.*' , $this->NativeTable , "( $this->AddLimitations ) AND $Condition"
					)
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция возвращает список страниц.
		*
		*	@param $Start - Номер первой записи.
		*
		*	@param $Limit - Ограничение на количество записей.
		*
		*	@param $Field - Поле, по которому будет осуществляться сортировка.
		*
		*	@param $Order - Порядок сортировки.
		*
		*	@return Список страниц.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns list of pages.
		*
		*	@param $Start - Number of the first record.
		*
		*	@param $Limit - Count of records limitation.
		*
		*	@param $Field - Field to sort by.
		*
		*	@param $Order - Sorting order.
		*
		*	@return List of pages.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			select( $Start , $Limit , $Field = false , $Order = false , $Condition = false )
		{
			try
			{
				if( $this->DatabaseAlgorithms === false )
				{
					$this->DatabaseAlgorithms = get_package( 'database::database_algorithms' , 'last' , __FILE__ );
				}

				$Condition = $this->DatabaseAlgorithms->select_condition( 
					$Start , $Limit , $Field , $Order , $Condition , $this->NativeTable
				);

				$Records =  $this->unsafe_select( $Condition );

				$ListOfPages = $this->PageFSAccess->select( $Start , $Limit , $Field , $Order , $Condition );

				$ListOfPages = array_merge( $Records , $ListOfPages );

				return( $this->PageFSAccess->filter_pages( $ListOfPages , $Limit ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Существует ли страница.
		*
		*	@param $PageName - Имя запрашиваемой страницы.
		*
		*	@return true если страница существует.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Does page exists.
		*
		*	@param $PageName - Name of the requested page.
		*
		*	@return true if the page exists
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			page_exists( $PageName )
		{
			try
			{
				$PageName = $this->Security->get( $PageName , 'command' );

				return( $this->CachedMultyFS->file_exists( dirname( __FILE__ )."/data/".$PageName ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция содания страницы.
		*
		*	@param $Record - Данные.
		*
		*	@return Данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function creates page.
		*
		*	@param $Record - Data.
		*
		*	@return Data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_create_data( &$Record )
		{
			try
			{
				$Title = $this->Security->get( get_field( $Record , 'page_title' ) , 'string' );
				$Template = $this->Security->get( get_field( $Record , 'page_template' ) , 'string' );
				$TemplateVersion = get_field( $Record , 'page_template_version' , 'last' );
				$TemplateVersion = $this->Security->get( $TemplateVersion , 'string' );

				return( "$Title#$Template#$TemplateVersion#$Settings" );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция обработки записи.
		*
		*	@param $Record - Данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function process data.
		*
		*	@param $Record - Data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	filter_creation_data( &$Record )
		{
			try
			{
				$Record = $this->SecurityParser->parse_parameters( 
					$Record , 
						'alias:string;title:string;template_package_name:string,default_default;'.
							'template_package_version:command,default_default;predefined_packages:command,allow_not_set'
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция содания страницы.
		*
		*	@param $Record - Данные.
		*
		*	@return Название созданной страницы.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function creates page.
		*
		*	@param $Record - Data.
		*
		*	@return Title of the created page.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			create( &$Record )
		{
			try
			{
				$this->filter_creation_data( $Record );

				if( $this->DatabaseAlgorithms === false )
				{
					$this->DatabaseAlgorithms = get_package( 'database::database_algorithms' , 'last' , __FILE__ );
				}

				list( $Fields , $Values ) = $this->DatabaseAlgorithms->compile_fields_values( $Record );

				$id = $this->DatabaseAlgorithms->create( $this->NativeTable , $Fields , $Values );

				$this->EventManager->trigger_event( 'on_after_create_page' , array( 'id' => $id ) );

				return( $id );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция редактирования страницы.
		*
		*	@param $PageName - Имя страницы.
		*
		*	@param $Title - Название страницы.
		*
		*	@param $Template - Пакет шаблона.
		*
		*	@param $TemplateVersion - Версия шаблона.
		*
		*	@param $PredefinedPackages - Настройки страницы.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function updates page.
		*
		*	@param $PageName - Name of the page.
		*
		*	@param $Title - Page's title.
		*
		*	@param $Template - Template name.
		*
		*	@param $TemplateVersion - Template version.
		*
		*	@param $PredefinedPackages - Page's settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			update( $PageName , $Title , $Template , $TemplateVersion , $PredefinedPackages )
		{
			try
			{
				/*$PageName = $this->Security->get( $PageName , 'command' );
				$Page = $this->get_page_description( $PageName );

				$Title = $this->Security->get( $Title , 'string' );
				$Template = $this->Security->get( $Template , 'string' );
				$TemplateVersion = $this->Security->get( $TemplateVersion , 'command' );
				$PredefinedPackages = $this->Security->get( $PredefinedPackages , 'string' );

				$Path = dirname( __FILE__ )."/data/$PageName";
				$this->CachedMultyFS->file_put_contents( $Path , "$Title#$Template#$TemplateVersion#$Options" );*/
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Удаление записей.
		*
		*	@param $id - Идентификатор записи.
		*
		*	@param $Options - Дополнительные настройки.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Deleting records.
		*
		*	@param $id - Record's identificator.
		*
		*	@param $Options - Additional options.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			delete( $id , $Options = ' 1 = 1' )
		{
			try
			{
				$this->EventManager->trigger_event( 'on_before_delete_page' , array( 'id' => $id ) );

				if( $this->Database === false )
				{
					$this->Database = get_package( 'database' , 'last' , __FILE__ );
				}

				$id = $this->Security->get( $id , 'integer_list' );
				$this->Database->delete( $this->NativeTable , "( $this->AddLimitations ) AND id IN ( $id )" );
				$this->Database->commit();

				$this->EventManager->trigger_event( 'on_after_delete_page' , array( 'id' => $id ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция доабвления пакета к странице.
		*
		*	@param $PageName - Имя страницы.
		*
		*	@param $PackageName - Имя пакета.
		*
		*	@param $PackageVersion - Версия пакета.
		*
		*	@param $Params - Параметры.
		*
		*	@param $PlaceHolder - Плэйсхолдер.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function adds package to page.
		*
		*	@param $PageName - Name of the page.
		*
		*	@param $PackageName - Package's name.
		*
		*	@param $PackageVersion - Package version.
		*
		*	@param $Params - Parameters.
		*
		*	@param $PlaceHolder - Placeholder.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			add_package( $PageName , $PackageName , $PackageVersion , $Params , $PlaceHolder )
		{
			try
			{
				$PageName = $this->Security->get( $PageName , 'command' );

				$CachedFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$CachedFS->file_put_contents( 
					dirname( __FILE__ ).'/data/pa_'.$PageName , 
					$PackageName.'#'.$PackageVersion.'#'.$Params.'#'.$PlaceHolder."\r\n" , FILE_APPEND
				);
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
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			select_list( $id )
		{
			try
			{
				$id = $this->Security->get( $id , 'integer_list' );

				return( $this->unsafe_select( $this->NativeTable.".id IN ( $id ) ORDER BY id ASC" ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>