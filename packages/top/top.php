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
	*	\~russian Работа с топами.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Working with tops.
	*
	*	@author Dodonov A.A.
	*/
	class	top_1_0_0{
	
		/**
		*	\~russian Закешированные пакеты.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cached packages.
		*
		*	@author Dodonov A.A.
		*/
		var					$CachedMultyFS = false;
		var					$Database = false;
		var					$Security = false;
		var					$String = false;
		
		/**
		*	\~russian Результат работы функций отображения.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Display function's result.
		*
		*	@author Dodonov A.A.
		*/
		var					$Output = false;
	
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
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->Database = get_package( 'database' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция получения шаблонов.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@return Templates.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns templates.
		*
		*	@param $Options - Settings.
		*
		*	@return Templates.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_templates( $Options )
		{
			try
			{
				$DirPath = dirname( __FILE__ )."/res/templates/";
				
				$FileName = $Options->get_setting( 'header' , 'top_header' );
				$Header = $this->CachedMultyFS->file_get_contents( "$DirPath$FileName.tpl" );
				
				$FileName = $Options->get_setting( 'item' , 'top_item' );
				$Item = $this->CachedMultyFS->file_get_contents( "$DirPath$FileName.tpl" );
				
				$FileName = $Options->get_setting( 'footer' , 'top_footer' );
				$Footer = $this->CachedMultyFS->file_get_contents( "$DirPath$FileName.tpl" );
				
				return( array( $Header , $Item , $Footer ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция компиляции записей.
		*
		*	@param $Options - Настройки.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles records.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_records( &$Options )
		{
			try
			{
				$Query = $Options->get_setting( 'query' );
				$Records = $this->Database->query( $Query );
				$Records = $this->Database->fetch_results( $Records );
				foreach( $Records as $i => $Record )
				{
					set_field( $Record , 'row_number' , $i + 1 );
					$this->Output .= $this->String->print_record( $Item , $Record );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отрисовки конкретного топа.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws top.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			draw_top( &$Options )
		{
			try
			{
				$this->Output = '';
				$TopName = $this->Security->get_gp( 
					'top_name' , 'command' , $Options->get_setting( 'top_name' , 'undefined' )
				);
				$Options->append_file( dirname( __FILE__ )."/conf/cf_$TopName" );
				$Title = $Options->get_setting( 'title' , false );
				list( $Header , $Item , $Footer ) = $this->get_templates( $Options );

				$this->compile_records( &$Options );

				$this->Output = $Header.$this->Output.$Footer;
				if( $Title !== false )
				{
					$this->Output = "<h3>{lang:$Title}</h3>".$this->Output;
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отрисовки компонента.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@return HTML код компонента.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws component.
		*
		*	@param $Options - Settings.
		*
		*	@return HTML code of the component.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			view( &$Options )
		{
			try
			{
				$Context = get_package( 'gui::context' , 'last' , __FILE__ );
				
				$Context->load_config( dirname( __FILE__ ).'/conf/cfcx_top' );
				if( $Context->execute( $Options , $this ) )return( $this->Output );
				
				return( $this->Output );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
?>