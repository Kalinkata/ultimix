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
	class	ad_banner_view_1_0_0{
		
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
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция предгенерационных действий.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function executes before any page generating actions took place.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			pre_generation( $Options )
		{
			try
			{
				$this->PageCSS->add_stylesheet( 
					'{http_host}/'._get_package_relative_path_ex( 
						'ad::ad_banner::ad_banner_view' , '1.0.0' 
					).'/res/css/ad_banner_view.css' , 
					true 
				);

				$Lang = get_package( 'lang' , 'last' , __FILE__ );
				$Lang->include_strings_js( 'ad::ad_banner::ad_banner_view' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция полчения кампаний и баннеров.
		*
		*	@return Кампании и баннеры.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns campaigns and banners.
		*
		*	@return Campaigns and banners.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_campaigns_and_banners()
		{
			try
			{
				$Campaigns = $this->AdCampaignAccess->unsafe_select( 
					'archived = 0 AND creator = '.$this->UserAlgorithms->get_id()
				);

				if( count( $Campaigns ) == 0 )
				{
					$Campaigns = array( array( 'id' => -1 ) );
				}
				$Banners = $this->AdBannerAccess->unsafe_select( 
					'archived = 0 AND campaign_id IN ( '.implode_ex( ',' , $Campaigns , 'id' ).' )'
				);

				return( array( $Campaigns , $Banners ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Компиляция списка баннеров.
		*
		*	@param $CampaignId - Идентификатор кампании.
		*
		*	@param $Code - Список.
		*
		*	@param $Banners - Баннеры.
		*
		*	@return HTML код компонента.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles banners list.
		*
		*	@param $CampaignId - Campaign's id.
		*
		*	@param $Code - Campaign's list.
		*
		*	@param $Banners - Banners.
		*
		*	@return HTML code of the компонента.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_banners_for_campaign( $CampaignId , $Code , $Banners )
		{
			try
			{
				foreach( $Banners as $j => $b )
				{
					if( $CampaignId == $b->campaign_id )
					{
						$BannerTemplate = $this->CachedMultyFS->get_template( __FILE__ , 'banner.tpl' );
						$BannerTemplate = $this->String->print_record( $BannerTemplate , $b );
						$Code = str_replace( 
							'{banners}' , $BannerTemplate.'{banners}' , $Code
						);
					}
				}

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция отрисовки компонента.
		*
		*	@param $Options - Настройки работы модуля.
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

				foreach( $Campaigns as $i => $c )
				{
					$Code = $this->CachedMultyFS->get_template( __FILE__ , 'campaign.tpl' );
					$Code = $this->String->print_record( $Code , $c );
					$Code = str_replace( '{i}' , $i , $Code );

					$this->Output .= $this->compile_banners_for_campaign( $c->id , $Code , $Banners );
				}

				$CampaignListTemplate = $this->CachedMultyFS->get_template( __FILE__ , 'campaign_list.tpl' );

				$this->Output = str_replace( '{output}' , $this->Output , $CampaignListTemplate );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отрисовки компонента.
		*
		*	@param $Options - Настройки работы модуля.
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

				$ContextSet->add_context( dirname( __FILE__ ).'/conf/cfcx_ad_banner_view_common_view' );

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