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
	*	\~russian Класс, отвечающий за тестирование компонентов системы.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class for unit testing.
	*
	*	@author Dodonov A.A.
	*/
	class	unit_tests{

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
		var				$AdCampaignAccess = false;
		var				$DatabaseAlgorithms = false;
		var				$DefaultControllers = false;
		var				$PageComposer = false;
		var				$Security = false;
		var				$Settings = false;
		var				$Testing = false;

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
				$this->DatabaseAlgorithms = get_package( 'database::database_algorithms' );
				$this->DefaultControllers = get_package( 'gui::context_set::default_controllers' );
				$this->PageComposer = get_package_object( 'page::page_composer' );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->Testing = get_package( 'testing' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Настройка тестового стенда.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Setting up testing mashine.
		*
		*	@author Dodonov A.A.
		*/
		function			set_up()
		{
			$this->Settings->clear();
		}

		/**
		*	\~russian Возвращаем тестовый стенд в исходное положение.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function restores default settings.
		*
		*	@author Dodonov A.A.
		*/
		function			tear_down()
		{
		}

		/**
		*	\~russian Обработка некорректных макросов.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Processing illegal macro.
		*
		*	@author Dodonov A.A.
		*/
		function			test_load_package()
		{
			get_package( 'ad::ad_campaign::ad_campaign_manager' , 'last' , __FILE__ );

			return( 'TEST PASSED' );
		}

		/**
		*	\~russian Обработка некорректных макросов.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Processing illegal macro.
		*
		*	@author Dodonov A.A.
		*/
		function			test_display_list()
		{
			$PageContent = $this->PageComposer->get_page( 'ad_campaign_manager' );

			if( stripos( $PageContent , 'Ultimix Project AD campaign' ) === false )
			{
				print( 'ERROR: ad list was not displayed' );
				return;
			}

			return( 'TEST PASSED' );
		}

		/**
		*	\~russian Обработка некорректных макросов.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Processing illegal macro.
		*
		*	@author Dodonov A.A.
		*/
		function			test_create_record_form()
		{
			$this->Security->set_g( 'ad_campaign_context_action' , 'create_record_form' );

			$PageContent = $this->PageComposer->get_page( 'ad_campaign_manager' );

			if( stripos( $PageContent , 'ad_campaign_create_form' ) === false )
			{
				print( 'ERROR: ad campaign create form was not displayed'.$PageContent );
				return;
			}

			return( 'TEST PASSED' );
		}

		/**
		*	\~russian Тестирование вида.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing view.
		*
		*	@author Dodonov A.A.
		*/
		function			test_create_record()
		{
			$this->Security->set_g( 'title' , 'test_title' );

			$Controller = get_package( 'ad::ad_campaign::ad_campaign_manager' , 'last' , __FILE__ );

			$this->Testing->setup_controller( $this->Settings , 'ad_campaign' );

			$Controller->controller( $this->Settings );

			if( $this->DatabaseAlgorithms->record_exists( 'umx_ad_campaign' , 'title LIKE "test_title"' ) )
			{
				$this->AdCampaignAccess->delete( $this->DefaultControllers->id );
				return( 'TEST PASSED' );
			}
			else
			{
				return( 'ERROR' );
			}
		}
	}

?>