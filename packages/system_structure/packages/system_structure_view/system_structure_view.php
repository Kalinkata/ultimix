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
	*	\~russian Класс для управления отображением компонента.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english This class provides component visualisation routine.
	*
	*	@author Dodonov A.A.
	*/
	class	system_structure_view_1_0_0{
		
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
		var					$Output;
		
		/**
		*	\~russian Закешированные объекты.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cached objects.
		*
		*	@author Dodonov A.A.
		*/
		var					$Cache = false;
		var					$CachedMultyFS = false;
		var					$Security = false;
		var					$Settings = false;
		var					$PageAccess = false;
		var					$String = false;
		
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
				$this->Cache = get_package( 'cache' , 'last' , __FILE__ );
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->Settings = get_package( 'settings::package_settings' , 'last' , __FILE__ );
				$this->PageAccess = get_package( 'page::page_access' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция выборки корня карты.
		*
		*	@param $Items - Элементы карты.
		*
		*	@return Корневой элемент или false в случае ошибки.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns root of the map.
		*
		*	@param $Items - Map items.
		*
		*	@return Root item or false.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_root_item( $Items )
		{
			try
			{
				foreach( $Items as $i => $v )
				{
					if( $v->page == $v->root_page )
					{
						return( $v );
					}
				}
				
				return( false );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция выборки корневого элемента.
		*
		*	@param $MainItem - Элемент.
		*
		*	@param $Items - Элементы карты.
		*
		*	@return Корневой элемент.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns root item.
		*
		*	@param $MainItem - Item.
		*
		*	@param $Items - Map items.
		*
		*	@return Root item.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_prev_item( $MainItem , $Items )
		{
			try
			{
				foreach( $Items as $i => $v )
				{
					if( $v->page == $MainItem->root_page )
					{
						return( $v );
					}
				}
				
				return( false );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция выборки элемента.
		*
		*	@param $Page - Страница.
		*
		*	@param $Items - Элементы карты.
		*
		*	@return Элемент.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns item.
		*
		*	@param $Page - Page.
		*
		*	@param $Items - Map items.
		*
		*	@return Item.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_item( $Page , $Items )
		{
			try
			{
				foreach( $Items as $i => $v )
				{
					if( $v->page == $Page )
					{
						return( $v );
					}
				}
				
				return( false );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция компиляции одного уровня.
		*
		*	@param $Map - Часть карты.
		*
		*	@param $RootItem - Корневой элемент.
		*
		*	@param $Items - Элементы карты.
		*
		*	@return Map.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles single level of the map.
		*
		*	@param $Map - Map's part.
		*
		*	@param $RootItem - Root item.
		*
		*	@param $Items - Map items.
		*
		*	@return Map.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_map_items( $Map , $RootItem , $Items )
		{
			try
			{
				$MapPart = '';
				
				foreach( $Items as $i )
				{
					if( $i->root_page == $RootItem->page && $i->root_page != $i->page )
					{
						if( $MapPart === '' )
						{
							$MapPart .= $this->CachedMultyFS->get_template( __FILE__ , 'map_start.tpl' );
						}
						$MapPart .= $this->compile_map( $i , $Items );
					}
				}
				
				if( $MapPart !== '' )
				{
					$MapPart .= $this->CachedMultyFS->get_template( __FILE__ , 'map_end.tpl' );
				}
				
				return( $MapPart );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция компиляции карты.
		*
		*	@param $RootItem - Корневой элемент.
		*
		*	@param $Items - Элементы карты.
		*
		*	@return Карта.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles map.
		*
		*	@param $RootItem - Root item.
		*
		*	@param $Items - Map items.
		*
		*	@return Map.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_map( $RootItem , $Items )
		{
			try
			{
				$Map = '';
				
				$PageDescription = $this->PageAccess->get_page_description( $RootItem->page );
				
				$Map .= $this->CachedMultyFS->get_template( __FILE__ , 'map_item_start.tpl' ).
					( strlen( $RootItem->navigation ) ? $RootItem->navigation : 
						'{href:tpl=std;page=./'.$RootItem->page.'.html;raw_text='.$PageDescription[ 'title' ].'}' );
				
				$Map .= $this->compile_map_items( $Map , $RootItem , $Items );
				
				$Map .= $this->CachedMultyFS->get_template( __FILE__ , 'map_item_end.tpl' );
				
				return( $Map );
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
		*	@return HTML code of the компонента.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			draw_map( $Options )
		{
			try
			{
				$Data = $this->Cache->get_data( 'full_map' );
				if( $Data === false )
				{
					$Access = get_package( 'system_structure::system_structure_access' , 'last' , __FILE__ );
					
					$Items = $Access->unsafe_select();
					$RootItem = $this->get_root_item( $Items );
					
					$Map  = $this->CachedMultyFS->get_template( __FILE__ , 'map_start.tpl' );
					$Map .= $this->compile_map( $RootItem , $Items );
					$Map .= $this->CachedMultyFS->get_template( __FILE__ , 'map_end.tpl' );
					
					$this->Cache->add_data( 'full_map' , $Map );
					
					$this->Output = $Map;
				}
				else
				{
					$this->Output = $Data;
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение разделителя.
		*
		*	@return Разделитель.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Gettining separator.
		*
		*	@return Separator.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_separator()
		{
			try
			{
				$Separator = $this->Settings->get_package_setting( 
					'system_structure::system_structure_view' , 'last' , 'cf_system_structure' , 
					'bread_crumbs_separator' , '&nbsp;&gt;&nbsp;'
				);
				
				return( $Separator );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Цикл обработки элементов.
		*
		*	@param $Str - Уже скомпилированные крошки.
		*
		*	@param $MainItem - Концевой элемент.
		*
		*	@param $Items - Элементы.
		*
		*	@return HTML код компонента.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Processing loop.
		*
		*	@param $Str - Compiled bread crumbs.
		*
		*	@param $MainItem - Ending item.
		*
		*	@param $Items - Items.
		*
		*	@return HTML code of the component.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_item_loop( $Str , $MainItem , $Items )
		{
			try
			{
				$Counter = 1;
				$Separator = $this->get_separator();

				while( $MainItem !== false && $MainItem->page != $MainItem->root_page )
				{
					$Str = $Separator.$Str;
					$MainItem = $this->get_item( $MainItem->root_page , $Items );
					$PageDescription = $this->PageAccess->get_page_description( $MainItem->page );
					$Str = ( 
						strlen( $MainItem->navigation ) != 0 ? $MainItem->navigation : '{href:tpl=std;page=./'.
						$MainItem->page.'.html;raw_text='.$PageDescription[ 'title' ].'}' 
					).$Str;
					$Counter++;
				}

				return( array( $Str , $Counter ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки элементов.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@param $MainItem - Концевой элемент.
		*
		*	@param $Items - Элементы.
		*
		*	@return HTML код компонента.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes items.
		*
		*	@param $Options - Settings.
		*
		*	@param $MainItem - Ending item.
		*
		*	@param $Items - Items.
		*
		*	@return HTML code of the component.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_items( &$Options , $MainItem , $Items )
		{
			try
			{
				$PageDescription = $this->PageAccess->get_page_description( $MainItem->page );
				$Str = strlen( $MainItem->navigation ) != 0 ? $MainItem->navigation : '{href:tpl=std;page=./'.
						$MainItem->page.'.html;raw_text='.$PageDescription[ 'title' ].'}';
						
				list( $Str , $Counter ) = $this->compile_item_loop( $Str , $MainItem , $Items );

				if( $Options->get_setting( 'show_on_root_page' , false ) == false )
				{
					if( $Counter == 1 )
					{
						$Str = '';
					}
				}

				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция компиляции "крошек".
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
		*	\~english Function compiles "bread crumbs".
		*
		*	@param $Options - Settings.
		*
		*	@return HTML code of the component.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_bread_crumbs( &$Options )
		{
			try
			{
				$PageName = $this->Security->get_g( 'page_name' , 'command' );
				$Access = get_package( 'system_structure::system_structure_access' , 'last' , __FILE__ );
				$Items = $Access->unsafe_select();
				$MainItem = $this->get_item( $PageName , $Items );
				
				if( $MainItem !== false )
				{
					$Str = $this->compile_items( $Options , $MainItem , $Items );
				}
				else
				{
					$Str = '';
				}
				
				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отрисовки "крошек".
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
		*	\~english Function draws "bread crumbs".
		*
		*	@param $Options - Settings.
		*
		*	@return HTML code of the component.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			draw_bread_crumbs( &$Options )
		{
			try
			{
				$PageName = $this->Security->get_g( 'page_name' , 'command' );
				$Data = $this->Cache->get_data( "bread_crumbs_for_$PageName" );
				
				if( $Data === false )
				{
					$Str = $this->compile_bread_crumbs( $Options );
					
					$this->Cache->add_data( "bread_crumbs_for_$PageName" , $Str );
						
					$this->Output = $Str;
				}
				else
				{
					$this->Output = $Data;
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
		*	@return HTML code of the компонента.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			view( &$Options )
		{
			try
			{
				$ContextSet = get_package_object( 'gui::context_set' , 'last' , __FILE__ );

				$ContextSet->add_context( dirname( __FILE__ ).'/conf/cfcx_map' );

				$ContextSet->add_context( dirname( __FILE__ ).'/conf/cfcx_bread_crumbs' );

				$ContextSet->execute( $Options , $this , __FILE__ );

				return( $this->Output );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>