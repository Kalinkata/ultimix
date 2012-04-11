<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
	<channel>
		<title>{title}</title>
		<description>{description}</description>
		<link>{link}</link>
		<lastBuildDate>{last_build_date}</lastBuildDate>
		<generator>ultimix generator</generator>
		<image>
			<url>{http_host}{package_path}/res/images/rss_inline.gif</url>
			<title>{title}</title>
			<link>{link}</link>
			<description>{description}</description>
		</image>
		<atom:link href="{link}/rss.html?feed={http_param:name=feed;get=1}" rel="self" type="application/rss+xml" />
{items}	</channel>
</rss>