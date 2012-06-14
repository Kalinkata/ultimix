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
	*	\~russian Класс для обработки макросов.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class processes macro.
	*
	*	@author Dodonov A.A.
	*/
	class	review_markup_1_0_0{
	
		/**
		*	\~russian Закэшированные пакеты.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cached packages.
		*
		*	@author Dodonov A.A.
		*/
		var					$BlockSettings = false;
		var					$CachedMultyFS = false;
		var					$Link = false;
		var					$ReviewAccess = false;
		var					$ReviewAlgorithms = false;
		var					$String = false;
		var					$UserAlgorithms = false;

		/**
		*	\~russian Конструктор.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
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
				$this->BlockSettings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->CachedMultyFS = get_package_object( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->Link = get_package( 'link' , 'last' , __FILE__ );
				$this->ReviewAccess = get_package( 'review::review_access' , 'last' , __FILE__ );
				$this->ReviewAlgorithms = get_package( 'review::review_algorithms' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
				$this->UserAlgorithms = get_package( 'user::user_algorithms' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение отзывов для указанного объекта.
		*
		*	@param $BlockSettings - Параметры.
		*
		*	@return Отзывы.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns all reviews for the object.
		*
		*	@param $BlockSettings - Parameters.
		*
		*	@return Reviews object.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_reviews_for_object( &$BlockSettings )
		{
			try
			{
				$MasterId = $BlockSettings->get_setting( 'master_id' );
				$MasterType = $BlockSettings->get_setting( 'master_type' );

				return( $this->ReviewAlgorithms->get_records_for_object( $MasterId , $MasterType ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Компиляция ленты отзывов.
		*
		*	@param $Reviews - Отзывы.
		*
		*	@return HTML код ленты отзывов.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles review list.
		*
		*	@param $Reviews - Reviews.
		*
		*	@return Reviews line's HTML code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_reviews( &$Reviews )
		{
			try
			{
				if( isset( $Reviews[ 0 ] ) )
				{
					$ReviewLine = '';

					$TemplatePath = dirname( __FILE__ ).'/res/templates/default_review_template.tpl';
					
					foreach( $Reviews as $i => $Review )
					{
						$ReviewLine .= $this->CachedMultyFS->file_get_contents( $TemplatePath );
						$ReviewLine  = $this->String->print_record( $ReviewLine , $Review );
					}
					
					return( $ReviewLine );
				}
				else
				{
					return( '{lang:reviews_were_not_found}' );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'review_line'.
		*
		*	@param $Str - Обрабатывемая строка.
		*
		*	@param $Changed - Была ли осуществлена обработка.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'review_line'.
		*
		*	@param $Str - Processing string.
		*
		*	@param $Changed - Was the processing completed.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_review_line( $Str , $Changed )
		{
			try
			{
				$Limitations = array( 'master_id' => TERMINAL_VALUE , 'master_type' => TERMINAL_VALUE );
				for( ; $Params = $this->String->get_macro_parameters( $Str , 'review_line' , $Limitations ) ; )
				{
					$this->BlockSettings->load_settings( $Params );
					$Reviews = $this->get_reviews_for_object( $this->BlockSettings );
			
					$Code = $this->compile_reviews( $Reviews );
					
					$Str = str_replace( "{review_line:$Params}" , $Code , $Str );
					$Changed = true;
				}
				
				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция компиляции макроса 'review_form'.
		*
		*	@param $BlockSettings - Параметры.
		*
		*	@return Код макроса.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'review_form'.
		*
		*	@param $BlockSettings - Parameters.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_review_form( &$BlockSettings )
		{
			try
			{
				$MasterId = $BlockSettings->get_setting( 'master_id' );
				$MasterType = $BlockSettings->get_setting( 'master_type' );
				
				$Code = '{direct_controller:package_name=review::review_controller;meta=meta_create_review;'.
							"master_type=$MasterType;master_id=$MasterId;direct_create=1}".
						'{direct_view:package_name=review::review_view;meta=meta_create_review_form;'.
							"master_type=$MasterType;master_id=$MasterId;direct_create=1}";
							
				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'review_form'.
		*
		*	@param $Str - Обрабатывемая строка.
		*
		*	@param $Changed - Была ли осуществлена обработка.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'review_form'.
		*
		*	@param $Str - Processing string.
		*
		*	@param $Changed - Was the processing completed.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_review_form( $Str , $Changed )
		{
			try
			{
				$Limitations = array( 'master_id' => TERMINAL_VALUE , 'master_type' => TERMINAL_VALUE );
				
				for( ; $Params = $this->String->get_macro_parameters( $Str , 'review_form' , $Limitations ) ; )
				{
					$this->BlockSettings->load_settings( $Params );
					
					$Code = $this->compile_review_form( $this->BlockSettings );

					$Str = str_replace( "{review_form:$Params}" , $Code , $Str );
					$Changed = true;
				}
				
				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'review_rank'.
		*
		*	@param $Str - Обрабатывемая строка.
		*
		*	@param $Changed - Была ли осуществлена обработка.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'review_rank'.
		*
		*	@param $Str - Processing string.
		*
		*	@param $Changed - Was the processing completed.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_review_rank( $Str , $Changed )
		{
			try
			{
				$Limitations = array( 'master_id' => TERMINAL_VALUE , 'master_type' => TERMINAL_VALUE );
				
				for( ; $Params = $this->String->get_macro_parameters( $Str , 'review_rank' , $Limitations ) ; )
				{
					$this->BlockSettings->load_settings( $Params );
					
					$MasterType = $this->BlockSettings->get_setting( 'master_type' );
					$MasterId = $this->BlockSettings->get_setting( 'master_id' );

					$Code = $this->RankAccess->get_total_rank( $MasterType , $MasterId );
					
					$Str = str_replace( "{review_rank:$Params}" , $Code , $Str );
					$Changed = true;
				}
				
				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отвечающая за обработку строки.
		*
		*	@param $Options - Параметры отображения.
		*
		*	@param $Str - Обрабатывемая строка.
		*
		*	@param $Changed - Была ли осуществлена обработка.
		*
		*	@return HTML код для отображения.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes string.
		*
		*	@param $Options - Options of drawing.
		*
		*	@param $Str - Processing string.
		*
		*	@param $Changed - Was the processing completed.
		*
		*	@return HTML code to display.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_string( $Options , $Str , &$Changed )
		{
			try
			{
				/* TODO: move it to auto_markup */
				list( $Str , $Changed ) = $this->process_review_line( $Str , $Changed );
				
				list( $Str , $Changed ) = $this->process_review_form( $Str , $Changed );
				
				list( $Str , $Changed ) = $this->process_review_rank( $Str , $Changed );
				
				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
?>