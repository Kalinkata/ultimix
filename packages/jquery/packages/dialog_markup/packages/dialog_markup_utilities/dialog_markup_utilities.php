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
	*	\~russian Класс для обработкид иалоговых макросов.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class processes dialog macroes.
	*
	*	@author Dodonov A.A.
	*/
	class	dialog_markup_utilities_1_0_0{

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
		var					$Utilities = false;

		/**
		*	\~russian Закэшированная информация о созданных диалогах.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cached info about created packages.
		*
		*	@author Dodonov A.A.
		*/
		var					$Dialogs = array();
		
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
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->Utilities = get_package( 'utilities' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Компиляция контента.
		*
		*	@param $Settings - Параметры выборки.
		*
		*	@return array( $id , $DataSource , $Name ).
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Content compilation.
		*
		*	@param $Settings - Settings.
		*
		*	@return array( $id , $DataSource , $Name ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_dialog_parameters( &$Settings )
		{
			try
			{
				$id = md5( $Settings->get_setting( 'package_name' ).microtime( true ) );
				$DataSource = $Settings->get_setting( 'data_source' , $id );
				$Name = $Settings->get_setting( 'name' , $DataSource );
				
				return( array( $id , $DataSource , $Name ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Компиляция контента.
		*
		*	@param $Settings - Параметры выборки.
		*
		*	@return Скомпилированный контент диалога.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Content compilation.
		*
		*	@param $Settings - Settings.
		*
		*	@return Compiled dialog content.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	select_dialog_content( &$Settings )
		{
			try
			{
				list( $id , $DataSource , $Name ) = $this->get_dialog_parameters( $Settings );

				$Checked = 'checked';
				$Code = '';
				$Records = $this->Utilities->get_records( $Settings );
				foreach( $Records as $k => $v )
				{
					$PlaceHolders = array( '{checked}' , '{id}' , '{value}' , '{title}' );
					$id = $DataSource.get_field( $v , 'id' );
					$Data = array( $Checked , $id , get_field( $v , 'id' ) , get_field( $v , 'title' ) );
					$Code = $this->CachedMultyFS->get_template( __FILE__ , 'select_dialog_item.tpl' );
					$Code = str_replace( $PlaceHolders , $Data , $Code );
					$Checked = '';
				}

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>