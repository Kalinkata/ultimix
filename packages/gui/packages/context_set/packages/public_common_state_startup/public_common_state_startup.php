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
	class	public_common_state_startup_1_0_0{

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
		var					$StartupUtilities = false;
		var					$DefaultControllers = false;
		var					$DefaultViews = false;
		var					$LocalOptions = false;
		var					$Security = false;
		var					$Trace = false;

		/**
		*	\~russian Префикс.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Prefix.
		*
		*	@author Dodonov A.A.
		*/
		var					$Prefix = false;

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
				$PackageName = 'gui::context_set::common_state_startup::common_state_startup_utilities';
				$this->StartupUtilities = get_package( $PackageName , 'last' , __FILE__ );
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
		*	\~russian Установка параметров работы.
		*
		*	@param $ContextSet - Набор контекстов.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sets all necessary parameters.
		*
		*	@param $ContextSet - Set of contexts.
		*
		*	@param $Options - Execution parameters.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_constants( &$ContextSet , &$Options )
		{
			try
			{
				$this->Prefix = $ContextSet->Prefix;
				$this->DefaultControllers->set_constants( $ContextSet , $Options );
				$this->DefaultViews->set_constants( $ContextSet , $Options );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция запуска стейта формы последних записей.
		*
		*	@param $ContextSet - Набор контекстов.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@return true если стейт был обработан.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function starts last records form sate.
		*
		*	@param $ContextSet - Set of contexts.
		*
		*	@param $Options - Execution parameters.
		*
		*	@return true if the state was processed.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			last_records_form_state_startup( &$ContextSet , &$Options )
		{
			try
			{
				$this->Trace->start_group( "{lang:last_records_form_state}" );

				$Result = false;

				if( intval( $Options->get_setting( 'last_records' , 0 ) ) )
				{
					$Result = $this->StartupUtilities->try_run_view_state( $ContextSet , $Options , 'last_records' );
				}
				else
				{
					$this->StartupUtilities->trace_no_need_to_run_state_message( 
						'last_records_form' , $this->Prefix , ''
					);
				}

				$this->Trace->end_group();
				return( $Result );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция запуска стейта формы зависимых записей.
		*
		*	@param $ContextSet - Набор контекстов.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@return true если стейт был обработан.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function starts dependent records form sate.
		*
		*	@param $ContextSet - Set of contexts.
		*
		*	@param $Options - Execution parameters.
		*
		*	@return true if the state was processed.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			dependent_records_form_state_startup( &$ContextSet , &$Options )
		{
			try
			{
				$this->Trace->start_group( "{lang:dependent_records_form_state}" );

				$Result = false;

				if( intval( $Options->get_setting( 'dependent_records' , 0 ) ) )
				{
					$Result = $this->StartupUtilities->try_run_view_state( 
						$ContextSet , $Options , 'dependent_records'
					);
				}
				else
				{
					$this->StartupUtilities->trace_no_need_to_run_state_message( 
						'dependent_records_form' , $this->Prefix , ''
					);
				}

				$this->Trace->end_group();
				return( $Result );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Нужен ли запуск стандартных контекстов.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@param $State - Стейт.
		*
		*	@return true если стейт должен быть обработан.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function starts all standart controller states.
		*
		*	@param $Options - Execution parameters.
		*
		*	@param $State - State.
		*
		*	@return true if the state must be processed.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	run_it( &$Options , $State )
		{
			try
			{
				$HintedContext = $Options->get_setting( 'common_context' , false );

				if( $HintedContext === false )
				{
					return( true );
				}

				return( $HintedContext == $State );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Запуск всех стандартных стейтов.
		*
		*	@param $ContextSet - Набор контекстов.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@return true если стейт был обработан.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function starts all states.
		*
		*	@param $ContextSet - Set of contexts.
		*
		*	@param $Options - Execution parameters.
		*
		*	@return true if the state was processed.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			run_public_commmon_states( &$ContextSet , &$Options )
		{
			try
			{
				$this->set_constants( $ContextSet , $Options );

				if( $this->last_records_form_state_startup( $ContextSet , $Options ) !== false )return( true );

				if( $this->dependent_records_form_state_startup( $ContextSet , $Options ) !== false )return( true );

				return( false );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>