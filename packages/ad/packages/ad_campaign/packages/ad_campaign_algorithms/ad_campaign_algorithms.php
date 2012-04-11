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
	class	ad_campaign_algorithms_1_0_0{
		
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
		var					$AdCampaignAccess = false;
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
				$this->AdCampaignAccess = get_package( 'ad::ad_campaign::ad_campaign_access' , 'last' , __FILE__ );
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
		*	@param $uid - идентификатор лица создавшего рекламные компании.
		*
		*	@return Массив объектов.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Selecting records.
		*
		*	@param $uid - id of the user who has created the company.
		*
		*	@return Array of objects.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			select_for_creator( $uid )
		{
			try
			{
				$uid = $this->Security->get( $uid , 'integer' );

				return( $this->AdCampaignAccess->unsafe_select( "creator = $uid" ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>