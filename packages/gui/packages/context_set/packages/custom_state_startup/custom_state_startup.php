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
	*	\~russian Класс для запуска стейтов.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class runs states.
	*
	*	@author Dodonov A.A.
	*/
	class	custom_state_startup_1_0_0{
	
		/**
		*	\~russian Закешированные пакеты.
		*
		*	@author Dodonov A.A.
		*/
		/**
		*	\~english Cached packages.
		*
		*	@author Dodonov A.A.
		*/
		var					$Cache = false;
		var					$DefaultControllers = false;
		var					$DefaultViews = false;
		var					$Security = false;
		var					$Utilities = false;

		/**
		*	\~russian Конструктор.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
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
				$this->Cache = get_package( 'cache' , 'last' , __FILE__ );
				$this->DefaultControllers = get_package( 'gui::context_set::default_controllers' , 'last' , __FILE__ );
				$this->DefaultViews = get_package( 'gui::context_set::default_views' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->Utilities = get_package( 'utilities' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Обработка нестандартных конфигов.
		*
		*	@param $ContextSet - Набор контекстов.
		*
		*	@param $Config - Конфиг.
		*
		*	@param $CustomSettings - Параметры выполнения.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@return true/false
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method starts controller/view.
		*
		*	@param $ContextSet - Contexts.
		*
		*	@param $Config - Config.
		*
		*	@param $CustomSettings - Execution parameters.
		*
		*	@param $Options - Execution parameters.
		*
		*	@return true/false
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	run_multy_call( &$ContextSet , $Config , &$CustomSettings , &$Options )
		{
			try
			{
				$ContextSet->Context->load_raw_config( $Config );

				$this->DefaultControllers->set_constants( $ContextSet , $Options );
				if( $ContextSet->run_execution( $CustomSettings , $this->DefaultControllers , 1 ) )
				{
					$ContextSet->clear();
					return( true );
				}
				
				return( false );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Обработка нестандартных конфигов.
		*
		*	@param $ContextSet - Набор контекстов.
		*
		*	@param $Config - Конфиг.
		*
		*	@param $CustomSettings - Параметры выполнения.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@return true/false
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method starts controller/view.
		*
		*	@param $ContextSet - Contexts.
		*
		*	@param $Config - Config.
		*
		*	@param $CustomSettings - Execution parameters.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@return true/false
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	run_simple_form( &$ContextSet , $Config , &$CustomSettings , &$Options )
		{
			try
			{
				$FileName = $CustomSettings->get_setting( 'form_template' );
				if( $this->Cache->data_exists( $FileName ) )
				{
					$this->DefaultViews->Provider->Output = $this->Cache->get_data( $FileName );
					return( true );
				}

				$ContextSet->Context->load_raw_config( $Config );

				$this->DefaultViews->set_constants( $ContextSet , $Options );
				if( $ContextSet->run_execution( $CustomSettings , $this->DefaultViews , 0 ) )
				{
					$this->Cache->add_data( $FileName , $this->DefaultViews->Provider->Output );
					$ContextSet->clear();
					return( true );
				}

				return( false );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Обработка нестандартных конфигов.
		*
		*	@param $ContextSet - Набор контекстов.
		*
		*	@param $Config - Конфиг.
		*
		*	@param $CustomSettings - Параметры выполнения.
		*
		*	@return true/false
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method starts controller/view.
		*
		*	@param $ContextSet - Contexts.
		*
		*	@param $Config - Config.
		*
		*	@param $CustomSettings - Execution parameters.
		*
		*	@return true/false
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	run_list_view( &$ContextSet , $Config , &$CustomSettings )
		{
			try
			{
				global			$SkipCallParamsValidation;
				if( $SkipCallParamsValidation )
				{
					$CustomSettings->remove_setting( 'call_params_filter' );
				}

				$ContextSet->Context->load_config_from_object( $CustomSettings );

				$this->DefaultViews->set_constants( $ContextSet , $Options );
				if( $ContextSet->Context->execute( $CustomSettings , $this->DefaultViews ) )
				{
					$ContextSet->clear();
					return( true );
				}

				return( false );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Обработка нестандартных конфигов.
		*
		*	@param $ContextSet - Контексты.
		*
		*	@param $Config - Конфиг.
		*
		*	@param $CustomSettings - Параметры выполнения.
		*
		*	@return true/false
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method starts controller/view.
		*
		*	@param $ContextSet - Contexts.
		*
		*	@param $Config - Config.
		*
		*	@param $CustomSettings - Execution parameters.
		*
		*	@return true/false
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	run_custom_config( &$ContextSet , $Config , &$CustomSettings )
		{
			try
			{
				$OldProvider = $ContextSet->Provider;

				if( $CustomSettings->get_setting( 'provider_package_name' , false ) !== false )
				{
					$ContextSet->Provider = $this->Utilities->get_package( $CustomSettings , __FILE__ , 'provider_' );
				}

				$ContextSet->Context->load_raw_config( $Config );

				if( $ContextSet->run_execution( $CustomSettings , $ContextSet->Provider ) )
				{
					$OldProvider->Output = $ContextSet->Provider->Output;
					$ContextSet->clear();
					return( true );
				}

				return( false );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Обработка нестандартных конфигов.
		*
		*	@param $ContextSet - Контексты.
		*
		*	@param $Config - Конфиг.
		*
		*	@param $Settings - Параметры выполнения.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@return true/false
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method starts controller/view.
		*
		*	@param $ContextSet - Contexts.
		*
		*	@param $Config - Config.
		*
		*	@param $Settings - Execution parameters.
		*
		*	@param $Options - Execution parameters.
		*
		*	@return true/false
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			run_config_processors( &$ContextSet , $Config , &$Settings , &$Options )
		{
			try
			{
				switch( $Settings->get_setting( 'success_func' , false ) )
				{
					case( 'multy_call' ):
						$Res = $this->run_multy_call( $ContextSet , $Config , $Settings , $Options );
					break;
					case( 'simple_form' ):
						$Res = $this->run_simple_form( $ContextSet , $Config , $Settings , $Options );
					break;
					case( 'list_view' ):
						$Res = $this->run_list_view( $ContextSet , $Config , $Settings );
					break;
					default:
						$Res = $this->run_custom_config( $ContextSet , $Config , $Settings );
					break;
				}
				return( $Res );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>