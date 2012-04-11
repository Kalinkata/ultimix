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
	class	change_history_access_1_0_0{
		
		/**
		*	\~russian Таблица в которой хранятся объекты этой сущности.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Table name in wich objects of this entity are stored.
		*
		*	@author Dodonov A.A.
		*/
		var					$NativeTable = '`umx_change_history`';
		
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
		var					$Link = false;
		var					$LinkDictionary = false;
		var					$Security = false;
		var					$UserAlgorithms = false;
		
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
				$this->Link = get_package( 'link' , 'last' , __FILE__ );
				$this->LinkDictionary = get_package( 'link::link_dictionary' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->UserAlgorithms = get_package( 'user::user_algorithms' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение записи.
		*
		*	@param $id - Идентификатор сохраняемой записи.
		*
		*	@param $ObjectType - Числовой тип объекта.
		*
		*	@param $Name - Название поля.
		*
		*	@return Последнее значение поля.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Function retrives records.
		*
		*	@param $id - Id of the saving record.
		*
		*	@param $ObjectType - Numeric object type.
		*
		*	@param $Name - Field name.
		*
		*	@return Changes history.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_entry( $id , $ObjectType , $Name )
		{
			try
			{
				$this->Database->query_as( DB_OBJECT );
				
				$Entry = $this->Database->select( 
					$this->NativeTable.'.field_value' , 
					$this->NativeTable , 
					$this->NativeTable.".object_id = $id AND ".$this->NativeTable.".object_type = $ObjectType AND ".
						$this->NativeTable.".field_name LIKE '".$Name."' ORDER BY id DESC LIMIT 1"
				);

				return( $Entry );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение последнего значения указанного поля.
		*
		*	@param $id - Идентификатор сохраняемой записи.
		*
		*	@param $ObjectType - Числовой тип объекта.
		*
		*	@param $Name - Название поля.
		*
		*	@return Последнее значение поля.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Function retrives last field value.
		*
		*	@param $id - Id of the saving record.
		*
		*	@param $ObjectType - Numeric object type.
		*
		*	@param $Name - Field name.
		*
		*	@return Changes history.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_last_field_vlue( $id , $ObjectType , $Name )
		{
			try
			{
				$id = $this->Security->get( $id , 'integer' );
				$ObjectType = $this->Security->get( $ObjectType , 'integer' );;
				$Name = $this->Security->get( $Name , 'command' );
				
				$Entry = $this->get_entry( $id , $ObjectType , $Name );

				if( isset( $Entry[ 0 ] ) )
				{
					return( get_field( $Entry[ 0 ] , 'field_value' ) );
				}
				
				return( false );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Нужно ли сохранять поле.
		*
		*	@param $id - Идентификатор сохраняемой записи.
		*
		*	@param $ObjectType - Числовой тип объекта.
		*
		*	@param $Name - Название поля.
		*
		*	@param $NewValue - Значение поля.
		*
		*	@return true/false.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Should the field be saved.
		*
		*	@param $id - Id of the saving record.
		*
		*	@param $ObjectType - Numeric object type.
		*
		*	@param $Name - Field name.
		*
		*	@param $NewValue - Field value.
		*
		*	@return true/false.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			need_save_field( $id , $ObjectType , $Name , $NewValue )
		{
			try
			{
				$Value = $this->get_last_field_vlue( $id , $ObjectType , $Name );

				return( $Value === false || ( $Value == $NewValue ? false : true ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение автора действия.
		*
		*	@return Автор действия.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Method returns action's author.
		*
		*	@return Action's author.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_author()
		{
			try
			{
				$User = $this->UserAlgorithms->get_user();
				
				return( get_field( $User , 'id' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Сохранение истории изменений.
		*
		*	@param $id - Идентификатор сохраняемой записи.
		*
		*	@param $ObjectType - Тип объекта.
		*
		*	@param $Record - Запись.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Function saves changes history.
		*
		*	@param $id - Id of the saving record.
		*
		*	@param $ObjectType - Object type.
		*
		*	@param $Record - Fields to save.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			add_to_history( $id , $ObjectType , $Record )
		{
			try
			{
				$id = $this->Security->get( $id , 'integer' );
				$Record = $this->Security->get( $Record , 'string' );
				$ObjectType = $this->LinkDictionary->get_link_type( 'history' , $ObjectType );
				$Author = $this->get_author();

				foreach( $Record as $Name => $Value )
				{
					if( $this->need_save_field( $id , $ObjectType , $Name , $Value ) )
					{
						$this->Database->insert( $this->NativeTable , 
							'object_id , object_type , field_name , field_value , creation_date , author' , 
							"$id , $ObjectType , '$Name' , '$Value' , NOW() , $Author"
						);

						$this->Database->commit();
					}
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение истории изменений.
		*
		*	@param $id - Идентификатор сохраняемой записи.
		*
		*	@param $ObjectType - Тип объекта.
		*
		*	@return История изменений.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Function retrives changes history.
		*
		*	@param $id - Id of the saving record.
		*
		*	@param $ObjectType - Object type.
		*
		*	@return Changes history.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_history( $id , $ObjectType )
		{
			try
			{
				$id = $this->Security->get( $id , 'integer' );
				$ObjectType = $this->LinkDictionary->get_link_type( 'history' , $ObjectType );
				
				$this->Database->query_as( DB_OBJECT );
				
				return( 
					$this->Database->select( 
						$this->NativeTable.'.* , umx_user.login AS author_name' , 
						$this->NativeTable.' , umx_user' , 
						$this->NativeTable.".author = umx_user.id AND ".$this->NativeTable.".object_id = $id AND ".
							$this->NativeTable.".object_type = $ObjectType ORDER BY id ASC"
					)
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>