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

?>