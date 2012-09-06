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
	*	\~russian Класс утилит.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class with context_set utilities.
	*
	*	@author Dodonov A.A.
	*/
	class	context_set_utilities_1_0_0{

		/**
		*	\~russian Закешированные пакеты.
		*
		*	@author Dodonov A.A.
		*/
		/**
		*	\~english Cached packages.
		*
		*	@author Dodonov A.A.
		*/
		var					$BlockSettings = false;
		var					$CachedMultyFS = false;
		var					$PageComposer = false;
		var					$Security = false;
		var					$SecurityParser = false;
		var					$SecurityUtilities = false;
		var					$String = false;
		var					$Trace = false;

		/**
		*	\~russian Конструктор.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
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
				$this->PageComposer = get_package( 'page::page_composer' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->SecurityParser = get_package( 'security::security_parser' , 'last' , __FILE__ );
				$this->SecurityUtilities = get_package( 'security::security_utilities' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
				$this->Trace = get_package( 'trace' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция инициализации шаблона грида.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@param $Paging - Объект грида.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function inits grid template.
		*
		*	@param $Options - Execution parameters.
		*
		*	@param $Paging - Grid object.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_header_template( $Options , &$Paging , $Prefix )
		{
			try
			{
				$FileName = $Options->get_setting( 'header' , $Prefix.'_header.tpl' );
				$Path = dirname( $Options->get_setting( 'file_path' ) )."/res/templates/$FileName";
				$Header = $this->CachedMultyFS->file_get_contents( $Path );

				$Paging->set( 'Header' , $Header );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция инициализации шаблона грида.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@param $Paging - Объект грида.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function inits grid template.
		*
		*	@param $Options - Execution parameters.
		*
		*	@param $Paging - Grid object.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_item_template( $Options , &$Paging , $Prefix )
		{
			try
			{
				$FileName = $Options->get_setting( 'item' , $Prefix.'_item.tpl' );
				$Path = dirname( $Options->get_setting( 'file_path' ) )."/res/templates/$FileName";
				$Item = $this->CachedMultyFS->file_get_contents( $Path );
				
				$Paging->set( 'ItemTemplate' , $Item );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Функция инициализации грида.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@param $Paging - Объект грида.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function inits grid.
		*
		*	@param $Options - Execution parameters.
		*
		*	@param $Paging - Grid object.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_no_data_found_message( $Options , &$Paging )
		{
			try
			{
				if( $FileName = $Options->get_setting( 'no_data_found_message' , false ) )
				{
					$Path = dirname( $Options->get_setting( 'file_path' ) )."/res/templates/$FileName";
				}
				else
				{
					$Path = dirname( __FILE__ )."/res/templates/default_no_data_found_message.tpl";
				}

				$NoDataFoundTemplate = $this->CachedMultyFS->file_get_contents( $Path );
				
				$Paging->set( 'NoDataFoundMessage' , $NoDataFoundTemplate );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Функция инициализации шаблона грида.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@param $Paging - Объект грида.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function inits grid template.
		*
		*	@param $Options - Execution parameters.
		*
		*	@param $Paging - Grid object.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_footer_template( $Options , &$Paging , $Prefix )
		{
			try
			{
				$FileName = $Options->get_setting( 'footer' , $Prefix.'_footer.tpl' );
				$Path = dirname( $Options->get_setting( 'file_path' ) )."/res/templates/$FileName";
				$Footer = $this->CachedMultyFS->file_get_contents( $Path );

				$Paging->set( 'Footer' , $Footer );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция инициализации основных настроек грида.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@param $Paging - Объект грида.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function inits grid's main settings.
		*
		*	@param $Options - Execution parameters.
		*
		*	@param $Paging - Grid object.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_main_settings( $Options , &$Paging )
		{
			try
			{
				$Paging->set( 'RecordsPerPage' , $Options->get_setting( 'records_per_page' , 20 ) );
				
				$Paging->set( 'PageField' , $Options->get_setting( 'page_field' , 'page' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Функция возвращает записи из БД.
		*
		*	@param $Options - Настройки выполнения.
		*
		*	@param $IdList - Список идентификаторов.
		*
		*	@return Объект.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns records from the DB.
		*
		*	@param $Options - Execution parameters.
		*
		*	@param $IdList - List of identificators.
		*
		*	@return Object.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_original_records( &$Options , $IdList )
		{
			try
			{
				$Provider = $this->get_data_provider( $Options , $this->Provider );
				
				if( method_exists( $Provider , 'select_list' ) === false )
				{
					$ClassName = $Provider ? get_class( $Provider ) : 'undefined_class';
					throw( new Exception( 'Method "select_list" was not found in the class "'.$ClassName."'" ) );
				}
				
				$Records = call_user_func( array( $Provider , 'select_list' ) , implode( ',' , $IdList ) );

				return( $Records );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Функция возвращает суперпозицию записей.
		*
		*	@param $Options - Настройки выполнения.
		*
		*	@param $IdList - Список идентификаторов.
		*
		*	@return Объект.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns superposition of the records.
		*
		*	@param $Options - Execution parameters.
		*
		*	@param $IdList - List of identificators.
		*
		*	@return Object.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_data_record( &$Options , $IdList )
		{
			try
			{
				$Records = $this->get_original_records( $Options , $IdList );
				
				$Record = $Records[ 0 ];
				
				if( intval( $Options->get_setting( 'massive_processing' , 1 ) ) )
				{
					$c = count( $Records );
					for( $i = 1 ; $i < $c ; $i++ )
					{
						foreach( $Records[ $i ] as $k => $v )
						{
							if( get_field( $Record , $k ) !== $v )
							{
								set_field( $Record , $k , false );
							}
						}
					}
				}
				
				return( $Record );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция выборки идентификаторов из запроса.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@param $Record - Запись, которая будет дополнена данными из запроса.
		*
		*	@param $SettingName - Название настройки со скриптом выборки.
		*
		*	@param $Prefix - Префикс сущности.
		*
		*	@return Строка со списком идентификаторов.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function fetches id' from the request.
		*
		*	@param $Options - Execution parameters.
		*
		*	@param $Record - This record will be extended with the data from request.
		*
		*	@param $SettingName - Setting name with the extraction script.
		*
		*	@param $Prefix - Entity prefix.
		*
		*	@return String with id list.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			extract_data_from_request( &$Options , $Record , $SettingName , $Prefix )
		{
			try
			{
				if( $Options->get_setting( $SettingName , false ) )
				{
					$Parameter = $Options->get_setting( $SettingName );
					$PostedRecord = $this->SecurityParser->parse_http_parameters( $Parameter );
					
					foreach( $PostedRecord as $k => $v )
					{
						$k = str_replace( $Prefix.'_' , '' , $k );
						
						if( $v !== false )
						{
							set_field( $Record , $k , $v );
						}
					}
				}
				
				return( $Record );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Функция возвращает объект доступа к данным.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@param $DefaultProvider - Дефолтовый объект доступа к данным.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns data access object.
		*
		*	@param $Options - Execution parameters.
		*
		*	@param $DefaultProvider - Default data access object.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_data_provider( &$Options , &$DefaultProvider )
		{
			try
			{
				if( $Options->get_setting( 'access_package_name' , false ) )
				{
					$PackageName = $Options->get_setting( 'access_package_name' );
					$PackageVersion = $Options->get_setting( 'access_package_version' , 'last' );
					
					return( get_package( $PackageName , $PackageVersion , __FILE__ ) );
				}
				else
				{
					return( $DefaultProvider );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Получение идентификаторов записей.
		*
		*	@param $Prefix - Префикс сущности.
		*
		*	@return Идентификаторы выбранных записей.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns id's of the selected records.
		*
		*	@param $Prefix - Entity prefix.
		*
		*	@return Identificators of the selected records.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_posted_ids( $Prefix )
		{
			try
			{
				if( $this->Security->get_gp( $Prefix.'_record_id' , 'command' , false ) !== false && 
					$this->Security->get_gp( $Prefix.'_record_id' , 'command' ) != -1 )
				{
					$Ids = array( $this->Security->get_gp( $Prefix.'_record_id' , 'command' ) );
				}
				else
				{
					$Mode = POST | PREFIX_NAME | KEYS;
					$Ids = $this->SecurityUtilities->get_global( '_id_' , 'string' , $Mode , array() );
				}
				
				return( $Ids );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения значений формы.
		*
		*	@param $Settings - Параметры.
		*
		*	@param $Data - Запись с обрабатываемыми данными.
		*
		*	@return Значение поля формы.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns form value.
		*
		*	@param $Settings - Parameters.
		*
		*	@param $Data - Record with processing data.
		*
		*	@return Form field value.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_form_value( &$Settings , $Data )
		{
			try
			{
				$Name = $Settings->get_setting( 'name' );
				$Type = $Settings->get_setting( 'type' , 'string' );
				
				if( $this->Security->get_gp( $Name , 'set' ) )
				{
					$Value = $this->Security->get_gp( $Name , $Type );
				}
				else
				{
					$Value = get_field( $Data , $Name , '' );
				}

				if( is_array( $Value ) )
				{
					$Value = serialize( $Value );
					$Value = $this->Security->get( $Value , 'string' );
				}
				
				return( $Value );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция подстановки данных в форму.
		*
		*	@param $Form - Код формы.
		*
		*	@param $Data - Запись с обрабатываемыми данными.
		*
		*	@return Код формы.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sets data in the form.
		*
		*	@param $Form - Form's code.
		*
		*	@param $Data - Record with processing data.
		*
		*	@return Form's code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_form_data( $Form , $Data )
		{
			try
			{
				for( ; $Parameters = $this->String->get_macro_parameters( $Form , 'form_value' ) ; )
				{
					$this->BlockSettings->load_settings( $Parameters );
					$FormValue = $this->get_form_value( $this->BlockSettings , $Data );
					$Form = str_replace( "{form_value:$Parameters}" , $FormValue , $Form );
				}

				$Form = $this->String->print_record( $Form , $Data );
				foreach( $Data as $k => $v )
				{
					if( is_array( $v ) === false && is_object( $v ) === false )
					{
						$Form = str_replace( '{'.$k.'_original}' , $v , $Form );
					}
				}

				return( $Form );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция установка пакета выборки данных.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@param $Paging - Объект грида.
		*
		*	@param $QueryString - Строка поискового запроса.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sets data accessor.
		*
		*	@param $Options - Execution parameters.
		*
		*	@param $Paging - Grid object.
		*
		*	@param $QueryString - Query string.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	set_data_accessor( $Options , &$Paging , $QueryString = '1 = 1' )
		{
			try
			{
				$PackageName = $Options->get_setting( 'access_package_name' );
				$PackageVersion = $Options->get_setting( 'access_package_version' , 'last' );
				$Method = $Options->get_setting( 'select_func' , 'select' );

				$this->Trace->add_trace_string( 
					"{lang:data_accessor} : $PackageName.$PackageVersion->$Method" , COMMON
				);

				$Paging->set( 'DataAccessor' , create_function( '$Start , $Limit , $Field , $Order , $Options' , 
					"\$Object = get_package( '$PackageName' , '$PackageVersion' , __FILE__ );
					return( \$Object->$Method( \$Start , \$Limit , \$Field , \$Order , 
					\"$QueryString\" , \$Options ) );" ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция инициализации данных грида.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@param $Paging - Объект грида.
		*
		*	@param $QueryString - Строка поискового запроса.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function inits grid's data.
		*
		*	@param $Options - Execution parameters.
		*
		*	@param $Paging - Grid object.
		*
		*	@param $QueryString - Query string.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_grid_data( $Options , &$Paging , $QueryString = '1 = 1' )
		{
			try
			{
				$this->set_data_accessor( $Options , $Paging , $QueryString );
				
				if( $Options->get_setting( 'draw_package_name' , false ) )
				{
					$DrawPackageName = $Options->get_setting( 'draw_package_name' );
					$DrawPackageVersion = $Options->get_setting( 'draw_package_version' , 'last' );
					$DrawFunction = $Options->get_setting( 'draw_func' , 'select' );
					
					$Paging->set( 'CallbackFunc' , create_function( '$Template , $Record' , 
						"\$Object = get_package( '$DrawPackageName' , '$DrawPackageVersion' , __FILE__ );
						return( \$Object->$DrawFunction( \$Template , \$Record ) );" ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция получения шаблона формы.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@param $IdList - Список идентификтаоров обрабатываемых записей.
		*
		*	@param $FormFileName - Файл с шаблоном формы.
		*
		*	@param $Prefix - Префикс сущности.
		*
		*	@param $State - Стейт.
		*
		*	@return Код формы.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns form's template.
		*
		*	@param $Options - Execution parameters.
		*
		*	@param $IdList - Ids of the processing records.
		*
		*	@param $FormFileName - Form template file.
		*
		*	@param $Prefix - Entity prefix.
		*
		*	@param $State - Стейт.
		*
		*	@return Form's code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_form( &$Options , $IdList , $FormFileName , $Prefix , $State )
		{
			try
			{
				$FormFileName = $Options->get_setting( 'form_template' , $FormFileName );
				$FormFilePath = dirname( $Options->get_setting( 'file_path' ) )."/res/templates/$FormFileName.tpl";
				$Form = $this->CachedMultyFS->file_get_contents( $FormFilePath );
				$Form = str_replace( '{prefix}' , $Prefix , $Form );
				$Form = str_replace( '{state}' , $State , $Form );
				$Form = str_replace( '{ids}' , implode( ',' , $IdList ) , $Form );

				return( $Form );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>