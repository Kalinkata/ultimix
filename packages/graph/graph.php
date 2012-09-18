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
	class	graph_1_0_0{

		/**
		*	\~russian Объект картики графика.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Object of the graph picture.
		*
		*	@author Dodonov A.A.
		*/
		var					$Img = false;

		/**
		*	\~russian Размер клиентской области.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Size of the client area.
		*
		*	@author Dodonov A.A.
		*/
		var					$ClientWidth = 0;
		var					$ClientHeight = 0;

		/**
		*	\~russian Координата угла клиентской области.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Сoordinate of the client area.
		*
		*	@author Dodonov A.A.
		*/
		var					$ClientX = 0;
		var					$ClientY = 0;

		/**
		*	\~russian Центр координат.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Coordinate center.
		*
		*	@author Dodonov A.A.
		*/
		var					$CoordX = 0;
		var					$CoordY = 0;

		/**
		*	\~russian Нужно ли выводить сетку.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Should we draw grid.
		*
		*	@author Dodonov A.A.
		*/
		var					$DrawGrid = true;

		/**
		*	\~russian Количество шагов сетки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Count of grid's steps.
		*
		*	@author Dodonov A.A.
		*/
		var					$StepsX = 8;
		var					$StepsY = 6;

		/**
		*	\~russian Отступ.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Padding for the graph.
		*
		*	@author Dodonov A.A.
		*/
		var					$MarginTop = 10;
		var					$MarginBottom = 10;
		var					$MarginLeft = 10;
		var					$MarginRight = 10;

		/**
		*	\~russian Установка поля.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sets field.
		*
		*	@author Dodonov A.A.
		*/
		function			set( $Field , $Value )
		{
			$this->$Field = $Value;
		}

		/**
		*	\~russian Заливка клиентской области графика.
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
		*	@param $GraphAreaColor - Hexadecimal representation of the color.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			fill_graph_area( $GraphAreaColor )
		{
			try
			{
				$GraphAreaColor = intval( $GraphAreaColor );

				$GraphAreaColor = $this->GraphCore->get_color_from_hex( $this->Img , $GraphAreaColor );

				$Res = imagefilledrectangle( 
					$this->Img , $this->ClientX , $this->Height - $this->ClientY , 
					$this->ClientX + $this->ClientWidth , $this->Height - $this->ClientHeight - $this->ClientY , 
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
		*	\~russian Функция рисует координатные оси.
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
		*	@param $X - Start of the cordinates system.
		*
		*	@param $Y - Start of the cordinates system.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			draw_coordinates( $X = 0 , $Y = 0 )
		{
			try
			{
				if( $this->Img === false )
				{
					$this->draw_client_area();
				}

				$this->CoordX = intval( $X );
				$this->CoordY = intval( $Y );

				$BlackColor = imagecolorallocate( $this->Img , 0 , 0 , 0 );

				$Y = intval( $Y );
				imageline( 
					$this->Img , $this->ClientX ,  $this->Height - $this->ClientY - $Y , 
					$this->ClientX + $this->ClientWidth , $this->Height - $this->ClientY - $Y , $BlackColor
				);

				$X = intval( $X );
				imageline( 
					$this->Img , $this->ClientX + $X , $this->Height - $this->ClientY  , $this->ClientX + $X , 
					$this->Height - $this->ClientY - $this->ClientHeight , $BlackColor
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция рисует сетку.
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
		*	@param $Color - Grid color.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	draw_vertical_grid_lines( $Color )
		{
			try
			{
				$dx = ( $this->ClientWidth - $this->MarginLeft - $this->MarginRight ) / $this->StepsX;
				for( $i = 0 ; $i <= $this->StepsX ; $i++ )
				{
					imageline( 
						$this->Img , $this->ClientX + $dx * $i + $this->MarginLeft , $this->Height - $this->ClientY  , 
						$this->MarginLeft + $this->ClientX + $dx * $i , 
						$this->Height - $this->ClientY - $this->ClientHeight , $Color
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
		*	@param $Color - Цвет сетки.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws grid.
		*
		*	@param $Color - Grid color.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	draw_horizontal_grid_lines( $Color )
		{
			try
			{
				$dy = ( $this->ClientHeight - $this->MarginTop - $this->MarginBottom ) / $this->StepsY;
				for( $i = 0 ; $i <= $this->StepsY ; $i++ )
				{
					imageline(
						$this->Img , $this->ClientX , $this->MarginTop + $this->ClientY + $dy * $i , 
						$this->ClientX + $this->ClientWidth , $this->MarginTop + $this->ClientY + $dy * $i , $Color
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
		*	@param $Color - Цвет сетки.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws grid.
		*
		*	@param $Color - Grid color.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			draw_grid( $Color = 0xeeeeee )
		{
			try
			{
				$Color = $this->GraphCore->get_color_from_hex( $this->Img , $Color );

				$this->draw_vertical_grid_lines( $Color );

				$this->draw_horizontal_grid_lines( $Color );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Параметры отрисоки подписей.
		*
		*	@return array( $GlobalCenterY , $dy )
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function calculates params.
		*
		*	@return array( $GlobalCenterY , $dy )
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_draw_y_labels_params()
		{
			try
			{
				$GlobalCenterY = $this->Height - $this->ClientY - $this->CoordY;

				$dy = ( $this->ClientHeight - $this->MarginTop - $this->MarginBottom ) / $this->StepsY;

				return( array( $GlobalCenterY , $dy ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция рисует подписи.
		*
		*	@param $Labels - Подписи.
		*
		*	@param $Color - Цвет сетки.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws labels.
		*
		*	@param $Labels - Labels.
		*
		*	@param $Color - Grid color.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			draw_y_labels( $Labels , $Color = 0x000000 )
		{
			try
			{
				$Color = $this->GraphCore->get_color_from_hex( $this->Img , $Color );
				list( $GlobalCenterY , $dy ) = $this->get_draw_y_labels_params();

				$Font = dirname( __FILE__ ).'/res/font/arial.ttf';
				$Size = 10;

				for( $i = 0 ; $i <= $this->StepsY ; $i++ )
				{
					list( $Width , $Height ) = $this->GraphCore->string_width_height( $Font , $Size , $Labels[ $i ] );

					imagettftext( 
						$this->Img , $Size , 0 , $this->ClientX - $Width - 10 , 
						$GlobalCenterY - $dy * $i - $Height / 2 , $Color , $Font , $Labels[ $i ]
					);
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция возвращает координаты.
		*
		*	@param $d - Масштаб.
		*
		*	@param $Width - Ширина.
		*
		*	@param $Height - Высота.
		*
		*	@return array( $x , $y )
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function calculates coordinates.
		*
		*	@param $d - Scale.
		*
		*	@param $Width - Width.
		*
		*	@param $Height - Height.
		*
		*	@return array( $x , $y )
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_x_y( $d , $Width , $Height )
		{
			try
			{
				$x = $this->ClientX + $this->CoordX + $d + $this->MarginLeft - $Width / 2 ;

				$y = $this->Height - $this->ClientY + $Height + 5;

				return( array( $x , $y ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция рисует подписи.
		*
		*	@param $DataX - Данные.
		*
		*	@param $Color - Цвет меток.
		*
		*	@param $Labels - Метки.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws labels.
		*
		*	@param $DataX - Дата.
		*
		*	@param $Color - Labels color.
		*
		*	@param $Labels - Labels.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			draw_x_labels( $DataX , $Color = 0x000000 , $Labels = false )
		{
			try
			{
				$Color = $this->GraphCore->get_color_from_hex( $this->Img , $Color );

				$Labels = $Labels === false ? $DataX : $Labels;

				list( $dX , $dY ) = $this->get_scales( $DataX , false );
				$Font = dirname( __FILE__ ).'/res/font/arial.ttf';

				$Count = count( $DataX );

				for( $i = 0 ; $i < $Count ; $i++ )
				{
					list( $Width , $Height ) = $this->GraphCore->string_width_height( $Font , 10 , $Labels[ $i ] );
					$d = ( $DataX[ $i ] - min( $DataX ) ) * $dX;
					list( $x , $y ) = $this->get_x_y( $d , $Width , $Height );
					imagettftext( $this->Img , 10 , 0 , $x , $y , $Color , $Font , $Labels[ $i ] );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция считает ширину клиентской области.
		*
		*	@param $DataX - Данные для графика.
		*
		*	@return Ширина клиентской области.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function calcuates client area's width.
		*
		*	@param $DataX - Data for the graph.
		*
		*	@return Width of the client area.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_total_client_width( $DataX )
		{
			try
			{
				$c = count( $DataY );

				if( $DataX === false )
				{
					$DataX = array();
					for( $i = 0 ; $i < $c ; $i++ )
					{
						$DataX [] = $i;
					}
					$TotalClientWidth = $this->ClientWidth - $this->CoordX;
				}
				else
				{
					$TotalClientWidth = $this->ClientWidth;
				}

				return( $TotalClientWidth );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение мастабирующих коэффициентов.
		*
		*	@param $DataX - Данные для графика.
		*
		*	@param $DataY - Данные для графика.
		*
		*	@return array( $dX , $dY )
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns scales.
		*
		*	@param $DataX - Data for the graph.
		*
		*	@param $DataY - Data for the graph.
		*
		*	@return array( $dX , $dY )
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_scales( $DataX , $DataY )
		{
			try
			{
				$dX = $dY = 0;
				if( $DataX !== false )
				{
					$MDW = max( $DataX ) - min( $DataX );
					$MDW = $MDW ? $MDW : 1;
					$dX = ( $this->ClientWidth - $this->MarginLeft - $this->MarginRight )/ $MDW;
				}
				if( $DataY !== false )
				{
					$MDH = max( $DataY ) - min( $DataY );
					$MDH = $MDH ? $MDH : 1;
					if( $MDH )
					{
						$dY = ( $this->ClientHeight - $this->MarginTop - $this->MarginBottom ) / $MDH;
					}
					else
					{
						$this->MarginBottom = $this->ClientHeight / 2;
					}
				}
				return( array( $dX , $dY ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция рисует часть графика.
		*
		*	@param $x1 - Начало сегмента.
		*
		*	@param $x2 - Конец сегмента.
		*
		*	@param $y1 - Начало сегмента.
		*
		*	@param $y2 - Конец сегмента.
		*
		*	@param $Color - Цвет сегмента.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws part of the graph.
		*
		*	@param $x1 - Segment start.
		*
		*	@param $x2 - Segment end.
		*
		*	@param $y1 - Segment start.
		*
		*	@param $y2 -  Segment end.
		*
		*	@param $Color - Segment color
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	draw_graph_part( $x1 , $x2 , $y1 , $y2 , $Color )
		{
			try
			{
				$this->GraphCore->imagelinethick( $this->Img , $x1 , $y1 , $x2 , $y2 , $Color , 2 );

				imagefilledellipse( $this->Img , $x1 , $y1 , 9 , 9 , $Color );

				imagefilledellipse( $this->Img , $x2 , $y2 , 9 , 9 , $Color );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция рисует график.
		*
		*	@param $DataY - Данные для графика.
		*
		*	@param $DataX - Данные для графика.
		*
		*	@param $Color - Цвет графика.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws graph.
		*
		*	@param $DataY - Data for the graph.
		*
		*	@param $DataX - Data for the graph.
		*
		*	@param $Color - Color of the graph.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			draw_graph( $DataY , $DataX , $Color = 0xff0000 )
		{
			try
			{
				$Color = $this->GraphCore->get_color_from_hex( $this->Img , $Color );

				list( $dX , $dY ) = $this->get_scales( $DataX , $DataY );

				for( $i = 0 ; $i < count( $DataX ) - 1 ; $i++ )
				{
					$OX = $this->ClientX + $this->CoordX - min( $DataX ) * $dX + $this->MarginLeft;
					$x1 = $OX + $DataX[ $i + 0 ] * $dX;
					$x2 = $OX + $DataX[ $i + 1 ] * $dX;

					$OY = $this->Height - $this->ClientY - $this->CoordY 
						- min( $DataY ) * $dY - $this->MarginBottom;
					$y1 = $OY - $DataY[ $i + 0 ] * $dY;
					$y2 = $OY - $DataY[ $i + 1 ] * $dY;

					$this->draw_graph_part( $x1 , $x2 , $y1 , $y2 , $Color );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

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
		*	\~russian Функция получения данных для графика.
		*
		*	@return array( $DataX , $DataY ).
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns data for graph.
		*
		*	@return array( $DataX , $DataY ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_graph_data()
		{
			try
			{
				return(
					array( 
						explode( ',' , $this->Security->get_gp( 'data_x' , 'string' ) ) , 
						explode( ',' , $this->Security->get_gp( 'data_y' , 'string' ) )
					)
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
		function			draw_graph_data( &$Options )
		{
			try
			{
				$this->Graph->prepare_graph_area();

				list( $DataX , $DataY ) = $this->get_graph_data();
				$Color = $this->Security->get_gp( 'color' , 'integer' , 0xff0000 );
				$this->draw_graph( $DataY , $DataX , $Color );
				$DataYLabels = $this->GraphCore->compile_labels_from_data( $DataY , $this->StepsY );
				$this->draw_y_labels( $DataYLabels );
				$DataXLabels = $this->Security->get_gp( 'data_x_labels' , 'string' , false );
				$DataXLabels = $DataXLabels === false ? false : explode( ',' , $DataXLabels );
				$this->draw_x_labels( $DataX , 0x000000 , $DataXLabels );

				$this->GraphCore->output( $Options , $this->Img );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>