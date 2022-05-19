var tags = {
	"!ion-item": ["ion-item"],
	"!attrs": {
		id: null,
		class: ["A", "B", "C"]
	},
	"ion-card": {
		attrs: {
			lang: ["en", "de", "fr", "nl"],
		},
		children: ["animal", "plant"]
	}
};

function completeAfter(cm, pred) {
	var cur = cm.getCursor();
	if (!pred || pred()) setTimeout(function() {
		if (!cm.state.completionActive) cm.showHint({
			completeSingle: false
		});
	}, 100);
	return CodeMirror.Pass;
}

function completeIfAfterLt(cm) {
	return completeAfter(cm, function() {
		var cur = cm.getCursor();
		return cm.getRange(CodeMirror.Pos(cur.line, cur.ch - 1), cur) == "<";
	});
}

function completeIfInTag(cm) {
	return completeAfter(cm, function() {
		var tok = cm.getTokenAt(cm.getCursor());
		if (tok.type == "string" && (!/['"]/.test(tok.string.charAt(tok.string.length - 1)) || tok.string.length == 1)) return false;
		var inner = CodeMirror.innerMode(cm.getMode(), tok.state).state;
		return inner.tagName;
	});
}

function selectText(containerid) {
	if (document.selection) { // IE
		var range = document.body.createTextRange();
		range.moveToElementText(document.getElementById(containerid));
		range.select();
	} else if (window.getSelection) {
		var range = document.createRange();
		range.selectNode(document.getElementById(containerid));
		window.getSelection().removeAllRanges();
		window.getSelection().addRange(range);
	}
}
$('pre.shell').click(function() {
	var prop_id = 'shell-' + Date.now();
	$(this).prop('id', prop_id);
	$(this).addClass('ready')
	selectText(prop_id);
});



$(document).ready(function(){
	$('table[data-type="datatable"]').DataTable();
	$('.emulator-reload').on('click', function() {
		var elm_android = '.iframe-emulator-android';
		$(elm_android).attr('src', $(elm_android).attr('src'));
		var elm_ios = '.iframe-emulator-ios';
		$(elm_ios).attr('src', $(elm_ios).attr('src'));
		return false;
	});
	setTimeout(function() {
		$(".auto-dismissible").fadeOut();
	}, 5000);
	$.extend($.inputmask.defaults.definitions, {
		'A': {
			validator: "[A-Za-z ]",
			cardinality: 1
		},
		'B': {
			validator: "[a-z0-9\-]",
			cardinality: 1
		},
		'C': {
			validator: "[a-zA-Z0-9\_\.]",
			cardinality: 1
		},
		'D': {
			validator: "[A-Za-z\.\, ]",
			cardinality: 1
		}
	});
	$('[data-mask]').inputmask();
	$('input[type="checkbox"].flat-blue').iCheck({
		checkboxClass: 'icheckbox_flat-blue',
		radioClass: 'iradio_flat-blue'
	});
	$('input[type="checkbox"].flat-green').iCheck({
		checkboxClass: 'icheckbox_flat-green',
		radioClass: 'iradio_flat-green'
	});
	$('input[type="checkbox"].flat-red').iCheck({
		checkboxClass: 'icheckbox_flat-red',
		radioClass: 'iradio_flat-red'
	});
	$('input[type="radio"].flat-blue').iCheck({
		checkboxClass: 'icheckbox_flat-blue',
		radioClass: 'iradio_flat-blue'
	});
	$('input[type="radio"].flat-yellow').iCheck({
		checkboxClass: 'icheckbox_flat-yellow',
		radioClass: 'iradio_flat-yellow'
	});
	$('input[type="radio"].flat-green').iCheck({
		checkboxClass: 'icheckbox_flat-green',
		radioClass: 'iradio_flat-green'
	});
	$('input[type="radio"].flat-red').iCheck({
		checkboxClass: 'icheckbox_flat-red',
		radioClass: 'iradio_flat-red'
	});
	$('input[type="radio"].flat-purple').iCheck({
		checkboxClass: 'icheckbox_flat-purple',
		radioClass: 'iradio_flat-purple'
	});
	$('input[type="radio"].flat-black').iCheck({
		checkboxClass: 'icheckbox_flat-black',
		radioClass: 'iradio_flat-black'
	});
	$('.select2').select2();
	$(".autocomplete").select2({
		tags: "true",
		placeholder: {
			id: "-1",
			text: "Select an option",
		},
		allowClear: true,
		width: '100%',
		createTag: function(params) {
			var term = $.trim(params.term);
			if (term === '') {
				return null;
			}
			return {
				id: term,
				text: term,
				value: true // add additional parameters
			}
		}
	});
	// code mirror json 
	for (var ix = 0; ix < 10; ++ix) {
		if ($('textarea[data-type="json"]')[ix]) {
			var code_json = $('textarea[data-type="json"]')[ix];
			var editor = CodeMirror.fromTextArea(code_json, {
				theme: codemirror_theme,
				lineNumbers: true,
				foldGutter: true,
				matchBrackets: true,
				autoCloseBrackets: true,
				gutters: ["CodeMirror-linenumbers", "CodeMirror-foldgutter"],
				mode: "application/ld+json",
				extraKeys: {
					"Ctrl-Space": "autocomplete"
				},
			});
		}
	}
	// code mirror html 
	for (var ix = 0; ix < 10; ++ix) {
		if ($('textarea[data-type="html5"]')[ix]) {
			var code_html5 = $('textarea[data-type="html5"]')[ix];
			var editor = CodeMirror.fromTextArea(code_html5, {
				mode: "xml",
				lineNumbers: true,
				matchBrackets: true,
				autoRefresh: true,
				theme: codemirror_theme,
				selectionPointer: true,
				extraKeys: {
					"F11": function(cm) {
						cm.setOption("fullScreen", !cm.getOption("fullScreen"));
					},
					"Esc": function(cm) {
						if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
					},
					"'<'": completeAfter,
					"'/'": completeIfAfterLt,
					"' '": completeIfInTag,
					"'='": completeIfInTag,
					"Ctrl-Space": "autocomplete"
				},
				hintOptions: {
					schemaInfo: ionic_tags
				}
			});
		}
	}
	// code mirror scss 
	for (var ix = 0; ix < 10; ++ix) {
		if ($('textarea[data-type="scss"]')[ix]) {
			var code_scss = $('textarea[data-type="scss"]')[ix];
			var editor = CodeMirror.fromTextArea(code_scss, {
				lineNumbers: true,
				matchBrackets: true,
				autoRefresh: true,
				theme: codemirror_theme,
				mode: "text/x-scss",
				extraKeys: {
					"Ctrl-Space": "autocomplete",
					"F11": function(cm) {
						cm.setOption("fullScreen", !cm.getOption("fullScreen"));
					},
					"Esc": function(cm) {
						if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
					}
				}
			});
		}
	}
	// code mirror ts    
	for (var ix = 0; ix < 10; ++ix) {
		if ($('textarea[data-type="ts"]')[ix]) {
			var code_ts = $('textarea[data-type="ts"]')[ix];
			var editor = CodeMirror.fromTextArea(code_ts, {
				lineNumbers: true,
				matchBrackets: true,
				autoRefresh: true,
				theme: codemirror_theme,
				mode: "application/typescript",
				extraKeys: {
					"Ctrl-Space": "autocomplete",
					"F11": function(cm) {
						cm.setOption("fullScreen", !cm.getOption("fullScreen"));
					},
					"Esc": function(cm) {
						if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
					}
				}
			});
		}
	}
	// code mirror sql  
	for (var ix = 0; ix < 10; ++ix) {
		if ($('textarea[data-type="sql"]')[ix]) {
			var code_sql = $('textarea[data-type="sql"]')[ix];
			var editor = CodeMirror.fromTextArea(code_sql, {
				lineNumbers: true,
				matchBrackets: true,
				mode: "text/x-mysql",
				autoRefresh: true,
				indentUnit: 4,
				theme: codemirror_theme,
				indentWithTabs: true,
				extraKeys: {
					"F11": function(cm) {
						cm.setOption("fullScreen", !cm.getOption("fullScreen"));
					},
					"Esc": function(cm) {
						if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
					}
				}
			});
		}
	}
	// code mirror php  
	for (var ix = 0; ix < 10; ++ix) {
		if ($('textarea[data-type="php"]')[ix]) {
			var code_php = $('textarea[data-type="php"]')[ix];
			var editor = CodeMirror.fromTextArea(code_php, {
				lineNumbers: true,
				matchBrackets: true,
				autoRefresh: true,
				mode: "application/x-httpd-php",
				indentUnit: 4,
				theme: codemirror_theme,
				indentWithTabs: true,
				extraKeys: {
					"F11": function(cm) {
						cm.setOption("fullScreen", !cm.getOption("fullScreen"));
					},
					"Esc": function(cm) {
						if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
					}
				}
			});
		}
	}
	if ($('*[data-type="date"]')) {
		$('*[data-type="date"]').datetimepicker({
			format: 'YYYY-MM-DD'
		});
	}
	if ($('*[data-type="time"]')) {
		$('*[data-type="time"]').datetimepicker({
			format: 'HH:mm:ss'
		});
	}
	if ($('*[data-type="datetime"]')) {
		$('*[data-type="datetime"]').datetimepicker({
			format: 'YYYY-MM-DD HH:mm:ss'
		});
	}
	$("*[data-type='icon-picker']").on('click', function() {
		window.ICON_PICKER = $(this).attr('data-target');
		var listing = $(this).attr('data-dialog');
		$(listing).modal();
	});
	$("#filter-fa-icon").keyup(function() {
		var keyword = $(this).val();
		$(".fa-icon-item").each(function() {
			var fa_icon = $(this).attr('data-id');
			$(this).addClass('hidden');
			if (fa_icon.toLowerCase().indexOf(keyword) >= 0) {
				$(this).removeClass('hidden');
			}
		});
	});
	$(".fa-icon-list").on('click', function() {
		var class_icon = $(this).attr('data-icon');
		var form_input = window.ICON_PICKER;
		$(form_input).val(class_icon);
		var preview_id = '#preview-' + form_input.replace('#', '');
		$(preview_id).attr('class', 'pointer icon fa fa-' + class_icon);
		$('#fa-icon-dialog').modal('hide');
	});
	$("#filter-ion-icon").keyup(function() {
		var keyword = $(this).val();
		$(".ion-icon-item").each(function() {
			var fa_icon = $(this).attr('data-id');
			$(this).addClass('hidden');
			if (fa_icon.toLowerCase().indexOf(keyword) >= 0) {
				$(this).removeClass('hidden');
			}
		});
	});
	$(".ion-icon-list").on('click', function() {
		var class_icon = $(this).attr('data-icon');
		var form_input = window.ICON_PICKER;
		$(form_input).val(class_icon);
		var preview_id = '#preview-' + form_input.replace('#', '');
		$(preview_id).attr('class', 'pointer icon ion ion-md-' + class_icon);
		$('#ion-icon-dialog').modal('hide');
	});
	$("#filter-dashicons-icon").keyup(function() {
		var keyword = $(this).val();
		$(".dashicons-icon-item").each(function() {
			var fa_icon = $(this).attr('data-id');
			$(this).addClass('hidden');
			if (fa_icon.toLowerCase().indexOf(keyword) >= 0) {
				$(this).removeClass('hidden');
			}
		});
	});
	$(".dashicons-icon-list").on('click', function() {
		var class_icon = $(this).attr('data-icon');
		var form_input = window.ICON_PICKER;
		$(form_input).val(class_icon);
		var preview_id = '#preview-' + form_input.replace('#', '');
		$(preview_id).attr('class', 'pointer icon dashicons dashicons-' + class_icon);
		$('#dashicons-icon-dialog').modal('hide');
	});
	$(".remove-item").on("click", function() {
		var target = $(this).attr("data-target");
		$(target).replaceWith(' ');
		return false;
	});
	$(".clear-item").on("click", function() {
		var target = $(this).attr("data-target");
		$(target).val('');
		return false;
	});
	$(".select-color").on('click', function() {
		$(this).attr('data-color', $(this).val());
	});
	var elFinderTarget = "";
	window.elFinder = {
		callBack: function(e) {
			$(elFinderTarget).val(e);
		},
		open: function(prop_id, file_type) {
			var w = 1028;
			var h = 480;
			var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : window.screenX;
			var dualScreenTop = window.screenTop != undefined ? window.screenTop : window.screenY;
			var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
			var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;
			var left = ((width / 2) - (w / 2)) + dualScreenLeft;
			var top = ((height / 2) - (h / 2)) + dualScreenTop;
			var newwindow = window.open("./system/plugin/elfinder/", "File Browser", 'scrollbars=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
			elFinderTarget = prop_id;
			if (window.focus) {
				newwindow.focus()
			}
		}
	};
	if ($('*[data-type="file-picker"]').length) {
		$('*[data-type="file-picker"]').on('click', function() {
			var _id = $(this).attr('data-target');
			elFinder.open(_id, "images");
			return false;
		});
	};
	if ($('textarea[data-type="tinymce"]').length) {
		tinymce.init({
			selector: "textarea[data-type='tinymce']",
			plugins: "link image imagetools lists gui_elfinder textcolor code hr table",
			image_prepend_url: dir_output,
			imagetools_toolbar: "rotateleft rotateright | flipv fliph | editimage imageoptions",
			toolbar1: 'addlink | undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | image forecolor backcolor | hr | fontsizeselect | table',
			force_br_newlines: false,
			force_p_newlines: false,
			forced_root_block: "",
			extended_valid_elements: valid_elements,
		});
	};
	$('#app-publish').on('click', function() {
		var appName = $("#app-name").val();
		var appDesc = $("#app-desc").val();
		var urlPlayStore = $("#url-playstore").val();
		var urlAppStore = $("#url-appstore").val();
		var urlApk = $("#url-apk").val();
		var postdata = {
		    //callback: 'resp',
			appName: appName,
			appDesc: appDesc,
			urlApk: urlApk,
			urlPlayStore: urlPlayStore,
			urlAppStore: urlAppStore,
		}
		$.ajax({
			url: 'https://ihsana.com/imabuilder3/restapi.php?json=submit-app',
			dataType: 'json',
            type: "post",
            data: postdata,
			success: function(respdata) {
				console.log(respdata);
                alert(respdata.message);
			}
		});
	});
       
});
 