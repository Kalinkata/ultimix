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
	class	comment_markup_1_0_0{
	
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
		var					$CommentAlgorithms = false;
		var					$Link = false;
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
				$this->BlockSettings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->CommentAlgorithms = get_package( 'comment::comment_algorithms' , 'last' , __FILE__ );
				$this->Link = get_package( 'link' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Компиляция ленты комментариев.
		*
		*	@param $BlockSettings - Параметры компиляции.
		*
		*	@return HTML код ленты комментариев.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles comment list.
		*
		*	@param $BlockSettings - Compilation parameters.
		*
		*	@return Comment line's HTML code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_comments( &$BlockSettings )
		{
			try
			{
				$Comments = $this->get_comments_for_object( $BlockSettings );

				if( isset( $Comments[ 0 ] ) )
				{
					$CommentLine = '';

					$TemplatePath = dirname( __FILE__ ).'/res/templates/default_comment_template.tpl';
					
					foreach( $Comments as $i => $Comment )
					{
						$CommentLine .= $this->CachedMultyFS->file_get_contents( $TemplatePath );
						$CommentLine  = $this->String->print_record( $CommentLine , $Comment );
					}
					
					return( $CommentLine );
				}
				else
				{
					return( '{lang:comments_were_not_found}' );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение комментариев для указанного объекта.
		*
		*	@param $BlockSettings - Параметры.
		*
		*	@return Комментарии.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns all comments for the object.
		*
		*	@param $BlockSettings - Parameters.
		*
		*	@return Comments object.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_comments_for_object( &$BlockSettings )
		{
			try
			{
				$MasterId = $BlockSettings->get_setting( 'master_id' );
				$MasterType = $BlockSettings->get_setting( 'master_type' );

				return( $this->CommentAlgorithms->get_records_for_object( $MasterId , $MasterType ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция компиляции макроса 'comment_link'.
		*
		*	@param $BlockSettings - Параметры компиляции.
		*
		*	@return Widget.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'comment_link'.
		*
		*	@param $BlockSettings - Compilation parameters.
		*
		*	@return Widget.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_comment_link( &$BlockSettings )
		{
			try
			{
				$MasterId = $BlockSettings->get_setting( 'master_id' );
				$MasterType = $BlockSettings->get_setting( 'master_type' );

				$CommentsCount = $this->Link->get_links_count( $MasterId , false , $MasterType , 'comment' );

				$Page = $BlockSettings->get_setting( 'page' );

				$Template = $this->CachedMultyFS->get_template( __FILE__ , 'comment_link.tpl' );
				$PlaceHolders = array( '{page}' , '{comment_count}' );

				return( str_replace( $PlaceHolders , array( $Page , $CommentsCount ) , $Template ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции макроса 'comment_form'.
		*
		*	@param $Parameters - Параметры компиляции.
		*
		*	@return Виджет.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'comment_form'.
		*
		*	@param $Parameters - Compilation parameters.
		*
		*	@return Widget.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_comment_form( $Parameters )
		{
			try
			{
				$this->BlockSettings->load_settings( $Parameters );

				list( $MasterType , $MasterId )= $this->BlockSettings->get_settings( 'master_type,master_id' );
				$NeedRun = $this->BlockSettings->get_setting( 'need_run' , 1 );

				$Code = '{direct_controller:package_name=comment::comment_controller;meta=meta_create_comment;'.
							"master_type=$MasterType;master_id=$MasterId;direct_create=1;need_run=$NeedRun}".
						'{direct_view:package_name=comment::comment_view;meta=meta_create_comment_form;'.
							"master_type=$MasterType;master_id=$MasterId;direct_create=1;need_run=$NeedRun}";

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>