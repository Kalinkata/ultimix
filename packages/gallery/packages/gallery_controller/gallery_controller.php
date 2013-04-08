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
	*	\~russian Класс контроллера.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class of the controller.
	*
	*	@author Dodonov A.A.
	*/
	class	gallery_controller_1_0_0{
		
		/**
		*	\~russian Функция прикрепления файла к галерее.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function attaches file to the gallery.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			attach_file( $Options )
		{
			try
			{
				$FileInputController = get_package( 'file_input::file_input_controller' , 'last' , __FILE__ );
				
				if( $FileInputController->UploadedFile )
				{
					$Security = get_package( 'security' , 'last' , __FILE__ );
					$GalleryAlgorithms = get_package( 'gallery::gallery_algorithms' , 'last' , __FILE__ );
					
					$GalleryId = $Security->get_gp( 'gallery_id' , 'integer' );
					$FileId = get_field( $FileInputController->UploadedFile , 'id' );
					
					$GalleryAlgorithms->attach_file( $GalleryId , $FileId );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция удаления файла из галереи.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function detaches file from the gallery.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			detach_file( $Options )
		{
			try
			{
				$Security = get_package( 'security' , 'last' , __FILE__ );
				
				$GalleryId = $Security->get_gp( 'gallery_id' , 'integer' );
				$FileId = $Security->get_gp( 'file_id' , 'integer' );
				
				$GalleryAlgorithms = get_package( 'gallery::gallery_algorithms' , 'last' , __FILE__ );
				$GalleryAlgorithms->detach_file( $GalleryId , $FileId );
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
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function controls component.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			controller( &$Options )
		{
			try
			{
				$ContextSet = get_package( 'gui::context_set' , 'last' , __FILE__ );

				$ContextSet->add_context( dirname( __FILE__ ).'/conf/cfcx_gallery_attach_file' );

				$ContextSet->add_context( dirname( __FILE__ ).'/conf/cfcx_gallery_detach_file' );

				$ContextSet->execute( $Options , $this , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>