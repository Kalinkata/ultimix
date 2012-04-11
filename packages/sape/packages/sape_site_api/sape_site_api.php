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
	class	sape_site_api_1_0_0{

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
		*	\~russian Получение списка сайтов.
		*
		*	@return Список сайтов.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Function returns a list of sites.
		*
		*	@return A list of sites.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_sites()
		{
			try
			{
				$Response = $this->SapeUtilities->call_method( 
					$this->SapeCommonApi->Client , 'sape.get_sites' , array() , 'Can\'t get sites'
				);

				return( php_xmlrpc_decode( $Response->value() ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение параметров по доходам с сайта.
		*
		*	@param $SiteId - Идентфикатор сайта.
		*
		*	@param $Status - Статус.
		*
		*	@return Список ссылок.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Function returns a list of links.
		*
		*	@param $SiteId - Site's id.
		*
		*	@param $Status - Status.
		*
		*	@return A list of links.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_site_money_stats_parameters( $SiteId , $Year , $Month , $Day )
		{
			try
			{
				$SiteId = $this->Security->get( $SiteId , 'integer' );

				$Parameters = array( new xmlrpcval( $SiteId , 'int' ) );
				if( $Year !== false )
				{
					$Parameters [] = new xmlrpcval( $this->Security->get( $Year , 'integer' ) , 'int' );
					if( $Month !== false )
					{
						$Parameters [] = new xmlrpcval( $this->Security->get( $Month , 'integer' ) , 'int' );
						if( $Day !== false )
						{
							$Parameters [] = new xmlrpcval( $this->Security->get( $Day , 'integer' ) , 'int' );
						}
					}
				}

				return( $Parameters );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение статистики по доходам с сайта.
		*
		*	@param $SiteId - Идентфикатор сайта.
		*
		*	@param $Year - Год.
		*
		*	@param $Month - Месяц.
		*
		*	@param $Day - День.
		*
		*	@return Список ссылок.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Function returns site money.
		*
		*	@param $SiteId - Site's id.
		*
		*	@param $Year - Year.
		*
		*	@param $Month - Month.
		*
		*	@param $Day - Day.
		*
		*	@return Site money.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_site_money_stats( $SiteId , $Year = false , $Month = false , $Day = false )
		{
			try
			{
				$Parameters = $this->get_site_money_stats_parameters( $SiteId , $Year , $Month , $Day );

				$Method = 'sape.get_site_money_stats';
				$Response = $this->SapeUtilities->call_method( 
					$this->SapeCommonApi->Client , $Method , $Parameters , 'Can\'t get site money stats'
				);

				return( php_xmlrpc_decode( $Response->value() ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение списка страниц.
		*
		*	@param $SiteId - Идентфикатор сайта.
		*
		*	@return Список страниц.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Function returns a list of pages.
		*
		*	@param $SiteId - Site's id.
		*
		*	@return A list of pages.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_site_pages( $SiteId )
		{
			try
			{
				$SiteId = $this->Security->get( $SiteId , 'integer' );

				$Parameters = array( new xmlrpcval( $SiteId , 'int' ) );

				$Response = $this->SapeUtilities->call_method( 
					$this->SapeCommonApi->Client , 'sape.get_site_pages' , $Parameters , 'Can\'t get site pages'
				);

				return( php_xmlrpc_decode( $Response->value() ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение списка ссылок.
		*
		*	@param $SiteId - Идентфикатор сайта.
		*
		*	@param $Status - Статус.
		*
		*	@return Список ссылок.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Function returns a list of links.
		*
		*	@param $SiteId - Site's id.
		*
		*	@param $Status - Status.
		*
		*	@return A list of links.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_site_links( $SiteId , $Status = false )
		{
			try
			{
				$SiteId = $this->Security->get( $SiteId , 'string' );				
				$Parameters = array( new xmlrpcval( $SiteId , 'int' ) );

				if( $Status !== false )
				{
					$Status = $this->Security->get( $Status , 'command' );
					$Parameters [] = new xmlrpcval( $Status , 'string' );
				}

				$Response = $this->SapeUtilities->call_method( 
					$this->SapeCommonApi->Client , 'sape.get_site_links' , $Parameters , 'Can\'t get site links'
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