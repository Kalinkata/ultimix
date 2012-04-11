<table cellpadding="0" cellspacing="0" id="id_{name}">
	<tr>
		<td>
			<div>
				{uploaded_file_code}
			</div>
			<div id="{name}_file_input_cancel"></div>
			<div id="{name}_file_input_target"></div>
		</td>
		<td valign="top">
			<div id="{name}_file_input"></div>
		</td>
	</tr>
</table>
<div id="divStatus" class="invisible"></div>
<script type="text/javascript">
	var swfu;

	window.onload = function() {
		var settings = {
			flash_url : "{package_path:package_name=file_input::file_input_view;package_version=1.0.0}/include/flash/swfupload.swf",
			upload_url: "{upload_url}",
			file_size_limit : "{file_size_limit}",
			file_types : "{file_types}",
			file_types_description : "{file_types_description}",
			file_upload_limit : {file_upload_limit},
			file_queue_limit : 0,
			custom_settings : {
				progressTarget : "{name}_file_input_target",
				cancelButtonId : "{name}_file_input_cancel",
				statusAcceptor : "{name}_status_acceptor", 
				dataAcceptor : "{name}_data_acceptor",
				name : '{name}'
			},
			debug: false,

			// Button Settings
			button_image_url : "{image_path:package_name=file_input::file_input_view;package_version=1.0.0;file_name=input_file_024.gif}",
			button_placeholder_id : "{name}_file_input",
			button_width: 24,
			button_height: 24,
			button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
			button_cursor: SWFUpload.CURSOR.HAND,
			
			// The event handler functions are defined in handlers.js
			file_queued_handler : fileQueued,
			file_queue_error_handler : fileQueueError,
			file_dialog_complete_handler : fileDialogComplete,
			upload_start_handler : uploadStart,
			upload_progress_handler : uploadProgress,
			upload_error_handler : uploadError,
			upload_success_handler : {upload_success_handler},
			upload_complete_handler : {upload_complete_handler},
			queue_complete_handler : queueComplete	// Queue plugin event
		};

		swfu = new SWFUpload( settings );
	 };
</script>