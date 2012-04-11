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
	*	\~russian Обработчик компонента.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Component's controller.
	*
	*	@author Dodonov A.A.
	*/
	class	category_controller_1_0_0{
		
		/**
		*	\~russian Обновление записи.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Updating record.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			update_category_title( $Options )
		{
			try
			{
				$Security = get_package( 'security' , 'last' , __FILE__ );
				$CategoryAlgorithms = get_package( 'category::category_algorithms' , 'last' , __FILE__ );
				$CategoryAlgorithms->update_category_title( 
					$Security->get_p( 'category_id' , 'integer' , 0 ) , $Security->get_p( 'title' , 'string' , '' )
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Обработка списков категорий.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Processing categories list.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			category_list( $Options )
		{
			try
			{
				$Link = get_package( 'link' , 'last' , __FILE__ );
				$MasterId = $Options->get_setting( 'master_id' );
				$MasterType = $Options->get_setting( 'master_type' );
				$Link->delete_link( $MasterId , false , $MasterType , 'category' );
				
				$SecurityUtilities = get_package( 'security::security_utilities' , 'last' , __FILE__ );
				$Ids = $SesurityUtilities->get_global( '_id_' , 'integer' , CHECKBOX_IDS );
				
				$Link->create_link( $MasterId , $Ids , $MasterType , 'category' , true );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Обработчик события удаления категории.
		*
		*	@param $Parameters - Параметры сообщения.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Category deletion event handler.
		*
		*	@param $Parameters - Event parameters.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			on_before_delete_category( $Parameters )
		{
			try
			{
				/* allways called for the single category */
				$cid = get_field( $Parameters , 'id' );
				
				$CategoryAccess = get_package( 'category::category_access' , 'last' , __FILE__ );
				
				$Categories = $CategoryAccess->select_list( $cid );

				$CategoryAccess->move_up_children_categories( $cid , get_field( $Categories[ 0 ] , 'root_id' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Обработка компонента.
		*
		*	@param $Options - настройки работы модуля.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Component's controller.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			controller( $Options )
		{
			try
			{
				$ContextSet = get_package( 'gui::context_set' , 'last' , __FILE__ );
				
				$ContextSet->add_context( dirname( __FILE__ ).'/conf/cfcx_update_category_title' );
				
				$ContextSet->add_context( dirname( __FILE__ ).'/conf/cfcx_category_list' );

				$ContextSet->execute( $Options , $this , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
?>