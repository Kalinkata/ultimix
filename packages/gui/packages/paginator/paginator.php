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
	*	\~russian Класс для подключения компонента paginator3000.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class loads paginator3000 component.
	*
	*	@author Dodonov A.A.
	*/
	class	paginator_1_0_0{

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
		var					$CachedMultyFS = false;

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
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение количества записей.
		*
		*	@param $Settings - Настройки компиляции.
		*
		*	@return Количество записей.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns count of records.
		*
		*	@param $Settings - Compilation settings.
		*
		*	@return Count of records.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_record_count( &$Settings )
		{
			try
			{
				$Query = $Settings->get_setting( 'count_query' );

				$Database = get_package( 'database' , 'last' , __FILE__ );

				$Result = $Database->query( $Query );

				$Records = $Database->fetch_results( $Result );

				return( get_field( $Records[ 0 ] , 'record_count' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция копиляции макроса 'paginator3000'.
		*
		*	@param $Settings - Параметры обработки.
		*
		*	@return Виджет.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'paginator3000'.
		*
		*	@param $Settings - Processing options.
		*
		*	@return Widget.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_paginator( &$Settings )
		{
			try
			{
				$Code = '';
				$RecordCount = $this->get_record_count( $Settings );
				$RecordsPerPage = $Settings->get_setting( 'records_per_page' , 25 );
				$PageField = $Settings->get_setting( 'page_field' , 'page' );

				if( $RecordCount > $RecordsPerPage )
				{
					$Pages = ceil( $RecordCount / $RecordsPerPage );

					for( $i = 1 ; $i <= $Pages ; $i++ )
					{
						$Code .= $this->CachedMultyFS->get_template( __FILE__ , 'paginator_item.tpl' );
						$Code .= $i != $Pages ? '&nbsp;' : '';
						$Code = str_replace( array( '{i}' , '{field}' ) , array( $i , $PageField ) , $Code );
					}
				}

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>