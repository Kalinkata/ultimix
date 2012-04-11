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
	*	\~russian Получение доступа к статистике.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Counter.
	*
	*	@author Dodonov A.A.
	*/
	class	stat_access_1_0_0{
	
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
		var					$NativeTable = '`umx_stat`';
	
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
				$this->Database = get_package( 'database' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Создание квитка со статистикой.
		*
		*	@param $Key - Ключ.
		*
		*	@param $Value - Значение.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function adds stat info in the database.
		*
		*	@param $Key - Key.
		*
		*	@param $Value - Value.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			add_stat( $Key , $Value )
		{
			try
			{
				if( is_array( $Key ) )
				{
					$Key = implode( '#' , $Key );
				}
				
				$Key = $this->Security->get( $Key , 'string' );
				$Key = str_replace( '[sharp]' , '#' , $Key );
				$Value = $this->Security->get( $Value , 'string' );

				$this->Database->insert( 
					$this->NativeTable , '`key` , `value` , creation_date' , "\"$Key\" , \"$Value\" , NOW()"
				);
				
				$this->Database->commit();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получения квитков со статистикой.
		*
		*	@param $Fields - Поля.
		*
		*	@param $Condition - Условия выбора.
		*
		*	@return Статистика.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns stat info from the database.
		*
		*	@param $Fields - Fields.
		*
		*	@param $Condition - Select condition.
		*
		*	@return Stat.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_stat( $Fields , $Condition )
		{
			try
			{
				return(
					$this->Database->select( $Fields , $this->NativeTable , $Condition )
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>