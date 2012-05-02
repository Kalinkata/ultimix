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
	class	site_algorithms_1_0_0{

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
		var					$Security = false;
		var					$SiteAccess = false;

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
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->SiteAccess = get_package( 'site::site_access' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Функция возвращает пользователя по идентификатору.
		*
		*	@param $id - Идентфиикатор искомого пользователя.
		*
		*	@return Пользователь.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns user by it's id.
		*
		*	@param $id - Id of the searching user.
		*
		*	@return User object.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_by_id( $id )
		{
			try
			{
				$id = $this->Security->get( $id , 'integer' );
				
				$Sites = $this->SiteAccess->unsafe_select( $this->SiteAccess->NativeTable.".id = $id" );

				if( count( $Sites ) === 0 || count( $Sites ) > 1 )
				{
					throw( new Exception( 'Site with id '.$id.' was not found' ) );
				}
				else
				{
					return( $Sites[ 0 ] );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>