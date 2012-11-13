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
	*	\~russian ����� ��� ��������� ��������.
	*
	*	@author ������� �.�.
	*/
	/**
	*	\~english Class processes macro.
	*
	*	@author Dodonov A.A.
	*/
	class	comment_markup_1_0_0{

		/**
		*	\~russian �������������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Cached packages.
		*
		*	@author Dodonov A.A.
		*/
		var					$CachedMultyFS = false;
		var					$CommentAlgorithms = false;
		var					$Link = false;
		var					$String = false;

		/**
		*	\~russian �����������.
		*
		*	@exception Exception �������� ��������� ����� ���� � ��������� ������.
		*
		*	@author  ������� �.�.
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
		*	\~russian ���������� ����� ������������.
		*
		*	@param $Settings - ��������� ����������.
		*
		*	@return HTML ��� ����� ������������.
		*
		*	@exception Exception �������� ��������� ����� ���� � ��������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Function compiles comment list.
		*
		*	@param $Settings - Compilation parameters.
		*
		*	@return Comment line's HTML code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_comments( &$Settings )
		{
			try
			{
				$Comments = $this->get_comments_for_object( $Settings );

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
		*	\~russian ��������� ������������ ��� ���������� �������.
		*
		*	@param $Settings - ���������.
		*
		*	@return �����������.
		*
		*	@exception Exception �������� ��������� ����� ���� � ��������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Function returns all comments for the object.
		*
		*	@param $Settings - Parameters.
		*
		*	@return Comments object.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_comments_for_object( &$Settings )
		{
			try
			{
				$MasterId = $Settings->get_setting( 'master_id' );
				$MasterType = $Settings->get_setting( 'master_type' );

				return( $this->CommentAlgorithms->get_records_for_object( $MasterId , $MasterType ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian ������� ���������� ������� 'comment_link'.
		*
		*	@param $Settings - ��������� ����������.
		*
		*	@return Widget.
		*
		*	@exception Exception �������� ��������� ����� ���� � ��������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Function compiles macro 'comment_link'.
		*
		*	@param $Settings - Compilation parameters.
		*
		*	@return Widget.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_comment_link( &$Settings )
		{
			try
			{
				$MasterId = $Settings->get_setting( 'master_id' );
				$MasterType = $Settings->get_setting( 'master_type' );

				$CommentsCount = $this->Link->get_links_count( $MasterId , false , $MasterType , 'comment' );

				$Page = $Settings->get_setting( 'page' );

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
		*	\~russian ������� ���������� ������� 'comment_form'.
		*
		*	@param $Settings - ��������� ����������.
		*
		*	@return ������.
		*
		*	@exception Exception �������� ��������� ����� ���� � ��������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Function compiles macro 'comment_form'.
		*
		*	@param $Settings - Compilation parameters.
		*
		*	@return Widget.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_comment_form( &$Settings )
		{
			try
			{
				list( $MasterType , $MasterId )= $Settings->get_settings( 'master_type,master_id' );
				$NeedRun = $Settings->get_setting( 'need_run' , 1 );

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