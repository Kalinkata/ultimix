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
	*	\~russian Класс для работы с файлами.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides file access routine.
	*
	*	@author Dodonov A.A.
	*/
	class	simple_file_access_1_0_0{

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
		*	\~russian Получение содержимого загруженного файла.
		*
		*	@param $FieldName - Название поля.
		*
		*	@return Содержимое файла.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns content of the uploaded file.
		*
		*	@param $FieldName - Field name.
		*
		*	@return Content of the file.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_uploaded_file_content( $FieldName )
		{
			try
			{
				if( isset( $_FILES[ $FieldName ] ) )
				{
					$FilePath = $_FILES[ $FieldName ][ 'tmp_name' ];

					return( file_get_contents( $FilePath ) );
				}

				return( false );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>