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
	*	\~russian Класс для создания RSS-потоков.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class creates RSS-feeds.
	*
	*	@author Dodonov A.A.
	*/
	class	rss_2_0_0{
		
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
		var					$AutoMarkup = false;
		var					$CachedMultyFS = false;
		var					$Database = false;
		var					$PageComposer = false;
		var					$Security = false;
		var					$Settings = false;
		var					$String = false;
		
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
				$this->AutoMarkup = get_package( 'page::page_parts' , 'last' , __FILE__ );
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->Database = get_package( 'database' , 'last' , __FILE__ );
				$this->PageComposer = get_package( 'page::page_composer' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения данных для фида.
		*
		*	@return Данные.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns data for feed.
		*
		*	@return Data.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_feed_records()
		{
			try
			{
				if( $this->Security->get_gp( 'feed' , 'set' ) === false )
				{
					return( false );
				}
				
				$Feed = $this->Security->get_gp( 'feed' , 'command' );
				
				$FeedScript = $this->CachedMultyFS->get_data( __FILE__ , "$Feed.sql" );
				$FeedScript = $this->AutoMarkup->compile_string( $FeedScript );
				
				$this->Database->query_as( DB_OBJECT );
				
				$Result = $this->Database->query( $FeedScript );
				
				return( $this->Database->fetch_results( $Result ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция компиляции фида.
		*
		*	@param $Records - Данные.
		*
		*	@return Скомпилированный фид.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles feed.
		*
		*	@param $Records - Records.
		*
		*	@return Compiled feed.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_records( &$Records )
		{
			try
			{
				$FeedXml = $this->CachedMultyFS->get_template( __FILE__ , 'rss20_feed.tpl' );

				foreach( $Records as $Record )
				{					
					$FeedItem = $this->CachedMultyFS->get_template( __FILE__ , 'rss20_item.tpl' );

					$FeedItem = $this->String->print_record( $FeedItem , $Record );

					$FeedXml = str_replace( '{items}' , $FeedItem.'{items}' , $FeedXml );
				}
				
				return( $FeedXml );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции фида.
		*
		*	@param $Records - Данные.
		*
		*	@return Скомпилированный фид.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles feed.
		*
		*	@param $Records - Records.
		*
		*	@return Compiled feed.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_feed( &$Records )
		{
			try
			{
				$FeedXml = $this->compile_records( $Records );

				$FeedXml = str_replace( '{last_build_date}' , date( 'r' ) , $FeedXml );
				$FeedXml = str_replace( '{package_path}' , _get_package_path( 'rss' , '2.0.0' ) , $FeedXml );

				$this->Settings->load_file( dirname( __FILE__ ).'/conf/cf_default' );
				$FeedXml = $this->String->print_record( $FeedXml , $this->Settings->get_raw_settings() );

				$FeedXml = $this->AutoMarkup->compile_string( $FeedXml );

				return( $FeedXml );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция генерации фида.
		*
		*	@param $Options - Опции генерации.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function generates feed.
		*
		*	@param $Options - Generatating options.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			view( $Options )
		{
			try
			{
				$Records = $this->get_feed_records();

				if( $Records === false )
				{
					return( false );
				}

				$Feed = $this->compile_feed( $Records );

				$Feed = $this->Security->get( $Feed , 'unsafe_string' );

				header( "Content-Type: application/rss+xml" );

				return( $Feed );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция обработки макроса 'rss_button'.
		*
		*	@param $Str - Строка требуюшщая обработки.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@return array( Обрабатываемая строка , Была ли строка обработана ).
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'rss_button'.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return array( Processed string , Was the string changed ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_rss_button( &$Settings )
		{
			try
			{
				$Type = $Settings->get_setting( 'type' , 'small' );

				$Code = $this->CachedMultyFS->get_template( __FILE__ , $Type.'_rss_button.tpl' );

				$Code = $this->String->print_record( $Code , $Settings );

				$Code = str_replace( '{package_path}' , _get_package_relative_path_ex( 'rss' , '2.0.0' ) , $Code );

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>