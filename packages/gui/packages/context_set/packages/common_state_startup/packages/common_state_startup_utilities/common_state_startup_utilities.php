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
	*	\~russian Класс для быстрого создания кнопок.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class for rapid buttons creation.
	*
	*	@author Dodonov A.A.
	*/
	class	common_state_startup_utilities_1_0_0{

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
		var					$ContextSetConfigs = false;
		var					$DefaultControllers = false;
		var					$DefaultViews = false;
		var					$LocalOptions = false;
		var					$Security = false;
		var					$Trace = false;

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
				$this->ContextSetConfigs = get_package( 'gui::context_set::context_set_configs' , 'last' , __FILE__ );
				$this->DefaultControllers = get_package( 'gui::context_set::default_controllers' , 'last' , __FILE__ );
				$this->DefaultViews = get_package( 'gui::context_set::default_views' , 'last' , __FILE__ );
				$this->LocalOptions = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->Trace = get_package( 'trace' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция получения конфига стейта.
		*
		*	@param $ContextSet - Набор контекстов.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@param $StateName - Имя стейта.
		*
		*	@param $Suffix - Суффикс.
		*
		*	@return Конфиг стейта.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function loads common state's config.
		*
		*	@param $ContextSet - Set of contexts.
		*
		*	@param $Options - Execution parameters.
		*
		*	@param $StateName - State's name.
		*
		*	@param $Suffix - Suffix.
		*
		*	@return State's config.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_common_state_config( &$ContextSet , $Options , $StateName , $Suffix = '' )
		{
			try
			{
				$FieldName = 'common_state_config_'.$StateName.$Suffix;
				$FileName = 'cfcxs_'.$StateName.'_'.$ContextSet->Prefix.$Suffix;

				return( 
					$this->ContextSetConfigs->get_common_state_config( 
						$ContextSet->ContextSetSettings , $FieldName , $FileName , $Options->get_setting( 'file_path' )
					)
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция трассировки.
		*
		*	@param $Prefix - Префикс.
		*
		*	@param $FieldSuffix - Суффикс поля.
		*
		*	@param $RequiredValue - Необходимое значение.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Trace function.
		*
		*	@param $Prefix - Prefix.
		*
		*	@param $FieldSuffix - Field name suffix.
		*
		*	@param $RequiredValue - Required value.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	trace_field( $Prefix , $FieldSuffix , $RequiredValue )
		{
			try
			{
				$Field = $Prefix.'_'.$FieldSuffix;

				$PostedValue = $this->Security->get_gp( $Field , 'command' , 'not set' );

				$Message = $Prefix.'_'.$FieldSuffix.': "'.$PostedValue.'"';

				$this->Trace->add_trace_string( $Message );

				$this->Trace->add_trace_string( "required_".$FieldSuffix." : \"$RequiredValue\"" );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция трассировки.
		*
		*	@param $StateName - Название стейта.
		*
		*	@param $Prefix - Префикс.
		*
		*	@param $ContextAction - Действие контекста.
		*
		*	@param $Direct - Прямой вызов.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Trace function.
		*
		*	@param $StateName - State name.
		*
		*	@param $Prefix - Prefix.
		*
		*	@param $ContextAction - Context action.
		*
		*	@param $Direct - Direct call.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			trace_no_need_to_run_state_message( $StateName , $Prefix , $ContextAction , $Direct )
		{
			try
			{
				$this->Trace->add_trace_string( '{lang:no_need_to_run_trace_message}' , COMMON );

				if( $Direct == 0 )
				{
					$this->Trace->add_trace_string( 'direct_call_is_not_allowed' );
				}

				if( strpos( $ContextAction , '_form' ) !== false )
				{
					$this->trace_field( $Prefix , 'context_action' , $ContextAction );
				}

				if( strpos( $ContextAction , '_form' ) === false )
				{
					$this->trace_field( $Prefix , 'action' , $ContextAction );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция трассировки.
		*
		*	@param $StateName - Название стейта.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Trace function.
		*
		*	@param $StateName - State's name.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			trace_config_was_not_found_message( $StateName )
		{
			try
			{
				$this->Trace->add_trace_string( "State config was not found ( $StateName )" );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Подготовить конфиг.
		*
		*	@param $ContextSet - Набор контекстов.
		*
		*	@param $Config - Конфиг стейта.
		*
		*	@param $StateName - Название стейта.
		*
		*	@return Конфиг.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function prepares.
		*
		*	@param $ContextSet - Set of contexts.
		*
		*	@param $Config - State's config.
		*
		*	@param $StateName - State's name.
		*
		*	@return Config.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			prepare_config( &$ContextSet , $Config , $StateName )
		{
			try
			{
				if( strpos( $Config , 'success_message=' ) === false )
				{
					$Config .= "\r\nsuccess_message=".$ContextSet->Prefix.'_'.$StateName.'_was_completed';
				}
				if( strpos( $Config , 'cleanup_fields=' ) === false )
				{
					$Config .= "\r\ncleanup_fields=".$ContextSet->Prefix."_action,".
							   $ContextSet->Prefix."_context_action";
				}
				if( strpos( $Config , 'success_func=' ) === false )
				{
					$Config .= "\r\nsuccess_func=$StateName";
				}

				return( $Config );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Заполнение настроек.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@param $StateName - Имя стейта.
		*
		*	@param $Config - Конфиг стейта.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sets settings.
		*
		*	@param $Options - Execution parameters.
		*
		*	@param $StateName - State's name.
		*
		*	@param $Config - State's config.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	set_undefined_options( $Options , $StateName , $Config )
		{
			try
			{
				$this->LocalOptions->clear();
				$this->LocalOptions->append_settings( $Config );
				$this->LocalOptions->add_settings_from_object( $Options );
				$this->LocalOptions->set_undefined( 'access_package_version' , 'last' );
				if( $StateName == 'import' )
				{
					$this->LocalOptions->set_undefined( $StateName.'_func' , 'import' );
				}
				else
				{
					$this->LocalOptions->set_undefined( 
						$StateName.'_func' , $StateName == 'copy' ? 'create' : $StateName
					);
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция запускает стейт-вида.
		*
		*	@param $ContextSet - Набор контекстов.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@param $StateName - Имя стейта.
		*
		*	@param $Config - Конфиг стейта.
		*
		*	@return true если стейт был выполнен.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function runs state-controller.
		*
		*	@param $ContextSet - Set of contexts.
		*
		*	@param $Options - Execution parameters.
		*
		*	@param $StateName - State's name.
		*
		*	@param $Config - State's config.
		*
		*	@return true if the state was executed.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			run_controller_state( &$ContextSet , $Options , $StateName , $Config )
		{
			try
			{
				$Config = $this->prepare_config( $ContextSet , $Config , $StateName );

				$this->set_undefined_options( $Options , $StateName , $Config );

				$ContextSet->Context->load_raw_config( $Config );

				if( $ContextSet->run_execution( $this->LocalOptions , $this->DefaultControllers , 1 ) )
				{
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
		*	\~russian Подготовка опций запуска.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@param $StateName - Имя стейта.
		*
		*	@param $Config - Конфиг стейта.
		*
		*	@return Конфиг стейта.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function prepares run options.
		*
		*	@param $Options - Execution parameters.
		*
		*	@param $StateName - State's name.
		*
		*	@param $Config - State's config.
		*
		*	@return State's config.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			prepare_options( &$Options , $StateName , $Config )
		{
			try
			{
				$this->LocalOptions->clear();
				$this->LocalOptions->append_settings( $Config );				
				$this->LocalOptions->add_settings_from_object( $Options );
				$this->LocalOptions->set_undefined( 'access_package_version' , 'last' );

				if( strpos( $Config , 'success_func' ) === false )
				{
					$Suffix = $StateName == 'export' ? '' : '_form';
					$Config .= "\r\nsuccess_func=".$StateName.$Suffix;
					$this->LocalOptions->set_undefined( 'success_func' , $StateName.$Suffix );
				}

				return( $Config );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция запускает стейт-вида.
		*
		*	@param $ContextSet - Набор контекстов.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@param $StateName - Имя стейта.
		*
		*	@param $Config - Конфиг стейта.
		*
		*	@return true если стейт был выполнен.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function runs state-view.
		*
		*	@param $ContextSet - Set of contexts.
		*
		*	@param $Options - Execution parameters.
		*
		*	@param $StateName - State's name.
		*
		*	@param $Config - State's config.
		*
		*	@return true if the state was executed.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			run_view_state( &$ContextSet , &$Options , $StateName , $Config )
		{
			try
			{
				$this->Trace->add_trace_string( '{lang:run_view_state}' , COMMON );

				$Config = $this->prepare_options( $Options , $StateName , $Config );

				$ContextSet->Context->load_raw_config( $Config );

				if( $ContextSet->Context->execute( $this->LocalOptions , $this->DefaultViews ) )
				{
					$this->Trace->add_trace_string( '{lang:run_view_state_true}' , COMMON );
					return( true );
				}

				$this->Trace->add_trace_string( '{lang:run_view_state_false}' , COMMON );
				return( false );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция обработки стейта-контроллера.
		*
		*	@param $ContextSet - Набор контекстов.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@param $StateName - Имя стейта.
		*
		*	@return true если стейт был обработан.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes state-controller.
		*
		*	@param $ContextSet - Set of contexts.
		*
		*	@param $Options - Execution parameters.
		*
		*	@param $StateName - State's name.
		*
		*	@return true if the state was processed.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			try_run_controller_state( &$ContextSet , $Options , $StateName )
		{
			try
			{
				$Config = $this->get_common_state_config( $ContextSet , $Options , $StateName );

				if( $Config !== false )
				{
					return( $this->run_controller_state( $ContextSet , $Options , $StateName , $Config ) );
				}
				else
				{
					$this->trace_config_was_not_found_message( $StateName );
				}

				return( false );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция обработки стейта-вида.
		*
		*	@param $ContextSet - Набор контекстов.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@param $StateName - Имя стейта.
		*
		*	@return true если стейт был обработан.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes state-view.
		*
		*	@param $ContextSet - Set of contexts.
		*
		*	@param $Options - Execution parameters.
		*
		*	@param $StateName - State's name.
		*
		*	@return true if the state was processed.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			try_run_view_state( &$ContextSet , &$Options , $StateName )
		{
			try
			{
				$Config = $this->get_common_state_config( 
					$ContextSet , $Options , $StateName , $StateName == 'export' ? '' : '_form'
				);

				if( $Config !== false )
				{
					return( $this->run_view_state( $ContextSet , $Options , $StateName , $Config ) );
				}
				else
				{
					$this->trace_config_was_not_found_message( $StateName );
				}

				return( false );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>