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

	require_once( dirname( __FILE__ ).'/include/php/excel_reader2.php' );
	
	/**
	*	\~russian Класс для подключения библиотеки excel_reader.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class loads excel_reader library.
	*
	*	@author Dodonov A.A.
	*/
	class	excel_reader_1_0_0{

		/**
		*	\~russian Конструктор.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Constructor.
		*
		*	@exception Exception - An exception of this type is thrown.
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
		*	\~russian Получение ридера.
		*
		*	@param $Path - Путь к загружаемому файлу.
		*
		*	@return Объект ридера.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Function creates reader.
		*
		*	@param $Path - Path to the loading file.
		*
		*	@return Reader object.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_excel_reader( $Path )
		{
			try
			{
				return( new Spreadsheet_Excel_Reader( $Path ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>