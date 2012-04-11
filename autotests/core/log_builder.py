#!/usr/python
# -*- coding: utf-8 -*-

import		file , string_utilities , conf , sys

#
#	Функция определения цвета строки в таблице.
#
#	@param RowCursor - курсор выводимой строки.
#
#	@param ErrorFlag - если 1, то тест завершился с ошибкой, если 0 то успешно.
#
#	@return Строку с текстовый выражением цвета в #RGB формате.
#
#	@author Додонов А.А.
#
def			GetRowColor( RowCursor , ErrorFlag ):
	if( RowCursor % 2 == 0 and ErrorFlag ):
		return( "#FFABAB" );
	if( RowCursor % 2 == 1 and ErrorFlag ):
		return( "#FFCDCD" );
		
	if( RowCursor % 2 == 0 and not ErrorFlag ):
		return( "#ABFFAB" );
	if( RowCursor % 2 == 1 and not ErrorFlag ):
		return( "#CDFFCD" );

#
#	Класс для создания HTMLных логов.
#
#	@author Додонов А.А.
#
class	LogBuilder:

	#
	#	Тип лога. Пока может быть XML или HTML.
	#
	#	@author Додонов А.А.
	#
	Type = "html";

	#
	#	Фунцкия обрабатывает параметр -rn и возвращает имя файла отчета с учетом всех сделанных подстановок.
	#
	#	@param Extension - расширение лога.
	#
	#	@return Имя файла отчета с учетом всех сделанных подстановок.
	#
	#	@author Додонов А.А. 
	#
	def		GetLogFileName( self = 0 , Title = 0 ):
		if( "-rn" in sys.argv ):
			FileNamePattern = sys.argv[ sys.argv.index( "-rn" ) + 1 ];
			NowDateTime = datetime.datetime.now();
			FileNamePattern = string_utilities.MassiveReplace( FileNamePattern , { "#now_year#" : str( NowDateTime.year ) , "#now_month#" : format( "{02d}" , NowDateTime.month ) , "#now_day#" : format( "{02d}" , NowDateTime.day ) , "#now_hour#" : format( "{02d}" , NowDateTime.hour ) , "#now_minute#" : format( "{02d}" , NowDateTime.minute ) , "#now_second#" : format( "{02d}" , NowDateTime.second ) } );
			if( Title == 0 ):
				return( FileNamePattern + "." + self.GetType() );
			else:
				return( FileNamePattern );

		if( Title == 0 ):
			return( "autotest_log" + "." + self.GetType() );
		else:
			return( "autotest_log" );
	
	#
	#	Тип лога. Пока может быть XML или HTML.
	#
	#	@author Додонов А.А.
	#
	def		SetType( self ):
		if( "-xml" in sys.argv ):
			self.Type = "xml";
			
	#
	#	Возвращает тип лога.
	#
	#	@return Тип лога.
	#
	#	@author Додонов А.А.
	#
	def		GetType( self ):
		self.SetType();
		
		return( self.Type );

	#
	#	Поток вывода.
	#
	#	@author Додонов А.А.
	#
	FStream = 0;
	
	#
	#	Получение потока вывода.
	#
	#	@author Додонов А.А.
	#
	def		GetStream( self ):
		if( self.FStream == 0 ):
			self.FStream = open( conf.workspace_path + "../" + self.GetLogFileName() , "wb+" );
			
		return( self.FStream );
		
	#
	#	Заголовок таблицы с данными.
	#
	#	@author Додонов А.А.
	#
	TableHeader = 0;
	
	#
	#	Получение заголовка страницы.
	#
	#	@author Додонов А.А.
	#
	def		GetTableHeader( self ):
		if( self.TableHeader == 0 ):
			self.TableHeader = string_utilities._unicode( file.LoadFile( conf.core_path + "templates/inc_1." + self.GetType() ) );
			
		return( self.TableHeader );
		
	#
	#	Подвал таблицы с данными.
	#
	#	@author Додонов А.А.
	#
	TableFooter = 0;
		
	#
	#	Получение подвала страницы.
	#
	#	@author Додонов А.А.
	#
	def		GetTableFooter( self ):
		if( self.TableFooter == 0 ):
			self.TableFooter = string_utilities._unicode( file.LoadFile( conf.core_path + "templates/inc_2." + self.GetType() ) );
			
		return( self.TableFooter );
		
	#
	#	Статистика по времени.
	#
	#	@author Додонов А.А.
	#
	TimeStat = 0;
		
	#
	#	Получение подвала страницы.
	#
	#	@author Додонов А.А.
	#
	def		GetTimeStat( self ):
		if( self.TimeStat == 0 ):
			self.TimeStat = string_utilities._unicode( file.LoadFile( conf.core_path + "templates/inc_3." + self.GetType() ) );
			
		return( self.TimeStat );
		
	#
	#	Общее количество ошибок.
	#
	#	@author Додонов А.А.
	#
	TotalErrors = 0;
		
	#
	#	Получение формы вывода общего количества ошибок.
	#
	#	@author Додонов А.А.
	#
	def		GetTotalErrors( self ):
		if( self.TotalErrors == 0 ):
			self.TotalErrors = string_utilities._unicode( file.LoadFile( conf.core_path + "templates/inc_rep_1." + self.GetType() ) );
			
		return( self.TotalErrors );
		
	#
	#	Количество ошибок для каждого тестировщика.
	#
	#	@author Додонов А.А.
	#
	IndividualErrors = "";
		
	#
	#	Получение формы отображения статистики ошибок по пользователям.
	#
	#	@author Додонов А.А.
	#
	def		GetIndividualErrors( self ):
		return( string_utilities._unicode( file.LoadFile( conf.core_path + "templates/inc_rep_2." + self.GetType() ) ) );
		
	#
	#	Строки отчета.
	#
	#	@author Додонов А.А.
	#
	ReportRows = "";
		
	#
	#	Получение шаблона строки отчета.
	#
	#	@author Додонов А.А.
	#
	def		GetReportRows( self ):
		return( string_utilities._unicode( file.LoadFile( conf.core_path + "templates/inc_4." + self.GetType() ) ) );
	
	#
	#	Выполнение подстановок.
	#
	#	@param PartName - название части которую будем обрабатывать.
	#
	#	@param Data - данные дляподстановки.
	#
	#	@author Додонов А.А.
	#
	def		Set( self , PartName , Data ):
		if( PartName == "table_header" ):
			self.TableHeader = string_utilities.MassiveReplace( self.GetTableHeader() , Data );
		elif( PartName == "table_footer" ):
			self.TableFooter = string_utilities.MassiveReplace( self.GetTableFooter() , Data );
		elif( PartName == "total_errors" ):
			self.TotalErrors = string_utilities.MassiveReplace( self.GetTotalErrors() , Data );
		elif( PartName == "individual_errors" ):
			self.IndividualErrors = self.IndividualErrors + string_utilities.MassiveReplace( self.GetIndividualErrors() , Data );
		elif( PartName == "report_row" ):
			self.ReportRows = self.ReportRows + string_utilities.MassiveReplace( self.GetReportRows() , Data );
		elif( PartName == "time_stat" ):
			self.TimeStat = string_utilities.MassiveReplace( self.GetTimeStat() , Data );
			
	#
	#	Получение потока вывода.
	#
	#	@author Додонов А.А.
	#	
	def		Compile( self ):
		self.GetStream().write( string_utilities.StrToBytes( self.GetTableHeader() , 'utf-8' ) );
		self.GetStream().write( string_utilities.StrToBytes( self.ReportRows , 'utf-8' ) );
		self.GetStream().write( string_utilities.StrToBytes( str( self.GetTableFooter() ) , 'utf-8' ) );
		self.GetStream().write( string_utilities.StrToBytes( self.GetTotalErrors() , 'utf-8' ) );
		self.GetStream().write( string_utilities.StrToBytes( self.IndividualErrors , 'utf-8' ) );
		self.GetStream().write( string_utilities.StrToBytes( self.GetTimeStat() , 'utf-8' ) );
		self.GetStream().close();