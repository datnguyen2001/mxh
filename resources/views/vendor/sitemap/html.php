<!DOCTYPE html>
<html>
<head>
	<title><?php $channel['title'] ?></title>
</head>
<body>
	<h1><a href="<?php $channel['link'] ?>"><?php $channel['title'] ?></a></h1>
	<ul>
		<?php foreach ($items as $item) : ?>
		<li>
			<a href="<?php $item['loc'] ?>"><?php (empty($item['title'])) ? $item['loc'] : $item['title'] ?></a>
			<small>(last updated: <?php date('Y-m-d\TH:i:sP', strtotime($item['lastmod'])) ?>)</small>
		</li>
		<?php endforeach; ?>
	</ul>
</body>
</html>
