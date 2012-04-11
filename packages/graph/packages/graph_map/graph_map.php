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
	*	\~russian Работа с графиками.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Working with graphs.
	*
	*	@author Dodonov A.A.
	*/
	class	graph_map_1_0_0{

		/**
		*	\~russian Функция компиляции карты.
		*
		*	@param $Data - Данные для графика.
		*
		*	@param $Coords - Координаты для маркера.
		*
		*	@return Область.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles map.
		*
		*	@param $Data - Data for the graph.
		*
		*	@param $Coords - Marker coordinates.
		*
		*	@return Area.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_area( $Data , $Coords )
		{
			try
			{
				$this->Output .= $this->CachedMultyFS->get_template( __FILE__ , 'area.tpl' );
				$this->Output = str_replace( 
					array( '{title}' , '{coords}' )  , array( $Data , $Coords ) , $this->Output
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция компиляции карты.
		*
		*	@param $DataY - Данные для графика.
		*
		*	@param $DataX - Данные для графика.
		*
		*	@return Карта.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles map.
		*
		*	@param $DataY - Data for the graph.
		*
		*	@param $DataX - Data for the graph.
		*
		*	@return Map.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_map_items( $DataY , $DataX )
		{
			try
			{
				$GlobalCenterX = $this->ClientX + $this->CoordX;
				$GlobalCenterY = $this->Height - $this->ClientY - $this->CoordY;

				list( $dX , $dY ) = $this->get_scales( $DataX , $DataY );

				$c = count( $DataX );

				$this->Output = '';

				for( $i = 0 ; $i < $c ; $i++ )
				{
					$x = intval( $GlobalCenterX + ( $DataX[ $i ] - min( $DataX ) ) * $dX + $this->MarginLeft );
					$y = intval( $GlobalCenterY - ( $DataY[ $i + 0 ] - min( $DataY ) ) * $dY - $this->MarginBottom );

					$this->compile_area( $DataY[ $i ] , "$x,$y" );
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
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Component's view.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	prepare_map_generation( &$Options )
		{
			try
			{
				$Width = $Options->get_setting( 'width' , 640 );
				$Height = $Options->get_setting( 'height' , 480 );

				$this->set( 'Width' , $Width );
				$this->set( 'Height' , $Height );

				$ClientX = $Options->get_setting( 'client_x' , 50 );
				$ClientY = $Options->get_setting( 'client_y' , 20 );
				$ClientWidth = $Options->get_setting( 'client_width' , $Width - 70 );
				$ClientHeight = $Options->get_setting( 'client_height' , $Height - 40 );
				$this->compile_client_width_height( $ClientX , $ClientY , $ClientWidth , $ClientHeight );
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
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Component's view.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			view_map( &$Options )
		{
			try
			{
				$this->prepare_map_generation( $Options );

				$DataY = explode( ',' , $Options->get_setting( 'data_y' ) );
				$DataX = explode( ',' , $Options->get_setting( 'data_x' ) );
				$this->compile_map_items( $DataY , $DataX );

				$MapName = $Options->get_setting( 'map_name' , 'graph_map' );
				$this->Output = $this->CachedMultyFS->get_template( __FILE__ , 'map.tpl' );
				$this->Output = str_replace( 
					array( '{map_name}' , '{output}' ) , array( $MapName , $this->Output ) , $this->Output
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>