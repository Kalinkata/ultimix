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
	*	\~russian Класс для быстрого создания контроллеров и видов.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class for rapid controllers and viewes development.
	*
	*	@author Dodonov A.A.
	*/
	class	context_1_0_0{

		/**
		*	\~russian Конфиг выполнения.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Execution config.
		*
		*	@author Dodonov A.A.
		*/
		var					$Config = false;

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
		var					$CachedMultyFS = false;
		var					$ContextUtilities = false;
		var					$CustomValidations = false;
		var					$Messages = false;
		var					$PermitAlgorithms = false;
		var					$Security = false;
		var					$SecurityValidator = false;
		var					$Settings = false;
		var					$Trace = false;
	
		/**
		*	\~russian Конструктор.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
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
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->ContextUtilities = get_package( 'gui::context::context_utilities' , 'last' , __FILE__ );
				$this->CustomValidations = get_package( 'gui::context::custom_validations' , 'last' , __FILE__ );
				$this->Messages = get_package( 'page::messages' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->SecurityValidator = get_package( 'security::security_validator' , 'last' , __FILE__ );
				$this->Trace = get_package( 'trace' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Функция загрузки конфига.
		*
		*	@param $ConfigFilePath - Имя файла конфига выполнения.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function loads config.
		*
		*	@param $ConfigFilePath - Execution config's file name.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			load_config( $ConfigFilePath )
		{
			try
			{
				$Tmp = $this->CachedMultyFS->file_get_contents( $ConfigFilePath );
				$this->load_raw_config( $Tmp );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция загрузки конфига.
		*
		*	@param $Config - Конфиг.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function loads config.
		*
		*	@param $Config - Config.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			load_raw_config( $Config )
		{
			try
			{
				if( $this->Settings === false )
				{
					$this->Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				}
				$this->Settings->load_settings( $Config );
				$this->Config = $this->Settings->get_raw_settings();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция загрузки конфига.
		*
		*	@param $Config - Конфиг.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function loads config.
		*
		*	@param $Config - Config.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			load_config_from_object( $Config )
		{
			try
			{
				$this->Config = $Config->get_raw_settings();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Проверка параметров запуска.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@return false если проверка не была пройдена.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function validates call parameters.
		*
		*	@param $Options - Execution parameters.
		*
		*	@return false if the condition was not passed.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_call_params_filter( &$Options )
		{
			try
			{
				if( $this->ContextUtilities->section_exists( $this->Config , 'call_params_filter' ) )
				{
					$Filter = $this->ContextUtilities->get_section( $this->Config ,  'call_params_filter' );
					$this->Trace->add_trace_string( "{lang:call_params_filter} : $Filter" , COMMON );
					if( $this->SecurityValidator->validate_custom_fields( $Options->get_raw_settings() , 
																						$Filter ) === false )
					{
						$this->Trace->add_trace_string( 
							"{lang:call_params_filter_not_passed} : $Filter" , COMMON
						);
						return( false );
					}
				}

				return( true );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Проверка фильтров доступов.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@return false если проверка не была пройдена.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function validates permits filters.
		*
		*	@param $Options - Execution parameters.
		*
		*	@return false if the filtration was not passed.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_permits_filter( &$Options )
		{
			try
			{
				$this->PermitAlgorithms = get_package( 'permit::permit_algorithms' , 'last' , __FILE__ );

				if( $this->ContextUtilities->section_exists( $this->Config ,  'permits_filter' ) )
				{
					$Filter = $this->ContextUtilities->get_section( $this->Config ,  'permits_filter' );
					$this->Trace->add_trace_string( "{lang:permits_filter} : $Filter" , COMMON );

					if( $this->PermitAlgorithms->object_has_all_permits( false , 'user' , $Filter ) === false )
					{
						$this->Trace->add_trace_string( "{lang:permits_filter_not_passed}" , COMMON );
						return( false );
					}
				}

				return( true );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Проверка доступов.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@return false если проверка не была пройдена.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function validates permits.
		*
		*	@param $Options - Execution parameters.
		*
		*	@return false if the validation was not passed.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_permits_validation( &$Options )
		{
			try
			{
				if( $this->ContextUtilities->section_exists( $this->Config , 'permits_validation' ) )
				{
					$Validation = $this->ContextUtilities->get_section( $this->Config ,  'permits_validation' );
					$this->Trace->add_trace_string( "{lang:permits_validation} : $Validation" , COMMON );

					if( $this->PermitAlgorithms->object_has_all_permits( false , 'user' , $Validation ) === false )
					{
						$this->ContextUtilities->process_no_permits( $Validation );
						return( false );
					}
				}

				return( true );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Кастомные проверки.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@return false если проверка не была пройдена.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Custom validations.
		*
		*	@param $Options - Execution parameters.
		*
		*	@return false if the validation was not passed.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_custom_validation( &$Options )
		{
			try
			{
				if( $this->ContextUtilities->section_exists( $this->Config , 'custom_validation' ) )
				{
					$CustomValidation = $this->ContextUtilities->get_section( $this->Config ,  'custom_validation' );

					$this->Trace->add_trace_string( "{lang:custom_validation} : $CustomValidation" , COMMON );

					if( $this->CustomValidations->custom_validation( $CustomValidation , $Options ) === false )
					{
						$TraceString = "{lang:custom_validation_not_passed} : $CustomValidation";

						$this->Trace->add_trace_string( $TraceString , COMMON );

						return( false );
					}
				}

				return( true );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Кастомные проверки провайдера.
		*
		*	@return Объект.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Provider's custom validations.
		*
		*	@return Object.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_custom_validation_object()
		{
			try
			{
				$Name = $this->ContextUtilities->get_section( 
					$this->Config ,  'custom_validation_package_name' , false
				);
				if( $Name !== false )
				{
					$Version = $this->ContextUtilities->get_section( 
						$this->Config ,  'custom_validation_package_version' , 'last'
					);

					$ValidationObject = get_package( $Name , $Version , __FILE__ );
				}
				else
				{
					$ValidationObject = $Owner;
				}

				return( $ValidationObject );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Кастомные проверки провайдера.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@return false если проверка не была пройдена.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Provider's custom validations.
		*
		*	@param $Options - Execution parameters.
		*
		*	@return false if the validation was not passed.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	process_custom_validation_func( &$Options )
		{
			try
			{
				if( $this->ContextUtilities->section_exists( $this->Config , 'custom_validation_func' ) )
				{
					$ValidationObject = $this->get_custom_validation_object();

					$Func = $this->ContextUtilities->get_section( $this->Config ,  'custom_validation_func' );

					if( call_user_func( array( $ValidationObject , $Func ) , $Options ) === false )
					{
						$TraceString = "{lang:custom_validation_func_not_passed} : $Func";

						$this->Trace->add_trace_string( $TraceString , COMMON );

						return( false );
					}
				}

				return( true );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки ошибок.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@param $Owner - Объект класса представляющего функции-обработчики.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes errors.
		*
		*	@param $Options - Execution parameters.
		*
		*	@param $Owner - Object of the class wich provides all handlers.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_error_func( &$Owner , &$Options )
		{
			try
			{
				$Func = $this->ContextUtilities->get_section( $this->Config ,  'error_func' , false );
				if( $Func === false )
				{
					$ErrMsg = $this->SecurityValidator->get_error_message();
					$ErrMsg = $ErrMsg === '' ? 'an_error_occured' : $ErrMsg;
					$this->Messages->add_error_message( $ErrMsg );
					$this->Trace->add_trace_string( "{lang:_std_error_message} : ".$ErrMsg , COMMON );
				}
				else
				{
					$FuncBody = 'return( $Owner->'.$Func.'( $Options ) );';
					$NewFunc = create_function( '$OwnerObject , $Options' , $FuncBody );
					$NewFunc( $Owner , $Options );
				}
				return( false );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция проверки кастомной функции контекста.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@param $Owner - Объект класса представляющего функции-обработчики.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function checks custom context method.
		*
		*	@param $Options - Execution parameters.
		*
		*	@param $Owner - Object of the class wich provides all handlers.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			check_success_function( &$Owner , $Func )
		{
			try
			{
				if( method_exists( $Owner , $Func ) === false )
				{
					throw( new Exception( "Method \"$Func\" was not found in class ".get_class( $Owner ) ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Очистка данных.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function cleanups fiedls.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	cleanup_fields()
		{
			try
			{
				if( $this->ContextUtilities->section_exists( $this->Config , 'cleanup_fields' ) )
				{
					$Items = explode( ',' , $this->ContextUtilities->get_section( 
						$this->Config ,  'cleanup_fields' )
					);
					foreach( $Items as $key => $value )
					{
						$this->Security->reset_p( $value , '' );
					}
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки кастомной функции контекста.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@param $Owner - Объект класса представляющего функции-обработчики.
		*
		*	@param $Func - Название функции.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes custom context method.
		*
		*	@param $Options - Execution parameters.
		*
		*	@param $Owner - Object of the class wich provides all handlers.
		*
		*	@param $Func - Function name.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_package_success_func( &$Options , &$Owner , $Func )
		{
			try
			{
				$this->check_success_function( $Owner , $Func );

				$FunctionBody = 'return( $OwnerObject->'.$Func.'( $Options ) );';
				$NewFunc = create_function( '$OwnerObject , $Options' , $FunctionBody );

				$this->Trace->add_trace_string( "{lang:calling_method} ".get_class( $Owner )."->$Func" , COMMON );

				if( $NewFunc( $Owner , $Options ) !== false )
				{
					$this->cleanup_fields();
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция запуска контроллера/вида.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@param $Owner - Объект класса представляющего функции-обработчики.
		*
		*	@return True если контроллер/вид отработал, иначе false.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function starts controller/view.
		*
		*	@param $Options - Execution parameters.
		*
		*	@param $Owner - Object of the class wich provides all handlers.
		*
		*	@return True if the contoller/view started correctly, false otherwise.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	run_success_function( &$Options , &$Owner )
		{
			try
			{
				$Func = $this->ContextUtilities->get_section( $this->Config ,  'success_func' , '_std_redirect' );

				if( $Func === '_std_redirect' )
				{
					$Url = $this->ContextUtilities->get_section( $this->Config ,  'redirect_url' , false );

					if( $Url !== false )
					{
						$FunctionBody = 'return( _std_redirect( "'.$Url.'" , $OwnerObject ) );';

						$NewFunc = create_function( '$OwnerObject' , $FunctionBody );

						$NewFunc( $Owner );
					}
				}
				else
				{
					$this->process_package_success_func( $Options , $Owner , $Func );
				}

				$this->ContextUtilities->process_success_messages( $Options );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция запуска фильтров.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@return True если контроллер/вид отработал, иначе false.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function starts filters.
		*
		*	@param $Options - Execution parameters.
		*
		*	@return True if the contoller/view started correctly, false otherwise.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	run_filters( &$Options )
		{
			try
			{
				if( $this->process_call_params_filter( $Options ) === false )
				{
					return( false );
				}

				if( $this->ContextUtilities->process_get_post_filter( $this->Config , $Options ) === false )
				{
					return( false );
				}

				if( $this->process_permits_filter( $Options ) === false )
				{
					return( false );
				}

				return( true );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция запуска контроллера/вида.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@param $Owner - Объект класса представляющего функции-обработчики.
		*
		*	@return True если контроллер/вид отработал, иначе false.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function starts controller/view.
		*
		*	@param $Options - Execution parameters.
		*
		*	@param $Owner - Object of the class wich provides all handlers.
		*
		*	@return True if the contoller/view started correctly, false otherwise.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	run_execution( &$Options , &$Owner )
		{
			try
			{
				if( $this->run_filters( $Options , $Owner ) === false || 
					$this->process_permits_validation( $Options ) === false	)
				{
					return( false );
				}

				if( $this->ContextUtilities->process_get_post_validation( $this->Config , $Options ) )
				{
					if( $this->process_custom_validation( $Options ) === false || 
						$this->process_custom_validation_func( $Options ) === false )
					{
						return( false );
					}

					$this->run_success_function( $Options , $Owner );

					return( true );
				}

				return( $this->process_error_func( $Owner , $Options ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция запуска контроллера/вида.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@param $Owner - Объект класса представляющего функции-обработчики.
		*
		*	@return True если контроллер/вид отработал, иначе false.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function starts controller/view.
		*
		*	@param $Options - Execution parameters.
		*
		*	@param $Owner - Object of the class wich provides all handlers.
		*
		*	@return True if the contoller/view started correctly, false otherwise.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			execute( &$Options , &$Owner )
		{
			try
			{
				$this->Trace->start_group( "Context::execute for class \"".get_class( $Owner )."\"" );

				if( $this->run_execution( $Options , $Owner ) === false )
				{
					$this->Trace->add_trace_string( "{lang:state_was_not_processed}" , COMMON );
					$this->Trace->end_group();
					return( false );
				}

				$this->Trace->add_trace_string( "{lang:state_was_processed}" , COMMON );
				$this->Trace->end_group();
				return( true );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>