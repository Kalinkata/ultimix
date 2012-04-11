#!/usr/python
# -*- coding: utf-8 -*-

import			file , re , sys , locale , codecs , conf

#
#	Фунцкия обработки лога теста.
#
#	@param LogFile - содержимое файла лога.
#
#	@return Обработанное содержимое файла лога (в виде строки).
#
#	@author Додонов А.А. 
#
def			ProcessLog( LogFile ):
	if( ( sys.version_info[ 0 ] == 2 and sys.version_info[ 1 ] >= 2 ) or ( sys.version_info[ 0 ] >= 3 ) ):
		if( conf.console_encoding != None ):
			d = codecs.getdecoder( conf.console_encoding );
		else:
			if( locale.getlocale()[ 1 ] == None ):
				d = codecs.getdecoder( 'cp1251' );
			else:
				d = codecs.getdecoder( locale.getlocale()[ 1 ] );
	else:
		if( conf.console_encoding != None ):
			d = codecs.lookup( conf.console_encoding )[ 1 ];
		else:
			if( sys.version_info[ 0 ] > 1 ):
				d = codecs.lookup( locale.getlocale()[ 1 ] )[ 1 ];
			else:
				d = None;
		
	if( sys.version_info[ 0 ] == 2 and sys.version_info[ 1 ] in [ 3 , 4 , 5 ,6 ] ):
		LogFile = d( LogFile )[ 0 ].replace( "\r" , "" );
	elif( sys.version_info[ 0 ] >= 3 ):
		if( type( LogFile ) == type( "" ) ):
			LogFile = LogFile.replace( "\r" , "" );
		else:
			LogFile = d( LogFile )[ 0 ].replace( "\r" , "" );
	else:
		if( d != None ):
			LogFile = d( LogFile )[ 0 ].replace( "\r" , "" );
		else:
			LogFile = 'ERROR (Log file is hidden but it can be found in %test_project_pah%/logs directory)';
	
	return( LogFile );

#
#	Функция отчищает строку.
#
#	@param ClearingString - очищаемая строка.
#
#	@return Имя файла отчета с учетом всех сделанных подстановок.
#
#	@author Додонов А.А. 
#
def			CleanStr( ClearingString ):	
	if( sys.version_info[ 0 ] >= 3 ):
		return( ClearingString.replace( "\\r" , "\r" ).replace( "\\n" , "\n" ).replace( "\\t" , "\t" ).replace( "'b'" , "" ) );
	else:
		return( ClearingString );

#
#	Фунцкия при необходмости преобразует строку в цепочку байт.
#
#	@param String - строка для кодирования.
#
#	@param Encoding - кодировка.
#
#	@return Имя файла отчета с учетом всех сделанных подстановок.
#
#	@author Додонов А.А. 
#
def			StrToBytes( String , Encoding = 'utf-8' ):
	if( sys.version_info[ 0 ] == 2 and sys.version_info[ 1 ] == 6 ):
		if( type( String ) == type( unicode( 'unicode' , Encoding ) ) ):
			return( String.encode( Encoding ) );
		else:
			return( String );
			
	if( sys.version_info[ 0 ] == 2 and sys.version_info[ 1 ] in [ 0 , 1 , 2 , 3 , 4 , 5 ] ):
		return( String.encode( Encoding ) );
		
	if( sys.version_info[ 0 ] == 1 and sys.version_info[ 1 ] == 6 ):
		return( String );
		
	if( sys.version_info[ 0 ] >= 3 ):
		if( type( String ) == type( '' ) ):
			return( bytes( CleanStr( String ) , Encoding ) );
		else:
			return( String );
			
	return( String );
	
#
#	Фунцкия при необходмости преобразует строку в цепочку байт.
#
#	@param String - строка для кодирования.
#
#	@param Encoding - кодировка.
#
#	@return Имя файла отчета с учетом всех сделанных подстановок.
#
#	@author Додонов А.А. 
#
def			BytesToStr( Bytes , Encoding = 'utf-8' ):
	if( sys.version_info[ 0 ] >= 3 ):
		if( type( Bytes ) == type( '' ) ):
			return( Bytes );
		else:
			return( str( Bytes , Encoding ) );
			
	return( Bytes );

#
#	Преобразование строки в unicode.
#
#	@param ConvertingString - преобразовываемая строка.
#
#	@param Encoding - кодировка.
#
#	@exception Может и кидануть.
#
#	@author Додонов А.А.
#
def			_unicode( ConvertingString , Encoding = 'utf-8' ):
	if( sys.version_info[ 0 ] >= 3 ):
		return( ConvertingString );
	elif( sys.version_info[ 0 ] == 1 ):
		return( ConvertingString );
	else:
		return( unicode( ConvertingString , Encoding ) );

#
#	Функция поиска подстроки в файле
#
#	@param SearchString - искомая строка.
#
#	@param FilePath - путь к обрабатываемому файлу.
#
#	@return 1 если подстрока найдена, 0 если не найдена.
#
#	@exception Может и кидануть.
#
#	@author Додонов А.А.
#
def			FindStringInFile( SearchString , FilePath ):
	if( file.FileExists( SearchString ) ):
		FileContent = file.LoadFile( FilePath );
		if( string.find( FileContent , SearchString ) != -1 ):
			return( 1 );
		else:
			return( 0 );
	else:
		return( 0 );

#
#	Функция поиска подстроки в файле удовлетворяющей паттерну RegexpPattern
#
#	@param RegexpPattern - паттерн регулярного выражения.
#
#	@param FilePath - путь к обрабатываемому файлу.
#
#	@return 1 если подстрока найдена, 0 если не найдена.
#
#	@exception Может и кидануть.
#
#	@author Додонов А.А.
#		
def			FileMatchesRegexp( RegexpPattern , FilePath ):
	if( file.FileExists( SearchString ) ):
		RegexpObject = re.compile( RegexpPattern , re.MULTILINE | re.UNICODE );
		FileContent = file.LoadFile( FilePath );
		if( RegexpObject.match( FileContent ) == None ):
			return( 0 );
		else:
			return( 1 );
	else:
		return( 0 );

#
#	Функция массовой замены подстрок в строке
#
#	@param Template - обрабатываемая строка.
#
#	@param Substitutions - подстановки в виде словаря.
#
#	@return Обработанная строка.
#
#	@exception Может и кидануть.
#
#	@author Додонов А.А.
#
def			MassiveReplace( Template , Substitutions ):
	for k in Substitutions.keys():
		if( sys.version_info[ 0 ] >= 3 ):
			Template = str( Template ).replace( k , Substitutions[ k ] );
		else:
			Template = Template.replace( k , Substitutions[ k ] );
	return( Template );

#
#	Очищаем строку от слэшей и бэкслэшей.
#
#	@param s - обрабатываемая строка.
#
#	@return Обработанная строка.
#
#	@exception Может и кидануть.
#
#	@author Додонов А.А.
#	
def			StripSlashes( s ):
	if( s[ len( s ) - 1 ] == "/" ):
		s = s[ 0 : len( s ) - 1 ];
		
	if( s[ len( s ) - 1 ] == "\\" ):
		s = s[ 0 : len( s ) - 1 ];
		
	return( s );
