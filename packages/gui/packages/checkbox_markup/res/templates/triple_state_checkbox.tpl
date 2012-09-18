<div>
	<div class="triple_checkbox_style_0">
		<input type="checkbox" id="_checkbox_{id}" name="_checkbox_{name}" {if:condition={eq:value1=0;value2={http_param:name={name};type=integer;post=1;default={default}}};result1=;result2=checked} {if:cond={eq:value1=2;value2={http_param:name={name};type=integer;post=1;default={default}}};then=disabled;else=}>
		<label for="_checkbox_{id}" class="pointer">{label}</label>
		<input type="hidden" id="{id}" name="{name}" value="{http_param:name={name};type=integer;post=1;default={default}}">
	</div>
	<div class="triple_checkbox_style_1">
		<img onclick="ultimix.forms.triple_set_checkbox_click( '{id}' , '{name}' );" width="16px" height="16px" src="./packages/_core_data/res/images/transparent.gif">
	</div>
</div>