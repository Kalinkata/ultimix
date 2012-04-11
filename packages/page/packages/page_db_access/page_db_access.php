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
	*	\~russian Класс для работы со страницами.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides access for data about pages.
	*
	*	@author Dodonov A.A.
	*/
	class	page_db_access_1_0_0{
	
		/**
		*	\~russian Дополнительные ограничения на рабочее множество данных.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~russian Additional limitations of the processing data.
		*
		*	@author Dodonov A.A.
		*/
		var					$AddLimitations = '1 = 1';
		
		/**
		*	\~russian Установка дополнительных ограничений.
		*
		*	@param $theAddLimitation - Дополнительные ограничения.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sets additional limitations.
		*
		*	@param $theAddLimitation - Additional limitations.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_add_limitations( $theAddLimitation )
		{
			try
			{
				if( $this->AddLimitations === '1 = 1' )
				{
					$this->AddLimitations = $theAddLimitation;
				}
				else
				{
					throw( new Exception( '"AddLimitations" was already set' ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	Выборка списка пакетов, применённых к странице $PageName.
		*
		*	@param $PageName - имя страницы, для которой выбирается информация о примененных пакетах.
		*
		*	@return Информация о примененных пакетах в формате array( array( 'package' , 'package_version' , 
		*	'options' , 'placeholder' ) )
		*
		*	@exception Exception - \~russian кидается иключение этого типа с описанием ошибки.
		*	\~english An exception of this type is thrown.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns all applied packages.
		*
		*	@param $PageName - page name.
		*
		*	@return Information about all applied packages wich is returned as a list of array( array( 'package' , 
		*	'package_version' , 'options' , 'placeholder' ) )
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	fetch_package_appliance( $PageName )
		{
			try
			{
				$RowPage = $this->CachedMultyFS->file_get_contents( 
					dirname( __FILE__ ).'/../page_access/data/pa_'.$PageName
				);

				$Appliance = array();

				foreach( $RowPage as $rp )
				{
					$Appliance [] = array( 
						'package' => $rp[ 0 ] , 'package_version' => $rp[ 1 ] , 
						'options' => $rp[ 2 ] , 'placeholder' => $rp[ 3 ]
					);
				}

				return( $Appliance );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	Выборка списка пакетов, применённых к странице $PageName.
		*
		*	@param $PageName - имя страницы, для которой выбирается информация о примененных пакетах.
		*
		*	@return Информация о примененных пакетах в формате array( array( 'package' , 'package_version' , 
		*	'options' , 'placeholder' ) )
		*
		*	@exception Exception - \~russian кидается иключение этого типа с описанием ошибки.
		*	\~english An exception of this type is thrown.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns all applied packages.
		*
		*	@param $PageName - page name.
		*
		*	@return Information about all applied packages wich is returned as a list of array( array( 'package' , 
		*	'package_version' , 'options' , 'placeholder' ) )
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_package_appliance( $PageName )
		{
			try
			{
				$Security = & get_package( 'security' );
				$PageName = $Security->get( $PageName , string );

				$PageName = htmlspecialchars( $PageName , ENT_QUOTES );

				if( file_exists( dirname( __FILE__ ).'/../page_access/data/pa_'.$PageName ) )
				{
					return( $this->fetch_package_appliance( $PageName ) );
				}

				return( array() );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Функция возвращает список путей к доступным страницам.
		*
		*	@return Список доступных страниц.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns list of paths to the available pages.
		*
		*	@return List of available pages.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_page_list()
		{
			try
			{
				$Utilities = get_package( 'utilities' , 'last' , __FILE__ );
				return( $Utilities->get_files_from_directory( dirname( __FILE__ ).'/data' , '/pa_.+/' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция возвращает описание запрошенной таблицы.
		*
		*	@param $PageName - имя запрашиваемой страницы.
		*
		*	@return Описание запрашиваемой странице в виде array( 0 => array( id , title , name , template , 
		*	template_version ) )
		*
		*	@note Все записи о страницах хранятся в отдельных файлах (каждая запись в 
		*	своем файле), имя страницы совпадает с именем файла. Конечно это не очень быстро работает, 
		*	но предполагается, что у сайтов без СУБД не будет много страниц, соответственно и тормозов будет 
		*	не очень много.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns description of the requested page.
		*
		*	@param $PageName - Name of the requested page.
		*
		*	@return Description of the requesting page in the folowing representation : array( 0 => array( id , 
		*	title , name , template , template_version ) )
		*
		*	@note All data about pages is stored in the stand alone files (each record in each own file),
		*	name of the page is the same as file name. We know that it works slowly but this CMS is used to apply for
		*	sites with small amount of pages so it would not work VERY slow)).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_page_description( $PageName )
		{
			try
			{
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>