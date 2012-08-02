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
		var					$CachedMultyFS = false;
		var					$ReviewAccess = false;
		var					$ReviewAlgorithms = false;
		var					$String = false;

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
				$this->CachedMultyFS = get_package_object( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->ReviewAccess = get_package( 'review::review_access' , 'last' , __FILE__ );
				$this->ReviewAlgorithms = get_package( 'review::review_algorithms' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение отзывов для указанного объекта.
		*
		*	@param $Settings - Параметры.
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
		*	@param $Settings - Parameters.
		*
		*	@return Reviews object.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_reviews_for_object( &$Settings )
		{
			try
			{
				$MasterId = $Settings->get_setting( 'master_id' );
				$MasterType = $Settings->get_setting( 'master_type' );

				return( $this->ReviewAlgorithms->get_records_for_object( $MasterId , $MasterType ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция компиляции макроса 'review_rank'.
		*
		*	@param $Settings - Параметры.
		*
		*	@return Код макроса.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'review_rank'.
		*
		*	@param $Settings - Parameters.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_review_line( &$Settings )
		{
			try
			{
				$Reviews = $this->get_reviews_for_object( $Settings );

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
		*	\~russian Функция компиляции макроса 'review_form'.
		*
		*	@param $Settings - Параметры.
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
		*	@param $Settings - Parameters.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_review_form( &$Settings )
		{
			try
			{
				$MasterId = $Settings->get_setting( 'master_id' );
				$MasterType = $Settings->get_setting( 'master_type' );

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
		*	\~russian Функция компиляции макроса 'review_rank'.
		*
		*	@param $Settings - Параметры.
		*
		*	@return Код макроса.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'review_rank'.
		*
		*	@param $Settings - Parameters.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_review_rank( &$Settings )
		{
			try
			{
				$MasterType = $Settings->get_setting( 'master_type' );
				$MasterId = $Settings->get_setting( 'master_id' );

				return( $this->RankAccess->get_total_rank( $MasterType , $MasterId ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
?>