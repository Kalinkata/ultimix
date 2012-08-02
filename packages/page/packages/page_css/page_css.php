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
	class	page_css_1_0_0{

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
		var					$CSSFiles = array();

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
		*	\~russian Компрессия стилей.
		*
		*	@param $Files - Массив файлов для объединения.
		*
		*	@return Массив файлов после компрессии.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Stylesheets compression.
		*
		*	@param $Files - Array of files to unite.
		*
		*	@return Array of files after the compression.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compress_stylesheets( $Files )
		{
			try
			{
				$Compressed = array();

				foreach( $Files as $k => $v )
				{
					$v = $this->String->clear_ultimix_tags( $v );
					if( $v[ 'join' ] )
					{
						$Compressed[ 'join' ] [] = $v[ 'path' ];
					}
					else
					{
						$Key = str_replace( '././' , './' , dirname( $v[ 'path' ] ) );
						if( isset( $Compressed[ $Key ] ) == false )
						{
							$Compressed[ $Key ] = array();
						}
						$Compressed[ $Key ] [] = basename( $v[ 'path' ] );
					}
				}

				return( $Compressed );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Заполнение файла.
		*
		*	@param $FileName - Название файла.
		*
		*	@param $Files - Массив файлов для объединения.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Filling file.
			*
		*	@param $FileName - File name.
		*
		*	@param $Files - Array of files to unite.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	fill_file( $FileName , $Files )
		{
			try
			{
				$Handle = fopen( dirname( __FILE__ )."/tmp/$FileName.css" , "wb" );

				foreach( $Files as $k2 => $v2 )
				{
					$Content = $this->CachedMultyFS->file_get_contents( "$v2" );
					fwrite( $Handle , $Content );
					fwrite( $Handle , "\r\n" );
				}

				fclose( $Handle );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Объединение стилей.
		*
		*	@param $Files - Массив файлов для объединения.
		*
		*	@param $RetFiles - Объединённые стили.
		*
		*	@return Массив файлов после объединения.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Stylesheets compression.
		*
		*	@param $Files - Array of files to unite.
		*
		*	@param $RetFiles - Joined stylesheets.
		*
		*	@return Array of file paths.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	stylesheets_join1( $Files , $RetFiles )
		{
			try
			{	
				$FilesHash = md5( implode_ex( '' , $Files , 'path' ) );
				$UnionFilePath = dirname( __FILE__ )."/tmp/$FilesHash.css";

				if( $this->CachedMultyFS->file_exists( $UnionFilePath ) === false || 
					$this->Cache->get_data( $UnionFilePath ) === false )
				{
					$this->fill_file( $FilesHash , $Files );

					$RetFiles [] = array( 
						'path' => _get_package_relative_path( __FILE__ )."/tmp/$FilesHash.css"
					);
				}
				else
				{
					$RetFiles [] = array( 
						'path' => _get_package_relative_path( __FILE__ )."/tmp/$FilesHash.css"
					);
				}

				return( $RetFiles );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Объединение стилей.
		*
		*	@param $Path - Путь к папке стиля.
		*
		*	@param $Files - Массив файлов для объединения.
		*
		*	@param $RetFiles - Объединённые стили.
		*
		*	@return Массив файлов после объединения.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Stylesheets compression.
		*
		*	@param $Path - Path to the stylesheet folder.
		*
		*	@param $Files - Array of files to unite.
		*
		*	@param $RetFiles - Joined stylesheets.
		*
		*	@return Array of file paths.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	stylesheets_join3( $Path , $Files , $RetFiles )
		{
			try
			{	
				$FilesHash = implode( '' , $Files );
				$UnionFilePath = "$Path/$FilesHash.css";

				if( $this->CachedMultyFS->file_exists( $UnionFilePath ) === false || 
					$this->Cache->get_data( $UnionFilePath ) === false )
				{
					$Handle = fopen( $UnionFilePath , "wb" );

					foreach( $Files as $k2 => $v2 )
					{
						$Content = $this->CachedMultyFS->file_get_contents( "$Path/$v2" );
						fwrite( $Handle , $Content );
						fwrite( $Handle , "\r\n" );
					}

					fclose( $Handle );
				}

				$RetFiles [] = array( 'path' => str_replace( './' , '{http_host}/' , $UnionFilePath ) );

				return( $RetFiles );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция объединения файлов со стилями.
		*
		*	@param $Compressed - Массив файлов для объединения.
		*
		*	@return Массив файлов после объединения.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function unites stylesheets.
		*
		*	@param $Compressed - Array of files to unite.
		*
		*	@return Array of files after the union.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	join_compressed_stylesheets( $Compressed )
		{
			try
			{
				$RetFiles = array();

				foreach( $Compressed as $k1 => $v1 )
				{
					if( $k1 === 'join' )
					{
						$RetFiles = $this->stylesheets_join1( $v1 , $RetFiles );
					}
					elseif( count( $v1 ) == 1 )
					{
						$RetFiles [] = array( 'path' => str_replace( './' , '{http_host}/' , "$k1/".$v1[ 0 ] ) );
					}
					else
					{
						$RetFiles = $this->stylesheets_join3( $k1 ,$v1 , $RetFiles );
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
		*	\~russian Функция объединения файлов со стилями.
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
		*	\~english Function unites stylesheets.
		*
		*	@param $Files - Array of files to unite.
		*
		*	@return Array of files after the union.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			join_stylesheets( $Files )
		{
			try
			{
				if( is_array( $Files ) && count( $Files ) > 0 )
				{
					$Compressed = $this->compress_stylesheets( $Files );

					$RetFiles = $this->join_compressed_stylesheets( $Compressed );

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
		*	\~russian Компиляция стилей.
		*
		*	@param $Str - Контент страницы.
		*
		*	@return Страница со стилями.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function commpiles style sheets.
		*
		*	@param $Str - Page content.
		*
		*	@return Page with style sheets.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_stylesheets( $Str )
		{
			try
			{
				$this->CSSFiles = $this->join_stylesheets( $this->CSSFiles , 'css' );
				$Start = $this->CachedMultyFS->get_template( __FILE__ , 'stylesheet_link_start.tpl' );
				$End = $this->CachedMultyFS->get_template( __FILE__ , 'stylesheet_link_end.tpl' );

				$HeaderContent = $Start.implode_ex( $End.$Start , $this->CSSFiles , 'path' ).$End;
				
				if( strpos( $Str , '{header}' ) !== false )
				{
					$Str = str_replace( '{header}' , $HeaderContent.'{header}' , $Str );
				}
				else
				{
					$Str = str_replace( '</head>' , $HeaderContent.'</head>' , $Str );
				}

				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Вывод стилей.
		*
		*	@param $Str - Контент страницы.
		*
		*	@return Страница со стилями.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function outputs style sheets.
		*
		*	@param $Str - Page content.
		*
		*	@return Page with style sheets.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			output_stylesheets( $Str )
		{
			try
			{
				if( is_array( $this->CSSFiles ) && count( $this->CSSFiles ) )
				{
					$Str = $this->compile_stylesheets( $Str );
				}

				$this->CSSFiles = array();

				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция добавляет на подключение таблицу стилей.
		*
		*	@param $Path - Путь к стилю.
		*
		*	@param $Join - Нужно ли объединять стиль с другими.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function adds stylesheet to include queue.
		*
		*	@param $Path - Path to the stylesheet.
		*
		*	@param $Join - Should this stylesheet be joined with others.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			add_stylesheet( $Path , $Join = false )
		{
			try
			{
				if( $this->PageComposer === false )
				{
					$this->PageComposer = get_package( 'page::page_composer' , 'last' , __FILE__ );
				}
				$Path = $this->PageComposer->Template->compile_string( $Path );
				$Path = str_replace( '/./' , '/' , $Path );
				foreach( $this->CSSFiles as $k => $v )
				{
					if( $v[ 'path' ] == $Path )
					{
						return;
					}
				}
				$this->CSSFiles [] = array( 'path' => $Path , 'join' => $Join );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>