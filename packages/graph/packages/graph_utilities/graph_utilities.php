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
	class	graph_utilities_1_0_0{

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
		var					$GraphCore = false;
		var					$Security = false;

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
				$this->GraphCore = get_package( 'graph::graph_core' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция отрисовки компонента.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Component's view.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	set_width_height( &$Graph )
		{
			try
			{
				$Width = $this->Security->get_gp( 'width' , 'integer' , 640 );
				$Height = $this->Security->get_gp( 'height' , 'integer' , 480 );

				$Graph->set( 'Width' , $Width );
				$Graph->set( 'Height' , $Height );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция готовит холст для рисования.
		*
		*	@param $Graph - График.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function prepares canvas for drawing.
		*
		*	@param $Graph - Graph.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	prepare_canvas( &$Graph )
		{
			try
			{
				$Graph->Img = imagecreatetruecolor( $Graph->Width , $Graph->Height );

				if( $Graph->Img === false )
				{
					throw( new Exception( 'An error occured while image creation' ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция рисует клиентскую область.
		*
		*	@param $Graph - График.
		*
		*	@param $ClientX - Координаты клиентской области.
		*
		*	@param $ClientY - Координаты клиентской области.
		*
		*	@param $Width - Размеры клиентской области.
		*
		*	@param $Height - Размеры клиентской области.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws client area.
		*
		*	@param $Graph - Graph.
		*
		*	@param $ClientX - Coordinates of the client area.
		*
		*	@param $ClientY - Coordinates of the client area.
		*
		*	@param $Width - Size of the client area.
		*
		*	@param $Height - Size of the client area.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_client_width_height( $Graph , $ClientX = 20 , $ClientY = 20 , 
																							$Width = 0 , $Height = 0 )
		{
			try
			{
				$Graph->ClientX = intval( $ClientX );
				$Graph->ClientY = intval( $ClientY );

				if( $Width === 0 )
				{
					$Graph->ClientWidth = $Graph->Width - 2 * $Graph->ClientX;
				}
				else
				{
					$Graph->ClientWidth = intval( $Width );
				}

				if( $Height === 0 )
				{
					$Graph->ClientHeight = $Graph->Height - 2 * $Graph->ClientY;
				}
				else
				{
					$Graph->ClientHeight = intval( $Height );
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
		*	@param $Graph - График.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Component's view.
		*
		*	@param $Graph - Graph.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	init_client_area( &$Graph )
		{
			try
			{
				$ClientX = $this->Security->get_gp( 'client_x' , 'integer' , 50 );
				$ClientY = $this->Security->get_gp( 'client_y' , 'integer' , 20 );

				$ClientWidth = $this->Security->get_gp( 'client_width' , 'integer' , $Graph->Width - 70 );
				$ClientHeight = $this->Security->get_gp( 'client_height' , 'integer' , $Graph->Height - 40 );

				$this->compile_client_width_height( $Graph , $ClientX , $ClientY , $ClientWidth , $ClientHeight );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Заливка клиентской области графика.
		*
		*	@param $Graph - График.
		*
		*	@param $GraphAreaColor - Шестнадцатеричное представление цвета.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function fills graph's client area.
		*
		*	@param $Graph - Graph.
		*
		*	@param $GraphAreaColor - Hexadecimal representation of the color.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			fill_graph_area( &$Graph , $GraphAreaColor )
		{
			try
			{
				$GraphAreaColor = intval( $GraphAreaColor );

				$GraphAreaColor = $this->GraphCore->get_color_from_hex( $Graph->Img , $GraphAreaColor );

				$Res = imagefilledrectangle( 
					$Graph->Img , $Graph->ClientX , $Graph->Height - $Graph->ClientY , 
					$Graph->ClientX + $Graph->ClientWidth , $Graph->Height - $Graph->ClientHeight - $Graph->ClientY , 
					$GraphAreaColor
				);

				if( $Res === false )
				{
					throw( new Exception( 'An error occured while filling client area' ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция рисует сетку.
		*
		*	@param $Graph - График.
		*
		*	@param $Color - Цвет сетки.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws grid.
		*
		*	@param $Graph - Graph.
		*
		*	@param $Color - Grid color.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	draw_vertical_grid_lines( $Graph , $Color )
		{
			try
			{
				$dx = ( $Graph->ClientWidth - $Graph->MarginLeft - $Graph->MarginRight ) / $Graph->StepsX;
				for( $i = 0 ; $i <= $Graph->StepsX ; $i++ )
				{
					imageline( 
						$Graph->Img , $Graph->ClientX + $dx * $i + $Graph->MarginLeft , 
						$Graph->Height - $Graph->ClientY  , $Graph->MarginLeft + $Graph->ClientX + $dx * $i , 
						$Graph->Height - $Graph->ClientY - $Graph->ClientHeight , $Color
					);
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция рисует сетку.
		*
		*	@param $Graph - График.
		*
		*	@param $Color - Цвет сетки.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws grid.
		*
		*	@param $Graph - Graph.
		*
		*	@param $Color - Grid color.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	draw_horizontal_grid_lines( $Graph , $Color )
		{
			try
			{
				$dy = ( $Graph->ClientHeight - $Graph->MarginTop - $Graph->MarginBottom ) / $Graph->StepsY;
				for( $i = 0 ; $i <= $Graph->StepsY ; $i++ )
				{
					imageline(
						$Graph->Img , $Graph->ClientX , $Graph->MarginTop + $Graph->ClientY + $dy * $i , 
						$Graph->ClientX + $Graph->ClientWidth , $Graph->MarginTop + $Graph->ClientY + $dy * $i , $Color
					);
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция рисует сетку.
		*
		*	@param $Graph - График.
		*
		*	@param $Color - Цвет сетки.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws grid.
		*
		*	@param $Graph - Graph.
		*
		*	@param $Color - Grid color.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			draw_grid( $Graph , $Color = 0xeeeeee )
		{
			try
			{
				$Color = $this->GraphCore->get_color_from_hex( $Graph->Img , $Color );

				$this->draw_vertical_grid_lines( $Graph , $Color );

				$this->draw_horizontal_grid_lines( $Graph , $Color );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция рисует координатные оси.
		*
		*	@param $Graph - График.
		*
		*	@param $X - Начало координат.
		*
		*	@param $Y - Начало координат.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws coordinate grid.
		*
		*	@param $Graph - Graph.
		*
		*	@param $X - Start of the cordinates system.
		*
		*	@param $Y - Start of the cordinates system.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			draw_coordinates( $Graph , $X = 0 , $Y = 0 )
		{
			try
			{
				if( $Graph->Img === false )
				{
					$Graph->draw_client_area();
				}

				$Graph->CoordX = $X = intval( $X );
				$Graph->CoordY = $Y = intval( $Y );

				$BlackColor = imagecolorallocate( $Graph->Img , 0 , 0 , 0 );

				imageline( 
					$Graph->Img , $Graph->ClientX ,  $Graph->Height - $Graph->ClientY - $Y , 
					$Graph->ClientX + $Graph->ClientWidth , $Graph->Height - $Graph->ClientY - $Y , $BlackColor
				);

				imageline( 
					$Graph->Img , $Graph->ClientX + $X , $Graph->Height - $Graph->ClientY  , $Graph->ClientX + $X , 
					$Graph->Height - $Graph->ClientY - $Graph->ClientHeight , $BlackColor
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция отрисовки компонента.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Component's view.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			prepare_graph_area( &$Graph )
		{
			try
			{
				$this->set_width_height( $Graph );

				$this->prepare_canvas( $Graph );

				$BackgroundColor = $this->Security->get_gp( 'background_color' , 'integer' , 0xeeeeee );
				$this->GraphCore->fill_background( $Graph->Img , $BackgroundColor );

				$this->init_client_area( $Graph );

				$GraphAreaColor = $this->Security->get_gp( 'graph_area_color' , 'integer' , 0xffffff );
				$this->fill_graph_area( $Graph , $GraphAreaColor );

				$this->draw_grid( $Graph );
				$this->draw_coordinates( $Graph );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>