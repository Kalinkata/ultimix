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
	*	\~russian Класс обработки загрузок файлов.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class processes file uploads.
	*
	*	@author Dodonov A.A.
	*/
	class	file_input_controller_1_0_0{

		/**
		*	\~russian Последний загруженный файл.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Last uploaded file.
		*
		*	@author Dodonov A.A.
		*/
		var					$UploadedFile = false;

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
		var					$FileInputAlgorithms = false;
		var					$Security = false;

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
				$this->FileInputAlgorithms = get_package( 'file_input::file_input_algorithms' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция сохранения загруженных данных.
		*
		*	@param $SavePath - Путь куда сохраняем файл.
		*
		*	@param $FileName - Новое имя файла.
		*
		*	@param $OriginalFileName - Оригинальное имя файла.
		*
		*	@return Идентификатор загружнного файла.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns a list of the uploading files.
		*
		*	@param $SavePath - Destination path.
		*
		*	@param $FileName - New file name.
		*
		*	@param $OriginalFileName - Original file name.
		*
		*	@return id of the uploaded file.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			save_uploaded_file( $SavePath , $FileName , $OriginalFileName )
		{
			try
			{
				$FileInputAccess = get_package( 'file_input::file_input_access' , 'last' , __FILE__ );

				$Record = array( 'file_path' => $SavePath.$FileName , 'original_file_name' => $OriginalFileName );
				$id = $FileInputAccess->create( $Record );

				$EventManager = get_package( 'event_manager' , 'last' , __FILE__ );
				$EventManager->trigger_event( 'on_load_file' , array( 'id' => $id ) );

				$Record[ 'id' ] = $id;
				$FileInputAlgorithms = get_package( 'file_input::file_input_algorithms' , 'last' , __FILE__ );
				$this->UploadedFile = $Record;

				return( $id );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция отображения информации для клиента.
		*
		*	@param $SavePath - Путь куда сохраняем файл.
		*
		*	@param $FileId - Идентификатор загруженного файла.
		*
		*	@param $OriginalFileName - Имя загруженного файла.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function displays data for client.
		*
		*	@param $SavePath - Destination path.
		*
		*	@param $FileId - id of the uploaded file.
		*
		*	@param $OriginalFileName - Name of the uploaded file.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			display_file_info( $SavePath , $FileId , $OriginalFileName )
		{
			try
			{
				$ServerData = new stdClass;
				set_field( $ServerData , 'href' , $SavePath );
				set_field( $ServerData , 'id' , $FileId );
				set_field( $ServerData , 'original_file_name' , $OriginalFileName );

				$JSON = get_package( 'json' , 'last' , __FILE__ );
				print_r( $JSON->encode( $ServerData ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Обработка запроса.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@return array( $save_path , $file_name , $original_file_name ).
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes request.
		*
		*	@param $Options - Settings.
		*
		*	@return array( $save_path , $file_name , $original_file_name ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			handle_request( &$Options )
		{
			try
			{
				global	$extension_whitelist;
				$extension_whitelist = $this->FileInputAlgorithms->get_extensions( 
					$Options->get_setting( 'file_types' , 'default' )
				);

				$PackagePath = _get_package_relative_path_ex( 'file_input::file_input_controller' , '1.0.0' );
				$DirectoryPath = $PackagePath.'/data/'.date( 'Ymd' );
				@mkdir_ex( $DirectoryPath );

				global	$save_path;
				$save_path = $DirectoryPath.'/';
				global 	$file_name;
				global 	$original_file_name;
				define( 'NO_DIRECT_CALL' , 1 );
				require_once( $PackagePath.'/include/php/upload.php' );

				return( array( $save_path , $file_name , $original_file_name ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Загрузка файлов.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function uploads file.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			upload_file( &$Options )
		{
			try
			{
				list( $save_path , $file_name , $original_file_name ) = $this->handle_request( $Options );

				$id = $this->save_uploaded_file( $save_path , $file_name , $original_file_name );

				$VarName = $this->Security->get_gp( 'page_name' , 'command' ).'_file';
				if( $Options->get_setting( 'var_name' , false ) !== false )
				{
					$VarName = $Options->get_setting( 'var_name' );
				}
				/* saving info in the session */
				$this->Security->set_s( $VarName , $id );

				$this->display_file_info( $save_path."$file_name" , $id , $original_file_name );
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
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Component's controller.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			controller( $Options )
		{
			try
			{
				$UploadFile = $Options->get_setting( 'upload_file' , false );
				$NotDirectControllerCall = $this->Security->get_s( 'direct_controller' , 'integer' , 0 ) == 0;

				if( $UploadFile && $NotDirectControllerCall && count( $_FILES ) )
				{
					$this->upload_file( $Options );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>