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
	*	\~russian Класс для работы с поисковиками.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides search engines routine.
	*
	*	@author Dodonov A.A.
	*/
	class	search_engines_1_0_0{
	
		/**
		*	\~russian Закешированные пакеты.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cached packages.
		*
		*	@author Dodonov A.A.
		*/
		var					$Security = false;
		var					$Text = false;
	
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
				$this->Text = get_package( 'string::text' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция возвращает реферала.
		*
		*	@return Реферал.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~russian Function return referer.
		*
		*	@return Referer.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_referer()
		{
			try
			{
				$URL = '';
				
				if( $this->Security->get_gp( 'referer' , 'raw' , '' ) != '' )
				{
					$URL = $this->Security->get_gp( 'referer' , 'raw' );
				}
				else
				{
					$URL = $this->Security->get_srv( 'HTTP_REFERER' , 'raw' , false );
				}
				
				return( $URL );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Проверка поисковика.
		*
		*	@param $CrawlerUrl - URL, по которому проверяем поисковик.
		*
		*	@param $CrawlerName - Название поисковика.
		*
		*	@param $Crawler - Переменная с найденным поисковиком.
		*
		*	@return Возвращает имя поисковика -> $Crawler, если не с поисковика из списка возвращает false.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~russian Validating crawler.
		*
		*	@param $CrawlerUrl - Crawler URL.
		*
		*	@param $CrawlerName - Crawler name.
		*
		*	@param $Crawler - Variable with the crawler name.
		*
		*	@return Search engine name, or false
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			test_crawler( $CrawlerUrl , $CrawlerName , $Crawler )
		{
			try
			{
				$URL = $this->get_referer();
			
				if( $Crawler === false && stristr( $URL , $CrawlerUrl ) )
				{
					$Crawler = $CrawlerName;
				}
				
				return( $Crawler );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Данная функция получает в переменну $url ссылку откуда пришел пол-ль
		*	определяет  с какого поисковика пришли методом совпаения в строках
		*	и присваивает переменной $Crawler имя поисковика 	
		*	например чтобы изменить вывод имени поисковика с Google на Google.ru
		*	надо  в строке $Crawler = 'Google' изменить на $Crawler = 'Google.ru'
		*	чтобы добавить поисковить, надо вставить еще строку соответственно
		*	if (stristr($url, 'адресс_поисковика')) {  $Crawler = 'имя_вывода';}
		*
		*	@return Возвращает имя поисковика -> $Crawler, если не с поисковика из списка возвращает false.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns search engine name.
		*
		*	@return Search engine name, or false
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_search_engine()
		{
			try
			{
				if( $this->get_referer() === false )
				{
					return( false );
				}
				
				$Crawler = false;
				
				$Crawler = $this->test_crawler( 'google.' , 'Google' , $Crawler );
				$Crawler = $this->test_crawler( 'yandex.' , 'Yandex' , $Crawler );
				$Crawler = $this->test_crawler( 'qip.ru' , 'Qip' , $Crawler );
				$Crawler = $this->test_crawler( 'mail.ru' , 'Mail' , $Crawler );
				$Crawler = $this->test_crawler( 'rambler.ru' , 'Rambler' , $Crawler );
				$Crawler = $this->test_crawler( 'bing.com' , 'Bing' , $Crawler );
				$Crawler = $this->test_crawler( 'nigma.ru' , 'Nigma' , $Crawler );
				$Crawler = $this->test_crawler( 'webalta.ru' , 'Webalta' , $Crawler );
				$Crawler = $this->test_crawler( 'ukr.net' , 'Ukr.net' , $Crawler );
				$Crawler = $this->test_crawler( 'conduit.com' , 'Conduit' , $Crawler );
				
				return( $Crawler );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение параметра поискового запроса.
		*
		*	@return Параметр поискового запроса.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function return search query parametr.
		*
		*	@return Search query parameter.
		*
		*	@exception Exception Exception An exception of this type is thrown.
		*
		*	@author Додонов А.А.
		*/
		function			get_search_prefix()
		{
			try
			{
				$SearchEngine = $this->get_search_engine();
				
				$Search = false;
				
				switch( $SearchEngine )
				{
					case( 'Google' ):
					case( 'Webalta' ):
					case( 'Mail' ):
					case( 'Bing' ):
					case( 'Conduit' ):
					case( 'Ukr.net' ):$Search = 'q=';break;
					case( 'Yandex' ):$Search = 'text=';break;
					case( 'Qip' ):
					case( 'Rambler' ):$Search = 'query=';break;
					case( 'Nigma' ):$Search = 's=';break;
				}
				
				return( $Search );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Также получает адресс откуда пришел пол-ль в переменную $URL,
		*	далее определяет с какого поисковика и присваивает переменной $search
		*	что то вроде ключа, чтобы понять откуда искать ключевые слова,
		*	далее находит ключевые слова, записывает в переменную $phrase2,
		*	кодирует в utf8 и возвращает значение
		*
		*	@return Возвращает ключевые слова поиска, если не из дынных поисковиков, возврщает false.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns search query.
		*
		*	@return search query, or false.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_search_query()
		{
			try
			{
				$Search = $this->get_search_prefix();

				if( $Search !== false )
				{
					$URL = $this->get_referer();

					$Phrase = urldecode( urldecode( $URL ) );

					preg_match( "/[\?\&]{1}$Search([^\&\#]*)/" , "$Phrase&" , $Phrase2 );

					return( isset( $Phrase2[ 1 ] ) ? $this->Text->iconv( false , 'utf-8' , $Phrase2[ 1 ] ) : false );
				}
				else
				{
					return( false );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Проверяет значение функции get_search_engine.
		*
		*	@return Если пришли с поисковика, возвращает true если нет, возвращает false.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function validates value of the function get_search_engine.
		*
		*	@return true if the user has come from the searche engine, false otherwise.
		*
		*	@exception Exception Exception An exception of this type is thrown.
		*
		*	@author Додонов А.А.
		*/
		function			redirected_from_search_engine()
		{
			try
			{
				$Redir = $this->get_search_engine();
				
				return( $Redir === false ? false : true );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
?>