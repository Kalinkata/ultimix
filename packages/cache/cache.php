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
	*	\~russian Класс для работы с кэшем.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides cache manipulating routine.
	*
	*	@author Dodonov A.A.
	*/
	class	cache_1_0_0{
	
		/**
		*	\~russian Кэш.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cache.
		*
		*	@author Dodonov A.A.
		*/
		var					$Cache;
		
		/**
		*	\~russian Признак обновленного кэша.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Evidence of the updated cache.
		*
		*	@author Dodonov A.A.
		*/
		var					$CacheWasUpdated = false;
	
		/**
		*	\~russian Описание кэша.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cache description.
		*
		*	@author Dodonov A.A.
		*/
		var					$TableOfContents = false;
		
		/**
		*	\~russian Включено ли кэширование или нет.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Enables or disables caching.
		*
		*	@author Dodonov A.A.
		*/
		var					$CacheSwitch = true;
	
		/**
		*	\~russian Таимаут кэша. По умолчанию 120 секунд.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cache's timeout. Default value is 120 seconds.
		*
		*	@author Dodonov A.A.
		*/
		var					$CacheTimeout = 120;
	
		/**
		*	\~russian Конструктор загружает хранилище с кэшем.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Constructor loads cache from file.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			__construct()
		{
			try
			{
				$this->Cache = @file_get_contents( dirname( __FILE__ ).'/data/cache' );

				$this->TableOfContents = @file_get_contents( dirname( __FILE__ ).'/data/table' );

				if( $this->TableOfContents !== false )
				{
					$this->TableOfContents = unserialize( $this->TableOfContents );
				}

				$this->reset();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Переустановка настроек.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		/**
		*	\~english Function resets settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			reset()
		{
			try
			{
				$Conf = file_get_contents( dirname( __FILE__ ).'/conf/cf_cache' );
				$Conf = explode( ';' , $Conf );
				$Conf[ 0 ] = explode( '=' , $Conf[ 0 ] );
				$Conf[ 1 ] = explode( '=' , $Conf[ 1 ] );
				$this->CacheSwitch = $Conf[ 0 ][ 1 ] == 'on';
				$this->CacheTimeout = intval( $Conf[ 1 ][ 1 ] );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения параметров заголовка.
		*
		*	@param $md5SectionOriginName - Имя искомой секции (до преобразования).
		*
		*	@return Данные заголовка.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns header data.
		*
		*	@param $md5SectionOriginName - Name of the searching section (before transformation).
		*
		*	@return Header data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Додонов А.А.
		*/
		private function	get_header_parameters( $md5SectionOriginName )
		{
			try
			{
				$HeaderSize = 32 + 1 + 32 + 1;
				
				$ReadCursor = $this->TableOfContents[ $md5SectionOriginName ][ 'read_cursor' ];
				
				$SectionSize = $this->TableOfContents[ $md5SectionOriginName ][ 'section_size' ];
				
				return( array( $HeaderSize , $ReadCursor , $SectionSize ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка содержимого кэша.
		*
		*	@param $md5SectionOriginName - Имя искомой секции (до преобразования).
		*
		*	@return - Данные. Если данные по каким-либо причинам недоступны то функция вернет false.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Extracting cache data.
		*
		*	@param $SectionOriginName - Name of the searching section (before transformation).
		*
		*	@return false if no data was found or data
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	fetch_data( $md5SectionOriginName )
		{
			try
			{
				list( $HeaderSize , $Cursor , $SectionSize ) = $this->get_header_parameters( $md5SectionOriginName );
				
				return( substr( $this->Cache , $Cursor + $HeaderSize , $SectionSize - $HeaderSize ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка содержимого кэша.
		*
		*	@param $SectionOriginName - Имя искомой секции (до преобразования).
		*
		*	@return - Данные. Если данные по каким-либо причинам недоступны то функция вернет false.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Extracting cache data.
		*
		*	@param $SectionOriginName - Name of the searching section (before transformation).
		*
		*	@return false if no data was found or data
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_data( $SectionOriginName )
		{
			try
			{
				if( $this->TableOfContents === false )
				{
					return( false );
				}

				$md5SectionOriginName = md5( $SectionOriginName );
				if( isset( $this->TableOfContents[ $md5SectionOriginName ] ) === false )
				{
					return( false );
				}

				$CreateDate = $this->TableOfContents[ $md5SectionOriginName ][ 'tags' ][ '_timeout' ];
				if( time() - $CreateDate > $this->CacheTimeout )
				{
					$this->delete_data( $SectionOriginName );
					return( false );
				}

				return( $this->fetch_data( $md5SectionOriginName ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обовления кэша.
		*
		*	@param $md5SectionOriginName - Имя искомой секции (до преобразования).
		*
		*	@param $Data - Данные.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function updates cache.
		*
		*	@param $md5SectionOriginName - Name of the searching section (before transformation).
		*
		*	@param $Data - Data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Додонов А.А.
		*/
		private function	update_cache( $md5SectionOriginName , $Data )
		{
			try
			{
				list( $HeaderSize , $Cursor , $SectionSize ) = $this->get_header_parameters( $md5SectionOriginName );
				
				$NewDataSize = strlen( $Data );
				
				$this->Cache = substr_replace( 
					$this->Cache , 
					$md5SectionOriginName.':'.sprintf( "%032d" , $NewDataSize + $HeaderSize ).':'.$Data , 
					$Cursor , 
					$SectionSize
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обовления содержания.
		*
		*	@param $md5SectionOriginName - Имя искомой секции (до преобразования).
		*
		*	@param $Data - Данные.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function updates table of content.
		*
		*	@param $md5SectionOriginName - Name of the searching section (before transformation).
		*
		*	@param $Data - Data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Додонов А.А.
		*/
		private function	update_table( $md5SectionOriginName , $Data )
		{
			try
			{
				list( $HeaderSize , $Cursor , $SectionSize ) = $this->get_header_parameters( $md5SectionOriginName );
				
				$NewDataSize = strlen( $Data );
				
				$NewTable = array();
				foreach( $this->TableOfContents as $Key => $Value )
				{
					if( $Value[ 'read_cursor' ] === $Cursor )
					{
						$Value[ 'section_size' ] = $HeaderSize + $NewDataSize;
					}
					elseif( $Value[ 'read_cursor' ] > $Cursor )
					{
						$Value[ 'read_cursor' ] += $HeaderSize + $NewDataSize - $SectionSize;
					}
					$Value[ 'tags' ][ '_timeout' ] = time();
					$NewTable[ $Key ] = $Value;
				}
				$this->TableOfContents = $NewTable;
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция установки данных.
		*
		*	@param $SectionOriginName - Имя искомой секции (до преобразования).
		*
		*	@param $Data - Данные.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sets data.
		*
		*	@param $SectionOriginName - Name of the searching section (before transformation).
		*
		*	@param $Data - Data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Додонов А.А.
		*/
		function			set_data( $SectionOriginName , $Data )
		{
			try
			{
				if( $this->TableOfContents === false )
				{
					throw( new Exception( 'Cache is empty' ) );
				}
				$md5SectionOriginName = md5( $SectionOriginName );
				if( isset( $this->TableOfContents[ $md5SectionOriginName ] ) )
				{
					$this->update_cache( $md5SectionOriginName , $Data );
					
					$this->update_table( $md5SectionOriginName , $Data );
					
					if( $this->CacheSwitch === true )
					{
						$this->CacheWasUpdated = true;
					}
				}
				else
				{
					throw( new Exception( 'Section '.$SectionOriginName.' was not found' ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Добавление данных в кэш.
		*
		*	@param $SectionOriginName - Имя искомой секции (до преобразования).
		*
		*	@param $Data - Данные для кэширования.
		*
		*	@param $Tags - Метка данных.
		*
		*	@note - Если данные уже лежат в кэше, то они будут удалены.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Additing data to cache.
		*
		*	@param $SectionOriginName - Name of the searching section (before transformation).
		*
		*	@param $Data - Data to cache.
		*
		*	@param $Tags - Data tags.
		*
		*	@note if the data already exists, then it will be deleted.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			add_data( $SectionOriginName , $Data , $Tags = array() )
		{
			try
			{
				$this->delete_data( $SectionOriginName );
				$md5SectionOriginName = md5( $SectionOriginName );
				$SectionSize = 32 + 1 + 32 + 1 + strlen( $Data );
				$this->TableOfContents[ $md5SectionOriginName ] = array( 
					'section_size' => $SectionSize , 'read_cursor' => strlen( $this->Cache )
				);
				$this->Cache .= $md5SectionOriginName.":".sprintf( "%032d" , $SectionSize ).":$Data";
				$this->TableOfContents[ $md5SectionOriginName ][ 'tags' ] = array_merge( 
					$Tags , array( '_cache_sys' , '_timeout' => time() )
				);
				
				if( $this->CacheSwitch === true )
				{
					$this->CacheWasUpdated = true;
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Удаление данных из кэша.
		*
		*	@param $SectionOriginName - Имя искомой секции (до преобразования).
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Deleting data from cache.
		*
		*	@param $SectionOriginName - Name of the searching section (before transformation).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			delete_data( $SectionOriginName )
		{
			try
			{
				if( $this->CacheSwitch === false )
				{
					return;
				}
				$this->delete_section( md5( $SectionOriginName ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Проверка, существуют ли данные в кэше.
		*
		*	@param $SectionOriginName - Имя искомой секции (до преобразования).
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@note  Функция не осуществляет проверку на просроченность данных. Поэтому если 
		*	данные существуют, но просрочены, то функция вернет true.
		*
		*	@author Додонов А.А.
		*
		*/
		/**
		*	\~english Check, wether data exists in the cache.
		*
		*	@param $SectionOriginName - Name of the searching section (before transformation).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@note Function validates data existance with checking timeout, so if data was 
		*	timed out but presents in the cache, then function will return true.
		*
		*	@author Dodonov A.A.
		*/
		function			data_exists( $SectionOriginName )
		{
			try
			{
				if( $this->TableOfContents === false )
				{
					return( false );
				}
				else
				{
					return( isset( $this->TableOfContents[ md5( $SectionOriginName ) ] ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Создание нового оглавления кэша.
		*
		*	@param $ReadCursor - Курсор чтения.
		*
		*	@param $SectionSize - Размер секции.
		*
		*	@return Новое оглавление.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function creates new toc.
		*
		*	@param $ReadCursor - Read cursor.
		*
		*	@param $SectionSize - Section size.
		*
		*	@return New toc.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_new_table_of_contents( $ReadCursor , $SectionSize )
		{
			try
			{
				$NewTable = array();
				
				foreach( $this->TableOfContents as $Key => $Value )
				{
					if( $Value[ 'read_cursor' ] === $ReadCursor )
					{
						/* nop */
					}
					else
					{
						if( $Value[ 'read_cursor' ] > $ReadCursor )
						{
							$Value[ 'read_cursor' ] -= $SectionSize;
						}
						$NewTable[ $Key ] = $Value;
					}
				}
				
				return( $NewTable );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Удаление данных из кэша.
		*
		*	@param $SectionOriginName - Имя искомой секции (до преобразования).
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Deleting data from cache.
		*
		*	@param $SectionOriginName - Name of the searching section (before transformation).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	delete_section( $SectionName )
		{
			try
			{
				if( $this->TableOfContents !== false && isset( $this->TableOfContents[ $SectionName ] ) )
				{
					$ReadCursor = $this->TableOfContents[ $SectionName ][ 'read_cursor' ];
					$SectionSize = $this->TableOfContents[ $SectionName ][ 'section_size' ];
					$this->Cache = substr_replace( $this->Cache , '' , $ReadCursor , $SectionSize );
					
					/** \~russian Обновляем содержимое оглавления
						\~english Updating table of content*/
				
					
					$this->TableOfContents = $this->compile_new_table_of_contents( $ReadCursor , $SectionSize );
					
					$this->CacheWasUpdated = true;
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Удаление данных из кэша по тэгу.
		*
		*	@param $Tag - Тэг удаляемой секции.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Deleting data from cache by it's tag.
		*
		*	@param $Tag - Tag of the deleting section.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			delete_data_by_tag( $Tag )
		{
			try
			{
				if( $this->CacheSwitch === false )
				{
					return;
				}
				$Sections = array();
				
				foreach( $this->TableOfContents as $Key => $Value )
				{
					if( array_search( $Tag , $Value[ 'tags' ] ) !== false )
					{
						$Sections [] = $Key;
					}
				}
				
				foreach( $Sections as $Key => $Value )
				{
					$this->delete_section( $Value );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция сохраняет все данные на диск.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function flushes all data on disk.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			flush()
		{
			try
			{
				if( $this->CacheWasUpdated && $this->CacheSwitch === true )
				{
					@unlink( dirname( __FILE__ ).'./data/cache' );
					/** \~russian сохранение обновленного кэша
						\~english save updated cache*/
					file_put_contents( dirname( __FILE__ ).'/data/cache' , $this->Cache );
					
					/** \~russian сохранение описания кэша
						\~english save cache's table of content*/
					file_put_contents( dirname( __FILE__ ).'/data/table' , serialize( $this->TableOfContents ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Очистка кэша.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function drops cache.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			drop_cache()
		{
			try
			{
				@unlink( dirname( __FILE__ ).'./data/cache' );
				@unlink( dirname( __FILE__ ).'./data/table' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Конструктор загружает хранилище с кэшем.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Constructor loads cache from file.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			__destruct()
		{
			try
			{
				if( $this->CacheSwitch === false )
				{
					return;
				}
				
				$this->flush();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>