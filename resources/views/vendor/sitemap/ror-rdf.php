<?php '<'.'?'.'xml version="1.0" encoding="UTF-8"?>'."\n"; ?>
<rdf:RDF xmlns="http://rorweb.com/0.1/" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#">
<Resource rdf:about="sitemap">
	<title><?php $channel['title'] ?></title>
	<url><?php $channel['link'] ?></url>
	<type>sitemap</type>
</Resource>
<?php foreach ($items as $item) : ?>
<Resource>
	<url><?php $item['loc'] ?></url>
	<title><?php $item['title'] ?></title>
	<updated><?php date('Y-m-d\TH:i:sP', strtotime($item['lastmod'])) ?></updated>
	<updatePeriod><?php $item['freq'] ?></updatePeriod>
	<sortOrder><?php $item['priority'] ?></sortOrder>
	<resourceOf rdf:resource="sitemap"/>
</Resource>
<?php endforeach; ?>
</rdf:RDF>
