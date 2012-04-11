#!/usr/python
# -*- coding: utf-8 -*-

import		sys , os , conf , string_utilities

if( sys.version_info[ 0 ] >= 3 ):
	import 		http.client , urllib.parse
else:
	import		httplib , urllib
	
#
#	Функция отправки HTTP запроса.
#
#	@param Host - хост.
#
#	@param URL - URL запрашиваемой страницы.
#
#	@param Timeout - таймаут запроса.
#
#	@param Method - метод отправки данных.
#
#	@return Строка с ответом.
#
#	@exception Может и кидануть.
#
#	@author Додонов А.А.
#
def			HTTPRequest( Host , URL , Timeout = 10 , Method = 'POST' , StringParams = {} ):	
	Host = Host.replace( '{path}' , conf.http_server_path );
	Host = Host.replace( '{host}' , conf.http_server_host );
	Host = Host.replace( '{login}' , conf.http_server_login );
	Host = Host.replace( '{password}' , conf.http_server_password );
	
	URL = URL.replace( '{path}' , conf.http_server_path );
	URL = URL.replace( '{host}' , conf.http_server_host );
	URL = URL.replace( '{login}' , conf.http_server_login );
	URL = URL.replace( '{password}' , conf.http_server_password );

	Timeout = float( Timeout );

	if( sys.version_info[ 0 ] >= 3 ):
		Connection = http.client.HTTPConnection( Host );
	else:
		Connection = httplib.HTTPConnection( Host );
	
	if( sys.version_info[ 0 ] >= 3 ):
		Params = urllib.parse.urlencode( StringParams );
	else:
		Params = urllib.urlencode( StringParams );
	
	Headers = { "Content-type" : "application/x-www-form-urlencoded" , "Accept" : "text/plain" };
	Connection.request( Method , URL , Params , Headers );
	Response = Connection.getresponse();
	
	ReturnValue = { "status" : Response.status , "response" : Response.read() };
	
	Connection.close();
	
	return( ReturnValue );
	"""except:
		return( { "status" : 404 , "response" : 'No response' } );"""
	
#
#	Функция отправки HTTPS запроса.
#
#	@param Host - хост.
#
#	@param URL - URL запрашиваемой страницы.
#
#	@param Timeout - таймаут запроса.
#
#	@param Method - метод отправки данных.
#
#	@return Строка с ответом.
#
#	@exception Может и кидануть.
#
#	@author Додонов А.А.
#
def			HTTPSRequest( Host , URL , Timeout = 10 , Method = 'POST' , StringParams = {} ):
	try:
		Host = Host.replace( '{path}' , conf.http_server_path );
		Host = Host.replace( '{host}' , conf.http_server_host );
		Host = Host.replace( '{login}' , conf.http_server_login );
		Host = Host.replace( '{password}' , conf.http_server_password );
		
		URL = URL.replace( '{path}' , conf.http_server_path );
		URL = URL.replace( '{host}' , conf.http_server_host );
		URL = URL.replace( '{login}' , conf.http_server_login );
		URL = URL.replace( '{password}' , conf.http_server_password );
	
		Timeout = float( Timeout );
	
		if( sys.version_info[ 0 ] >= 3 ):
			Connection = http.client.HTTPSConnection( Host , timeout = Timeout );
		else:
			Connection = httplib.HTTPSConnection( Host , timeout = Timeout );
		
		if( sys.version_info[ 0 ] >= 3 ):
			Params = urllib.parse.urlencode( StringParams );
		else:
			Params = urllib.urlencode( StringParams );
		
		Headers = { "Content-type" : "application/x-www-form-urlencoded" , "Accept" : "text/plain" };
		Connection.request( Method , URL , Params , Headers );
		Response = Connection.getresponse();
		
		ReturnValue = { "status" : Response.status , "response" : Response.read() };
		
		Connection.close();
		
		return( ReturnValue );
	except:
		return( { "status" : 404 , "response" : 'No response' } );
	
#
#	Функция получения количества тестов.
#
#	@param Host - хост.
#
#	@param URL - URL запрашиваемой страницы.
#
#	@param Timeout - таймаут запроса.
#
#	@param Method - метод отправки данных.
#
#	@return Строка с ответом.
#
#	@exception Может и кидануть.
#
#	@author Додонов А.А.
#
def			HTTPGetTestCount( Host , URL , Timeout = 10 , Method = 'POST' ):
	try:
		Ret = HTTPRequest( Host , URL , Timeout , Method , { 'action' : 'get_sub_test_count' } );
		
		if( Ret[ 'status' ] != 200 ):
			return( 1 );
		
		return( int( Ret[ 'response' ] ) );
	except ValueError:
		return( 1 );
	
