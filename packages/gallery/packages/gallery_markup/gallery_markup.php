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
	*	\~english Class processes gallery macro.
	*
	*	@author Dodonov A.A.
	*/
	class	gallery_markup_1_0_0{
	
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
		var					$GalleryAccess = false;
		var					$GalleryAlgorithms = false;
		var					$Lin = falsek;
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
				$this->CachedMultyFS = get_package_object( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->GalleryAccess = get_package( 'gallery::gallery_access' , 'last' , __FILE__ );
				$this->GalleryAlgorithms = get_package( 'gallery::gallery_algorithms' , 'last' , __FILE__ );
				$this->Link = get_package( 'link' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian СОздание галереи
		*
		*	@param $MasterType - Тип объекта.
		*
		*	@param $MasterId - Id объекта.
		*
		*	@return Идентификатор галереи.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function creates gallery.
		*
		*	@param $MasterType - Object's type.
		*
		*	@param $MasterId - Object's id.
		*
		*	@return Gallery's id.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	create_dependent_gallery( $MasterType , $MasterId )
		{
			try
			{	
				$Gallery = array( 
					'title' => "gallery for $MasterType|id=$MasterId" , 
					'description' => "description for $MasterType|id=$MasterId" 
				);
				
				$id = $this->GalleryAccess->create( $Gallery );
				
				$this->Link->create_link( $MasterId , $id , $MasterType , 'gallery' );
					
				return( $id );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение идентфиикатора зависимой галереи. Если необходимо создать галерею, то она будет создана.
		*
		*	@param $BlockSettings - Параметры.
		*
		*	@return Идентификатор галереи.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns id of the dependent gallery. Gallery will be created if necessary.
		*
		*	@param $BlockSettings - Parameters.
		*
		*	@return Gallery's id.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_dependent_gallery_id( &$BlockSettings )
		{
			try
			{
				$MasterType = $BlockSettings->get_setting( 'master_type' );
				$MasterId = $BlockSettings->get_setting( 'master_id' );

				if( $this->Link->link_exists( $MasterId , false , $MasterType , 'gallery' ) )
				{
					$Link = $this->Link->get_links( $MasterId , false , $MasterType , 'gallery' );

					return( get_field( $Link[ 0 ] , 'object2_id' ) );
				}
				else
				{
					return( $this->create_dependent_gallery( $MasterType , $MasterId ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение объекта галереи. Если необходимо создать галерею, то она будет создана.
		*
		*	@param $BlockSettings - Параметры.
		*
		*	@return Объект галереи.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns gallery object. Gallery will be created if necessary.
		*
		*	@param $BlockSettings - Parameters.
		*
		*	@return Gallery object.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_gallery( &$BlockSettings )
		{
			try
			{
				if( $BlockSettings->get_setting( 'master_id' , false ) === false )
				{
					$id = $BlockSettings->get_setting( 'id' );
				}
				else
				{
					$id = $this->get_dependent_gallery_id( $BlockSettings );
				}
				
				return( $this->GalleryAlgorithms->get_by_id( $id ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение шаблона для клиента.
		*
		*	@param $FilePath - Путь к шаблону.
		*
		*	@param $GalleryId - Идентификатор галереи.
		*
		*	@return HTML код шаблона.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english GEtting template for the client.
		*
		*	@param $FilePath - Path to the template.
		*
		*	@param $GalleryId - Id of the gallery.
		*
		*	@return HTML code of the template.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_galery_template_for_client( $FilePath , $GalleryId )
		{
			try
			{
				$GalleryTemplate = $this->CachedMultyFS->file_get_contents( $FilePath );
				$GalleryTemplate = str_replace( '{gallery_id}' , $GalleryId , $GalleryTemplate );
				$GalleryTemplate = str_replace( '{id}' , '[id]' , $GalleryTemplate );
				$GalleryTemplate = str_replace( '{file_path}' , '[file_path]' , $GalleryTemplate );
				$GalleryTemplate = str_replace( '{original_file_name}' , '[original_file_name]' , $GalleryTemplate );
				$GalleryTemplate = str_replace( '{' , '[lfb]' , $GalleryTemplate );
				$GalleryTemplate = str_replace( '}' , '[rfb]' , $GalleryTemplate );
				
				return( $GalleryTemplate );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция компиляции галереи.
		*
		*	@param $Gallery - Объект галереи.
		*
		*	@param $Files - Файлы галереи.
		*
		*	@return Части галереи.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles gallery.
		*
		*	@param $Gallery - Gallery object.
		*
		*	@param $Files - Gallery files.
		*
		*	@return Gallery parts.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_gallery_parts( $Gallery , $Files )
		{
			try
			{
				$Code = '';
				$FilePath = dirname( __FILE__ ).'/res/templates/simple_file_list.tpl';
				$id = get_field( $Gallery , 'id' );
				foreach( $Files as $i => $File )
				{
					$Code .= $this->CachedMultyFS->file_get_contents( $FilePath );
					$Code  = $this->String->print_record( $Code , $File );
				}
				$Code  = str_replace( '{gallery_id}' , $id , $Code );
				
				$Input  = "{file_input:file_types=images;upload_url=gallery_upload.html?gallery_id[eq]{gallery_id};";
				$Input .= "upload_success_handler=ultimix_gallery_AfterImageUploadProcessor}";
				return( array( $Code , str_replace( '{gallery_id}' , $id , $Input ) ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция компиляции галереи.
		*
		*	@param $Gallery - Объект галереи.
		*
		*	@param $Files - Файлы галереи.
		*
		*	@return HTML код галереи.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles gallery.
		*
		*	@param $Gallery - Gallery object.
		*
		*	@param $Files - Gallery files.
		*
		*	@return HTML code of the gallery.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_gallery( $Gallery , $Files )
		{
			try
			{
				list( $Code , $Input ) = $this->compile_gallery_parts( $Gallery , $Files );

				$Template = $this->get_galery_template_for_client( $FilePath , $GalleryId );

				$Gallery = $this->CachedMultyFS->get_teplate( __FILE__ , 'gallery.tpl' );
				$PlaceHolders = array( '{code}' , '{gallery_template}' , '{input}' );
				$Gallery = str_replace( $PlaceHolders , array( $Code , $Template , $Input ) , $Gallery );
				$Gallery = str_replace( '{gallery_id}' , $GalleryId , $Gallery );
				
				return( $Template );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'gallery'.
		*
		*	@param $ProcessingString - Обрабатывемая строка.
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
		*	\~english Function processes macro 'gallery'.
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
		function			process_gallery( $ProcessingString , $Changed )
		{
			try
			{
				for( ; $MacroParameters = $this->String->get_macro_parameters( $ProcessingString , 'gallery' ) ; )
				{
					$this->BlockSettings->load_settings( $MacroParameters );
					$Gallery = $this->get_gallery( $this->BlockSettings );
					$Files = $this->GalleryAlgorithms->get_gallery_files( get_field( $Gallery , 'id' ) );
			
					$Code = $this->compile_gallery( $Gallery , $Files );
					
					$ProcessingString = str_replace( "{gallery:$MacroParameters}" , $Code , $ProcessingString );
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
		*	@param $ProcessingString - Щбрабатывемая строка.
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
				list( $ProcessingString , $Changed ) = $this->process_gallery( $ProcessingString , $Changed );
				
				return( $ProcessingString );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
?>