<div class="comment_main">
	<div class="comment_main2">
		<div class="comment_author">{author_login}</div>{lang:rank} : <span class="review_rank_{if:condition={lt:value1={rank};value2=0};then=red}{if:condition={eq:value1={rank};value2=0};then=zero}{if:condition={gt:value1={rank};value2=0};then=green}">{rank}</span><br>
		<span>{review}</span>
	</div>
</div>