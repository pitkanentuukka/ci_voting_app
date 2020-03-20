<?php foreach ($parties as $party): ?> 
<p> 
	<span><?php echo $party['name']; ?> </span>
	<span><?php
	
	$wholelink = $linkurl . $party['link'];
	
	echo $wholelink; ?> </span>
</p>

<?php endforeach ?>
