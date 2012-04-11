#!/usr/python
# -*- coding: utf-8 -*-

#
#	Начальная инициализация
#
import		sys , time , file
sys.path.append( sys.path[ 0 ] + "/../core/lang" );

global	LangModule;
LangModule = None;

def		GetLang():
	if( "-lang" in sys.argv and sys.argv.index( "-lang" ) + 1 < len( sys.argv ) ):
		if( file.FileExists( './lang/' + sys.argv[ sys.argv.index( "-lang" ) + 1 ] + '.py' ) ):
			return( sys.argv[ sys.argv.index( "-lang" ) + 1 ] );
	return( "english" );

def 	LoadLangModule( LangModuleName ):
	global	LangModule;
	LangModule = __import__( LangModuleName );
	
def 	GetString( StringName , DefaultValue = "undefined string" ):
	global	LangModule;

	try:
		if( hasattr( LangModule , StringName ) ):
			return( getattr( LangModule , StringName ) );
		else:
			return( DefaultValue + " #" + StringName + "#" );
	except:
		return( "An error occured while getting #" + StringName + "#" );
	
LoadLangModule( GetLang() );