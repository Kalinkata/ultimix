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
	*	\~russian Функция сортировки.
	*
	*	@param $Array - Массив сущностей.
	*
	*	@param $Field - Поле, по которому происходит сортировка.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function sorts array.
	*
	*	@param $Array - Array of entities.
	*
	*	@param $Field - Field name.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			sort_by_field( &$Array , $Field )
	{
		usort( 
			$Array , 
			create_function( 
				'$a , $b' , 
				'return( get_field( $a , "'.$Field.'" ) > get_field( $b , "'.$Field.'" ) );'
			)
		);
	}

	/**
	*	\~russian Функция сортировки.
	*
	*	@param $Array - Массив сущностей.
	*
	*	@param $Field - Поле, по которому происходит сортировка.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function sorts array.
	*
	*	@param $Array - Array of entities.
	*
	*	@param $Field - Field name.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			rsort_by_field( &$Array , $Field )
	{
		usort( 
			$Array , 
			create_function( 
				'$a , $b' , 
				'return( get_field( $a , "'.$Field.'" ) < get_field( $b , "'.$Field.'" ) );'
			)
		);
	}

	/**
	*	\~russian Функция суммирования элементов в массиве.
	*
	*	@param $Array - Массив с элементами.
	*
	*	@param $Field - Суммируемое поле.
	*
	*	@param $Condition - Условие фильтрации записей.
	*
	*	@return Сумма.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function sum all array's elements.
	*
	*	@param $Array - Array with elements.
	*
	*	@param $Field - Field to sum.
	*
	*	@param $Condition - Record filtration condition.
	*
	*	@return Sum.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			array_sum_cond( &$Array , $Field = false , $Condition = '1 == 1' )
	{
		try
		{
			if( count( $Array ) )
			{
				$Keys = array_keys( $Array );

				if( is_array( $Array[ $Keys[ 0 ] ] ) )
				{
					$Sum = 0;
					foreach( $Array as $i => $Element )
					{
						$Sum += array_sum_cond( $Element , $Field , $Condition );
					}
					return( $Sum );
				}
			}

			if( $Field !== false )
			{
				$Array = get_field_cond( $Array , $Field , $Condition );
			}

			return( array_sum( $Array ) );
		}
		catch( Exception $e )
		{
			$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
		}
	}

	$_array_filter_ex = array();

	/**
	*	\~russian Функция фильтрации массивов.
	*
	*	@param $ArrayOfEntities - Масив объектов или массивов.
	*
	*	@param $Condition - Условие фильтрации записей.
	*
	*	@return Массив значений.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function filters array.
	*
	*	@param $ArrayOfEntities - Array of objects or arrays.
	*
	*	@param $Cond - Record filtration condition.
	*
	*	@return Array of values.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			array_filter_ex( &$ArrayOfEntities , $Cond = '1 == 1' )
	{
		try
		{
			global			$_array_filter_ex;
			$_array_filter_ex = array();

			$FilterFunction = create_function( 
				'$Element' , 
				"global			\$_array_filter_ex;

				if( is_array( \$Element ) )
				{
					\$_array_filter_ex = array_merge( \$_array_filter_ex , array_filter_ex( \$Element , '$Cond' ) );
				}
				if( $Cond )
				{
					\$_array_filter_ex [] = \$Element;
				}"
			);

			array_walk( $ArrayOfEntities , $FilterFunction );

			return( $_array_filter_ex );
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}

?>