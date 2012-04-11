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
	*	\~russian Класс для работы с рекламной системой Sape.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides integration with the Sape system.
	*
	*	@author Dodonov A.A.
	*/
	class	sape_project_api_1_0_0{

		/**
		*	\~russian Закэшированные пакеты.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cached packages.
		*
		*	@author Dodonov A.A.
		*/
		var					$SapeCommonApi = false;
		var					$SapeUtilities = false;
		var					$Security = false;

		/**
		*	\~russian Конструктор.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
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
				$this->SapeCommonApi = get_package( 'sape::sape_common_api' , 'last' , __FILE__ );
				$this->SapeUtilities = get_package( 'sape::sape_utilities' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение списка проектов.
		*
		*	@return Список проектов.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Function returns a list of packages.
		*
		*	@return A list of projects.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_projects()
		{
			try
			{
				$Response = $this->SapeUtilities->call_method( 
					$this->SapeCommonApi->Client , 'sape.get_projects' , array() , 'Can\'t get projects'
				);

				return( php_xmlrpc_decode( $Response->value() ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение списка УРЛов на которые изменились цены.
		*
		*	@param $ProjectId - Идентификатор проекта.
		*
		*	@param $Days - Количество дней.
		*
		*	@return Список УРЛов.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Function returns a list of URLs with changed prices.
		*
		*	@param $ProjectId - Project's id.
		*
		*	@param $Days - Count of days.
		*
		*	@return A list of URLs.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_placements_new_prices( $ProjectId = 0 , $Days = 30 )
		{
			try
			{
				$ProjectId = $this->Security->get( $ProjectId , 'integer' );
				$Days = $this->Security->get( $Days , 'integer' );

				$Parameters = array( new xmlrpcval( $ProjectId , 'int' ) , new xmlrpcval( $Days , 'string' ) );

				$Response = $this->SapeUtilities->call_method( 
					$this->SapeCommonApi->Client , 'sape.get_placements_new_prices' , 
					$Parameters , 'Can\'t get placements'
				);

				return( php_xmlrpc_decode( $Response->value() ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Удаление купленных ссылок.
		*
		*	@param $LinkIds - Идентификаторы ссылок.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Function delete links.
		*
		*	@param $LinkIds - Ids of the deleting links.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			placements_delete( $LinkIds )
		{
			try
			{
				if( isset( $LinkIds[ 0 ] ) === false )
				{
					return( array() );
				}

				$LinkIds = $this->Security->get( $LinkIds , 'integer' );

				$LinksToDelete = array();

				foreach( $LinkIds as $i => $id )
				{
					$LinksToDelete [] = new xmlrpcval( $id , 'string' );
				}

				$Parameters = array( new xmlrpcval( $LinksToDelete , 'array' ) );

				$Response = $this->SapeUtilities->call_method( 
					$this->SapeCommonApi->Client , 'sape.placements_delete' , $Parameters , 'Can\'t delete links'
				);

				return( php_xmlrpc_decode( $Response->value() ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение УРЛов для указанного проекта.
		*
		*	@param $ProjectId - Идентификатор проекта.
		*
		*	@return Список проектов.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Function returns URLs for the specified project.
		*
		*	@param $ProjectId - Project's id.
		*
		*	@return A list of projects.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_urls( $ProjectId )
		{
			try
			{
				$ProjectId = $this->Security->get( $ProjectId , 'integer' );

				$Parameters = array( new xmlrpcval( $ProjectId , 'int' ) , new xmlrpcval( false , 'boolean' ) );

				$Response = $this->SapeUtilities->call_method( 
					$this->SapeCommonApi->Client , 'sape.get_urls' , $Parameters , 'Can\'t get URLs'
				);

				return( php_xmlrpc_decode( $Response->value() ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение купленных ссылок для указанного УРЛа.
		*
		*	@param $URLId - Идентификатор УРЛа.
		*
		*	@return Список ссылок.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Function returns URLs for the specified project.
		*
		*	@param $URLId - URL's id.
		*
		*	@return A list of links.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_url_links( $URLId )
		{
			try
			{
				$URLId = $this->Security->get( $URLId , 'integer' );

				$Parameters = array(
					new xmlrpcval( $URLId , 'int' ) , new xmlrpcval( '' , 'string' ) , 
					new xmlrpcval( '' , 'string' ) , new xmlrpcval( '' , 'string' ) , new xmlrpcval( 0 , 'int' )
				);

				$Response = $this->SapeUtilities->call_method(
					$this->SapeCommonApi->Client , 'sape.get_url_links' , $Parameters , 'Can\'t get links'
				);

				return( php_xmlrpc_decode( $Response->value() ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Добавление УРЛа.
		*
		*	@param $ProjectId - Идентификатор проекта.
		*
		*	@param $URL - УРЛ.
		*
		*	@param $Name - Название УРЛа.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Function adds URL.
		*
		*	@param $ProjectId - Project's id.
		*
		*	@param $URL - URL.
		*
		*	@param $Name - URL's name.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			url_add( $ProjectId , $URL , $Name )
		{
			try
			{
				$ProjectId = $this->Security->get( $ProjectId , 'integer' );

				$URL = $this->Security->get( $URL , 'string' );

				$Name = $this->Security->get( $Name , 'string' );

				$Parameters = array( 
					new xmlrpcval( $ProjectId , 'int' ) , new xmlrpcval( $URL , 'string' ) , 
					new xmlrpcval( $Name , 'string' )
				);

				$this->SapeUtilities->call_method( 
					$this->SapeCommonApi->Client , 'sape.url_add' , $Parameters , 'Can\'t add URL'
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Редактирование УРЛа.
		*
		*	@param $URLId - УРЛ.
		*
		*	@param $Params - Параметры обновления.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Function updates URL.
		*
		*	@param $URLId - URL.
		*
		*	@param $Params - Update parameters.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			url_update( $URLId , $Params )
		{
			try
			{
				$URLId = $this->Security->get( $URLId , 'integer' );

				$Params = $this->Security->get( $Params , 'string' );

				$ParamsHash = array();

				foreach( $Params as $Key => $Value )
				{
					$ParamsHash[ $Key ] = new xmlrpcval( $Value , 'string' );
				}

				$Parameters = array( new xmlrpcval( $URLId , 'int' ) , new xmlrpcval( $ParamsHash , 'array' ) );

				$Response = $this->SapeUtilities->call_method( 
					$this->SapeCommonApi->Client , 'sape.url_update' , $Parameters , 'Can\'t update URL' 
				);

				return( php_xmlrpc_decode( $Response->value() ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Удаление УРЛа.
		*
		*	@param $URLId - Идентификатор УРЛа.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Function deletes URL.
		*
		*	@param $URLId - URL's id.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			url_delete( $URLId )
		{
			try
			{
				$URLId = $this->Security->get( $URLId , 'integer' );

				$Parameters = array( new xmlrpcval( $URLId , 'int' ) );

				$this->SapeUtilities->call_method( 
					$this->SapeCommonApi->Client , 'sape.url_delete' , $Parameters , 'Can\'t delete URL'
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение анкеров УРЛа.
		*
		*	@param $URLId - Идентификатор УРЛа.
		*
		*	@return Список анкеров.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Function returns URL's anchors.
		*
		*	@param $URLId - URL's id.
		*
		*	@return A list of anchors.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_url_anchors( $URLId )
		{
			try
			{
				$URLId = $this->Security->get( $URLId , 'integer' );

				$Parameters = array( new xmlrpcval( $URLId , 'int' ) );

				$Response = $this->SapeUtilities->call_method(
					$this->SapeCommonApi->Client , 'sape.get_url_anchors' , $Parameters , 'Can\'t get url anchors'
				);

				return( php_xmlrpc_decode( $Response->value() ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Удаление анкеров УРЛа.
		*
		*	@param $URLId - Идентификатор УРЛа.
		*
		*	@param $AnchorIds - Идентификатор анкеров.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Function deletes URL's anchors.
		*
		*	@param $URLId - URL's id.
		*
		*	@param $AnchorIds - Anchor ids.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			url_anchors_delete( $URLId , $AnchorIds )
		{
			try
			{
				$URLId = $this->Security->get( $URLId , 'integer' );

				$AnchorIds = $this->Security->get( $URLId , 'AnchorIds' );

				$Anchors = array();

				foreach( $AnchorIds as $i => $Anchor )
				{
					$Anchors [] = new xmlrpcval( $Anchor , 'int' );
				}

				$Parameters = array( new xmlrpcval( $URLId , 'int' ) , new xmlrpcval( $Anchors , 'array' ) );

				$this->SapeUtilities->call_method( 
					$this->SapeCommonApi->Client , 'sape.url_anchors_delete' , $Parameters , 'Can\'t delete anchors'
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Установка режима модерации.
		*
		*	@param $URLId - Идентификатор УРЛа.
		*
		*	@param $Auto - Авто модерация.
		*
		*	@param $RequireConfirm - Подтверждение.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Function sets moderation mode.
		*
		*	@param $URLId - URL's id.
		*
		*	@param $Auto - Auto moderation.
		*
		*	@param $RequireConfirm - Confirm links.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			url_set_autoseo( $URLId , $Auto = true , $RequireConfirm = false )
		{
			try
			{
				$URLId = $this->Security->get( $URLId , 'integer' );

				$Auto = $Auto ? true : false;

				$RequireConfirm = $RequireConfirm ? true : false;

				$Parameters = array( 
					new xmlrpcval( $URLId , 'int' ) , new xmlrpcval( $Auto , 'boolean' ) , 
					new xmlrpcval( $RequireConfirm , 'boolean' )
				);

				$Response = $this->SapeUtilities->call_method(
					$this->SapeCommonApi->Client , 'sape.url_set_autoseo' , $Parameters , 'Can\'t set auto mode'
				);

				return( php_xmlrpc_decode( $Response->value() ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Параметры фильтра.
		*
		*	@param $FilterId - Идентификатор фильтра.
		*
		*	@param $URLId - Идентификатор УРЛа.
		*
		*	@param $Quant - Количество ссылок.
		*
		*	@param $Price - Сумма.
		*
		*	@param $DailyQuota - Дневная квота.
		*
		*	@return Параметры.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Function sets filter parameters.
		*
		*	@param $FilterId - Filter's id.
		*
		*	@param $URLId - URL's id.
		*
		*	@param $Quant - Links quantity.
		*
		*	@param $Price - Sum.
		*
		*	@param $DailyQuota - Daily quota.
		*
		*	@return Parameters.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	filter_auto_create_parameters( $FilterId , $URLId , $Quant , $Price , $DailyQuota )
		{
			try
			{
				$FilterId = $this->Security->get( $FilterId , 'integer' );
				$URLId = $this->Security->get( $URLId , 'integer' );
				$Quant = $this->Security->get( $Quant , 'integer' );
				$Price = $this->Security->get( $Price , 'float' );
				$DailyQuota = $this->Security->get( $DailyQuota , 'integer' );
				$DailyQuota = $DailyQuota == 0 ? ( 255 <= $Quant ? 255 : $Quant ) : $DailyQuota;

				$Parameters = array( 
					new xmlrpcval( $FilterId , 'int' ) , new xmlrpcval( $URLId , 'int' ) , 
					new xmlrpcval( $Quant , 'int' ) , new xmlrpcval( $Price , 'int' ) , 
					new xmlrpcval( $DailyQuota , 'int' )
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Установка фильтра.
		*
		*	@param $FilterId - Идентификатор фильтра.
		*
		*	@param $URLId - Идентификатор УРЛа.
		*
		*	@param $Quant - Количество ссылок.
		*
		*	@param $Price - Сумма.
		*
		*	@param $DailyQuota - Дневная квота.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Function sets filter.
		*
		*	@param $FilterId - Filter's id.
		*
		*	@param $URLId - URL's id.
		*
		*	@param $Quant - Links quantity.
		*
		*	@param $Price - Sum.
		*
		*	@param $DailyQuota - Daily quota.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			filter_auto_create( $FilterId , $URLId , $Quant , $Price , $DailyQuota = 0 )
		{
			try
			{
				$Parameters = $this->filter_auto_create_parameters( 
					$FilterId , $URLId , $Quant , $Price , $DailyQuota
				);

				$this->SapeUtilities->call_method(
					$this->SapeCommonApi->Client , 'sape.filter_auto_create' , $Parameters , 'Can\'t create auto filter'
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Параметры авто-фильтра.
		*
		*	@param $FilterAutoId - Идентификатор авто-фильтра.
		*
		*	@param $Quant - Количество ссылок.
		*
		*	@param $Price - Сумма.
		*
		*	@param $DailyQuota - Дневная квота.
		*
		*	@return Параметры.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Function returns update auto-filter parameters.
		*
		*	@param $FilterAutoId - Auto-filter's id.
		*
		*	@param $Quant - Links quantity.
		*
		*	@param $Price - Sum.
		*
		*	@param $DailyQuota - Daily quota.
		*
		*	@return Parameters.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	filter_auto_update_parameters( $FilterAutoId , $Quant , $Price , $DailyQuota )
		{
			try
			{
				$FilterAutoId = $this->Security->get( $FilterAutoId , 'integer' );
				$Quant = $this->Security->get( $Quant , 'integer' );
				$Price = $this->Security->get( $Price , 'float' );
				$DailyQuota = $this->Security->get( $DailyQuota , 'integer' );
				$DailyQuota = $DailyQuota == 0 ? ( 255 <= $Quant ? 255 : $Quant ) : $DailyQuota;

				$Parameters = array( 
					new xmlrpcval( $FilterAutoId , 'int' ) , new xmlrpcval( $Quant , 'int' ) , 
					new xmlrpcval( $Price , 'int' ) , new xmlrpcval( $DailyQuota , 'int' )
				);

				return( $Parameters );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Обновление авто-фильтра.
		*
		*	@param $FilterAutoId - Идентификатор авто-фильтра.
		*
		*	@param $Quant - Количество ссылок.
		*
		*	@param $Price - Сумма.
		*
		*	@param $DailyQuota - Дневная квота.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Function updates auto-filter.
		*
		*	@param $FilterAutoId - Auto-filter's id.
		*
		*	@param $Quant - Links quantity.
		*
		*	@param $Price - Sum.
		*
		*	@param $DailyQuota - Daily quota.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			filter_auto_update( $FilterAutoId , $Quant , $Price , $DailyQuota = 0 )
		{
			try
			{
				$Parameters = $this->filter_auto_update_parameters( $FilterAutoId , $Quant , $Price , $DailyQuota );

				$this->SapeUtilities->call_method(
					$this->SapeCommonApi->Client , 'sape.filter_auto_update' , $Parameters , 'Can\'t update auto filter'
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Удаление авто-фильтра.
		*
		*	@param $FilterAutoId - Идентификатор авто-фильтра.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Function deletes auto-filter.
		*
		*	@param $FilterAutoId - Auto-filter's id.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			filter_auto_delete( $FilterAutoId , $Quant , $Price , $DailyQuota = 0 )
		{
			try
			{
				$FilterAutoId = $this->Security->get( $FilterAutoId , 'integer' );

				$Parameters = array( new xmlrpcval( $FilterAutoId , 'int' ) );

				$this->SapeUtilities->call_method(
					$this->SapeCommonApi->Client , 'sape.filter_auto_delete' , $Parameters , 'Can\'t delete auto filter'
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение авто-фильтров.
		*
		*	@param $FilterAutoId - Идентификатор авто-фильтра.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Function deletes auto-filter.
		*
		*	@param $FilterAutoId - Auto-filter's id.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_filters_auto( $URLId )
		{
			try
			{
				$URLId = $this->Security->get( $URLId , 'integer' );

				$Parameters = array( new xmlrpcval( $URLId , 'int' ) , new xmlrpcval( true , 'boolean' ) );

				$Response = $this->SapeUtilities->call_method( 
					$this->SapeCommonApi->Client , 'sape.get_filters_auto' , $Parameters , 'Can\'t get auto filters'
				);

				return( php_xmlrpc_decode( $Response->value() ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>