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
	}

?>