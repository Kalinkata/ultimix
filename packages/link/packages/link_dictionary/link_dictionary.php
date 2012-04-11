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
	*	\~russian Класс для организации многие-ко-многим.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class allows to create many-to-many links.
	*
	*	@author Dodonov A.A.
	*/
	class	link_dictionary_1_0_0{
		
		/**
		*	\~russian Словарь типов связей.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Dictionary with link types.
		*
		*	@author Dodonov A.A.
		*/
		var					$LinkTypesDictionary = false;
		
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
		var					$Database = false;
		var					$Security = false;
		
		/**
		*	\~russian Конструктор.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
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
				$this->Database = get_package( 'database' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение типа ссылки из кэша.
		*
		*	@param $Object1Type - Тип первого объекта.
		*
		*	@param $Object2Type - Тип второго объекта.
		*
		*	@return Численный тип связи или false в случае ошибки.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Getting link's type from the cache.
		*
		*	@param $Object1Type - Type of the first object.
		*
		*	@param $Object2Type - Type of the second object.
		*
		*	@return Numeric type of the link or false if any error occured
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_type_from_cache( $Object1Type , $Object2Type )
		{
			try
			{
				$Types = array();

				foreach( $this->LinkTypesDictionary as $k => $v )
				{
					if( $Object1Type !== false && $v->object1_type != $Object1Type )
					{
						continue;
					}
					if( $Object2Type !== false && $v->object2_type != $Object2Type )
					{
						continue;
					}

					$Types [] = $v->id;
				}
				if( isset( $Types[ 0 ] ) )
				{
					return( implode( ',' , $Types ) );
				}

				return( false );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Заполнение кэша.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function filles cache.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			fill_cache()
		{
			try
			{
				if( $this->LinkTypesDictionary === false )
				{
					$this->Database->query_as( DB_OBJECT );
					$this->LinkTypesDictionary = $this->Database->select( '*' , 'umx_link_dictionary' , "1 = 1" );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение типа ссылки.
		*
		*	@param $Object1Type - Тип первого объекта.
		*
		*	@param $Object2Type - Тип второго объекта.
		*
		*	@return Численный тип связи или false в случае ошибки.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Getting link's type.
		*
		*	@param $Object1Type - Type of the first object.
		*
		*	@param $Object2Type - Type of the second object.
		*
		*	@return Numeric type of the link or false if any error occured.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_type_from_db( $Object1Type , $Object2Type )
		{
			try
			{
				$this->fill_cache();

				return( $this->get_type_from_cache( $Object1Type , $Object2Type ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Создание нового типа ссылки.
		*
		*	@param $Object1Type - Тип первого объекта.
		*
		*	@param $Object2Type - Тип второго объекта.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function creates new link type.
		*
		*	@param $Object1Type - Type of the first object.
		*
		*	@param $Object2Type - Type of the second object.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function				create_link_type( $Object1Type , $Object2Type )
		{
			try
			{
				$Object1Type = $this->Security->get( $Object1Type , 'string' );
				$Object2Type = $this->Security->get( $Object2Type , 'string' );
				
				$this->Database->lock( array( 'umx_link_dictionary' ) , array( 'WRITE' ) );
				$this->Database->insert( 'umx_link_dictionary' , 'object1_type , object2_type' , 
										 "'$Object1Type' , '$Object2Type'" );
				$this->Database->commit();
				$this->Database->unlock();
				
				$this->LinkTypesDictionary = false;
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение типа ссылки.
		*
		*	@param $Object1Type - Тип первого объекта.
		*
		*	@param $Object2Type - Тип второго объекта.
		*
		*	@return Численный тип связи.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Getting link's type.
		*
		*	@param $Object1Type - Type of the first object.
		*
		*	@param $Object2Type - Type of the second object.
		*
		*	@return Numeric type of the link.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_link_type( $Object1Type , $Object2Type )
		{
			try
			{
				$LinkType = $this->get_type_from_db( $Object1Type , $Object2Type );
				
				if( $LinkType === false )
				{
					if( $Object1Type === false || $Object2Type === false )
					{
						/* type with this parameters was not found */
						return( 0 );
					}
					else
					{
						/* both types defined so we can create new link type */
						$this->create_link_type( $Object1Type , $Object2Type );
						
						return( $this->get_link_type( $Object1Type , $Object2Type ) );
					}
				}
				else
				{
					return( $LinkType );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение типа ссылки.
		*
		*	@param $Type - Тип объекта.
		*
		*	@return Строковый тип связи.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Getting link's type.
		*
		*	@param $Type - Type of the object.
		*
		*	@return Literal type of the link.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_link_literal_type( &$Type )
		{
			try
			{
				$Type = is_array( $Type ) === true ? $Type : array( $Type );
				$this->fill_cache();
				$Types = array();
				foreach( $this->LinkTypesDictionary as $k => $v )
				{
					foreach( $Type as $i => $t )
					{
						if( $v->id == $t )
						{
							$Types [] = array( 
								'object1_type' => $v->object1_type , 'object2_type' => $v->object2_type
							);
						}
					}
				}
				if( isset( $Types[ 0 ] ) === false )
				{
					throw( new Exception( 'Literal type of the link was not found' ) );
				}
				return( $Types );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>