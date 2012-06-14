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
	*	\~russian Бросить исключение или вернуть аргумент.
	*
	*	@param $DefaultValue - Значение по умолчанию.
	*
	*	@param $Field - Поле/ключ.
	*
	*	@return Значение по умолчанию.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function returns value or throws exception.
	*
	*	@param $DefaultValue - Default value.
	*
	*	@param $Field - Field/key.
	*
	*	@return Default value.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_return_or_throw( $DefaultValue , $Field )
	{
		if( $DefaultValue === '_throw_exception' )
		{
			throw( new Exception( "Key '$Field' does not exists" ) );
		}
		else
		{
			return( $DefaultValue );
		}
	}
	
	/**
	*	\~russian Функция получения значения из объекта/массива.
	*
	*	@param $Entity - Объект или массив.
	*
	*	@param $Field - Поле/ключ.
	*
	*	@param $DefaultValue - Значение по умолчанию.
	*
	*	@return Значение.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function returns value from array/object.
	*
	*	@param $Entity - Object or array.
	*
	*	@param $Field - Field/key.
	*
	*	@param $DefaultValue - Default value.
	*
	*	@return Value.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			get_field( &$Entity , $Field , $DefaultValue = '_throw_exception' )
	{
		try
		{
			if( is_object( $Entity ) )
			{
				if( property_exists( $Entity , $Field ) )
				{
					return( $Entity->$Field );
				}
				
				return( _return_or_throw( $DefaultValue , $Field ) );
			}
			
			if( is_array( $Entity ) )
			{
				if( array_key_exists( $Field , $Entity ) )
				{
					return( $Entity[ $Field ] );
				}
				
				return( _return_or_throw( $DefaultValue , $Field ) );
			}
			
			throw( new Exception( "Illegal value was passed" ) );
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}
	
	/**
	*	\~russian Функция получения значения из объекта/массива.
	*
	*	@param $Entity - Объект или массив.
	*
	*	@param $Fields - Поля/ключи.
	*
	*	@param $DefaultValue - Значение по умолчанию.
	*
	*	@return Значение.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function returns values from array/object.
	*
	*	@param $Entity - Object or array.
	*
	*	@param $Fields - Fields/keys.
	*
	*	@param $DefaultValue - Default value.
	*
	*	@return Value.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			get_fields( &$Entity , $Fields , $DefaultValue = '_throw_exception' )
	{
		try
		{
			$Values = array();
			$Fields = explode( ',' , $Fields );
			
			foreach( $Fields as $i => $Field )
			{
				$Values [] = get_field( $Entity , $Field , $DefaultValue );
			}
			
			return( $Values );
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}
	
	/**
	*	\~russian Функция проверки существования поля.
	*
	*	@param $Entity - Объект или массив.
	*
	*	@param $Field - Поле/ключ.
	*
	*	@return true если существует, false если нет.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function validate field's existance.
	*
	*	@param $Entity - Object or array.
	*
	*	@param $Field - Field/key.
	*
	*	@return true if exists, false otherwise.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			is_field_set( &$Entity , $Field )
	{
		try
		{
			if( is_object( $Entity ) )
			{
				if( property_exists( $Entity , $Field ) )
				{
					return( true );
				}
			}
			
			if( is_array( $Entity ) )
			{
				if( isset( $Entity[ $Field ] ) )
				{
					return( true );
				}
			}
			
			return( false );
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}
	
	/**
	*	\~russian Функция получения значения из масива объектов/массивов.
	*
	*	@param $ArrayOfEntities - Масив объектов или массивов.
	*
	*	@param $Field - Поле/ключ.
	*
	*	@param $DefaultValue - Значение по умолчанию.
	*
	*	@return Массив значений.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function returns value from array of arrays/objects.
	*
	*	@param $ArrayOfEntities - Array of objects or arrays.
	*
	*	@param $Field - Field/key.
	*
	*	@param $DefaultValue - Default value.
	*
	*	@return Array of values.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			get_field_ex( &$ArrayOfEntities , $Field , $DefaultValue = '_throw_exception' )
	{
		try
		{
			$RetValues = array();
			
			foreach( $ArrayOfEntities as $k => $v )
			{
				$RetValues [] = get_field( $v , $Field , $DefaultValue );
			}
			
			return( $RetValues );
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}
	
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
	*	@param $Condition - Record filtration condition.
	*
	*	@return Array of values.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			array_filter_ex( &$ArrayOfEntities , $Condition = '1 == 1' )
	{
		try
		{
			$FilterFunction = create_function( '$Element' , "return( $Condition );" );
			
			$FilteredArrayOfEntities = array_filter( $ArrayOfEntities , $FilterFunction );
			
			return( $FilteredArrayOfEntities );
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}
	
	/**
	*	\~russian Функция получения значений из масива объектов/массивов.
	*
	*	@param $ArrayOfEntities - Масив объектов или массивов.
	*
	*	@param $Field - Поле/ключ.
	*
	*	@param $Condition - Условие фильтрации записей.
	*
	*	@param $DefaultValue - Дефолтовое значение.
	*
	*	@return Массив значений.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function returns values from array of arrays/objects.
	*
	*	@param $ArrayOfEntities - Array of objects or arrays.
	*
	*	@param $Field - Field/key.
	*
	*	@param $Condition - Record filtration condition.
	*
	*	@param $DefaultValue - Default value.
	*
	*	@return Array of values.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			get_field_cond( &$ArrayOfEntities , $Field , $Condition = '1 == 1' , 
																					$DefaultValue = '_throw_exception' )
	{
		try
		{
			$RetValues = array();
			
			$FilteredArrayOfEntities = array_filter_ex( $ArrayOfEntities , $Condition );

			foreach( $FilteredArrayOfEntities as $k => $v )
			{
				$RetValues [] = get_field( $v , $Field , $DefaultValue );
			}
			
			return( $RetValues );
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
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
	
	/**
	*	\~russian Функция установки значения из объекта/массива.
	*
	*	@param $Entity - Объект или массив.
	*
	*	@param $Field - Поле/ключ.
	*
	*	@param $Value - Устанавливаемое значение.
	*
	*	@return Объект/массив.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function sets value from array/object.
	*
	*	@param $Entity - Object or array.
	*
	*	@param $Field - Field/key.
	*
	*	@param $Value - Value to be set.
	*
	*	@return Object/array.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			set_field( &$Entity , $Field , $Value )
	{
		try
		{
			if( is_object( $Entity ) )
			{
				$Entity->$Field = $Value;
				return( $Entity );
			}
			
			if( is_array( $Entity ) )
			{
				$Entity[ $Field ] = $Value;
				return( $Entity );
			}
			
			return( $Entity );
		}
		catch( Exception $e )
		{
			$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
		}
	}
	
	/**
	*	\~russian Функция добавления значения.
	*
	*	@param $Entity - Объект или массив.
	*
	*	@param $Field - Поле/ключ.
	*
	*	@param $Value - Устанавливаемое значение.
	*
	*	@return Объект/массив.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function appends value.
	*
	*	@param $Entity - Object or array.
	*
	*	@param $Field - Field/key.
	*
	*	@param $Value - Value to be set.
	*
	*	@return Object/array.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			append_to_field( &$Entity , $Field , $Value )
	{
		try
		{
			if( is_field_set( $Entity , $Field ) === false || get_field( $Entity , $Field , false ) === false )
			{
				set_field( $Entity , $Field , array() );
			}
			
			if( is_object( $Entity ) )
			{
				array_push( $Entity->$Field , $Value );
			}
			
			if( is_array( $Entity ) )
			{
				array_push( $Entity[ $Field ] , $Value );
			}
			
			return( $Entity );
		}
		catch( Exception $e )
		{
			$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
		}
	}
	
	/**
	*	\~russian Функция склейки полей объектов/массивов.
	*
	*	@param $Str - Соединительная строка.
	*
	*	@param $Arr - Массив объектов/массивов.
	*
	*	@param $Field - Склеиваемое поле.
	*
	*	@return - Объект/массив.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function joins object's/array's fields.
	*
	*	@param $Str - Joining string.
	*
	*	@param $Arr - Array of objects/arrays.
	*
	*	@param $Field - Joining field.
	*
	*	@return - Object/array.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			implode_ex( $Str , &$Arr , $Field )
	{
		try
		{
			return( implode( $Str , get_field_ex( $Arr , $Field ) ) );
		}
		catch( Exception $e )
		{
			$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
		}
	}
	
	/**
	*	\~russian Функция добавления полей/значений в объект/массив.
	*
	*	@param $Destination - Изменяемая сущность.
	*
	*	@param $Source - Добавляемые данные.
	*
	*	@return - Объект/массив.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function adds fields/values in the object/array.
	*
	*	@param $Destination - Changing object.
	*
	*	@param $Source - Data to add.
	*
	*	@return - Object/array.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			extend( &$Destination , $Source )
	{
		try
		{
			if( $Source === false )
			{
				return( $Destination );
			}

			foreach( $Source as $k => $v )
			{
				$Destination = set_field( $Destination , $k , $v );
			}

			return( $Destination );
		}
		catch( Exception $e )
		{
			$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
		}
	}
	
	/**
	*	\~russian Функция суммирования элементов в массиве.
	*
	*	@param $Array - Массив с элементами.
	*
	*	@param $Field - Суммируемое поле.
	*
	*	@return - Сумма.
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
	*	@return - Sum.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			array_sum_ex( &$Array , $Field = false )
	{
		try
		{
			if( $Field !== false )
			{
				$Array2 = get_field_ex( $Array , $Field );
			}
			else
			{
				$Array2 = $Array;
			}

			return( array_sum( $Array2 ) );
		}
		catch( Exception $e )
		{
			$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
		}
	}
	
	/**
	*	\~russian Создание пустышки.
	*
	*	@param $Entity - Массив или объект.
	*
	*	@return - Массив или объект.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function creates dummie object or empty array.
	*
	*	@param $Array - Array or object.
	*
	*	@return - Array or object.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			get_dummie( &$Entity )
	{
		try
		{
			if( is_array( $Entity ) )
			{
				return( array() );
			}
			elseif( is_object( $Entity ) )
			{
				return( new stdClass() );
			}
			else
			{
				throw( new Exception( "Illegal data type : ".gettype( $Entity ) ) );
			}
		}
		catch( Exception $e )
		{
			$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
		}
	}
	
	/**
	*	\~russian Функция удаляет элементы из указанного массива.
	*
	*	@param $Entity - Объект или массив.
	*
	*	@param $Fields - Поля.
	*
	*	@return - Изменённый объект или массив.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function removes specified array's elements.
	*
	*	@param $Entity - Object or array.
	*
	*	@param $Fields - Array of fields.
	*
	*	@return - Changed object or array.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			remove_fields( &$Entity , $Fields )
	{
		try
		{
			if( is_array( $Fields ) === false )
			{
				$Fields = array( $Fields );
			}

			$ChangedEntity = get_dummie( $Entity );

			foreach( $Entity as $Field => $Value )
			{
				if( array_search( $Field , $Fields ) === false )
				{
					set_field( $ChangedEntity , $Field , $Value );
				}
			}

			return( $Entity = $ChangedEntity );
		}
		catch( Exception $e )
		{
			$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
		}
	}

	/**
	*	\~russian Функция создаёт массив из скаляра.
	*
	*	@param $Scalar - Скаляр.
	*
	*	@return - Массив.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function creates array using scalar.
	*
	*	@param $Scalar - Scalar.
	*
	*	@return - Array.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			make_array( &$Scalar )
	{
		try
		{
			if( is_array( $Scalar ) || is_object( $Scalar ) )
			{
				return( $Scalar );
			}
			else
			{
				return( array( $Scalar ) );
			}
		}
		catch( Exception $e )
		{
			$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
		}
	}

	/**
	*	\~russian Функция создания хэша.
	*
	*	@param $Array - Массив сущностей.
	*
	*	@param $Field - Поле, по которому создаётся хэш.
	*
	*	@return - Хэш.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function creates hash.
	*
	*	@param $Array - Array of entities.
	*
	*	@param $Field - Field name.
	*
	*	@return - Hash.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			make_hash_by_field( &$Array , $Field )
	{
		try
		{
			$Return = array();

			foreach( $Array as $k => $v )
			{
				$Return[ get_field( $v , $Field ) ] = $v;
			}

			return( $Return );
		}
		catch( Exception $e )
		{
			$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
		}
	}

	/**
	*	\~russian Функция векторизации.
	*
	*	@param $Array - Массив сущностей.
	*
	*	@param $Field - Поле, по которому создаётся хэш.
	*
	*	@return - Хэш.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function vectorises array.
	*
	*	@param $Array - Array of entities.
	*
	*	@param $Field - Field name.
	*
	*	@return - Hash.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			vectorize_by_field( &$Array , $Field )
	{
		try
		{
			$Return = array();

			foreach( $Array as $k => $v )
			{
				$Key = get_field( $v , $Field );

				if( isset( $Return[ $Key ] ) === false )
				{
					$Return[ $Key ] = array();
				}

				$Return[ $Key ][] = $v;
			}

			return( $Return );
		}
		catch( Exception $e )
		{
			$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
		}
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
	function			sort_by_field( &$Array , $Field )
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
				'return( get_field( $a , "'.$Field.'" ) > get_field( $b , "'.$Field.'" ) );'
			)
		);
	}
	
	/**
	*	\~russian Функция выборки данных.
	*
	*	@param $Array - Массив сущностей.
	*
	*	@param $Field - Поле, по которому происходит сортировка.
	*
	*	@param $Value - Значение.
	*
	*	@param $DefaultValue - Значение по умолчанию.
	*
	*	@return Запись.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function returns record.
	*
	*	@param $Array - Array of entities.
	*
	*	@param $Field - Field name.
	*
	*	@param $Value - Value.
		*
	*	@param $DefaultValue - Default value.
	*
	*	@return Record.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			get_record_by_field( &$Array , $Field , $Value , $DefaultValue = '_throw_exception' )
	{
		try
		{
			foreach( $Array as $i => $Element )
			{
				if( get_field( $Element , $Field , $DefaultValue ) == $Value )
				{
					return( $Element );
				}
			}

			return( false );
		}
		catch( Exception $e )
		{
			$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
		}
	}
	
?>