<div class="width_100p banner">
	<div class="width_50 float_left">{checkbox_ex:name=banner_{id};self_class=banner_{campaign_id}_checkbox_class;parent_selector=.campaign_{campaign_id}_checkbox_class}</div>
	<div class="width_500 float_left">{code}</div>
	<div class="width_100 float_left">{shows}</div>
	<div class="width_100 float_left">{clicks}</div>
	<div class="width_100 float_left">{sprintf:value={ctr};format=%.2f} %</div>
	<div class="invisible">
		<div class="banner_id">{id}</div>
		<div class="banner_strategy">{direct_strategy}</div>
	</div>
</div>