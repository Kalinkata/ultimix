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
	
	/*
	*	w3captcha - php-скрипт для генерации изображений CAPTCHA
	*	версия: 1.0 от 01.02.2008
	*	разработчики: http://w3box.ru
	*	тип лицензии: freeware
	*	w3box.ru © 2008
	*/
	
	/**
	*	\~russian Каптча.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Captcha.
	*
	*	@author Dodonov A.A.
	*/
	class	captcha_1_0_0{
	
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
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Подготовка изображения.
		*
		*	@return Изображение.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function prepares image.
		*
		*	@return Image.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			prepare_image()
		{
			try
			{
				$Width = 100; /* ширина картинки */
				$Height = 30; /* высота картинки */
				$Image = imagecreatetruecolor( $Width , $Height );

				$BackgroundColor = imagecolorallocate( $Image , 255 , 255 , 255 ); /* rbg-цвет фона */
				
				imagefill( $Image , 0 , 0 , $BackgroundColor);
				
				return( $Image );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Получение параметров текста.
		*
		*	@return array( $FontFile , $CharAlign , $Start , $Interval , $Color , $NumChars ).
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns text parameters.
		*
		*	@param $Options - Settings.
		*
		*	@return array( $FontFile , $CharAlign , $Start , $Interval , $Color , $NumChars ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_font_settings()
		{
			try
			{
				$FontFile = dirname( __FILE__ ).'/res/font/albonic.ttf'; /* путь к файлу относительно w3captcha.php */
				$CharAlign = 22; /* выравнивание символа по-вертикали */
				$Start = 5; /* позиция первого символа по-горизонтали */
				$Interval = 16; /* интервал между началами символов */
				$Color = imagecolorallocate( $Image , 255 , 0 , 0 ); /* rbg-цвет тени */
				$NumChars = strlen( $Chars = "0123456789" );
				
				return( array( $FontFile , $CharAlign , $Start , $Interval , $Color , $NumChars ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Функция создания капчи.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@return array( $Image , $Str ).
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function creates captcha.
		*
		*	@param $Options - Settings.
		*
		*	@return array( $Image , $Str ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			create_captcha( &$Options )
		{
			try
			{
				$Image = $this->prepare_image();
				$Str = "";
				
				list( $FontFile , $CharAlign , $Start , $Interval , $Color , $NumChars ) = $this->get_font_settings();
				
				for( $i = 0 ; $i < 5 ; $i++ )
				{
					$Char = $Chars[ rand( 0 , $NumChars - 1 ) ];
					$FontSize = rand( 15 , 25 );
					$CharAngle = rand( -10 , 10 );
					imagettftext( 
						$Image , $FontSize , $CharAngle , $Start , $CharAlign , $Color , $FontFile , $Char
					);
					$Start += $Interval;
					$Str .= $Char;
				}
				
				return( array( $Image , $Str ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Функция получения названия капчи.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@return Название капчи.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns captcha name.
		*
		*	@param $Options - Settings.
		*
		*	@return Captcha name.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_sesion_name( &$Options )
		{
			try
			{
				$SessionName = 'captcha';
				
				if( $Options->get_setting( 'captcha_name' , false ) !== false )
				{
					if( $Options->get_setting( 'captcha_name' ) == 'auto' )
					{
						$SessionName = $Options->get_setting( 'captcha_name' );
					}
					else
					{
						$SessionName = md5( 
							$this->Security->get_srv( 'SCRIPT_NAME' , 'string' ).
							$this->Security->get_srv( 'QUERY_STRING' , 'string' )
						);
					}
				}
				
				return( $SessionName );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция проверки каптчи.
		*
		*	@param $InputCaptcha - Введенное значение.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@return true если каптча введена правильно.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function validates captcha.
		*
		*	@param $InputCaptcha - Input value.
		*
		*	@param $Options - Execution options.
		*
		*	@return true if the captcha was inputed correctly.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			validate_captcha( $InputCaptcha , $Options )
		{
			try
			{
				return( @$_SESSION[ $this->get_sesion_name( $Options ) ] == $InputCaptcha );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Вывод капчи.
		*
		*	@param $Image - Капча.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws capcha.
		*
		*	@param $Image - Captcha.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			output_image( &$Image )
		{
			try
			{
				if( function_exists( "imagepng" ) )
				{
					header( "Content-type: image/png" );
					imagepng( $Image );
				}
				elseif( function_exists( "imagegif" ) )
				{
					header( "Content-type: image/gif" );
					imagegif( $Image );
				}
				elseif( function_exists( "imagejpeg" ) )
				{
					header( "Content-type: image/jpeg" );
					imagejpeg( $Image );
				}
				
				imagedestroy( $Image ); 
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Функция отрисовки каптчи.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@return HTML формы.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws captcha.
		*
		*	@param $Options - Settings.
		*
		*	@return HTML code of the form.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			view( $Options )
		{
			try
			{
				@session_start();

				list( $Image , $Str ) = $this->create_captcha( $Options );
				
				$_SESSION[ $this->get_sesion_name( $Options ) ] = $Str;

				$this->output_image( $Image );
				
				return( '' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>