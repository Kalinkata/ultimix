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
	*	\~russian Класс для работы с записями.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides records access routine.
	*
	*	@author Dodonov A.A.
	*/
	class	subscription_algorithms_1_0_0{

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
		var					$Link = false;
		var					$Security = false;
		var					$SecurityParser = false;
		var					$String = false;
		var					$UserAlgorithms = false;

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
				$this->AutoMarkup = get_package( 'page::auto_markup' , 'last' , __FILE__ );
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->Link = get_package( 'link' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->SecurityParser = get_package( 'security::security_parser' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
				$this->SubscriptionAccess = get_package( 'subscription::subscription_access' , 'last' , __FILE__ );
				$this->UserAlgorithms = get_package( 'user::user_algorithms' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение рассылок для пользователя.
		*
		*	@param $User - Пользователь.
		*
		*	@param $Subscription - Подписка.
		*
		*	@return HTML код.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function unsubscribes user.
		*
		*	@param $User - User object.
		*
		*	@param $Subscription - Subscription object.
		*
		*	@return HTML code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_subscription( $User , $Subscription )
		{
			try
			{
				$Code = $this->CachedMultyFS->get_template( 
					__FILE__ , get_field( $Subscription , 'email_template' ).'.tpl'
				);

				$User = set_field( $User , 'user_id' , get_field( $User , 'id' ) );
				$Code = $this->String->print_record( $Code , $User );

				$Subscription = set_field( $Subscription , 'subscription_id' , get_field( $Subscription , 'id' ) );
				$Code = $this->String->print_record( $Code , $Subscription );

				$Code = $this->AutoMarkup->compile_string( $Code );

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Посчитать хэш отписки.
		*
		*	@param $User - Пользователь.
		*
		*	@param $SubscriptionId - Подписка.
		*
		*	@return Хэш или false.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function calculates unsibscribe hash.
		*
		*	@param $UserId - User id.
		*
		*	@param $SubscriptionId - Subscription id.
		*
		*	@return Unsibscribe hash or false.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			calculate_hash( $UserId , $SubscriptionId )
		{
			try
			{
				$UserId = $this->Security->get( $UserId , 'integer' );
				$SubscriptionId = $this->Security->get( $SubscriptionId , 'integer' );

				$Link = $this->Link->get_links( $UserId , $SubscriptionId , 'user' , 'subscription' );

				if( isset( $Link[ 0 ] ) )
				{
					$LinkId = get_field( $Link[ 0 ] , 'id' );
					return( md5( "$UserId.$LinkId" ) );
				}

				return( false );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Отписать пользователя от рассылки.
		*
		*	@param $UserId - Список идентификаторов пользователей, разделённых запятыми.
		*
		*	@param $Hash - Хэш.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function unsubscribes user.
		*
		*	@param $UserId - Comma separated list of users's id.
		*
		*	@param $Hash - Unsibscribe hash.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			unsubscribe_user( $UserId , $Hash )
		{
			try
			{
				$UserId = $this->Security->get( $UserId , 'integer' );
				$Hash = $this->Security->get( $Hash , 'string' );

				$Subscriptions = $this->SubscriptionAccess->get_subscriptions_for_user( $UserId );

				foreach( $Subscriptions as $i => $Subscription )
				{
					$SubscriptionId = get_field( $Subscription , 'id' );

					if( $this->calculate_hash( $UserId , $SubscriptionId ) == $Hash )
					{
						$this->SubscriptionAccess->unsubscribe_user( $UserId , $SubscriptionId );
						return;
					}
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Подписан ли пользователь.
		*
		*	@param $UserId - Список идентификаторов пользователей, разделённых запятыми.
		*
		*	@param $SubscriptionId - Список идентификаторов подписок, разделённых запятыми.
		*
		*	@return true/false.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Is user subscribed.
		*
		*	@param $UserId - Comma separated list of users's id.
		*
		*	@param $SubscriptionId - Comma separated list of record's id.
		*
		*	@return true/false.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			is_subscribed( $UserId , $SubscriptionId )
		{
			try
			{
				$UserId = $this->Security->get( $UserId , 'integer' );
				$SubscriptionId = $this->Security->get( $SubscriptionId , 'integer' );

				$Links = $this->Link->get_links( $UserId , $SubscriptionId , 'user' , 'subscription' );

				return( isset( $Links[ 0 ] ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция возвращает подписки по идентификатору.
		*
		*	@param $id - Идентфиикатор искомой подписки.
		*
		*	@return Подписка.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns subscription by it's id.
		*
		*	@param $id - Id of the searching subscription.
		*
		*	@return Subscription.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_by_id( $id )
		{
			try
			{
				$id = $this->Security->get( $id , 'integer' );

				$Subscriptions = $this->SubscriptionAccess->unsafe_select( 
					$this->SubscriptionAccess->NativeTable.".id = $id"
				);

				if( count( $Subscriptions ) === 0 || count( $Subscriptions ) > 1 )
				{
					throw( new Exception( 'Subscription with id '.$id.' was not found' ) );
				}
				else
				{
					return( $Subscriptions[ 0 ] );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение параметров рассылки.
		*
		*	@param $Subscription - Рассылка.
		*
		*	@param $From - Email отправителя.
		*
		*	@param $Sender - Имя отправителя.
		*
		*	@return array( $From , $Subject , $Sender ).
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns subscrition parameters.
		*
		*	@param $Subscription - Subscription.
		*
		*	@param $From - Sender's email.
		*
		*	@param $Sender - Sender's name.
		*
		*	@return array( $From , $Subject , $Sender ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_subscription_parameters( $Subscription , $From , $Sender )
		{
			try
			{
				$Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$Settings->load_package_settings( 
					'subscription::subscription_algorithms' , 'last' , 
					'cf_'.get_field( $Subscription , 'email_template' )
				);
				$From = $Settings->get_setting( 'email' , $From );
				$Subject = $Settings->get_setting( 'subject' , 'Subscription' );
				$Sender = $Settings->get_setting( 'email_sender' , $Sender );
				
				return( array( $From , $Subject , $Sender ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение параметров рассылки.
		*
		*	@param $Subscription - Рассылка.
		*
		*	@return array( $From , $Subject , $Sender ).
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns subscrition parameters.
		*
		*	@param $Subscription - Subscription.
		*
		*	@return array( $From , $Subject , $Sender ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_email_parameters( $Subscription )
		{
			try
			{
				$SiteSettings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$SiteSettings->load_package_settings( 'page::page_composer' , 'last' , 'cf_site' );
				$Sender = $SiteSettings->get_setting( 'email_sender' , 'System' );
				$From = $SiteSettings->get_setting( 'system_email' , 'ultimix@localhost' );
				
				return( $this->get_subscription_parameters( $Subscription , $From , $Sender ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Отправить рассылку.
		*
		*	@param $EmailAddress - Получатель.
		*
		*	@param $Message - Сообщение.
		*
		*	@param $Subscription - Рассылка.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sends subscription if necessary.
		*
		*	@param $EmailAddress - Recipient.
		*
		*	@param $Message - Message.
		*
		*	@param $Subscription - Subscription.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	send_email( $EmailAddress , $Message , $Subscription )
		{
			try
			{
				$Email = get_package( 'mail' , 'last' , __FILE__ );
				
				list( $From , $Subject , $Sender ) = $this->get_email_parameters( $Subscription );
				
				$Email->send_email( $From , $EmailAddress , $Subject , $Message , $Sender );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Отправить рассылку.
		*
		*	@param $UserId - Список идентификаторов пользователей, разделённых запятыми.
		*
		*	@param $SubscriptionId - Список идентификаторов подписок, разделённых запятыми.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sends subscription if necessary.
		*
		*	@param $UserId - Comma separated list of users's id.
		*
		*	@param $SubscriptionId - Comma separated list of record's id.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			send_subscription_for_user( $UserId , $SubscriptionId )
		{
			try
			{
				$UserId = $this->Security->get( $UserId , 'integer' );
				$SubscriptionId = $this->Security->get( $SubscriptionId , 'integer' );

				if( $this->is_subscribed( $UserId , $SubscriptionId ) )
				{
					$User = $this->UserAlgorithms->get_by_id( $UserId );
					$Subscription = $this->get_by_id( $SubscriptionId );

					$Message = $this->compile_subscription( $User , $Subscription );

					$this->send_email( get_field( $User , 'email' ) , $Message , $Subscription );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
?>