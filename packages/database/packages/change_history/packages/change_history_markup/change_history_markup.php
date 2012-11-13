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
	*	\~russian Класс для сохранения изменений записей.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides records change history manupulation routine.
	*
	*	@author Dodonov A.A.
	*/
	class	change_history_markup_1_0_0{

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
		var					$ChangeHistoryView = false;

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
				$this->ChangeHistoryView = get_package( 
					'database::change_history::change_history_view' , 'last' , __FILE__
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение шаблона кнопки.
		*
		*	@param $BlockSettings - Параметры макроса.
		*
		*	@return Шаблон кнопки.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'history_button'.
		*
		*	@param $BlockSettings - Macro parameters.
		*
		*	@return Button template.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_button_template( &$BlockSettings )
		{
			try
			{
				switch( $BlockSettings->get_setting( 'type' , '' ) )
				{
					case( 'href' ):$FileName = 'href_history_button.tpl';break;

					default:$FileName = 'image_history_button_48.tpl';break;
				}

				return( $this->CachedMultyFS->get_template( __FILE__ , $FileName ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции истории.
		*
		*	@param $BlockSettings - Параметры генерации.
		*
		*	@return Скомпилированная история.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles history.
		*
		*	@param $BlockSettings - Parameters.
		*
		*	@return Compiled history.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_history_button( &$BlockSettings )
		{
			try
			{
				$id = $BlockSettings->get_setting( 'id' );
				$ObjectType = $BlockSettings->get_setting( 'object_type' );

				$Code = $this->ChangeHistoryView->get_changes_grid( $id , $ObjectType );
				$Code = $this->get_button_template( $BlockSettings ).$Code;

				$Code = str_replace( '{id}' , $id , $Code );

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>