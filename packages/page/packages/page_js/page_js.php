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
	*	\~russian Утилиты компоновки страниц.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Page composer utilities.
	*
	*	@author Dodonov A.A.
	*/
	class	page_js_1_0_0{

		/**
		*	\~russian Массив с путями к файам, которые надо подключить.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Array keeps all file paths to be included.
		*
		*	@author Dodonov A.A.
		*/
		var					$JSFiles = array();

		/**
		*	\~russian Закэшированный объект.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cached object.
		*
		*	@author Dodonov A.A.
		*/
		var					$Cache = false;
		var					$CachedMultyFS = false;
		var					$PageComposer = false;
		var					$Security = false;
		var					$String = false;
		var					$Tags = false;
		var					$Trace = false;

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
				$this->Cache = get_package( 'cache' , 'last' , __FILE__ );
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
				$this->Tags = get_package( 'string::tags' , 'last' , __FILE__ );
				$this->Trace = get_package( 'trace' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Объединение скриптов.
		*
		*	@param $Files - Массив файлов для объединения.
		*
		*	@param $Handle - Файловый дескриптор.
		*
		*	@return Массив файлов после объединения.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Scripts compression.
		*
		*	@param $Files - Array of files to unite.
		*
		*	@param $Handle - File handle.
		*
		*	@return Array of file paths.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	scripts_join1( $Files , $Handle )
		{
			try
			{
				$RetFiles = array();

				foreach( $Files as $k => $v )
				{
					if( $v[ 'join' ] )
					{
						if( strpos( $v[ 'path' ] , '{http_host}/' ) === 0 )
						{
							$v[ 'path' ] = str_replace( '{http_host}/' , './' , $v[ 'path' ] );
						}
						$v[ 'path' ] = $this->Tags->compile_ultimix_tags( $v[ 'path' ] );
						$Content = $this->CachedMultyFS->file_get_contents( $v[ 'path' ] );
						fwrite( $Handle , "$Content\r\n" );
					}
					else
					{
						$RetFiles [] = array( 'path' => $v[ 'path' ] );
					}
				}

				return( $RetFiles );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Объединение скриптов.
		*
		*	@param $Files - Массив файлов для объединения.
		*
		*	@return Массив файлов после объединения.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Scripts compression.
		*
		*	@param $Files - Array of files to unite.
		*
		*	@return Array of file paths.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	scripts_join2( $Files )
		{
			try
			{
				$RetFiles = array();

				foreach( $Files as $k => $v )
				{
					if( !$v[ 'join' ] )
					{
						$RetFiles [] = array( 'path' => $v[ 'path' ] );
					}
				}

				return( $RetFiles );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция объединения файлов со скриптами.
		*
		*	@param $Files - Массив файлов для объединения.
		*
		*	@return Массив файлов после объединения.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function unites scripts.
		*
		*	@param $Files - Array of files to unite.
		*
		*	@return Array of files after the union.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	join_compressed_scripts( $Files )
		{
			try
			{
				$FilesHash = md5( implode_ex( '' , $Files , 'path' ) );
				$UnionFilePath = dirname( __FILE__ )."/tmp/$FilesHash.js";

				if( $this->CachedMultyFS->file_exists( $UnionFilePath ) === false || 
					$this->Cache->get_data( $UnionFilePath ) === false )
				{
					$Handle = fopen( dirname( __FILE__ )."/tmp/$FilesHash.js" , "wb" );

					$RetFiles = $this->scripts_join1( $Files , $Handle );

					fclose( $Handle );
				}
				else
				{
					$RetFiles = $this->scripts_join2( $Files );
				}

				return( $RetFiles );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция объединения файлов со скриптами.
		*
		*	@param $Files - Массив файлов для объединения.
		*
		*	@return Массив файлов после объединения.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function unites scripts.
		*
		*	@param $Files - Array of files to unite.
		*
		*	@return Array of files after the union.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			join_scripts( $Files )
		{
			try
			{
				if( is_array( $Files ) && count( $Files ) > 0 )
				{
					$RetFiles = $this->join_compressed_scripts( $Files );

					$FilesHash = md5( implode_ex( '' , $Files , 'path' ) );

					$UnionFilePath = dirname( __FILE__ )."/tmp/$FilesHash.js";

					$RetFiles [] = array( 
						'path' => str_replace( 
							'./' , '{http_host}/' , _get_package_relative_path( __FILE__ )."/tmp/$FilesHash.js"
						)
					);

					return( $RetFiles );
				}
				else
				{
					return( $Files );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение контента для вывода.
		*
		*	@return Скрипт подключения js файлов.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns script contnt.
		*
		*	@return Script content.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_header_content()
		{
			try
			{
				$PageName = $this->Security->get_gp( 'page_name' , 'command' );

				if( $this->Cache->data_exists( "$PageName scripts" ) )
				{
					$Content = $this->Cache->get_data( "$PageName scripts" );
				}
				else
				{
					$this->JSFiles = $this->join_scripts( $this->JSFiles );
					$Start = $this->CachedMultyFS->get_template( __FILE__ , 'script_link_start.tpl' );
					$End = $this->CachedMultyFS->get_template( __FILE__ , 'script_link_end.tpl' );
					$Content = $Start.implode_ex( $End.$Start , $this->JSFiles , 'path' ).$End;

					$this->Cache->add_data( "$PageName scripts" , $Content );
				}

				return( $Content );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Вывод скриптов.
		*
		*	@param $Str - Контент страницы.
		*
		*	@return Страница со скриптами.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function outputs scripts.
		*
		*	@param $Str - Page content.
		*
		*	@return Page with scripts.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			output_scripts( $Str )
		{
			try
			{
				if( is_array( $this->JSFiles ) && count( $this->JSFiles ) )
				{
					$Content = $this->get_header_content();

					if( strpos( $Str , '{header}' ) !== false )
					{
						$Str = str_replace( '{header}' , $Content.'{header}' , $Str );
					}
					else
					{
						$Str = str_replace( '</head>' , $Content.'</head>' , $Str );
					}
				}

				$this->JSFiles = array();

				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция добавляет на подключение джаваскрипт.
		*
		*	@param $Path - Путь к скрипту.
		*
		*	@param $Join - Нужно ли объединять скрипт с другими.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function adds javascript to include queue.
		*
		*	@param $Path - Path to the script.
		*
		*	@param $Join - Should this script be joined with others.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			add_javascript( $Path , $Join = true )
		{
			try
			{
				if( $this->PageComposer === false )
				{
					$this->PageComposer = get_package( 'page::page_composer' , 'last' , __FILE__ );
				}
				$Path = $this->PageComposer->Template->compile_string( $Path );
				foreach( $this->JSFiles as $k => $v )
				{
					if( $v[ 'path' ] == $Path )
					{
						return;
					}
				}
				$this->JSFiles [] = array( 'path' => $Path , 'join' => $Join );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>