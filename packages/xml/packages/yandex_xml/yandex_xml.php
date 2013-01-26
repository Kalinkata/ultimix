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
	*	\~russian Класс для работы с Yandex.XML.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides Yandex.XML API.
	*
	*	@author Dodonov A.A.
	*/
	class	yandex_xml_1_0_0{

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
		var					$Security = false;

		/**
		*	\~russian Конструктор.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
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
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Ключ.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Key.
		*
		*	@author Dodonov A.A.
		*/
		var					$Key = '';
		
		/**
		*	\~russian Пользователь.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english User.
		*
		*	@author Dodonov A.A.
		*/
		var					$User = '/';
		
		/**
		*	\~russian Установка поля.
		*
		*	@param $FieldName - Имя поля.
		*
		*	@param $FieldValue - Значение поля.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sets field.
		*
		*	@param $FieldName - Field name.
		*
		*	@param $FieldValue - Field value.
		*
		*	@author Dodonov A.A.
		*/
		function			set( $FieldName , $FieldValue )
		{
			$this->$FieldName = $FieldValue;
		}

		/**
		*	\~russian Функция отправки запроса к Яндексу.
		*
		*	@param $Data - Данные для отправки.
		*
		*	@param $Region - Регион.
		*
		*	@return Результат выдачи яндекса.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sends request to yandex.
		*
		*	@param $Data - Data to be sent.
		*
		*	@param $Region - Region.
		*
		*	@return Yandex response.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	send_request( $Data , $Region = 0 )
		{
			try
			{
				$Header = "Content-type: application/xml\r\nContent-length: " . strlen( $Data );
				$HttpDescription = array( 'method' => "POST" , 'content' => $Data , 'header' => $Header );
				$ContextDescription = array( 'http' => $HttpDescription );
				$Context = stream_context_create( $ContextDescription );

				$URL = "http://xmlsearch.yandex.ru/xmlsearch?user=".
					"$this->User&key=$this->Key".( $Region ? "&lr=$Region" : '' )/**/;
				$Result = file_get_contents( $URL , true , $Context );

				return( $Result );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция отправки запроса к Яндексу.
		*
		*	@param $Query - Поисковый запрос.
		*
		*	@param $Region - Region.
		*
		*	@return Результат выдачи яндекса.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sends request to yandex.
		*
		*	@param $Query - Search query.
		*
		*	@param $Region - Region.
		*
		*	@return Yandex response.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	search_query( $Query , $Region = 0 , $Page = 0 )
		{
			try
			{
				$Data = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
				<request>
					<query>$Query</query>
					<groupings>
						<groupby attr=\"d\" mode=\"deep\" groups-on-page=\"100\" docs-in-group=\"1\" />
					</groupings>
					<page>$Page</page>
				</request>";

				return( $this->send_request( $Data , $Region ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция парсинга ответа.
		*
		*	@param $Response - Ответ.
		*
		*	@return Рапарсенный ответ.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function parses response.
		*
		*	@param $Response - Response.
		*
		*	@return Parsed response.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	parse_response( $Response )
		{
			try
			{
				$XMLDoc = new SimpleXMLElement( $Response );

				return( $XMLDoc->xpath( "response/results/grouping/group/doc" ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение позиции сайта в выдаче.
		*
		*	@param $Domain - Сайт.
		*
		*	@param $Query - Запрос.
		*
		*	@param $Region - Регион.
		*
		*	@param $Depth - Глубина.
		*
		*	@return Позиция.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns site position.
		*
		*	@param $Domain - Site.
		*
		*	@param $Query - Query.
		*
		*	@param $Region - Region.
		*
		*	@param $Depth - Depth.
		*
		*	@return Position.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_position( $Domain , $Query , $Region = 0 , $Depth = 1 )
		{
			try
			{
				$Domain = str_ireplace( 'http://' , '' , $Domain );
				$Domain = rtrim( $Domain , '/\\' );

				$Counter = 1;

				for( $Page = 0 ; $Page < $Depth ; $Page++ )
				{
					$Response = $this->search_query( $Query , $Region , $Page );
					$Response = $this->parse_response( $Response );

					foreach( $Response as $Item )
					{
						if( strtolower( $Item->domain ) == strtolower( $Domain ) )
						{
							return( $Counter );
						}
						$Counter++;
					}
				}

				return( false );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение позиции сайта в выдаче.
		*
		*	@param $Domain - Сайт.
		*
		*	@param $Query - Запрос.
		*
		*	@param $Region - Регион.
		*
		*	@param $Depth - Глубина.
		*
		*	@return array( $Position , $URL ).
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns site position.
		*
		*	@param $Domain - Site.
		*
		*	@param $Query - Query.
		*
		*	@param $Region - Region.
		*
		*	@param $Depth - Depth.
		*
		*	@return array( $Position , $URL ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_position_and_url( $Domain , $Query , $Region = 0 , $Depth = 1 )
		{
			try
			{
				$Domain = rtrim( str_ireplace( 'http://' , '' , $Domain ) , '/\\' );
				$Counter = 1;
				for( $Page = 0 ; $Page < $Depth ; $Page++ )
				{
					$Response = $this->search_query( $Query , $Region , $Page );
					$Response = $this->parse_response( $Response );
					if( empty( $Response ) )
					{
						return( array( false , false ) );
					}
					foreach( $Response as $Item )
					{
						if( strtolower( $Item->domain ) == strtolower( $Domain ) )
						{
							return( array( $Counter , "$Item->url" ) );
						}
						$Counter++;
					}
				}
				return( array( $Counter < count( $Response ) ? $Counter : 0 , 'undefined' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение позиции сайта в выдаче.
		*
		*	@param $Domain - Сайт.
		*
		*	@param $Query - Запрос.
		*
		*	@param $Region - Регион.
		*
		*	@param $Depth - Глубина.
		*
		*	@return Позиция.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns site position.
		*
		*	@param $Domain - Site.
		*
		*	@param $Query - Query.
		*
		*	@param $Region - Region.
		*
		*	@param $Depth - Depth.
		*
		*	@return Position.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_url( $Domain , $Query , $Region = 0 , $Depth = 1 )
		{
			try
			{
				$Domain = str_ireplace( 'http://' , '' , $Domain );
				$Domain = rtrim( $Domain , '/\\' );

				for( $Page = 0 ; $Page < $Depth ; $Page++ )
				{
					$Response = $this->search_query( "$Query site:$Domain" , $Region , $Page );

					$Response = $this->parse_response( $Response );

					foreach( $Response as $Item )
					{
						if( strtolower( $Item->domain ) == strtolower( $Domain ) )
						{
							return( "$Item->url" );
						}
					}
				}

				return( false );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>