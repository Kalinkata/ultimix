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
	*	\~russian Класс для обработки страниц с учетом доступов.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides permits dependent visualisation.
	*
	*	@author Dodonov A.A.
	*/
	class		group_buttons_1_0_0{

		/**
		*	\~russian Закешированные объекты.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cached objects.
		*
		*	@author Dodonov A.A.
		*/
		var					$CachedMultyFS = false;
		var					$String = false;

		/**
		*	\~russian Добавлен ли контроллер.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Was the controller added.
		*
		*	@author Dodonov A.A.
		*/
		var					$ControllerWasAdded = false;

		/**
		*	\~russian Конструктор.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Constructor.
		*
		*	@author Dodonov A.A.
		*/
		function			__construct()
		{
			try
			{
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Создание вызова контроллера.
		*
		*	@return Скрипт вызова контроллера.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function creates controller call.
		*
		*	@return Script with the controller call.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_controller()
		{
			try
			{
				$Code = '';

				if( $this->ControllerWasAdded === false )
				{
					$Code = '{direct_controller:set_group=1;delete_group=1;toggle_group=1;'.
							'package_name=permit::permit_controller}';

					$this->ControllerWasAdded = true;
				}

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Компиляция кнопки.
		*
		*	@param $Settings - Параметры обработки.
		*
		*	@return Кнопка.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles button.
		*
		*	@param $Settings - Processing options.
		*
		*	@return Button.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_group_button( &$Settings , $Name )
		{
			try
			{
				list( $Text , $Group , $MasterId ) = $Settings->get_settings( 'text,group,master_id' );
				$MasterType = $Settings->get_setting( 'master_type' , 'user' );
				$CheckBoxes = $Settings->get_setting( 'checkboxes' , 'user' );

				$Code = $this->get_controller();
				$Code .= "{href:text=$Text;page=javascript:ultimix.permit.".$Name."GroupButton".
					"( '$Group' , $MasterId , '$MasterType' , '$CheckBoxes' )}";

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Компиляция кнопки.
		*
		*	@param $Settings - Параметры обработки.
		*
		*	@return Кнопка.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles button.
		*
		*	@param $Settings - Processing options.
		*
		*	@return Button.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_set_group_button( &$Settings )
		{
			try
			{
				return( $this->compile_group_button( $Settings , 'Set' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Компиляция кнопки.
		*
		*	@param $Settings - Параметры обработки.
		*
		*	@return Кнопка.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles button.
		*
		*	@param $Settings - Processing options.
		*
		*	@return Button.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_delete_group_button( &$Settings )
		{
			try
			{
				return( $this->compile_group_button( $Settings , 'Delete' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Компиляция кнопки.
		*
		*	@param $Settings - Параметры обработки.
		*
		*	@return Кнопка.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles button.
		*
		*	@param $Settings - Processing options.
		*
		*	@return Button.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_toggle_group_button( &$Settings )
		{
			try
			{
				return( $this->compile_group_button( $Settings , 'Toggle' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>