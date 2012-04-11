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
		*	@param $User - Пользователь.
		*
		*	@param $Key - Ключ.
		*
		*	@param $Data - Данные для отправки.
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
		*	@param $User - User login.
		*
		*	@param $Key - Key.
		*
		*	@param $Data - Data to be sent.
		*
		*	@return Yandex response.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	send_request( $User , $Key , $Data = '' )
		{
			try
			{
				$Header = "Content-type: application/xml\r\nContent-length: " . strlen( $Data );
				$HttpDescription = array( 'method' => "POST" , 'content' => $Data , 'header' => $Header );
				$ContextDescription = array( 'http' => $HttpDescription );
				$Context = stream_context_create( $ContextDescription );

				$URL = "http://xmlsearch.yandex.ru/xmlsearch?user=$User&key=$Key";
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
		*	@param $User - Пользователь.
		*
		*	@param $Key - Ключ.
		*
		*	@param $Query - Поисковый запрос.
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
		*	@param $User - User login.
		*
		*	@param $Key - Key.
		*
		*	@param $Query - Search query.
		*
		*	@return Yandex response.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	search_query( $User , $Key , $Query )
		{
			try
			{
				$Data = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
				<request>
					<query>$Query</query>
					<groupings>
						<groupby attr=\"d\" mode=\"deep\" groups-on-page=\"100\" docs-in-group=\"1\" />
					</groupings>
				</request>";

				return( $this->send_request( $User , $Key , $Data ) );
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
 
				$Error = $XMLDoc->response->error;
				$FoundAll = $XMLDoc->response->found;

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
		*	@return Position.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_position( $Domain , $Query )
		{
			try
			{
				$Response = $this->search_query( $this->User , $this->Key , $Query );

				$Response = $this->parse_response( $Response );

				$Counter = 1;
				foreach( $Response as $Item )
				{
					if( strtolower( $Item->domain ) == $Domain )
					{
						return( $Counter );
					}
					$Counter++;
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
		*	@return array( $Position , $URL ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_position_and_url( $Domain , $Query )
		{
			try
			{
				$Response = $this->search_query( $this->User , $this->Key , $Query );
				$Response = $this->parse_response( $Response );
				$Domain = str_ireplace( 'http://' , '' , $Domain );

				if( empty( $Response ) )
				{
					return( array( false , false ) );
				}

				$Counter = 1;
				foreach( $Response as $Item )
				{
					if( strtolower( $Item->domain ) == $Domain )
					{
						return( array( $Counter , "$Item->url" ) );
					}
					$Counter++;
				}

				return( array( $Counter < count( $Response ) ? $Counter : 0 , 'undefined' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

	/*
		$YandexXML = get_package( 'xml::yandex_xml' , 'last' , __FILE__ );
		
		$YandexXML->set( 'User' , 'gdever' );
		$YandexXML->set( 'Key' , '03.47194176:143dc52413f92c472306881e7f75a626' );
		
		print( $YandexXML->get_position( 'gdzone.ru' , 'шанти' ) );

		exit( 0 );
	*/

?>