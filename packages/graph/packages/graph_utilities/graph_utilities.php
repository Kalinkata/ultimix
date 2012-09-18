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
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function prepares canvas for drawing.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	prepare_canvas( &$Graph )
		{
			try
			{
				$Graph->Img = imagecreatetruecolor( $this->Width , $this->Height );

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
		private function	compile_client_width_height( $ClientX = 20 , $ClientY = 20 , $Width = 0 , $Height = 0 )
		{
			try
			{
				$this->ClientX = intval( $ClientX );
				$this->ClientY = intval( $ClientY );

				if( $Width === 0 )
				{
					$this->ClientWidth = $this->Width - 2 * $this->ClientX;
				}
				else
				{
					$this->ClientWidth = intval( $Width );
				}

				if( $Height === 0 )
				{
					$this->ClientHeight = $this->Height - 2 * $this->ClientY;
				}
				else
				{
					$this->ClientHeight = intval( $Height );
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
		private function	init_client_area( &$Graph )
		{
			try
			{
				$ClientX = $this->Security->get_gp( 'client_x' , 'integer' , 50 );
				$ClientY = $this->Security->get_gp( 'client_y' , 'integer' , 20 );
				$ClientWidth = $this->Security->get_gp( 'client_width' , 'integer' , $Width - 70 );
				$ClientHeight = $this->Security->get_gp( 'client_height' , 'integer' , $Height - 40 );
				$Graph->compile_client_width_height( $ClientX , $ClientY , $ClientWidth , $ClientHeight );
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
				$this->set_width_height();

				$this->prepare_canvas();

				$BackgroundColor = $this->Security->get_gp( 'background_color' , 'integer' , 0xeeeeee );
				$this->GraphCore->fill_background( $this->Img , $BackgroundColor );

				$this->init_client_area();

				$GraphAreaColor = $this->Security->get_gp( 'graph_area_color' , 'integer' , 0xffffff );
				$this->fill_graph_area( $GraphAreaColor );

				$this->draw_grid();
				$this->draw_coordinates();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>