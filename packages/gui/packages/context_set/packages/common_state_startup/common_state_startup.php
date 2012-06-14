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
	class	common_state_startup_1_0_0{
	
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
		var					$ContextSetMarkup = false;
		var					$PermitAlgorithms = false;
		var					$Security = false;
		var					$StartupUtilities = false;
		
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
				$this->ContextSetMarkup = get_package( 'gui::context_set::context_set_markup' , 'last' , __FILE__ );
				$this->PermitAlgorithms = get_package( 'permit::permit_algorithms' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$PackageName = 'gui::context_set::common_state_startup::common_state_startup_utilities';
				$this->StartupUtilities = get_package( $PackageName , 'last' , __FILE__ );
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
		function			set_constants( &$ContextSet , $Options )
		{
			try
			{
				$this->Prefix = $ContextSet->Prefix;
				$this->StartupUtilities->DefaultControllers->set_constants( $ContextSet , $Options );
				$this->StartupUtilities->DefaultViews->set_constants( $ContextSet , $Options );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Действия если обработки не произошло.
		*
		*	@param $ContextSet - Набор контекстов.
		*
		*	@param $Str1 - Первая строка.
		*
		*	@param $Str2 - Вторая строка.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english No action processing.
		*
		*	@param $ContextSet - Set of contexts.
		*
		*	@param $Str1 - First string.
		*
		*	@param $Str2 - Second string.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	not_processed( &$ContextSet , $Str1 , $Str2 )
		{
			try
			{
				$this->StartupUtilities->trace_no_need_to_run_state_message( $Str1 , $this->Prefix , $Str2 );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция запуска стейта формы создания.
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
		*	\~english Function starts create form sate.
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
		function			list_form_state_startup( &$ContextSet , &$Options )
		{
			try
			{
				$ContextSet->Trace->start_group( "{lang:list_form_state}" );

				$ContextAction = $this->Security->get_gp( $this->Prefix.'_context_action' , 'command' , '' );

				if( $ContextAction == '' )
				{
					$Result = $this->StartupUtilities->try_run_view_state( $ContextSet , $Options , 'list' );
					$ContextSet->Trace->end_group();
					return( $Result );
				}
				else
				{
					$this->not_processed( $ContextSet , 'list' , '' );
					$ContextSet->Trace->end_group();
					return( false );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция запуска стейта удаления.
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
		*	\~english Function starts delete sate.
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
		function			delete_state_startup( &$ContextSet , &$Options )
		{
			try
			{
				$ContextSet->Trace->start_group( "{lang:delete_state}" );
				
				$Action = $this->Security->get_gp( $this->Prefix.'_action' , 'command' , '' );
				
				if( $Action == 'delete_record' )
				{
					$Result = $this->StartupUtilities->try_run_controller_state( $ContextSet , $Options , 'delete' );
					$ContextSet->Trace->end_group();
					return( $Result );
				}
				else
				{
					$this->not_processed( $ContextSet , 'delete' , 'delete_record' );
					$ContextSet->Trace->end_group();
					return( false );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция запуска стейта формы создания.
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
		*	\~english Function starts create form sate.
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
		function			create_form_state_startup( &$ContextSet , &$Options )
		{
			try
			{
				$ContextSet->Trace->start_group( "{lang:create_form_state}" );

				$ContextAction = $this->Security->get_gp( $this->Prefix.'_context_action' , 'command' , '' );

				if( $ContextAction == 'create_record_form' || $Options->get_setting( 'direct_create' , 0 ) != 0 )
				{
					$Result = $this->StartupUtilities->try_run_view_state( $ContextSet , $Options , 'create' );
					$ContextSet->Trace->end_group();
					return( $Result );
				}
				else
				{
					$this->not_processed( $ContextSet , 'create_form' , 'create_record_form' );
					$ContextSet->Trace->end_group();
					return( false );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция запуска стейта формы редактирвоания.
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
		*	\~english Function starts edit form sate.
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
		function			update_form_state_startup( &$ContextSet , &$Options )
		{
			try
			{
				$ContextSet->Trace->start_Group( "{lang:update_form_state}" );
				
				$ContextAction = $this->Security->get_gp( $this->Prefix.'_context_action' , 'command' , '' );
				$Direct = $Options->get_setting( 'direct_update' , 0 );

				if( $ContextAction == 'update_record_form' || $Direct != 0 )
				{
					$Result = $this->StartupUtilities->try_run_view_state( $ContextSet , $Options , 'update' );
					$ContextSet->Trace->end_group();
					return( $Result );
				}
				else
				{
					$this->not_processed( $ContextSet , 'update_form' , 'update_record_form' );
					$ContextSet->Trace->end_group();
					return( false );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция запуска стейта редактирования.
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
		*	\~english Function starts update sate.
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
		function			update_state_startup( &$ContextSet , &$Options )
		{
			try
			{
				$ContextSet->Trace->start_group( "{lang:update_state}" );
				
				$Action = $this->Security->get_gp( $this->Prefix.'_action' , 'command' , '' );
				$Direct = $Options->get_setting( 'direct_update' , 0 );
				
				if( $Action == 'update_record' || $Direct != 0 )
				{
					$Result = $this->StartupUtilities->try_run_controller_state( $ContextSet , $Options , 'update' );
					$ContextSet->Trace->end_group();
					return( $Result );
				}
				else
				{
					$this->not_processed( $ContextSet , 'update' , 'update_record' );
					$ContextSet->Trace->end_group();
					return( false );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция запуска стейта формы копирования.
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
		*	\~english Function starts copy form sate.
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
		function			copy_form_state_startup( &$ContextSet , &$Options )
		{
			try
			{
				$ContextSet->Trace->start_group( "{lang:copy_form_state}" );
				
				$ContextAction = $this->Security->get_gp( $this->Prefix.'_context_action' , 'command' , '' );
				$Direct = $Options->get_setting( 'direct_copy' , 0 );
				
				if( $ContextAction == 'copy_record_form' || $Direct != 0 )
				{
					$Result = $this->StartupUtilities->try_run_view_state( $ContextSet , $Options , 'copy' );
					$ContextSet->Trace->end_group();
					return( $Result );
				}
				else
				{
					$this->not_processed( $ContextSet , 'copy_form' , 'copy_record_form' );
					$ContextSet->Trace->end_group();
					return( false );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция запуска стейта копирования.
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
		*	\~english Function starts copy sate.
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
		function			copy_state_startup( &$ContextSet , &$Options )
		{
			try
			{
				$ContextSet->Trace->start_group( "{lang:copy_state}" );

				$Action = $this->Security->get_gp( $this->Prefix.'_action' , 'command' , '' );
				$Direct = $Options->get_setting( 'direct_copy' , 0 );

				if( $Action == 'copy_record' || $Direct != 0 )
				{
					$Result = $this->StartupUtilities->try_run_controller_state( $ContextSet , $Options , 'copy' );
					$ContextSet->Trace->end_group();
					return( $Result );
				}
				else
				{
					$this->not_processed( $ContextSet , 'copy' , 'copy_record' );
					$ContextSet->Trace->end_group();
					return( false );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция запуска стейта создания.
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
		*	\~english Function starts create sate.
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
		function			create_state_startup( &$ContextSet , &$Options )
		{
			try
			{
				$ContextSet->Trace->start_group( "{lang:create_state}");

				$Action = $this->Security->get_gp( $this->Prefix.'_action' , 'command' , '' );
				$Direct = $Options->get_setting( 'direct_create' , 0 );

				if( $Action == 'create_record' || $Direct != 0 )
				{
					$Result = $this->StartupUtilities->try_run_controller_state( $ContextSet , $Options , 'create' );
					$ContextSet->Trace->end_group();
					return( $Result );
				}
				else
				{
					$this->not_processed( $ContextSet , 'create' , 'create_record' );
					$ContextSet->Trace->end_group();
					return( false );
				}
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
		*	\~russian Запуск всех стандартных стейтов контроллеров.
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
		*	\~english Function starts all standart controller states.
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
		function			run_controller_states( &$ContextSet , &$Options )
		{
			try
			{
				$Next = true;

				if( $Next && $this->run_it( $Options , 'delete' ) )
				{
					$Next = $this->delete_state_startup( $ContextSet , $Options ) === false;
				}
				if( $Next && $this->run_it( $Options , 'create' ) )
				{
					$Next = $this->create_state_startup( $ContextSet , $Options ) === false;
				}
				if( $Next && $this->run_it( $Options , 'update' ) )
				{
					$Next = $this->update_state_startup( $ContextSet , $Options ) === false;
				}
				if( $Next && $this->run_it( $Options , 'copy' ) )
				{
					$Next = $this->copy_state_startup( $ContextSet , $Options ) === false;
				}

				return( !$Next );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Запуск всех стандартных стейтов видов.
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
		*	\~english Function starts all standart view states.
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
		function			run_view_states( &$ContextSet , &$Options )
		{
			try
			{
				$Next = true;

				if( $Next && $this->run_it( $Options , 'list' ) )
				{
					$Next = $this->list_form_state_startup( $ContextSet , $Options ) === false;
				}
				if( $Next && $this->run_it( $Options , 'create' ) )
				{
					$Next = $this->create_form_state_startup( $ContextSet , $Options ) === false;
				}
				if( $Next && $this->run_it( $Options , 'update' ) )
				{
					$Next = $this->update_form_state_startup( $ContextSet , $Options ) === false;
				}
				if( $Next && $this->run_it( $Options , 'copy' ) )
				{
					$Next = $this->copy_form_state_startup( $ContextSet , $Options ) === false;
				}

				return( !$Next );
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
		function			run_common_states( &$ContextSet , &$Options )
		{
			try
			{
				$this->set_constants( $ContextSet , $Options );

				if( $this->run_controller_states( $ContextSet , $Options ) )
				{
					return( true );
				}

				if( $this->run_view_states( $ContextSet , $Options ) )
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
	}
	
?>