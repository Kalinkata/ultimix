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
		var					$BlockSettings = false;
		var					$CachedMultyFS = false;
		var					$FileInputAlgorithms = false;
		var					$PageComposer = false;
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
				$this->BlockSettings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->FileInputAlgorithms = get_package( 'file_input::file_input_algorithms' , 'last' , __FILE__ );
				$this->PageComposer = get_package( 'page::page_composer' , 'last' , __FILE__ );
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
		*	@param $Code - Component's HTML code.
		*
		*	@return Component's HTML code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	apply_upload_count( $Code )
		{
			try
			{
				if( $this->BlockSettings->get_setting( 'single_input' , false ) )
				{
					$Code = str_replace( '{file_upload_limit}' , 1 , $Code );
					$Code = str_replace( '{file_queue_limit}' , 1 , $Code );
				}
				else
				{
					$FileUploadLimit = $this->BlockSettings->get_setting( 'file_upload_limit' , 0 );
					$Code = str_replace( '{file_upload_limit}' , $FileUploadLimit , $Code );
					$FileQueueLimit = $this->BlockSettings->get_setting( 'file_queue_limit' , 0 );
					$Code = str_replace( '{file_queue_limit}' , $FileQueueLimit , $Code );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Установка ограничений на загрузку.
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
		function			apply_upload_limitations( $Code , $Name )
		{
			try
			{
				$Type = $this->BlockSettings->get_setting( 'file_types' , 'default' );
				list( $FileExtensions , $FileDescription ) = $this->FileInputAlgorithms->get_file_filters( $Type );
				
				$Code = str_replace( '{file_types}' , $FileExtensions , $Code );
				$Code = str_replace( '{file_types_description}' , $FileDescription , $Code );
				$FileSizeLimit = $this->BlockSettings->get_setting( 'file_size_limit' , '512 KB' );
				$Code = str_replace( '{file_size_limit}' , $FileSizeLimit , $Code );
				
				$Cocde = $this->apply_upload_count( $Code );
				
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
		*	@param $Code - Component's HTML code.
		*
		*	@return Component's HTML code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_event_handlers( $Code )
		{
			try
			{
				$UploadSuccess = $this->BlockSettings->get_setting( 'upload_success_handler' , 'uploadSuccess' );
				$Code = str_replace( '{upload_success_handler}' , $UploadSuccess , $Code );
				
				$UploadComplete = $this->BlockSettings->get_setting( 'upload_complete_handler' , 'uploadComplete' );
				$Code = str_replace( '{upload_complete_handler}' , $UploadComplete , $Code );
				
				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение данных и статуса.
		*
		*	@return Данные и статус.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns data and status.
		*
		*	@return Data and status.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_data_and_status()
		{
			try
			{
				$Name = $this->BlockSettings->get_setting( 'name' , 'file_input' );
				$Data = $this->Security->get_gp( 
					"$Name" , 'string' , $this->BlockSettings->get_setting( 'value' , '' )
				);
				$Status = $this->Security->get_gp(
					"visible_$Name" , 'string' , $this->BlockSettings->get_setting( 'visible_value' , '' )
				);
				
				return( array( $Data , $Status ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Компиляция формы отображения загруженного файла.
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
		*	@return Component's HTML code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_uploaded_file_code()
		{
			try
			{
				list( $Data , $Status ) = $this->get_data_and_status();
			
				$TemplatePath = dirname( __FILE__ ).'/res/templates/file_field.tpl';
				$UploadedFileCode = $this->CachedMultyFS->file_get_contents( $TemplatePath );			
				$UploadedFileCode = str_replace( "{data}" , $Data , $UploadedFileCode );
				$UploadedFileCode = str_replace( "{status}" , $Status , $UploadedFileCode );

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
		*	@return Код компонента.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles component.
		*
		*	@return Component's HTML code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_upload_file_component()
		{
			try
			{
				$TemplatePath = dirname( __FILE__ ).'/res/templates/file_input.tpl';
				$Code = $this->CachedMultyFS->file_get_contents( $TemplatePath );

				$Code = str_replace( '{uploaded_file_code}' , $this->get_uploaded_file_code() , $Code );

				$Url = $this->BlockSettings->get_setting( 'upload_url' );
				$Code = str_replace( '{upload_url}' , $Url , $Code );

				$Name = $this->BlockSettings->get_setting( 'name' , 'file_input' );
				$Code = $this->apply_upload_limitations( $Code , $Name );
				$Code = $this->set_event_handlers( $Code );

				$Code = str_replace( '{name}' , $Name , $Code );

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'file_input'.
		*
		*	@param $ProcessingString - Щбрабатывемая строка.
		*
		*	@param $Changed - Была ли осуществлена обработка.
		*
		*	@return array( $ProcessingString , $Changed ).
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'file_input'.
		*
		*	@param $ProcessingString - Processing string.
		*
		*	@param $Changed - Was the processing completed.
		*
		*	@return array( $ProcessingString , $Changed ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_file_input( $ProcessingString , $Changed )
		{
			try
			{
				$ProcessingString = str_replace( '{file_input}' , '{file_input:f=1}' , $ProcessingString );
				
				for( ; $MacroParameters = $this->String->get_macro_parameters( $ProcessingString , 'file_input' ) ; )
				{
					$this->BlockSettings->load_settings( $MacroParameters );
					
					$Code = $this->compile_upload_file_component();
					
					$ProcessingString = str_replace( "{file_input:$MacroParameters}" , $Code , $ProcessingString );
					$Changed = true;
				}
				
				return( array( $ProcessingString , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отвечающая за обработку строки.
		*
		*	@param $Options - Параметры отображения.
		*
		*	@param $ProcessingString - Обрабатывемая строка.
		*
		*	@param $Changed - Была ли осуществлена обработка.
		*
		*	@return HTML код для отображения.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes string.
		*
		*	@param $Options - Options of drawing.
		*
		*	@param $ProcessingString - Processing string.
		*
		*	@param $Changed - Was the processing completed.
		*
		*	@return HTML code to display.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_string( $Options , $ProcessingString , &$Changed )
		{
			try
			{
				list( $ProcessingString , $Changed ) = $this->process_file_input( $ProcessingString , $Changed );
				
				return( $ProcessingString );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
?>