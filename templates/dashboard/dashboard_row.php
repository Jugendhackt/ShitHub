<?php
die("Direct invocation isn't allowed.");
?>
<div class="snippet_overview">
    <div class="title"><a href="?site=dreview&id={dashboard_row_id}">{dashboard_row_title}</a></div>
    <div class="author"><a href="?site=userpage&id={dashboard_row_author_id}">{dashboard_row_author_name}</a></div>
    <div class="secondrow">
	    <div class="tags">{dashboard_row_tags}</div>
	    <div class="date btn">{dashboard_row_date}</div>
	</div>
</div>