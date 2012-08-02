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
	*	\~russian Класс для работы с рекламной системой Sape.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides integration with the Sape system.
	*
	*	@author Dodonov A.A.
	*/
	class	sape_1_0_0{

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
		var					$Settings = false;
		var					$String = false;

		/**
		*	\~russian Пользователь Sape.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Sape user.
		*
		*	@author Dodonov A.A.
		*/
		var					$SapeUser = false;

		/**
		*	\~russian Объект Sape для простых ссылок.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Sape object for common links.
		*
		*	@author Dodonov A.A.
		*/
		var					$SapeClient = false;

		/**
		*	\~russian Объект Sape для контекстных ссылок.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Sape object for context links.
		*
		*	@author Dodonov A.A.
		*/
		var					$SapeContext = false;

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
				$this->Settings = get_package_object( 'settings::package_settings' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );

				$this->SapeUser = $this->Settings->get_package_setting( 
					'sape' , 'last' , 'cf_sape' , 'sape_user' , false
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция предгенерационных действий.
		*
		*	@param $Options - настройки работы модуля.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function executes before any page generating actions took place.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			pre_generation( $Options )
		{
			try
			{
				require_once( "./$this->SapeUser/sape.php" );

				$Options['multi_site'] = true;
				$this->SapeClient = new SAPE_client( $Options );
				$this->SapeContext = new SAPE_context( $Options );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция, отвечающая за обработку строки.
		*
		*	@param $Settings - Обрабатывемая строка.
		*
		*	@return HTML код.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes string.
		*
		*	@param $Settings - Processing string.
		*
		*	@return HTML code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_sape_common_links( &$Settings )
		{
			try
			{
				$Count = $Settings->get_setting( 'count' , null );

				$Links = $this->SapeClient->return_links( $Count );

				return( $Links );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>