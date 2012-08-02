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
	*	\~english Class provides macro processing.
	*
	*	@author Dodonov A.A.
	*/
	class		permit_buttons_1_0_0{

		/**
		*	\~russian Доступы пользователя.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Object permits.
		*
		*	@author Dodonov A.A.
		*/
		var					$Permits = array();

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
		var					$Database = false;
		var					$PermitAccess = false;
		var					$PermitAlgorithms = false;
		var					$Settings = false;
		var					$String = false;
		var					$UserAlgorithms = false;

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
				$this->Database = get_package( 'database' , 'last' , __FILE__ );
				$this->PermitAccess = get_package( 'permit::permit_access' , 'last' , __FILE__ );
				$this->PermitAlgorithms = get_package( 'permit::permit_algorithms' , 'last' , __FILE__ );
				$this->Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
				$this->UserAlgorithms = get_package( 'user::user_algorithms' , 'last' , __FILE__ );
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
					$Code = '{direct_controller:set_permit=1;delete_permit=1;toggle_permit=1'.
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
		*	\~russian Функция загрузки доступов.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function loads permits.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	load_permits()
		{
			try
			{
				$UserId = $this->UserAlgorithms->get_id();
				
				if( isset( $this->Permits[ $UserId ] ) === false )
				{
					$this->Permits[ $UserId ] = $this->PermitAlgorithms->get_permits_for_object( $UserId , 'user' );
				}
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
		*	@param $Type - Тип кнопки.
		*
		*	@return Код кнопки.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Button code compilation.
		*
		*	@param $Settings - Processing options.
		*
		*	@param $Type - Button type.
		*
		*	@return Button code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_permit_button( &$Settings , $Type )
		{
			try
			{
				$this->load_permits();

				list( $Text , $Group , $MasterId ) = $Settings->get_settings( 'text,group,master_id' );
				$MasterType = $Settings->get_setting( 'master_type' , 'user' );
				$CheckBoxes = $Settings->get_setting( 'checkboxes' , 'user' );

				$Code = $this->get_controller();
				$Code .= "{href:text=$Text;page=javascript:ultimix.permit.".$Type."PermitButton".
					"( '$Permit' , $MasterId , '$MasterType' , '$CheckBoxes' )}";

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
		*	@return Код кнопки.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Button code compilation.
		*
		*	@param $Settings - Processing options.
		*
		*	@return Button code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_set_permit_button( &$Settings )
		{
			try
			{
				return( $this->compile_permit_button( $Settings , 'Set' ) );
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
		*	@return Код кнопки.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Button code compilation.
		*
		*	@param $Settings - Processing options.
		*
		*	@return Button code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_delete_permit_button( &$Settings )
		{
			try
			{
				return( $this->compile_permit_button( $Settings , 'Delete' ) );
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
		*	@return Код кнопки.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Button code compilation.
		*
		*	@param $Settings - Processing options.
		*
		*	@return Button code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_toggle_permit_button( &$Settings )
		{
			try
			{
				return( $this->compile_permit_button( $Settings , 'Toggle' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>