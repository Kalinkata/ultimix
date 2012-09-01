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

	//TODO: join with page::page_manager::page_manager_controller

	/**
	*	\~russian Класс для управления страницами.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english This manager helps to create pages.
	*
	*	@author Dodonov A.A.
	*/
	class	page_manager_controller_1_0_0{
		
		/**
		*	\~russian Функция редактирования записи.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function edits record.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			update_packages( $Options )
		{
			try
			{
				$Security = get_package( 'security' , 'last' , __FILE__ );
				$PageName = $Security->get_p( 'page_record_id' , 'command' );
				
				$PageAccess = get_package( 'page::page_access' , 'last' , __FILE__ );
				$PageAccess->set_package_appliance( $PageName , $Security->get_p( 'page_packages' , 'unsafe_string' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция редактирования записи.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function edits record.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			update_permitions( $Options )
		{
			try
			{
				$Security = get_package( 'security' , 'last' , __FILE__ );
				$PageName = $Security->get_p( 'page_record_id' , 'command' );
				
				$PermitAccess = get_package( 'permit::permit_access' , 'last' , __FILE__ );
				$Permitions = $Security->get_p( 'page_permitions' , 'unsafe_string' );
				$PermitAccess->set_permits_for_page( $PageName , $Permitions );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция управления компонентом.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function controls component.
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
				
				$ContextSet->add_context( dirname( __FILE__ ).'/conf/cfcxs_packages_form' );
				
				$ContextSet->add_context( dirname( __FILE__ ).'/conf/cfcxs_permitions_form' );
				
				$ContextSet->execute( $Options , $this , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>