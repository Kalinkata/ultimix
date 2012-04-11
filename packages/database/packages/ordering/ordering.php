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
	*	\~russian Класс для упорядочивания записей.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides records ordering routine.
	*
	*	@author Dodonov A.A.
	*/
	class	ordering_1_0_0{
		
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
		var					$Database = false;
		var					$Security = false;
		
		/**
		*	\~russian Таблица, из которой тянем данные.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Table's name.
		*
		*	@author Dodonov A.A.
		*/
		var					$Table;
		
		/**
		*	\~russian Установка полей класса.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Setting fields.
		*
		*	@author Dodonov A.A.
		*/
		function			set_table_name( $NewTableName )
		{
			$this->Table = $NewTableName;
		}

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
				$this->Database = get_package( 'database' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	Функция выборки необходимого элемента.
		*
		*	@param $id - Идентификатор записи.
		*
		*	@param $Condition - Условие выборки записи.
		*
		*	@return Запись.
		*
		*	@author Додонов А.А.
		*/
		function			get_item( $id , $Condition = '1 = 1' )
		{
			try
			{
				$id = $this->Security->get( $id , 'integer' );
				
				$Items = $this->Database->select( '*' , $this->Table , "id = $id AND $Condition" );
				
				if( count( $Items ) == 1 )
				{
					return( $Items[ 0 ] );
				}
				
				throw( new Exception( "An error occured while getting item".mysql_error() ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	Функция получения следующего элемента.
		*
		*	@param $Order - Порядок Сдвигаемой записи.
		*
		*	@param $Condition - Условие выборки записей.
		*
		*	@return Запись. Или false если следующего элемента не найденно.
		*
		*	@author Додонов А.А.
		*/
		function			get_next_order_item( $Order , $Condition = '1 = 1' )
		{
			try
			{
				$Order = $this->Security->get( $Order , 'string' );
				
				$NextItem = $this->Database->select( 
					'*' ,  $this->Table , 
					"`order` >= $Order AND $Condition ORDER BY `order` ASC LIMIT 0 , 2" 
				);

				if( isset( $NextItem[ 1 ] ) )
				{
					return( $NextItem[ 1 ] );
				}
				
				return( false );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	Функция получения предыдущего элемента.
		*
		*	@param $Order - Порядок сдвигаемой записи.
		*
		*	@param $Condition - Условие выборки записей.
		*
		*	@return Запись. Или false если предыдущего элемента не найденно.
		*
		*	@author Додонов А.А.
		*/
		function			get_prev_order_item( $Order , $Condition = '1 = 1' )
		{
			try
			{
				$Order = $this->Security->get( $Order , 'string' );
				
				$PrevItem = $this->Database->select( 
					'*' , $this->Table ,
					"`order` <= $Order AND $Condition ORDER BY `order` DESC LIMIT 0 , 2"
				);
				
				if( isset( $PrevItem[ 1 ] ) )
				{
					return( $PrevItem[ 1 ] );
				}
				
				return( false );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	Меняем элементы местами.
		*
		*	@param $Item1 - Один из меняемых элементов.
		*
		*	@param $Item2 - Один из меняемых элементов.
		*
		*	@param $Condition - Условие выборки записей.
		*
		*	@author Додонов А.А.
		*/
		function			swap_items( $Item1 , $Item2 , $Condition = '1 = 1' )
		{
			try
			{
				$this->Database->update( 
					$this->Table , array( '`order`' ) , 
					get_field( $Item2 , 'order' ) , 
					"id = ".get_field( $Item1 , 'id' )
				);
				
				$this->Database->update( 
					$this->Table , array( '`order`' ) , 
					get_field( $Item1 , 'order' ) , 
					"id = ".get_field( $Item2 , 'id' )
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	Функция сдвига записи вперёд.
		*
		*	@param $id - Идентификатор сдвигаемой записи.
		*
		*	@param $Condition - Условие выборки записей.
		*
		*	@author Додонов А.А.
		*/
		function			shift_next( $id , $Condition = '1 = 1' )
		{
			try
			{
				$id = $this->Security->get( $id , 'integer' );
				
				$Item = $this->get_item( $id , $Condition );
				$NextItem = $this->get_next_order_item( $Item[ 'order' ] , $Condition );
				
				if( $NextItem === false )
				{
					return;
				}

				$this->swap_items( $Item , $NextItem , $Condition );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	Функция сдвига записи назад.
		*
		*	@param $id - Идентификатор сдвигаемой записи.
		*
		*	@param $Condition - Условие выборки записей.
		*
		*	@author Додонов А.А.
		*/
		function			shift_prev( $id , $Condition = '1 = 1' )
		{
			try
			{
				$id = $this->Security->get( $id , 'integer' );
				
				$Item = $this->get_item( $id , $Condition );
				$PrevItem = $this->get_prev_order_item( $Item[ 'order' ] , $Condition );
				
				if( $PrevItem === false )
				{
					return;
				}

				$this->swap_items( $Item , $PrevItem , $Condition );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>