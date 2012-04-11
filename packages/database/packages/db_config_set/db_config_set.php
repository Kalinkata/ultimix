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
	*	\~russian Класс для коннекта к базе.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides connection creation routine.
	*
	*	@author Dodonov A.A.
	*/
	class	db_config_set_1_0_0{
		
		/**
		*	\~russian Загруженный конфиг.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Loaded config.
		*
		*	@author Dodonov A.A.
		*/
		var					$Config = false;
		
		/**
		*	\~russian Путь к загруженному конфигу.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Path to the loaded config.
		*
		*	@author Dodonov A.A.
		*/
		var					$ConfigPath = false;
		
		/**
		*	\~russian Объект доступа к ФС.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Object provides access to the FS.
		*
		*	@author Dodonov A.A.
		*/
		var					$CachedMultyFS = false;
		
		/**
		*	\~russian Конструктор.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Constructor.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			__construct()
		{
			try
			{
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция загрузки конфига.
		*
		*	@param $ConfigPath - путь к загружаемому конфигу.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function loads config.
		*
		*	@param $ConfigPath - Path to the loading conig.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			load_config( $ConfigPath )
		{
			try
			{
				$this->Config = $this->CachedMultyFS->file_get_contents( $ConfigPath );

				$this->Config = explode( "\n" , $this->Config );

				$this->ConfigPath = $ConfigPath;
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Оптимизация конфига.
		*
		*	@param $i - Курсор строки.
		*
		*	@param $ConfigLine - Строка конфига.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Config optimization.
		*
		*	@param $i - Line cursor.
		*
		*	@param $DBAdapter - Config line.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			optimize_config_file( $i , $ConfigLine )
		{
			try
			{
				if( $i != 0 )
				{
					$Content = $ConfigLine."\r\n";
					
					foreach( $this->Config as $j => $ConfigLine2 )
					{
						if( $i != $j && $ConfigLine2 != '' )
						{
							$Content .= $ConfigLine2."\r\n";
						}
					}
					$this->Config = $this->CachedMultyFS->file_put_contents( $this->ConfigPath , $Content );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки строки конфига.
		*
		*	@param $DBAdapter - Адаптер БД АПИ.
		*
		*	@param $i - Курсор строки.
		*
		*	@param $ConfigLine - Строка конфига.
		*
		*	@return Обект коннекта к БД.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes config line.
		*
		*	@param $DBAdapter - Database adapter.
		*
		*	@param $i - Line cursor.
		*
		*	@param $ConfigLine - Config line.
		*
		*	@return Connection object.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_config_line( $DBAdapter , $i , $ConfigLine )
		{
			try
			{
				if( $ConfigLine != '' )
				{
					$DBAdapter->connect( $ConfigLine );
					
					$this->optimize_config_file( $i , $ConfigLine );
					
					return( $DBAdapter->get_connection() );
				}
			}
			catch( Exception $e )
			{
				return( false );
			}
		}
		
		/**
		*	\~russian Функция коннекта к базе.
		*
		*	@param $DBAdapter - Адаптер для работы с БД.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function connects to database.
		*
		*	@param $DBAdapter - Database API adapter.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			connect( $DBAdapter )
		{
			try
			{
				if( $this->Config == false )
				{
					throw( new Exception( 'Config was not loaded' ) );
				}
				
				foreach( $this->Config as $i => $ConfigLine )
				{
					$Connection = $this->process_config_line( $DBAdapter , $i , $ConfigLine );
					
					if( $Connection !== false )
					{
						return( $Connection );
					}
				}
				
				throw( new Exception( "Unable to connect to the database" ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>