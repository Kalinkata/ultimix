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
	
	DEFINE( 'ERROR' , 'error' );
	DEFINE( 'NOTIFICATION' , 'notification' );
	DEFINE( 'COMMON' , 'common' );
	DEFINE( 'QUERY' , 'query' );

	/**
	*	\~russian Трассировка.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Trace class.
	*
	*	@author Dodonov A.A.
	*/
	class	trace_1_0_0{

		/**
		*	\~russian Трассировка.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Tracing strings.
		*
		*	@author Dodonov A.A.
		*/
		var					$StoreTrace = true;

		/**
		*	\~russian Трассировка.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Tracing strings.
		*
		*	@author Dodonov A.A.
		*/
		var					$TraceStrings = array();

		/**
		*	\~russian Шаблоны.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Templates.
		*
		*	@author Dodonov A.A.
		*/
		var					$Templates = array();

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
		var					$CachedMultyFS = false;
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
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );

				$Data = array( 
					ERROR => 'trace_line_error.tpl' , COMMON => 'trace_line_common.tpl' , 
					NOTIFICATION => 'trace_line_notification.tpl' , QUERY => 'trace_line_query.tpl' , 
					'start_group' => 'trace_start_group.tpl' , 'end_group' => 'trace_end_group.tpl'
				);

				foreach( $Data as $Key => $Value )
				{
					$this->Templates[ $Key ] = $this->CachedMultyFS->get_template( __FILE__ , $Value );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция добавления строки трасировки.
		*
		*	@param $Str - Строка трассировки.
		*
		*	@param $Type - Тип строки.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method adds tracing string.
		*
		*	@param $Str - Trace string.
		*
		*	@param $Type - String type.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			add_trace_string( $Str , $Type = COMMON )
		{
			try
			{
				if( $this->StoreTrace )
				{
					$Template = str_replace( '{string}' , $Str , $this->Templates[ $Type ] );

					$this->TraceStrings [] = array( 'name' => 'string' , 'content' => $Template );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция добавления группы.
		*
		*	@param $Str - Название группы.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method adds group.
		*
		*	@param $Str - Group title.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			start_group( $Str )
		{
			try
			{
				if( $this->StoreTrace )
				{
					$Template = str_replace( '{string}' , $Str , $this->Templates[ 'start_group' ] );
					$Template = str_replace( '{i}' , count( $this->TraceStrings ) , $Template );

					$this->TraceStrings [] = array( 'name' => 'start_group' , 'content' => $Template );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция закрытия группы.
		*
		*	@param $Count - Количество закрытых групп.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method ends group.
		*
		*	@param $Count - Count of the ending groups.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			end_group( $Count = 1 )
		{
			try
			{
				if( $this->StoreTrace )
				{
					for( $i = 0 ; $i < $Count ; $i++ )
					{
						$this->TraceStrings [] = array( 
							'name' => 'end_group' , 'content' => $this->Templates[ 'end_group' ]
						);
					}
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция добавления записи в лог.
		*
		*	@param $ActionName - Название действия.
		*
		*	@param $ActionDescription - Описание действия.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method adds record to log.
		*
		*	@param $ActionName - Action's title.
		*
		*	@param $ActionDescription - Action's description.
		*
		*	@author Dodonov A.A.
		*/
		function			add_action( $ActionName , $ActionDescription )
		{
			try
			{
				if( $this->StoreTrace )
				{
					$Database = get_package( 'database' );
					$Database->insert( 
						'umx_action' , "action_name , time , info" , 
						"'".htmlspecialchars( $ActionName , ENT_QUOTES )."', NOW() ,'".
							htmlspecialchars( $ActionDescription , ENT_QUOTES )."'"
					);
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция удаляет пустые листовые тэги.
		*
		*	@return Количество удалённых тэгов.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method removes empty leaf tags.
		*
		*	@return Count of the removed tags.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	remove_empty_leaves()
		{
			try
			{
				$Counter = 0;

				for( $i = 0 ; $i < count( $this->TraceStrings ) ; )
				{
					if( get_field( $this->TraceStrings[ $i ] , 'name' ) == 'start_group' &&
						get_field( $this->TraceStrings[ $i + 1 ] , 'name' ) == 'end_group' )
					{
						$Counter++;
						array_splice( $this->TraceStrings , $i , 2 );
					}
					else
					{
						$i++;
					}
				}

				return( $Counter );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция удаляет все пустые тэги.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method removes all empty tags.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	remove_empty_tags()
		{
			try
			{
				for( ; $this->remove_empty_leaves() ; );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции трассировки.
		*
		*	@return HTML код.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method compiles trace.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_trace_items()
		{
			try
			{
				$this->remove_empty_tags();

				$Output  = $this->CachedMultyFS->get_template( __FILE__ , 'trace_start.tpl' );
				$Output .= implode_ex( '' , $this->TraceStrings , 'content' );
				$Output .= $this->CachedMultyFS->get_template( __FILE__ , 'trace_end.tpl' );
				$Output = str_replace( 
					'{output}' , $Output , $this->CachedMultyFS->get_template( __FILE__ , 'trace.tpl' )
				);

				return( $Output );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции трассировки.
		*
		*	@return HTML код.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method compiles trace.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_trace()
		{
			try
			{
				if( $this->StoreTrace )
				{
					$Output = $this->compile_trace_items();

					$TraceBlock = $this->CachedMultyFS->get_template( __FILE__ , 'trace_block.tpl' );
					$TraceBlock = str_replace( '{output}' , $Output , $TraceBlock );

					return( $TraceBlock );
				}
				else
				{
					return( '{lang:trace_switched_off}' );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция конвертации объекта в строку.
		*
		*	@return Строка с описанием объекта.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function converts object to string.
		*
		*	@return String with the object's description.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			__toString()
		{
			try
			{
				return( "" );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>