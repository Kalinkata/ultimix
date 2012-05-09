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

	require_once( dirname( __FILE__ ).'/include/php/excel/writer.php' );
	
	/**
	*	\~russian Класс для подключения библиотеки excel_writer.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class loads excel_reader library.
	*
	*	@author Dodonov A.A.
	*/
	class	excel_writer_1_0_0{

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
		*	\~russian Получение объекта класса.
		*
		*	@param $Path - Путь к загружаемому файлу.
		*
		*	@return Объект клсса.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Function creates writer.
		*
		*	@param $Path - Path to the loading file.
		*
		*	@return Writer object.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_excel_writer( $Path = false )
		{
			try
			{
				if( $Path === false )
				{
					$Writer = new Spreadsheet_Excel_Writer();
				}
				else
				{
					$Writer = new Spreadsheet_Excel_Writer( $Path );
				}

				$Writer->setVersion( 8 );

				return( $Writer );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение содержимого файла.
		*
		*	@param $Excel - Файл.
		*
		*	@return Содержимое файла.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Function returns file content.
		*
		*	@param $Excel - File.
		*
		*	@return File content.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_as_string( &$Excel )
		{
			try
			{
				ob_start();

				$Excel->close();

				$Content = ob_get_contents();

				ob_end_clean();

				return( $Content );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>