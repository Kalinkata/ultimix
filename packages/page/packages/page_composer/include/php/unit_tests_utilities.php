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
	*	\~russian Проверка наличия html кода в php файле.
	*
	*	@param $FilePath - Путь к файлу.
	*
	*	@return Количество ошибок.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Testing html code presense in php file.
	*
	*	@param $FilePath - Path to the file.
	*
	*	@return Count of errors.
	*
	*	@author Dodonov A.A.
	*/
	function			find_html_content_in_file( $FilePath )
	{
		$Errors = 0;
		$FileContent = file( $FilePath );
		$Patterns = array( 
			'<table' , '<a' , '<div' , '<span' , '<td' , '<tr' , '<li' , '<ul' , '<select' , '</a>' , '</div>' , 
			'</span>' , '</select>' , '<script' , '<link' , '</ul>' , '</li>' , '<br>' , '<p>' , '<p ' , '<option'
		);
		
		for( $k = 0 ; $k < count( $FileContent ) ; $k++ )
		{
			for( $j = 0 ; $j < count( $Patterns ) ; $j++ )
			{
				if( strpos( $FileContent[ $k ] , $Patterns[ $j ] ) !== false )
				{
					$Errors++;
					print( "<nobr>$FilePath($k)</nobr><br>" );
					break;
				}
			}
		}
		
		return( $Errors );
	}

	/**
	*	\~russian Получение списка начал функций из файла.
	*
	*	@param $Content - Содержимое файла.
	*
	*	@return Курсоры начал функций.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function returns function entries from the file.
	*
	*	@param $Content - File content.
	*
	*	@return Function starts cursors.
	*
	*	@author Dodonov A.A.
	*/
	function			get_function_entries( $Content )
	{
		$Start = 0;
		$Entries = array();
		
		for( ; $Start !== false ; )
		{
			$Start = strpos( $Content , 'function' , $Start );
			
			if( $Start !== false )
			{
				$Entries [] = $Start;
				$Start += 8;
			}
		}
		
		return( $Entries );
	}
	
	/**
	*	\~russian Является ли буквой названия функции.
	*
	*	@param $Letter - Буква.
	*
	*	@return true/false.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Is a letter of the function name.
	*
	*	@param $Letter - Letter.
	*
	*	@return true/false.
	*
	*	@author Dodonov A.A.
	*/
	function			isalnum( $Letter )
	{
		if( ( $Letter >= 'a' && $Letter <= 'z' ) || ( $Letter >= 'A' && $Letter <= 'Z' ) || 
			( $Letter >= '0' && $Letter <= '9' ) || $Letter == '_' )
		{
			return( true );
		}
		
		return( false );
	}
	
	/**
	*	\~russian Получение названия функции.
	*
	*	@param $Content - Содержимое файла.
	*
	*	@param $Entry - Начало функции.
	*
	*	@return Название функции.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function returns method name.
	*
	*	@param $Content - File content.
	*
	*	@param $Entry - Function start.
	*
	*	@return Function name.
	*
	*	@author Dodonov A.A.
	*/
	function			get_func_name( $Content , $Entry )
	{
		$Length = strlen( $Content );
		$FunctionName = false;
		for( $i = $Entry + 8 ; $i < $Length ; $i++ )
		{
			if( $FunctionName === false && isalnum( $Content[ $i ] ) )
			{
				$FunctionName = $Content[ $i ];
				continue;
			}
			elseif( $FunctionName !== false && isalnum( $Content[ $i ] ) )
			{
				$FunctionName .= $Content[ $i ];
				continue;
			}
			elseif( $FunctionName !== false && isalnum( $Content[ $i ] ) === false )
			{
				return( $FunctionName );
			}
		}
		return( false );
	}
	
	/**
	*	\~russian Получение курсора начала тела функции.
	*
	*	@param $Content - Содержимое файла.
	*
	*	@param $Entry - Начало функции.
	*
	*	@return Курсор тела функции.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function returns method body cursor.
	*
	*	@param $Content - File content.
	*
	*	@param $Entry - Function start.
	*
	*	@return Function body start cursor.
	*
	*	@author Dodonov A.A.
	*/
	function			get_func_start( $Content , $Entry )
	{
		return( strpos( $Content , chr( 123 ) , $Entry ) );
	}
	
	/**
	*	\~russian Получение курсора начала тела функции.
	*
	*	@param $Content - Содержимое файла.
	*
	*	@param $Entry - Начало функции.
	*
	*	@return Курсор тела функции.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function returns method body cursor.
	*
	*	@param $Content - File content.
	*
	*	@param $Entry - Function start.
	*
	*	@return Function body start cursor.
	*
	*	@author Dodonov A.A.
	*/
	function			get_func_end( $Content , $Entry )
	{
		if( $Entry === false )
		{
			return( false );
		}

		$Length = strlen( $Content );
		$Counter = 1;

		for( $i = $Entry + 1 ; $i < $Length ; $i++ )
		{
			$Counter = $Content[ $i ] == '{' ? $Counter + 1 : $Counter;
			$Counter = $Content[ $i ] == '}' ? $Counter - 1 : $Counter;

			if( $Counter === 0 )
			{
				return( $i );
			}
		}
		
		return( false );
	}

	/**
	*	\~russian Получение списка тел функций.
	*
	*	@param $Content - Содержимое файла.
	*
	*	@return Тела функций.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function returns function bodies.
	*
	*	@param $Content - File content.
	*
	*	@return Function bodies.
	*
	*	@author Dodonov A.A.
	*/
	function			get_function_bodies( $Content )
	{
		$Entries = get_function_entries( $Content );
		$Bodies = array();

		foreach( $Entries as $i => $Entry )
		{
			$FunctionName = get_func_name( $Content , $Entry );
			$FunctionStart = get_func_start( $Content , $Entry );
			$FunctionEnd = get_func_end( $Content , $FunctionStart );

			if( $FunctionStart !== false && $FunctionEnd !== false )
			{
				$Bodies [ $FunctionName ] = substr( $Content , $FunctionStart , $FunctionEnd - $FunctionStart + 1 );
			}
		}

		return( $Bodies );
	}
	
	/**
	*	\~russian Получение количества строк.
	*
	*	@param $Content - Проверяемый контент.
	*
	*	@return Количество строк.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function returns count of lines.
	*
	*	@param $Content - Testing content.
	*
	*	@return Lines count.
	*
	*	@author Dodonov A.A.
	*/
	function			count_lines( $Content )
	{
		$Content = str_replace( "\r" , "\n" , $Content );
		
		$Content = str_replace( "\n\n" , "\n" , $Content );
		
		$Content = explode( "\n" , $Content );
		
		return( count( $Content ) );
	}

	/**
	*	\~russian Файлы, которые надо пропустить.
	*
	*	@return Файлы для пропуска.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Files to skip.
	*
	*	@return Files to skip.
	*
	*	@author Dodonov A.A.
	*/
	function			get_skip_files()
	{
		return(
			array( 
			'excel' , 'soap' , 'json.php' , 'xml_rpc' , 'jquery.layout.min.js' , 'jquery.jstree.js' , 
			'jquery.media.js' , '.en.js' , '.ru.js' , 'jquery.tree.xml_nested.js' , 'jquery.tree.xml_flat.js' , 
			'jquery.tree.themeroller.js' , 'jquery.tree.contextmenu.js' , 'sarissa.js' , 'jquery.jstree.js' , 
			'jquery.corner.js' , '.min.js' , 'disable.text.select.js' , 'dropdown.block.js' , 
			'jquery.jqGrid.min.js' , 'grid.locale-' , 'jquery.colorbox' , 'swfupload.js' , 'jquery.cookie.js' , 
			'packages/ckeditor/include/' , 'jquery.jstree.js' , 'jquery-1.7.1.min.js' , 'ui.datepicker-ru.js' , 
			'file_input_view/include/plugins/' , 'jstree/include/js/' , 'paginator3000.js' , '/tmp/' )
		);
	}

	/**
	*	\~russian Нужно ли пропустить файл.
	*
	*	@param $FilePath - Путь к файлу.
	*
	*	@return true/false.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Should the file be skipped.
	*
	*	@param $FilePath - Path to the file.
	*
	*	@return true/false.
	*
	*	@author Dodonov A.A.
	*/
	function			skip_file( $FilePath )
	{
		$Files = get_skip_files();

		foreach( $Files as $k => $v )
		{
			if( strpos( $FilePath , $v ) !== false )
			{
				return( true );
			}
		}

		return( false );
	}

?>