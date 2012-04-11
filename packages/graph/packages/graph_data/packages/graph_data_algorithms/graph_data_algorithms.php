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
	*	\~russian Класс для работы с записями.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides records access routine.
	*
	*	@author Dodonov A.A.
	*/
	class	graph_data_algorithms_1_0_0{
	
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
		var					$GraphDataAccess = false;
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
				$this->GraphDataAccess = get_package( 'graph::graph_data::graph_data_access' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->SecurityParser = get_package( 'security::security_parser' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Выборка диапазона.
		*
		*	@param $UserId - Условие отбора записей.
		*
		*	@param $GraphType - Условие отбора записей.
		*
		*	@return Диапазон абсцисс.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Getting range.
		*
		*	@param $UserId - User id.
		*
		*	@param $GraphType - Graph type.
		*
		*	@return Abscissa range.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_abscissa_range( $UserId , $GraphType )
		{
			try
			{
				$UserId = $this->Security->get( $UserId , 'integer' );
				$GraphType = $this->Security->get( $GraphType , 'integer' );

				$Records = $this->GraphDataAccess->unsafe_select( 
					"author = $UserId AND graph_type = $GraphType" , 
					"MIN( abscissa ) AS `from` , MAX( abscissa ) AS `to`"
				);

				if( isset( $Records[ 0 ] ) === false || get_field( $Records[ 0 ] , 'from' ) == null )
				{
					return( false );
				}

				return(
					array( 'from' => get_field( $Records[ 0 ] , 'from' ) , 'to' => get_field( $Records[ 0 ] , 'to' ) )
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка диапазона.
		*
		*	@param $UserId - Условие отбора записей.
		*
		*	@param $GraphType - Условие отбора записей.
		*
		*	@param $AbscissaFrom - Начало диапазона.
		*
		*	@param $AbscissaTo - Конец диапазона.
		*
		*	@return Диапазон данных.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Getting range.
		*
		*	@param $UserId - User id.
		*
		*	@param $GraphType - Graph type.
		*
		*	@param $AbscissaFrom - Range start.
		*
		*	@param $AbscissaTo - Range end.
		*
		*	@return Data range.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_data_for_range( $UserId , $GraphType , $AbscissaFrom , $AbscissaTo )
		{
			try
			{
				$UserId = $this->Security->get( $UserId , 'integer' );
				$GraphType = $this->Security->get( $GraphType , 'integer' );
				$AbscissaFrom = $this->Security->get( $AbscissaFrom , 'integer' );
				$AbscissaTo = $this->Security->get( $AbscissaTo , 'integer' );

				$Records = $this->GraphDataAccess->unsafe_select( 
					"author = $UserId AND graph_type = $GraphType ".
					"AND abscissa >= $AbscissaFrom AND abscissa <= $AbscissaTo ORDER BY abscissa ASC"
				);

				return( $Records );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка данных.
		*
		*	@param $DataX - Значения по оси абсцисс.
		*
		*	@param $DataY - Значения по оси ординат.
		*
		*	@param $Ordinatus - Значение по оси ординат.
		*
		*	@return Данные.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Getting data.
		*
		*	@param $DataX - Absciss values.
		*
		*	@param $DataY - Ordinatus values.
		*
		*	@param $Ordinatus - Ordinatus value.
		*
		*	@return Data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function		get_abscissa_for_ordinatus( $DataX ,$DataY , $Ordinatus )
		{
			try
			{
				foreach( $DataY as $i => $Y )
				{
					if( $Y == $Ordinatus )
					{
						return( $DataX[ $i ] );
					}
				}
				
				throw( new Exception( 'Abscissa was not found' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>