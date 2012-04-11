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
	*	\~russian Класс для работы с базой данных.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class providees routine for database manipulation.
	*
	*	@author Dodonov A.A.
	*/
	class	database_logger_1_0_0{
	
		/**
		*	\~russian Объект базы данных.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Database object.
		*
		*	@author Dodonov A.A.
		*/
		var					$UserAlgorithms = false;
	
		/**
		*	\~russian Название запроса.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Query's name.
		*
		*	@author Dodonov A.A.
		*/
		static				$QueryName = 'undefined';
	
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
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Установка имени запроса.
		*
		*	@param $theQueryName - имя запроса.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Setting query name.
		*
		*	@param $theQueryName - имя запроса.
		*
		*	@author Додонов А.А.
		*/
		function			set_query_name( $theQueryName )
		{
			self::$QueryName = $theQueryName;
		}

		/**
		*	\~russian Функция получения id пользователя.
		*
		*	@return id пользователя.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns user's id.
		*
		*	@return User's id.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_owner()
		{
			try
			{
				if( $this->UserAlgorithms === false )
				{
					$this->UserAlgorithms = get_package( 'user::user_algorithms' );
				}

				$Owner = $this->UserAlgorithms->get_login();

				return( $Owner );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция логирования запроса.
		*
		*	@param $Query - Строка запроса.
		*
		*	@param $Start - Время начала выполнения запроса.
		*
		*	@param $DBLogging - Нужно ли логировать.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function logs query.
		*
		*	@param $Query - Query string.
		*
		*	@param $Start - Query execution start time.
		*
		*	@param $DBLogging - Need logging.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			log_query( $Query , $Start , $DBLogging )
		{
			try
			{
				$End = microtime( true );
				if( $DBLogging )
				{
					$Owner = $this->get_owner();
					$DBO->query( 
						"INSERT INTO umx_action ".
						"( alias , description , owner , ip , action_date, execute_time , session ) VALUES ( '".
						htmlspecialchars( self::$QueryName , ENT_QUOTES )."' , '".
						htmlspecialchars( $Query , ENT_QUOTES )."' , '$Owner' , '".$_SERVER[ 'REMOTE_ADDR' ].
						"' , NOW() , '".( $End - $Start )."' , '".self::$Session."' )" 
					);
					$DBO->query( 'COMMIT' );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>