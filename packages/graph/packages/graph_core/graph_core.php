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
	class	graph_core_1_0_0{

		/**
		*	\~russian Функция рисует прямоугольник.
		*
		*	@param $Image - объект изображения.
		*
		*	@param $x1 - Начало линии.
		*
		*	@param $y1 - Начало линии.
		*
		*	@param $x2 - Конец линии.
		*
		*	@param $y2 - Конец линии.
		*
		*	@param $color - Цвет линии.
		*
		*	@param $thick - Толщина линии.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws rectangle.
		*
		*	@param $Image - Image's object.
		*
		*	@param $x1 - Line's beginning.
		*
		*	@param $y1 - Line's beginning.
		*
		*	@param $x2 - Line's end.
		*
		*	@param $y2 -  Line's end.
		*
		*	@param $color - Line's color.
		*
		*	@param $thick - Line's thickness.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			filledrectangle( $Image , $x1 , $y1 , $x2 , $y2 , $color , $thick = 1 )
		{
			$t = $thick / 2 - 0.5;

			return(
				imagefilledrectangle( 
					$Image , round( min( $x1 , $x2 ) - $t ) , round( min( $y1 , $y2 ) - $t ) , 
					round( max( $x1 , $x2 ) + $t ) , round( max( $y1 , $y2 ) + $t ) , $color 
				)
			);
		}

		/**
		*	\~russian Функция рисует толстую линию.
		*
		*	@param $Image - Объект изображения.
		*
		*	@param $x1 - Начало линии.
		*
		*	@param $y1 - Начало линии.
		*
		*	@param $x2 - Конец линии.
		*
		*	@param $y2 - Конец линии.
		*
		*	@param $Color - Цвет линии.
		*
		*	@param $Thick - Толщина линии.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws thick line.
		*
		*	@param $Image - Image's object.
		*
		*	@param $x1 - Line's beginning.
		*
		*	@param $y1 - Line's beginning.
		*
		*	@param $x2 - Line's end.
		*
		*	@param $y2 -  Line's end.
		*
		*	@param $Color - Line's color.
		*
		*	@param $Thick - Line's thickness.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	commonimagelinethick( $Image , $x1 , $y1 , $x2 , $y2 , $Color , $Thick = 1 )
		{
			$t = $Thick / 2 - 0.5;
		    $k = ( $y2 - $y1 ) / ( $x2 - $x1 );
			$a = $t / sqrt( 1 + pow( $k , 2 ) );
		    $points = array(
		        round( $x1 - ( 1 + $k ) * $a ) , round( $y1 + ( 1 - $k ) * $a ) , round( $x1 - ( 1 - $k ) * $a ) , 
				round( $y1 - ( 1 + $k ) * $a ) , round( $x2 + ( 1 + $k ) * $a ) , round( $y2 - ( 1 - $k ) * $a ) , 
		        round( $x2 + ( 1 - $k ) * $a ) , round( $y2 + ( 1 + $k ) * $a ) , 
		    );

		    imagefilledpolygon( $Image , $points , 4 , $Color );
		    return( imagepolygon( $Image , $points , 4 , $Color ) );
		}

		/**
		*	\~russian Функция рисует толстую линию.
		*
		*	@param $Image - Объект изображения.
		*
		*	@param $x1 - Начало линии.
		*
		*	@param $y1 - Начало линии.
		*
		*	@param $x2 - Конец линии.
		*
		*	@param $y2 - Конец линии.
		*
		*	@param $color - Цвет линии.
		*
		*	@param $thick - Толщина линии.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws thick line.
		*
		*	@param $Image - Image's object.
		*
		*	@param $x1 - Line's beginning.
		*
		*	@param $y1 - Line's beginning.
		*
		*	@param $x2 - Line's end.
		*
		*	@param $y2 -  Line's end.
		*
		*	@param $color - Line's color.
		*
		*	@param $thick - Line's thickness.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function 			imagelinethick( $Image , $x1 , $y1 , $x2 , $y2 , $color , $thick = 1 )
		{
		    if( $thick == 1 )
			{
				return( imageline( $Image , $x1 , $y1 , $x2 , $y2 , $color ) );
			}
		    elseif( $x1 == $x2 || $y1 == $y2 )
			{
		        return( $this->filledrectangle( $Image , $x1 , $y1 , $x2 , $y2 , $color , $thick ) );
		    }

			return( $this->commonimagelinethick( $Image , $x1 , $y1 , $x2 , $y2 , $color , $thick ) );
		}
		
		/**
		*	\~russian Функция выделения цвета.
		*
		*	@param $Image - Объект изображения.
		*
		*	@param $Color - Цвет.
		*
		*	@return Цвет.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function allocates color.
		*
		*	@param $Image - Image's object.
		*
		*	@param $Color - Color.
		*
		*	@return Color.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_color_from_hex( $Image , $Color )
		{
			$Color = intval( $Color );

			$ColorObject = imagecolorallocate( 
				$Image , ( $Color & ( 255 << 16 ) ) >> 16 , 
				( $Color & ( 255 << 8 ) ) >> 8 , $Color & 255
			);

			return( $ColorObject );
		}
		
		/**
		*	\~russian Заливка фона графика.
		*
		*	@param $Img - Изображение.
		*
		*	@param $BackgroundColor - Шестнадцатеричное представление цвета.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function fills graph background.
		*
		*	@param $Img - Image.
		*
		*	@param $BackgroundColor - Hexadecimal representation of the color.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			fill_background( &$Img , $BackgroundColor )
		{
			try
			{
				$BackgroundColor = intval( $BackgroundColor );

				$BackgroundColor = $this->get_color_from_hex( $Img , $BackgroundColor );

				$Res = imagefill( $Img , 0 , 0 , $BackgroundColor );

				if( $Res === false )
				{
					throw( new Exception( 'An error occured while setting graph background' ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Расчёт ширины строки.
		*
		*	@param $FontFile - Файл шрифта.
		*
		*	@param $Size - Размер.
		*
		*	@param $String - Строка.
		*
		*	@return Ширина строки.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function calculates string width.
		*
		*	@param $FontFile - Font file.
		*
		*	@param $Size - Size.
		*
		*	@param $String - String.
		*
		*	@return String width.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			string_width( $FontFile , $Size , $String )
		{
			try
			{
				$Box = imagettfbbox( $Size , 0 , $FontFile , $String );

				return( $Box[ 2 ] - $Box[ 0 ] );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Расчёт высоты строки.
		*
		*	@param $FontFile - Файл шрифта.
		*
		*	@param $Size - Размер.
		*
		*	@param $String - Строка.
		*
		*	@return Высота строки.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function calculates string height.
		*
		*	@param $FontFile - Font file.
		*
		*	@param $Size - Size.
		*
		*	@param $String - String.
		*
		*	@return String height.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			string_height( $FontFile , $Size , $String )
		{
			try
			{
				$Box = imagettfbbox( $Size , 0 , $FontFile , $String );

				return( abs( $Box[ 5 ] - $Box[ 1 ] ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Расчёт ширины и высоты строки.
		*
		*	@param $FontFile - Файл шрифта.
		*
		*	@param $Size - Размер.
		*
		*	@param $String - Строка.
		*
		*	@return Высота и ширина строки.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function calculates string width and height.
		*
		*	@param $FontFile - Font file.
		*
		*	@param $Size - Size.
		*
		*	@param $String - String.
		*
		*	@return String width and height.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			string_width_height( $Font , $Size , $String )
		{
			try
			{
				$Box = imagettfbbox( $Size , 0 , $FontFile , $String );

				return( array( $Box[ 2 ] - $Box[ 0 ] , abs( $Box[ 5 ] - $Box[ 1 ] ) ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Компиляция меток из данных.
		*
		*	@param $DataY - Данные для графика.
		*
		*	@param $StepsY - Количество меток.
		*
		*	@return Метки.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles labels from data.
		*
		*	@param $DataY - Data for the graph.
		*
		*	@param $StepsY - Count of labels.
		*
		*	@return Labels.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_labels_from_data( $DataY , $StepsY )
		{
			try
			{
				$Labels = array();

				$MaxY = max( $DataY );
				$MinY = min( $DataY );
				$dY = ( $MaxY - $MinY ) / $StepsY;

				for( $i = 0 ; $i <= $StepsY ; $i++ )
				{
					$Labels [] = sprintf( '%.2f' , $MinY + $i * $dY );
				}

				return( $Labels );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Вывод графика.
		*
		*	@param $Options - Параметры отрисовки.
		*
		*	@param $Img - Изображение.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function outputs graph.
		*
		*	@param $Options - Draw parameters.
		*
		*	@param $Img - Image.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			output( &$Options , &$Img )
		{
			try
			{
				header( 'Content-type: image/png' );
				imagepng( $Img );
				imagedestroy( $Img );
				exit( 0 );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>