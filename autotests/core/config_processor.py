#!/usr/python
# -*- coding: utf-8 -*-

import 	sys , copy , string , file

if( sys.version_info[ 0 ] == 1 and sys.version_info[ 1 ] == 6 ):
	import	xmllib
	
	class 	Parser( xmllib.XMLParser ):
		#
		#	DOM модель документа.
		#
		#	@author Додонов А.А.
		#
		DOM = [];
		
		#
		#	Путь до требуемого тэга.
		#
		#	@author Додонов А.А.
		#
		DOMPath = [];
		
		#
		#	Конструктор.
		#
		#	@author Додонов А.А.
		#
		def 	__init__( self , **kw ):
			apply( xmllib.XMLParser.__init__ , ( self , ) , kw );
			self.DOM = [];
			self.DOMPath = [];
		
		#
		#	Обработчик тэга.
		#
		#	@author Додонов А.А.
		#	
		def	unknown_starttag( self , tag , attributes ):
			self.DOMPath.append( tag );
			Tmp = self.DOMPath[ 0 ];
			
			for i in range( 1 , len( self.DOMPath ) ):
				Tmp = Tmp + "/" + self.DOMPath[ i ];

			self.DOM.append( { "name" : tag , "path" : Tmp , "attributes" : attributes } );

		#
		#	Обработчик закрывающего тэга.
		#
		#	@author Додонов А.А.
		#
		def	unknown_endtag( self , tag ):
			del self.DOMPath[ len( self.DOMPath ) - 1 ];
		
		#
		#	Функция парсинга XML-файла.
		#
		#	@author Додонов А.А.
		#		
		def 	Parse( self , theFilePath ):
			self.feed( file.LoadFile( theFilePath ) );
			self.close();

else:
	import	xml.sax.handler
	
	class 	Parser( xml.sax.handler.ContentHandler ):
		#
		#	DOM модель документа.
		#
		#	@author Додонов А.А.
		#
		DOM = [];
		
		#
		#	Путь до требуемого тэга.
		#
		#	@author Додонов А.А.
		#
		DOMPath = [];
		
		#
		#	Конструктор.
		#
		#	@author Додонов А.А.
		#
		def	__init__( self ):
			xml.sax.handler.ContentHandler.__init__( self );
			self.DOM = [];
			self.DOMPath = [];
			
		#
		#	Обработчик тэга.
		#
		#	@author Додонов А.А.
		#	
		def 	startElement( self , name , attrs ):
			self.DOMPath.append( name );
			Tmp = self.DOMPath[ 0 ];
			
			for i in range( 1 , len( self.DOMPath ) ):
				Tmp = Tmp + "/" + self.DOMPath[ i ];

			self.DOM.append( { "name" : name , "path" : Tmp , "attributes" : attrs } );

		#
		#	Обработчик закрывающего тэга.
		#
		#	@author Додонов А.А.
		#	
		def 	endElement( self , name ):
			del self.DOMPath[ len( self.DOMPath ) - 1 ];
		
		#
		#	Функция парсинга XML-файла.
		#
		#	@author Додонов А.А.
		#		
		def 	Parse( self , theFilePath ):
			xml.sax.parse( theFilePath , self );

