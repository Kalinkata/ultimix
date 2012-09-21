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
	*	\~russian Класс для управления компонентом.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english View.
	*
	*	@author Dodonov A.A.
	*/
	class	auto_view_1_0_0{
		
		/**
		*	\~russian Путь к пакету, который подменяется.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Path to the replacing package.
		*
		*	@author Dodonov A.A.
		*/
		var					$PackagePath;
		
		/**
		*	\~russian Результат работы функций отображения.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Display function's result.
		*
		*	@author Dodonov A.A.
		*/
		var					$Output;
		
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
		function			pre_generation( &$Options )
		{
			try
			{
				$PageJS = get_package( 'page::page_js' , 'last' , __FILE__ );
				$PackagePath = _get_package_relative_path_ex( 'page::auto_view' , '1.0.0' );
				$PageJS->add_javascript( "{http_host}/$PackagePath/include/js/auto_view.js" );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Сохранение пути к заменяемому пакету.
		*
		*	@param $thePackagePath - путь к пакету.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Setting path to the replacing path.
		*
		*	@param $thePackagePath - Path to the package.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_path( $thePackagePath )
		{
			try
			{
				$this->PackagePath = $thePackagePath;
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция отрисоки компонента.
		*
		*	@param $Options - настройки работы модуля.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws component.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			view( $Options )
		{
			try
			{
				$ContextSet = get_package_object( 'gui::context_set' , 'last' , $this->PackagePath );

				$ContextSet->execute( $Options , $this , $this->PackagePath );

				return( $this->Output );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>