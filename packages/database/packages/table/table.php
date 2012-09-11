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
	*	\~russian Класс для работы с базой данных.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class providees routine for database manipulation.
	*
	*	@author Dodonov A.A.
	*/
	class	table_1_0_0{
		
		/**
		*	\~russian Конструктор.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Constructor.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			__construct()
		{
			try
			{
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Выполнение запроса удаления таблицы в БД.
		*
		*	@param $Table - Удаляемая таблица.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Executes delete table query.
		*
		*	@param $Table - Deleted table.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			drop( $Table )
		{
			try
			{
				$this->QueryCounter++;
				$DBO = $this->get_object();
				$DBO->drop( $Table );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Выполнение запроса добавления столбца в таблицу.
		*
		*	@param $Table - Таблица, в которую добавляется столбец.
		*
		*	@param $ColumnName - Имя столбца.
		*
		*	@param $Type - Тип столбца.
		*
		*	@param $Mode - Режим добавления столбца.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function inserts column in table.
		*
		*	@param $Table - Name of the editig table (new column will be inserted).
		*
		*	@param $ColumnName - Name of the inserting column.
		*
		*	@param $Type - Тype of the column.
		*
		*	@param $Mode - Column insertion mode.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			add_column( $Table , $ColumnName , $Type , $Mode = 'NOT NULL AFTER `id`' )
		{
			try
			{
				$this->QueryCounter++;
				$DBO = $this->get_object();
				$DBO->add_column( $Table , $ColumnName , $Type , $Mode = 'NOT NULL AFTER `id`' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Выполнение запроса удаления столбца из таблицы.
		*
		*	@param $Table - Таблица, из которой удаляется столбец.
		*
		*	@param $ColumnName - Имя удаляемого столбца.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function deletes column from table.
		*
		*	@param $Table - Name of the editig table (column will be deleted).
		*
		*	@param $ColumnName - Name of the deleting column.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function 			drop_column( $Table , $ColumnName )
		{
			try
			{
				$this->QueryCounter++;
				$DBO = $this->get_object();
				$DBO->drop_column( $Table , $ColumnName );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>