#
#	Функция получения названия конкретного теста.
#
#	@param TestID - идентификатор теста.
#
#	@param Host - хост.
#
#	@param URL - URL запрашиваемой страницы.
#
#	@param Timeout - таймаут запроса.
#
#	@param Method - метод отправки данных.
#
#	@return Строка с ответом.
#
#	@exception Может и кидануть.
#
#	@author Додонов А.А.
#
def			HTTPGetTestName( TestID , Host , URL , Timeout = 10 , Method = 'POST' ):
	Ret = HTTPRequest( Host , URL , Timeout , Method , { 'action' : 'get_sub_test_name' , 'test_id' : TestID } );
	
	if( Ret[ 'status' ] != 200 ):
		return( '1' );
	
	s = string_utilities.BytesToStr( Ret[ 'response' ] , 'utf-8' );
	
	if( len( s ) > 128 ):
		return( 'Error getting name' );
	
	if( s == 'Illegal request parameters' ):
		return( str( TestID ) );
	else:
		return( s );
	
#
#	Функция запуска теста.
#
#	@param TestID - идентификатор теста.
#
#	@param Host - хост.
#
#	@param URL - URL запрашиваемой страницы.
#
#	@param Timeout - таймаут запроса.
#
#	@param Method - метод отправки данных.
#
#	@return Строка с ответом.
#
#	@exception Может и кидануть.
#
#	@author Додонов А.А.
#
def			HTTPRunTest( TestID , Host , URL , Timeout = 10 , Method = 'POST' ):
	Ret = HTTPRequest( Host , URL , Timeout , Method , { 'action' : 'run_sub_test' , 'test_id' : TestID } );

	if( Ret[ 'status' ] != 200 ):
		return( string_utilities.StrToBytes( 'HTTP ERROR ' + string_utilities.BytesToStr( Ret[ 'response' ] , 'utf-8' ) , 'utf-8' ) );
	
	return( Ret[ 'response' ] );
	
#
#	Функция запуска теста.
#
#	@param TestID - идентификатор теста.
#
#	@param Host - хост.
#
#	@param URL - URL запрашиваемой страницы.
#
#	@param Timeout - таймаут запроса.
#
#	@param Method - метод отправки данных.
#
#	@return Строка с ответом.
#
#	@exception Может и кидануть.
#
#	@author Додонов А.А.
#
def			SimpleHTTPRunTest( TestID , Host , URL , Timeout = 10 , Method = 'POST' ):
	Ret = HTTPRequest( Host , URL , Timeout , Method , {} );

	if( Ret[ 'status' ] != 200 ):
		return( string_utilities.StrToBytes( 'HTTP ERROR ' + string_utilities.BytesToStr( Ret[ 'response' ] , 'utf-8' ) , 'utf-8' ) );
	
	return( Ret[ 'response' ] );
	
#
#	Функция получения количества тестов.
#
#	@param Host - хост.
#
#	@param URL - URL запрашиваемой страницы.
#
#	@param Timeout - таймаут запроса.
#
#	@param Method - метод отправки данных.
#
#	@return Строка с ответом.
#
#	@exception Может и кидануть.
#
#	@author Додонов А.А.
#
def			HTTPSGetTestCount( Host , URL , Timeout = 10 , Method = 'POST' ):
	try:
		Ret = HTTPSRequest( Host , URL , Timeout , Method , { 'action' : 'get_sub_test_count' } );
		
		if( Ret[ 'status' ] != 200 ):
			return( 1 );
		
		return( int( Ret[ 'response' ] ) );
	except ValueError:
		return( 1 );

