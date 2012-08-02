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
	*	\~russian Класс для работы с доступами (пока только доступами).
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides routine for permits.
	*
	*	@author Dodonov A.A.
	*/
	class	permit_access_utilities_1_0_0{

		var					$Link = false;

		/**
		*	\~russian Конструктор.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
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
				$this->Link = get_package( 'link' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Переключение доступа для объекта.
		*
		*	@param $Permit - Переключаемый доступ.
		*
		*	@param $Object - Объект, к которому добавляется доступ.
		*
		*	@param $ObjectType - Тип объекта, к которому добавляется доступ.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function toggles permit for object.
		*
		*	@param $Permit - Permit to toggle.
		*
		*	@param $Object - Object.
		*
		*	@param $ObjectType - Type of the object (may be menu, user, page).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	toggle_permits( $Permit , $Object , $ObjectType )
		{
			try
			{
				foreach( $Object as $i => $id )
				{
					if( $this->Link->link_exists( $id , get_field( $Permit , 'id' ) , $ObjectType , 'permit' ) )
					{
						$this->Link->delete_link( $id , get_field( $Permit , 'id' ) , $ObjectType , 'permit' );
					}
					else
					{
						$this->Link->create_link( $id , get_field( $Permit , 'id' ) , $ObjectType , 'permit' , true );
					}
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>