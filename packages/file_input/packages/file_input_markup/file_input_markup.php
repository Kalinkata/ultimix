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
	*	\~english Class processes file_input macro.
	*
	*	@author Dodonov A.A.
	*/
	class	file_input_markup_1_0_0{
	
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
		var					$Settings = false;
		var					$CachedMultyFS = false;
		var					$FileInputAlgorithms = false;
		var					$Security = false;
		var					$String = false;

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
				$this->FileInputAlgorithms = get_package( 'file_input::file_input_algorithms' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Количество загружаемых файлов.
		*
		*	@param $Settings - Параметры компиляции.
		*
		*	@param $Code - Код компонента.
		*
		*	@return Код компонента.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Count of the uploading files.
		*
		*	@param $Settings - Compilation parameters.
		*
		*	@param $Code - Component's HTML code.
		*
		*	@return Component's HTML code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	apply_upload_count( &$Settings , $Code )
		{
			try
			{
				if( $Settings->get_setting( 'single_input' , false ) )
				{
					$Code = str_replace( '{file_upload_limit}' , 1 , $Code );
					$Code = str_replace( '{file_queue_limit}' , 1 , $Code );
				}
				else
				{
					$FileUploadLimit = $Settings->get_setting( 'file_upload_limit' , 1 );
					$Code = str_replace( '{file_upload_limit}' , $FileUploadLimit , $Code );
					$FileQueueLimit = $Settings->get_setting( 'file_queue_limit' , 1 );
					$Code = str_replace( '{file_queue_limit}' , $FileQueueLimit , $Code );
				}

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Установка ограничений на загрузку.
		*
		*	@param $Settings - Параметры компиляции.
		*
		*	@param $Code - Код компонента.
		*
		*	@param $Name - Название компонента.
		*
		*	@return Код компонента.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Setting upload limitations.
		*
		*	@param $Settings - Compilation parameters.
		*
		*	@param $Code - Component's HTML code.
		*
		*	@param $Name - Component's name.
		*
		*	@return Component's HTML code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	apply_upload_limitations( &$Settings , $Code , $Name )
		{
			try
			{
				$Type = $Settings->get_setting( 'file_types' , 'default' );
				list( $FileExtensions , $FileDescription ) = $this->FileInputAlgorithms->get_file_filters( $Type );
				
				$Code = str_replace( '{file_types}' , $FileExtensions , $Code );
				$Code = str_replace( '{file_types_description}' , $FileDescription , $Code );
				$FileSizeLimit = $Settings->get_setting( 'file_size_limit' , '512 KB' );
				$Code = str_replace( '{file_size_limit}' , $FileSizeLimit , $Code );
				
				$Code = $this->apply_upload_count( $Settings , $Code );
				
				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Установка обработчиков событий.
		*
		*	@param $Settings - Параметры компиляции.
		*
		*	@param $Code - Код компонента.
		*
		*	@return Код компонента.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Setting event handlers.
		*
		*	@param $Settings - Compilation parameters.
		*
		*	@param $Code - Component's HTML code.
		*
		*	@return Component's HTML code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	set_event_handlers( &$Settings , $Code )
		{
			try
			{
				$UploadSuccess = $Settings->get_setting( 'upload_success_handler' , 'uploadSuccess' );
				$Code = str_replace( '{upload_success_handler}' , $UploadSuccess , $Code );
				
				$UploadComplete = $Settings->get_setting( 'upload_complete_handler' , 'uploadComplete' );
				$Code = str_replace( '{upload_complete_handler}' , $UploadComplete , $Code );
				
				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Компиляция формы отображения загруженного файла.
		*
		*	@param $Settings - Параметры компиляции.
		*
		*	@return Код компонента.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles uploaded file form.
		*
		*	@param $Settings - Compilation parameters.
		*
		*	@return Component's HTML code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_uploaded_file_code( &$Settings )
		{
			try
			{
				$TemplatePath = dirname( __FILE__ ).'/res/templates/file_field.tpl';

				$UploadedFileCode = $this->CachedMultyFS->file_get_contents( $TemplatePath );			

				$UploadedFileCode = $this->String->print_record( $UploadedFileCode , $Settings->get_raw_settings() );

				return( $UploadedFileCode );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Компиляция компонента.
		*
		*	@param $Settings - Параметры компиляции.
		*
		*	@return Код компонента.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles component.
		*
		*	@param $Settings - Compilation parameters.
		*
		*	@return Component's HTML code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_file_input( &$Settings )
		{
			try
			{
				$TemplatePath = dirname( __FILE__ ).'/res/templates/file_input.tpl';
				$Code = $this->CachedMultyFS->file_get_contents( $TemplatePath );

				$Code = str_replace( 
					'{uploaded_file_code}' , $this->get_uploaded_file_code( $Settings ) , $Code
				);

				$Url = $Settings->get_setting( 'upload_url' );

				$Name = $Settings->get_setting( 'name' , 'file_input' );
				$Code = $this->apply_upload_limitations( $Settings , $Code , $Name );
				$Code = $this->set_event_handlers( $Settings , $Code );

				$Code = str_replace( array( '{name}' , '{upload_url}' ) , array( $Name , $Url ) , $Code );

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
?>