#
#	Функция получения названия конкретного теста.
#
#	@param TestID - идентификатор теста.
#
#	@param Host - хост.
#
#	@param URL - URL запрашиваемой страницы.
#
#	@param Timeout - таймаут запроса.
#
#	@param Method - метод отправки данных.
#
#	@return Строка с ответом.
#
#	@exception Может и кидануть.
#
#	@author Додонов А.А.
#
def			HTTPSGetTestName( TestID , Host , URL , Timeout = 10 , Method = 'POST' ):
	Ret = HTTPSRequest( Host , URL , Timeout , Method , { 'action' : 'get_sub_test_name' , 'test_id' : TestID } );
	
	if( Ret[ 'status' ] != 200 ):
		return( '1' );
	
	s = string_utilities.BytesToStr( Ret[ 'response' ] , 'utf-8' );
	
	if( len( s ) > 128 ):
		return( 'Error getting name' );
	
	if( s == 'Illegal request parameters' ):
		return( str( TestID ) );
	else:
		return( s );
		
#
#	Функция запуска теста.
#
#	@param TestID - идентификатор теста.
#
#	@param Host - хост.
#
#	@param URL - URL запрашиваемой страницы.
#
#	@param Timeout - таймаут запроса.
#
#	@param Method - метод отправки данных.
#
#	@return Строка с ответом.
#
#	@exception Может и кидануть.
#
#	@author Додонов А.А.
#
def			HTTPSRunTest( TestID , Host , URL , Timeout = 10 , Method = 'POST' ):
	Ret = HTTPSRequest( Host , URL , Timeout , Method , Params , { 'action' : 'run_sub_test' , 'test_id' : TestID } );

	if( Ret[ 'status' ] != 200 ):
		return( string_utilities.StrToBytes( 'HTTP ERROR ' + string_utilities.BytesToStr( Ret[ 'response' ] , 'utf-8' ) , 'utf-8' ) );
	
	return( Ret[ 'response' ] );

#
#	Функция запуска теста.
#
#	@param TestID - идентификатор теста.
#
#	@param Host - хост.
#
#	@param URL - URL запрашиваемой страницы.
#
#	@param Timeout - таймаут запроса.
#
#	@param Method - метод отправки данных.
#
#	@return Строка с ответом.
#
#	@exception Может и кидануть.
#
#	@author Додонов А.А.
#
def			SimpleHTTPSRunTest( TestID , Host , URL , Timeout = 10 , Method = 'POST' ):
	Ret = HTTPSRequest( Host , URL , Timeout , Method , Params , {} );

	if( Ret[ 'status' ] != 200 ):
		return( string_utilities.StrToBytes( 'HTTP ERROR ' + string_utilities.BytesToStr( Ret[ 'response' ] , 'utf-8' ) , 'utf-8' ) );
	
	return( Ret[ 'response' ] );
	
#
#	Функция получения количества тестов.
#
#	@param Manifest - манифест запроса.
#
#	@return Строка с ответом.
#
#	@exception Может и кидануть.
#
#	@author Додонов А.А.
#
def			HTTPGetTestCountEx( Manifest ):	
	return( HTTPGetTestCount(   Manifest.GetTagByName( "host" ).GetAttributeValue( "value" ) , 
								Manifest.GetTagByName( "url" ).GetAttributeValue( "value" ).replace( '{amp}' , '&' ) , 
								float( Manifest.GetTagByName( "timeout" ).GetAttributeValue( "value" ) ) , 
								Manifest.GetTagByName( "method" ).GetAttributeValue( "value" , "POST" ) ) );
								
#
#	Функция получения названия теста.
#
#	@param TestID - идентификатор теста.
#
#	@param Manifest - манифест запроса.
#
#	@return Строка с ответом.
#
#	@exception Может и кидануть.
#
#	@author Додонов А.А.
#
def			HTTPGetTestNameEx( TestID , Manifest ):	
	return( HTTPGetTestName( TestID , Manifest.GetTagByName( "host" ).GetAttributeValue( "value" ) , 
								Manifest.GetTagByName( "url" ).GetAttributeValue( "value" ).replace( '{amp}' , '&' ) , 
								float( Manifest.GetTagByName( "timeout" ).GetAttributeValue( "value" ) ) , 
								Manifest.GetTagByName( "method" ).GetAttributeValue( "value" , "POST" ) ) );
	
