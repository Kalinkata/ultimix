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
	*	\~russian Класс дефолтовых контроллеров.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class of the default controllers.
	*
	*	@author Dodonov A.A.
	*/
	class	default_controllers_1_0_0{
	
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
		var					$ContextSetUtilities = false;
		var					$GUI = false;
		var					$SecurityParser = false;
	
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
		*	\~russian Объект класса представляющего функции-обработчики.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Object of the class wich provides all handlers.
		*
		*	@author Dodonov A.A.
		*/
		var					$Provider = false;
	
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
				$this->ContextSetUtilities = get_package( 
					'gui::context_set::context_set_utilities' , 'last' , __FILE__
				);
				$this->GUI = get_package( 'gui' , 'last' , __FILE__ );
				$this->SecurityParser = get_package( 'security::security_parser' , 'last' , __FILE__ );
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
				$this->Provider = $ContextSet->Provider;
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Функция удаления записи.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function deletes record.
		*
		*	@param $Options - Execution parameters.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			delete( &$Options )
		{
			try
			{
				$Provider = $this->ContextSetUtilities->get_data_provider( $Options , $this->Provider );
				$FunctionName = $Options->get_setting( 'delete_func' , 'delete' );
				$Ids = $this->ContextSetUtilities->get_posted_ids( $this->Prefix );
				
				if( method_exists( $Provider , $FunctionName ) === true )
				{
					call_user_func( array( $Provider , $FunctionName ) , implode( ',' , $Ids ) , $Options );
				}
				else
				{
					$ClassName = $Provider ? get_class( $Provider ) : 'undefined_class';
					throw( new Exception( "Method \"$FunctionName\" was not found in the class \"$ClassName.\"" ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция масовой обработки записей.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		/**
		*	\~english Function for massive processing.
		*
		*	@param $Options - Execution parameters.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			multy_call( &$Options )
		{
			try
			{
				$Ids = $this->ContextSetUtilities->get_posted_ids( $this->Prefix );
				$Provider = $this->ContextSetUtilities->get_data_provider( $Options , $this->Provider );

				if( $Options->get_setting( 'id_list_accept' , 1 ) == '1' )
				{
					call_user_func( 
						array( $Provider , $Options->get_setting( 'func_name' ) ) , implode( $Ids ) , $Options
					);
				}
				else
				{
					foreach( $Ids as $id )
					{
						call_user_func( array( $Provider , $Options->get_setting( 'func_name' ) ) , $id , $Options );
					}
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция выборки данных создания.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@return array( $Record , $FunctionName , $Provider ).
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function fetches creation data.
		*
		*	@param $Options - Execution parameters.
		*
		*	@return array( $Record , $FunctionName , $Provider ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_creation_data( &$Options )
		{
			try
			{
				$ExtractionScript = $Options->get_setting( 'get_post_extraction_script' );
				$Record = $this->SecurityParser->parse_http_parameters( $ExtractionScript );
				
				$FunctionName = $Options->get_setting( 'create_func' , 'create' );
				$Provider = $this->ContextSetUtilities->get_data_provider( $Options , $this->Provider );
				
				return( array( $Record , $FunctionName , $Provider ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция создания записи.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function creates record.
		*
		*	@param $Options - Execution parameters.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			create( &$Options )
		{
			try
			{
				list( $Record , $FunctionName , $Provider ) = $this->get_creation_data( $Options );

				if( method_exists( $Provider , $FunctionName ) === true )
				{
					$id = call_user_func( array( $Provider , $FunctionName ) , $Record , $Options );
					$this->GUI->set_var( 'record_id' , $id );
				}
				else
				{
					$ClassName = $Provider ? get_class( $Provider ) : 'undefined_class';
					throw( new Exception( "Method \"$FunctionName\" was not found in the class \"$ClassName.\"" ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция публичного создания записи.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function creates record (public).
		*
		*	@param $Options - Execution parameters.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			public_create( &$Options )
		{
			try
			{
				$this->Create( $Options );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Компиляция записи.
		*
		*	@param $RecordNew - Поля для обновления.
		*
		*	@param $RecordOriginal - Исходная запись.
		*
		*	@return Запись.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Record compilation.
		*
		*	@param $RecordNew - Updating fields.
		*
		*	@param $RecordOriginal - Original record.
		*
		*	@return Update record.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_update_record( $RecordNew , $RecordOriginal )
		{
			try
			{
				$UpdateRecord = array();
				
				foreach( $RecordNew as $Field => $NewValue )
				{
					$Field = str_replace( $this->Prefix.'_' , '' , $Field );
					
					if( @$RecordOriginal->$Field != $NewValue )
					{
						@$UpdateRecord[ $Field ] = $NewValue;
					}
				}
				
				return( $UpdateRecord );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение полей для обновления.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@param $Ids - Идентификаторы обновляемых записей.
		*
		*	@param $RecordOriginal - Исходная запись.
		*
		*	@return Поля для обновления.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns records to update.
		*
		*	@param $Options - Execution parameters.
		*
		*	@param $Ids - Ids of the updating records.
		*
		*	@param $RecordOriginal - Original record.
		*
		*	@return Updating records.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_update_record( &$Options , $Ids , $RecordOriginal )
		{
			try
			{
				$GetPostValidation = $Options->get_setting( 'get_post_validation' , false );
				$ValidationScript = $Options->get_setting( 'custom_get_post_validation' , $GetPostValidation );
				
				if( $ValidationScript === false )
				{
					throw( new Exception( 'There is no script to extract data from http headers' ) );
				}
				
				$RecordNew = $this->SecurityParser->parse_http_parameters( $ValidationScript );

				return( $this->compile_update_record( $RecordNew , $RecordOriginal ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения параметров обновления записей.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@return - Параметры обновления.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns update parameters.
		*
		*	@param $Options - Execution parameters.
		*
		*	@return - Update parameters.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_update_data( &$Options )
		{
			try
			{
				$Ids = $this->ContextSetUtilities->get_posted_ids( $this->Prefix );
				
				/** \~russian если массовое редактирование отключено, то здесь по-любому будет один идентификатор
					\~english if massive editing is switched off thet only on id will be in this variable*/
				$RecordOriginal = $this->ContextSetUtilities->get_data_record( $Options , $Ids );
				
				$UpdateRecord = $this->get_update_record( $Options , $Ids , $RecordOriginal );
				
				return( array( $Ids , $UpdateRecord ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция редактирования записей.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function updates records.
		*
		*	@param $Options - Execution parameters.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			update( &$Options )
		{
			try
			{
				list( $Ids , $UpdateRecord ) = $this->get_update_data( $Options );

				$Provider = $this->ContextSetUtilities->get_data_provider( $Options , $this->Provider );

				$FunctionName = $Options->get_setting( 'update_func' , 'update' );

				if( method_exists( $Provider , $FunctionName ) === true )
				{
					$Func = array( $Provider , $FunctionName );

					call_user_func( $Func , implode( ',' , $Ids ) , $UpdateRecord , $Options );
				}
				else
				{
					$ClassName = $Provider ? get_class( $Provider ) : 'undefined_class';

					throw( new Exception( "Method \"$FunctionName\" was not found in the class \"$ClassName.\"" ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция публичного редактирования записей.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function edits records (public).
		*
		*	@param $Options - Execution parameters.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			public_update( &$Options )
		{
			try
			{
				$this->edit( $Options );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция копирования записи.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function copies record.
		*
		*	@param $Options - Execution parameters.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			copy( &$Options )
		{
			try
			{
				$Options->set_setting( 'create_func' , $Options->get_setting( 'copy_func' ) );
				$this->create( $Options );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>