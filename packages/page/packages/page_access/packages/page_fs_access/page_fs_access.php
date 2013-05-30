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
	class	page_fs_access_1_0_0{

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
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Фильтрация страниц.
		*
		*	@param $ListOfPages - Список страниц.
		*
		*	@param $Limit - Ограничение на количество записей.
		*
		*	@return Список страниц.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function filters pages.
		*
		*	@param $ListOfPages - List of pages.
		*
		*	@param $Limit - Count of records limitation.
		*
		*	@return List of pages.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			filter_pages( &$ListOfPages , $Limit )
		{
			try
			{
				$Ret = array();
				$SearchString = $this->Security->get_gp( 'search_string' , 'string' , '' );
				$c = 0;
				foreach( $ListOfPages as $i => $l )
				{
					if( $SearchString !== '' && !( strpos( get_field( $l , 'title' ) , $SearchString ) !== false || 
						strpos( get_field( $l , 'alias' ) , $SearchString ) !== false || 
						strpos( get_field( $l , 'template' , '' ) , $SearchString ) !== false || 
						strpos( get_field( $l , 'template_version' , '' ) , $SearchString ) !== false ) )
					{
						continue;
					}
					if( $c < $Limit )
					{
						$Ret [] = $l;
						$c++;
					}
				}
				return( $Ret );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Создание описания страницы.
		*
		*	@param $RawData - Данные о странице.
		*
		*	@param $PageName - Название страницы.
		*
		*	@return Описание страницы.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function creates page description.
		*
		*	@param $RawData - Data for page.
		*
		*	@param $PageName - Page name.
		*
		*	@return Page description
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	create_object( &$RawData , $PageName )
		{
			try
			{
				$RawData = explode( '#' , $RawData );

				if( count( $RawData ) <= 3 )
				{
					$RawData[ 3 ] = '';
				}
				if( count( $RawData ) <= 4 )
				{
					$RawData[ 4 ] = '';
					$RawData[ 5 ] = '';
				}

				return(
					array( 'title' => $RawData[ 0 ] , 'alias' => $PageName , 'template' => $RawData[ 1 ] , 
						'template_version' => $RawData[ 2 ] , 'options' => $RawData[ 3 ] , 
						'keywords' => $RawData[ 4 ] , 'description' => $RawData[ 5 ] )
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Выборка содержимого файла страницы.
		*
		*	@param $PageName - Имя страницы, для которой выбирается информация о примененных пакетах.
		*
		*	@return Содержимое файла страницы.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns content of the page file.
		*
		*	@param $PageName - Name of the page.
		*
		*	@return Content of the page file
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_raw_page( $PageName )
		{
			try
			{
				$PageName = $this->Security->get( $PageName , 'command' );

				$FileName = dirname( __FILE__ ).'/../../data/pa_'.$PageName;
				if( $this->CachedMultyFS->file_exists( $FileName ) )
				{
					$RawData = $this->CachedMultyFS->file_get_contents( $FileName , 'cleaned' );
				}
				else
				{
					$RawData = '';
				}

				return( $RawData );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Парсинг пакетов страницы.
		*
		*	@param $RawData - Содержимое файла страницы.
		*
		*	@return Информация о примененных пакетах в формате array( array( 'package' , 'package_version' , 
		*	'options' , 'placeholder' ) )
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function parses page packages.
		*
		*	@param $RawData - Content of the page file.
		*
		*	@return Information about all packages wich are applied to the page.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			parse_raw_page( $RawData )
		{
			try
			{
				$Appliance = array();

				$RawData = explode( "\n" , $RawData );
				$c = count( $RawData );

				for( $i = 0 ; $i < $c ; $i++ )
				{
					$RawDataInfo = explode( '#' , $RawData[ $i ] );
					$Appliance [] = array( 
						'package' => @$RawDataInfo[ 0 ] , 'package_version' => @$RawDataInfo[ 1 ] , 
						'options' => @$RawDataInfo[ 2 ] , 'placeholder' => @$RawDataInfo[ 3 ]
					);
				}

				return( $Appliance );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция возвращает описание запрошенной таблицы.
		*
		*	@param $PageName - Имя запрашиваемой страницы.
		*
		*	@return Описание запрашиваемой странице в виде array( 0 => array( id , title , name , 
		*	template , template_version ) )
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns description of the requested page.
		*
		*	@param $PageName - Name of the requested page.
		*
		*	@return Description of the requesting page in the folowing representation : array( 0 => array( id , 
		*	title , name , template , template_version ) )
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_page_description( $PageName )
		{
			try
			{
				$PageName = $this->Security->get( $PageName , 'command' );

				if( $this->CachedMultyFS->file_exists( dirname( __FILE__ ).'/../../data/'.$PageName ) )
				{
					$RawData = $this->CachedMultyFS->file_get_contents( dirname( __FILE__ ).'/../../data/'.$PageName );

					return( $this->create_object( $RawData , $PageName ) );
				}

				return( false );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение списка страниц.
		*
		*	@return Список страниц.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns a list of pages.
		*
		*	@return List of pages.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_list_of_pages()
		{
			try
			{
				$ListOfPages = array();
				$MountedStorages = $this->CachedMultyFS->get_mounted_storages();
				$MountedStorages [] = dirname( __FILE__ ).'/../../data';
				foreach( $MountedStorages as $ms )
				{
					if( $Handle = @opendir( $ms ) )
					{
						while( false !== ( $File = readdir( $Handle ) ) )
						{
							$Flag = strpos( $File , 'pa_' ) !== 0 && strpos( $File , 'index.html' ) !== 0;

							if( is_file( dirname( __FILE__ ).'/../../data/'.$File ) && $Flag )
							{
								$ListOfPages [] = $this->get_page_description( $File );
							}
						}
						closedir( $Handle );
					}
				}
				return( $ListOfPages );
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
				$ListOfPages = $this->get_list_of_pages();

				if( $Field == false && $Order == false )
				{
					$Field = 'alias';
					$Order = 'ascending';
				}

				if( $Order !== false )
				{
					$SortSign = $Order === 'ascending' ? '<' : '>';
					$SortFunc = create_function( 
						'$a , $b' , "if( get_field( \$a , '$Field' ) == get_field( \$b , '$Field' ) )".
							"return(0);return( get_field( \$a , '$Field' ) ".
							"$SortSign get_field( \$b , '$Field' ) ? -1 : 1 );"
					);
					usort( $ListOfPages , $SortFunc );
				}

				return( $ListOfPages );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>