#
#	Функция получения количества тестов.
#
#	@param TestID - идентификатор теста.
#
#	@param Manifest - манифест запроса.
#
#	@return Строка с ответом.
#
#	@exception Может и кидануть.
#
#	@author Додонов А.А.
#
def			HTTPRunTestEx( TestID , Manifest ):
	return( HTTPRunTest( TestID , Manifest.GetTagByName( "host" ).GetAttributeValue( "value" ) , 
								  Manifest.GetTagByName( "url" ).GetAttributeValue( "value" ).replace( '{amp}' , '&' ) , 
								  Manifest.GetTagByName( "timeout" ).GetAttributeValue( "value" ) , 
								  Manifest.GetTagByName( "method" ).GetAttributeValue( "value" , "POST" ) ) );
								  
#
#	Функция запуска теста.
#
#	@param TestID - идентификатор теста.
#
#	@param Manifest - манифест запроса.
#
#	@return Строка с ответом.
#
#	@exception Может и кидануть.
#
#	@author Додонов А.А.
#
def			SimpleHTTPRunTestEx( TestID , Manifest ):
	return( SimpleHTTPRunTest( TestID , Manifest.GetTagByName( "host" ).GetAttributeValue( "value" ) , 
								  Manifest.GetTagByName( "url" ).GetAttributeValue( "value" ).replace( '{amp}' , '&' ) , 
								  Manifest.GetTagByName( "timeout" ).GetAttributeValue( "value" ) , 
								  Manifest.GetTagByName( "method" ).GetAttributeValue( "value" , "POST" ) ) );
	
#
#	Функция получения количества тестов.
#
#	@param Manifest - манифест запроса.
#
#	@return Строка с ответом.
#
#	@exception Может и кидануть.
#
#	@author Додонов А.А.
#
def			HTTPSGetTestCountEx( Manifest ):
	return( HTTPSGetTestCount( Manifest.GetTagByName( "host" ).GetAttributeValue( "value" ) , 
								Manifest.GetTagByName( "url" ).GetAttributeValue( "value" ).replace( '{amp}' , '&' ) , 
								Manifest.GetTagByName( "timeout" ).GetAttributeValue( "value" ) , 
								Manifest.GetTagByName( "method" ).GetAttributeValue( "value" , "POST" ) ) );
	
#
#	Функция получения количества тестов.
#
#	@param TestID - идентификатор теста.
#
#	@param Manifest - манифест запроса.
#
#	@return Строка с ответом.
#
#	@exception Может и кидануть.
#
#	@author Додонов А.А.
#
def			HTTPSRunTestEx( TestID , Manifest ):
	return( HTTPSRunTest( TestID , Manifest.GetTagByName( "host" ).GetAttributeValue( "value" ) , 
								   Manifest.GetTagByName( "url" ).GetAttributeValue( "value" ).replace( '{amp}' , '&' ) , 
								   Manifest.GetTagByName( "timeout" ).GetAttributeValue( "value" ) , 
								   Manifest.GetTagByName( "method" ).GetAttributeValue( "value" , "POST" ) ) );
								
#
#	Функция получения количества тестов.
#
#	@param TestID - идентификатор теста.
#
#	@param Manifest - манифест запроса.
#
#	@return Строка с ответом.
#
#	@exception Может и кидануть.
#
#	@author Додонов А.А.
#
def			SimpleHTTPSRunTestEx( TestID , Manifest ):
	return( SimpleHTTPSRunTest( TestID , Manifest.GetTagByName( "host" ).GetAttributeValue( "value" ) , 
								   Manifest.GetTagByName( "url" ).GetAttributeValue( "value" ).replace( '{amp}' , '&' ) , 
								   Manifest.GetTagByName( "timeout" ).GetAttributeValue( "value" ) , 
								   Manifest.GetTagByName( "method" ).GetAttributeValue( "value" , "POST" ) ) );
								   
#
#	Функция получения названия теста.
#
#	@param TestID - идентификатор теста.
#
#	@param Manifest - манифест запроса.
#
#	@return Строка с ответом.
#
#	@exception Может и кидануть.
#
#	@author Додонов А.А.
#
def			HTTPSGetTestNameEx( TestID , Manifest ):	
	return( HTTPSGetTestName( TestID , Manifest.GetTagByName( "host" ).GetAttributeValue( "value" ) , 
								Manifest.GetTagByName( "url" ).GetAttributeValue( "value" ).replace( '{amp}' , '&' ) , 
								float( Manifest.GetTagByName( "timeout" ).GetAttributeValue( "value" ) ) , 
								Manifest.GetTagByName( "method" ).GetAttributeValue( "value" , "POST" ) ) );