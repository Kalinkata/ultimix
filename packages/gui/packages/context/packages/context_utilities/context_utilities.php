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
	class	context_utilities_1_0_0{

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
		var					$Messages = false;
		var					$Security = false;
		var					$SecurityValidator = false;
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
		*	\~russian Функция возвращает секцию конфига по её имени.
		*
		*	@param $Config - Конфиг.
		*
		*	@param $SectionName - Название секции.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns config section by it's name.
		*
		*	@param $Config - Config.
		*
		*	@param $SectionName - Section's name.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_section( &$Config , $SectionName , $Default = '_throw_exception' )
		{
			try
			{
				if( isset( $Config[ $SectionName ] ) )
				{
					return( $Config[ $SectionName ] );
				}
				else
				{
					if( $Default == '_throw_exception' )
					{
						throw( 
							new Exception( 
								"Section \"$SectionName\" was not found in config ".wordwrap( serialize( $Config ) )
							)
						);
					}
					return( $Default );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция проверяет существование секции.
		*
		*	@param $Config - Конфиг.
		*
		*	@param $SectionName - Название секции.
		*
		*	@return True если секция существует, иначе false.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function validates section existance.
		*
		*	@param $Config - Config.
		*
		*	@param $SectionName - Section's name.
		*
		*	@return True if the section exists, false otherwise.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			section_exists( &$Config , $SectionName )
		{
			try
			{
				if( $Config === false )
				{
					throw( new Exception( 'Config was not set' ) );
				}

				if( isset( $Config[ $SectionName ] ) )
				{
					$this->Trace->add_trace_string( "{lang:section_was_found} : $SectionName" , COMMON );
				}
				else
				{
					$this->Trace->add_trace_string( "{lang:section_was_not_found} : $SectionName" , COMMON );
				}

				return( isset( $Config[ $SectionName ] ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Обработка сообщений.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes success messages.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_global_success_message()
		{
			try
			{
				if( $this->section_exists( $this->Config , 'global_success_message' ) )
				{
					$SuccessMessage = $this->get_section( $this->Config ,  'global_success_message' );

					if( $this->Security->get_s( 'direct_controller' , 'integer' , 0 ) == 0 )
					{
						$this->Security->reset_s( 'success_message' , $SuccessMessage );
					}
					$this->Messages->add_success_message( $SuccessMessage );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Обработка сообщений.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@return Текст сообщения или false.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes success messages.
		*
		*	@param $Options - Execution parameters.
		*
		*	@return Message text or false.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_success_message( &$Options )
		{
			try
			{
				$SuccessMessage = false;

				if( $Options->get_setting( 'success_message' , false ) !== false )
				{
					$SuccessMessage = $Options->get_setting( 'success_message' );
				}
				elseif( $this->section_exists( $this->Config , 'success_message' ) )
				{
					$SuccessMessage = $this->get_section( $this->Config ,  'success_message' );
				}

				return( $SuccessMessage );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Обработка сообщений.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes success messages.
		*
		*	@param $Options - Execution parameters.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_success_messages( &$Options )
		{
			try
			{
				$SuccessMessage = $this->get_success_message( $Options );

				if( $SuccessMessage !== false )
				{
					if( $this->Security->get_s( 'direct_controller' , 'integer' , 0 ) === 0 )
					{
						$PageName = $this->Security->get_gp( 'page_name' , 'command' );

						$this->Security->reset_s( "$PageName:success_message" , $SuccessMessage );
					}

					$this->Messages->add_success_message( $SuccessMessage );
				}

				$this->compile_global_success_message();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Вывод трассировки.
		*
		*	@param $Filter - Фильтр.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function outputs filter.
		*
		*	@param $Filter - Filter.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	print_get_post_filter_trace( $Filter )
		{
			try
			{
				$this->Trace->add_trace_string( "{lang:get_post_filter_not_passed} : $Filter" , COMMON );
				$this->Trace->add_trace_string( "GET : ".wordwrap( serialize( $_GET ) ) , COMMON );
				$this->Trace->add_trace_string( "POST : ".wordwrap( serialize( $_POST ) ) , COMMON );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Проверка GET/POST фильтров.
		*
		*	@param $Config - Конфиг.
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
		*	\~english Function validates GET/POST filters.
		*
		*	@param $Config - Config.
		*
		*	@param $Options - Execution parameters.
		*
		*	@return false if the filtration was not passed.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_get_post_filter( &$Config , &$Options )
		{
			try
			{
				if( $this->section_exists( $Config , 'get_post_filter' ) == false )
				{
					return( true );
				}

				$Filter = $this->get_section( $Config ,  'get_post_filter' );

				$this->Trace->add_trace_string( "{lang:get_post_filter} : $Filter" , COMMON );

				if( $this->SecurityValidator->validate_fields( $Filter ) === false )
				{
					$this->print_get_post_filter_trace( $Filter );
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
		*	\~russian Проверка GET/POST данных.
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
		*	\~english Function validates GET/POST data.
		*
		*	@param $Options - Execution parameters.
		*
		*	@return false if the validation was not passed.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_get_post_validation( &$Config , &$Options )
		{
			try
			{
				if( $this->section_exists( $Config , 'get_post_validation' ) )
				{
					$GetPostValidation = $this->get_section( $Config ,  'get_post_validation' );

					return( $this->SecurityValidator->validate_fields( $GetPostValidation ) );
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
		function			get_custom_validation_object( &$Config )
		{
			try
			{
				$Name = $this->get_section( $Config ,  'custom_validation_package_name' , false );

				if( $Name !== false )
				{
					$Version = $this->get_section( $Config ,  'custom_validation_package_version' , 'last' );

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
	}
	
?>