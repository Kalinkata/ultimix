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
	*	\~russian Утилиты компоновки страниц.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Page composer utilities.
	*
	*	@author Dodonov A.A.
	*/
	class	page_file_1_0_0{

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
		*	\~russian Получение названия файла.
		*
		*	@param $Files - Массив файлов для объединения.
		*
		*	@return Название файла.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Getting file name.
		*
		*	@param $Files - Array of files to unite.
		*
		*	@return File name.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_file_name( $Files )
		{
			try
			{
				$FilesHash = implode( '' , $Files );

				foreach( $Files as $k2 => $v2 )
				{
					$FilesHash .= $v2;
				}

				//TODO: remove this package if it is not used anywere
				
				return( md5( implode( '' , $Files ) ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>