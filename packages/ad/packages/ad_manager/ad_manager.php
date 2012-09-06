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
	*	\~russian Класс для управления отображением компонента.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english This class provides component visualisation routine.
	*
	*	@author Dodonov A.A.
	*/
	class	ad_manager_1_0_0{

		/**
		*	\~russian Результат работы функций отображения.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Display function's result.
		*
		*	@author Dodonov A.A.
		*/
		var					$Output;

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
		var					$CachedMultyFS = false;
		var					$String = false;

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
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );

				$PageCSS = get_package( 'page::page_css' , 'last' , __FILE__ );
				$Path = _get_package_relative_path_ex( 'ad::ad_manager' , 'last' );
				$PageCSS->add_stylesheet( "{http_host}/$Path/res/css/ad_manager.css" );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция получения кампаний и баннеров.
		*
		*	@return array( $Campaigns , $Banners ).
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function campaigns and banners.
		*
		*	@return array( $Campaigns , $Banners ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_campaigns_and_banners()
		{
			try
			{
				$UserAlgorithms = get_package( 'user::user_algorithms' , 'last' , __FILE__ );
				$AdCampaignAccess = get_package( 'ad::ad_campaign_access' , 'last' , __FILE__ );
				$AdBannerAccess = get_package( 'ad::ad_banner_access' , 'last' , __FILE__ );

				$id = $UserAlgorithms->get_id();
				$Campaigns = $AdCampaignAccess->unsafe_select( "archived = 0 AND creator = $id" );

				$ids = implode_ex( ',' , $Campaigns , 'id' );
				$Banners = $AdBannerAccess->unsafe_select( "archived = 0 AND campaign_id IN ( $ids )" );

				return( array( $Campaigns , $Banners ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция обработки одной кампании.
		*
		*	@param $Campaign - Кампания.
		*
		*	@param $Banners - Баннеры.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes one campaign.
		*
		*	@param $Campaign - Campaign.
		*
		*	@param $Banners - Banners.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_campaign( $Campaign , &$Banners )
		{
			try
			{
				$CompanyTemplate = $this->CachedMultyFS->get_template( __FILE__ , 'campaign.tpl' );
				$CompanyTemplate = $this->String->print_record( $CompanyTemplate , $Campaign );

				foreach( $Banners as $j => $Banner )
				{
					if( $Campaign->id == $Banner->campaign_id )
					{
						$Template2 = $this->CachedMultyFS->get_template( __FILE__ , 'banner.tpl' );
						$Template2 = $this->String->print_record( $Template2 , $Banner );
						$CompanyTemplate = str_replace( '{banners}' , $Template2.'{banners}' , $CompanyTemplate );
					}
				}

				$this->Output .= $CompanyTemplate;
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция отрисовки компонента.
		*
		*	@param $Options - настройки работы модуля.
		*
		*	@return HTML код компонента.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws component.
		*
		*	@param $Options - Settings.
		*
		*	@return HTML code of the компонента.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			common_view( $Options )
		{
			try
			{
				list( $Campaigns , $Banners ) = $this->get_campaigns_and_banners();

				foreach( $Campaigns as $i => $Campaign )
				{
					$this->compile_campaign( $Campaign , $Banners );
				}

				$Template = $this->CachedMultyFS->get_template( __FILE__ , 'campaigns_list.tpl' );

				$this->Output = str_replace( '{output}' , $this->Output , $Template );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция управления компонентом.
		*
		*	@param $Options - настройки работы модуля.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function controls component.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			controller( $Options )
		{
			try
			{
				$ContextSet = get_package_object( 'gui::context_set' , 'last' , __FILE__ );

				$ContextSet->execute( $Options , $this , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция отрисовки компонента.
		*
		*	@param $Options - настройки работы модуля.
		*
		*	@return HTML код компонента.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws component.
		*
		*	@param $Options - Settings.
		*
		*	@return HTML code of the компонента.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			view( $Options )
		{
			try
			{
				$ContextSet = get_package_object( 'gui::context_set' , 'last' , __FILE__ );

				$ContextSet->add_context( dirname( __FILE__ ).'/conf/cfcx_ad_manager_common_view' );

				$ContextSet->execute( $Options , $this , __FILE__ );

				return( $this->Output );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>