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
	*	\~english Controller.
	*
	*	@author Dodonov A.A.
	*/
	class	auto_controller_1_0_0{
		
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
		*	\~russian Сохранение пути к заменяемому пакету.
		*
		*	@param $thePackagePath - Путь к пакету.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
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
				$ContextSet = get_package_object( 'gui::context_set' , 'last' , $this->PackagePath );
				
				$ContextSet->execute( $Options , $this , $this->PackagePath );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>