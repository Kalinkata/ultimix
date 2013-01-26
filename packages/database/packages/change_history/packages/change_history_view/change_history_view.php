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
	*	\~russian Класс для сохранения изменений записей.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides records change history manupulation routine.
	*
	*	@author Dodonov A.A.
	*/
	class	change_history_view_1_0_0{

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
		var					$ChangeHistoryAcces = false;

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
				$this->ChangeHistoryAcces = get_package( 
					'database::change_history::change_history_access' , 'last' , __FILE__
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение заголовка грида.
		*
		*	@param $id - Идентификатор записи.
		*
		*	@return HTML код заголовка.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Function returns grid's header.
		*
		*	@param $id - Record's id.
		*
		*	@return HTML code of the grid's header.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_grid_header( $id )
		{
			try
			{
				$Code = $this->CachedMultyFS->get_template( __FILE__ , 'change_history_header.tpl' );

				return( str_replace( '{id}' , $id , $Code ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение параметров подстановки.
		*
		*	@param $i - Курсор записи.
		*
		*	@param $Change - Одно изменение.
		*
		*	@param $Previous - Предыдущие значения.
		*
		*	@return Параметры подстановки.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Method returns replace parameters.
		*
		*	@param $i - Record cursor.
		*
		*	@param $Change - Single change.
		*
		*	@param $Previous - Pervious values.
		*
		*	@return Replace parameters.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_replace_parameters( $i , $Change , $Previous )
		{
			try
			{
				$PlaceHolders = array( 
					'{class}' , '{date_string}' , '{time_string}' , '{author_name}' , '{field_name}' , 
					'{previous}' , '{field_value}'
				);

				$Time = strtotime( get_field( $Change , 'creation_date' ) );

				$Name = get_field( $Change , 'field_name' );
				$Value = get_field( $Change , 'field_value' );

				$Data = array( 
					'table_row_'.( $i % 2 ? 'even' : 'odd' ) , date( 'd.m.y' , $Time ) , date( 'H:i:s' , $Time ) , 
					get_field( $Change , 'author_name' ) , $Name , 
					get_field( $Previous , $Name , '-' ) , $Value
				);

				return( array( $PlaceHolders , $Data , $Name , $Value ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение строк грида.
		*
		*	@param $Changes - Изменения.
		*
		*	@return HTML код строк.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Function returns grid's rows.
		*
		*	@param $Changes - Changes.
		*
		*	@return HTML code of the grid's rows.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_grid_lines( &$Changes )
		{
			try
			{
				$Lines = $Previous = array();

				foreach( $Changes as $i => $Change )
				{
					list( $PlaceHolders , $Data , $Name , $Value ) = $this->get_replace_parameters( 
						$i , $Change , $Previous
					);

					$Code = $this->CachedMultyFS->get_template( __FILE__ , 'change_history_item.tpl' );

					$Code = str_replace( $PlaceHolders , $Data , $Code );

					$Previous[ $Name ] = $Value;

					$Lines [] = $Code;
				}

				return( implode( '' , array_reverse( $Lines ) ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение грида истории изменений.
		*
		*	@param $id - Идентификатор сохраняемой записи.
		*
		*	@param $ObjectType - Тип объекта.
		*
		*	@return HTML код истории изменений.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Function retrives changes history grid.
		*
		*	@param $id - Id of the saving record.
		*
		*	@param $ObjectType - Object type.
		*
		*	@return HTML code of the changes history.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_changes_grid( $id , $ObjectType )
		{
			try
			{
				$Changes = $this->ChangeHistoryAcces->get_history( $id , $ObjectType );

				if( isset( $Changes[ 0 ] ) )
				{
					$Code = $this->get_grid_header( $id );
					$Code .= $this->get_grid_lines( $Changes );

					$Footer = $this->CachedMultyFS->get_template( __FILE__ , 'change_history_footer.tpl' );
					$Code = str_replace( '{code}' , $Code , $Footer );
				}
				else
				{
					$NoDataFound = $this->CachedMultyFS->get_template( __FILE__ , 'change_history_no_data_found.tpl' );
					$Code = str_replace( '{id}' , $id , $NoDataFound );
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