#
#	Класс для работы с конфигами (на базе SAXа).
#
#	@author Додонов А.А.
#
class SAXConfigProcessor:

	#
	#	Путь к загружаемому конфигу.
	#
	#	@author Додонов А.А.
	#
	DOM = None;
	
	#
	#	Корневой тэг.
	#
	#	@author Додонов А.А.
	#
	RootTag = None;
	
	#
	#	Загружаем конфиг.
	#
	#	@param theFilePath - путь к загружаемому конфигу.
	#
	#	@author Додонов А.А.
	#
	def LoadConfig( self , theFilePath ):
		p = Parser();
		p.Parse( theFilePath );
		self.DOM = p.DOM;
		r = self.GetTag( 0 );
		self.DOM = r.DOM;
		self.RootTag = r.RootTag;
		
	#
	#	Возвращает количество вложенных тэгов.
	#
	#	@param TagName - название тэга.
	#
	#	@author Додонов А.А.
	#
	def GetCountOfTags( self ):
		return( len( list( filter( lambda x : x[ "path" ].count( '/' ) == 0 , self.DOM ) ) ) );
		
	#
	#	Получение тэга по крусору.
	#
	#	@param TagCursor - курсор тэга.
	#
	#	@return Тэг.
	#
	#	@author Додонов А.А.
	#
	def	GetTag( self , TagCursor ):
		Counter = 0;
		RootCursor = 0;
		RootTag = None;
		
		Items = [];
		
		for d in self.DOM:
			if( d[ "path" ].count( '/' ) == 0 and Counter == TagCursor ):
				RootCursor = Counter;
				RootTag = d;
				break;
			Counter = Counter + 1;
		
		for k in range( 0 , len( self.DOM ) ):
			if( k > Counter ):
				Items.append( { "name" : self.DOM[ k ][ "name" ] , "path" : self.DOM[ k ][ "path" ].replace( RootTag[ "name" ] + "/" , "" ) , "attributes" : self.DOM[ k ][ "attributes" ] } );
				continue;
				
			if( k > Counter and self.DOM[ k ][ "path" ].count( '/' ) == 0 ):
				break;
			
		Tag = SAXConfigProcessor();
		Tag.RootTag = RootTag;
		Tag.DOM = Items;
			
		return( Tag );
	
	#
	#	Проверка существования тэга.
	#
	#	@param TagName - название тэга.
	#
	#	@return 1 если существует, 0 если не существует.
	#
	#	@author Додонов А.А.
	#
	def	TagExists( self , TagName ):
		for d in self.DOM:
			if( d[ "path" ].count( '/' ) == 0 and d[ "name" ] == TagName ):
				return( 1 );
				
		return( 0 );
	
	#
	#	Получение тэга по имени.
	#
	#	@param TagCursor - название тэга.
	#
	#	@return Тэг.
	#
	#	@author Додонов А.А.
	#
	def	GetTagByName( self , TagName ):
		if( self.TagExists( TagName ) == 0 ):
			return( None );
			
		Counter = 0;
		RootCursor = 0;
		RootTag = None;
		
		Items = [];
		
		for d in self.DOM:
			if( d[ "path" ].count( '/' ) == 0 and d[ "name" ] == TagName ):
				RootTag = d;
				RootCursor = Counter;
				break;
			Counter = Counter + 1;
		
		for k in range( 0 , len( self.DOM ) ):
			if( k > Counter ):
				Items.append( { "name" : self.DOM[ k ][ "name" ] , "path" : self.DOM[ k ][ "path" ].replace( RootTag[ "name" ] + "/" , "" ) , "attributes" : self.DOM[ k ][ "attributes" ] } );
				continue;
				
			if( k > Counter and self.DOM[ k ][ "path" ].count( '/' ) == 0 ):
				break;
			
		Tag = SAXConfigProcessor();
		Tag.RootTag = d;
		Tag.DOM = Items;
			
		return( Tag );
		
	#
	#	Получение корневого тэга.
	#
	#	@return Корневой тэг.
	#
	#	@author Додонов А.А.
	#
	def	GetRoot( self ):
		return( self.GetTag( 0 ) );

	#
	#	Получение значение аттрибута по имени аттрибута.
	#
	#	@param AttributeName - имя аттрибута.
	#
	#	@param DefaultValue - значение по-умолчанию.
	#
	#	@author Додонов А.А.
	#
	def	GetAttributeValue( self , AttributeName , DefaultValue = '' ):
		if( self.HasAttribute( AttributeName ) ):
			if( sys.version_info[ 0 ] == 1 and sys.version_info[ 1 ] == 6 ):
				return( self.RootTag[ "attributes" ][ AttributeName ] );
			else:
				return( self.RootTag[ "attributes" ].getValue( AttributeName ) );
				
		return( DefaultValue );

	#
	#	Возвращает True если у тэга есть указанный аттрибут.
	#
	#	@param AttributeName - имя аттрибута.
	#
	#	@author Додонов А.А.
	#
	def HasAttribute( self , AttributeName ):
		if( sys.version_info[ 0 ] == 1 and sys.version_info[ 1 ] == 6 ):
			return( AttributeName in self.RootTag[ "attributes" ].keys() );
		else:
			return( AttributeName in self.RootTag[ "attributes" ].getNames() );
	
	#
	#	Деструктор.
	#
	#	@author Додонов А.А.
	#
	def	__del__( self ):
		pass;