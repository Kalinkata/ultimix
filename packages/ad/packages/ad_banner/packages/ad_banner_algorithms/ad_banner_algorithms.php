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
	*	\~russian Класс для работы с рекламными сообщениями.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides routine for ad banners.
	*
	*	@author Dodonov A.A.
	*/
	class	ad_banner_algorithms_1_0_0{
		
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
		var					$AdBannerAccess = false;
		var					$Database = false;
		var					$DatabaseAlgorithms = false;
		var					$Security = false;
		
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
				$this->AdBannerAccess = get_package( 'ad::ad_banner::ad_banner_access' , 'last' , __FILE__ );
				$this->Database = get_package( 'database' , 'last' , __FILE__ );
				$this->DatabaseAlgorithms = get_package( 'database::database_algorithms' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка записей.
		*
		*	@param $cid - Идентификатор рекламной кампании.
		*
		*	@return Массив объектов.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Selecting records.
		*
		*	@param $cid - id campaign.
		*
		*	@return Array of objects.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			select_for_campaign( $cid )
		{
			try
			{
				$cid = $this->Security->get( $cid , 'integer_list' );

				return( $this->AdBannerAccess->unsafe_select( "campaign_id IN ( $cid )" ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка записей.
		*
		*	@param $uid - Идентификатор создателя.
		*
		*	@param $AddCondition - Ограничение выборки записей.
		*
		*	@param $Limitation - Ограничение выборки записей.
		*
		*	@return Массив объектов.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Selecting records.
		*
		*	@param $uid - id of the creator.
		*
		*	@param $AddCondition - Query limitations.
		*
		*	@param $Limitation - Query limitations.
		*
		*	@return Array of objects.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	fetch_records( $uid , $AddCondition , $Limitation )
		{
			try
			{
				return( 
					$this->Database->select( 
						'umx_ad_banner.id , umx_ad_banner.direct_banner_id' , 'umx_ad_campaign , umx_ad_banner' , 
						"umx_ad_campaign.creator = $uid AND umx_ad_campaign.id = ".
						"umx_ad_banner.campaign_id$AddCondition".$Limitation
					)
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка записей.
		*
		*	@param $uid - Идентификатор создателя.
		*
		*	@param $Start - Ограничение выборки записей.
		*
		*	@param $Limit - Ограничение выборки записей.
		*
		*	@param $CampaignId - Идентификатор кампании.
		*
		*	@return Массив объектов.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Selecting records.
		*
		*	@param $uid - id of the creator.
		*
		*	@param $Start - Query limitations.
		*
		*	@param $Limit - Query limitations.
		*
		*	@param $CampaignId - Campaign's id.
		*
		*	@return Array of objects.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			select_for_creator( $uid , $Start = false , $Limit = false , $CampaignId = false )
		{
			try
			{
				$uid = $this->Security->get( $uid , 'integer_list' );
				$Limitation = '';
				
				if( $Start !== false && $Limit !== false )
				{
					$Start = $this->Security->get( $Start , 'integer' );
					$Limit = $this->Security->get( $Limit , 'integer' );
					$Limitation = " LIMIT $Start , $Limit";
				}
				
				$AddCondition = '';
				
				if( $CampaignId !== false )
				{
					$AddCondition = " AND umx_ad_campaign.id = ".$this->Security->get( $CampaignId , 'integer' );
				}
				
				return( $this->fetch_records( $uid , $AddCondition , $Limitation ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>