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
	*	\~russian Класс для менюшки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Menu class.
	*
	*	@author Dodonov A.A.
	*/
	class	menu_view_1_0_0{
		
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
		var					$Cache = false;
		var					$CachedMultyFS = false;
		var					$Database = false;
		var					$DatabaseAlgorithms = false;
		var					$MenuAccess = false;
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
				$this->Cache = get_package( 'cache' , 'last' , __FILE__ );
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->Database = get_package( 'database' , 'last' , __FILE__ );
				$this->DatabaseAlgorithms = get_package( 'database::database_algorithms' , 'last' , __FILE__ );
				$this->MenuAccess = get_package( 'menu::menu_access' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Результат работы функций отображения.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english View result.
		*
		*	@author Dodonov A.A.
		*/
		var					$Output = false;
		
		/**
		*	\~russian Функция отображает менюшку.
		*
		*	@param $Options - параметры запуска модуля.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function displays menu.
		*
		*	@param $Options - Module launch parameters.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			show_menu( $Options )
		{
			try
			{
				$MenuName = $Options->get_setting( 'menu_name' );
				$DataName = "menu_$MenuName";
				$this->Output = $this->Cache->get_data( $DataName );

				if( $this->Output === false )
				{
					$this->Output = $this->CachedMultyFS->get_template( __FILE__ , 'menu_header.tpl' );
					$Result = $this->MenuAccess->get_menu_items( $MenuName );
					foreach( $Result as $r )
					{
						$this->Output .= get_field( $r , 'href' );
					}
					$this->Output .= $this->CachedMultyFS->get_template( __FILE__ , 'menu_footer.tpl' );
					$this->Cache->add_data( $DataName , $this->Output );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отображения вида меню.
		*
		*	@param $Options - параметры запуска модуля.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws menu.
		*
		*	@param $Options - Module launch parameters.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			view( $Options )
		{
			try
			{
				$ContextSet = get_package( 'gui::context_set' , 'last' , __FILE__ );
				
				$ContextSet->add_context( dirname( __FILE__ ).'/conf/show_menu' );

				if( $ContextSet->execute( $Options , $this ) )return( $this->Output );

				return( $this->Output );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>