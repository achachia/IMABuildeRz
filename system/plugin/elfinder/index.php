<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="author" content="Jasman" />
    <link rel="stylesheet" href="./../../../templates/default/plugins/jQueryUI/jquery-ui.css"/>
    <link rel="stylesheet" href="./../../../templates/default/plugins/elfinder/css/elfinder.min.css"/>
    <link rel="stylesheet" href="./../../../templates/default/plugins/elfinder/css/theme.css"/>
	<title>elFinder</title>
    <style type="text/css">
    body {padding: 0 !important;margin: 0 !important;}
    #elfinder{z-index:999999999;height: 100%; width: 100%;}
    div{border-radius: 0 !important;}
    </style>
</head>
<body>

<div id="elfinder"></div>

<script src="./../../../templates/default/jQuery/jquery-2.2.3.min.js"></script>
<script src="./../../../templates/default/plugins/jQueryUI/jquery-ui.min.js"></script>
<script src="./../../../templates/default/plugins/elfinder/js/elfinder.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#elfinder').elfinder({
			cssAutoLoad : false, 
			baseUrl : './',  
			url : 'browse.php',
            width: '100%',
            height: '100%',
            resizable:false,
			getFileCallback : function(file,fm) {	
					<?php
                                                            
					if(isset($_GET['field'])){
						echo '
							var strPath = file.path;
                            strPath = strPath.replace(/\\\/gi,"/");
                            var path = "./outputs/'. $_SESSION['CURRENT_APP']['apps']['app-prefix'] .'/src/"  + strPath.replace(/src\//gi, "");       
							win = (window.opener ? window.opener : window.parent);                        
							$(win.document).find("#'.$_GET['field'].'").val(path);
							win.tinyMCE.activeEditor.windowManager.close();                                
						';
					} else{
						echo '                       
							var strPath = file.path;
                            strPath = strPath.replace(/\\\/gi,"/");
                            var path = strPath.replace(/src\//gi, "");                          
 						    window.opener.elFinder.callBack(path);
							window.close();                
						';
					}
                                          
					?>
			}	
		},

		function(fm, extraObj) {
			fm.bind('init', function() {
				 
				if (fm.lang === 'ja') {
					fm.loadScript(
						[ '//cdn.rawgit.com/polygonplanet/encoding.js/1.0.26/encoding.min.js' ],
						function() {
							if (window.Encoding && Encoding.convert) {
								fm.registRawStringDecoder(function(s) {
									return Encoding.convert(s, {to:'UNICODE',type:'string'});
								});
							}
						},
						{ loadType: 'tag' }
					);
				}
			});
			 
			var title = document.title;
			fm.bind('open', function() {
				var path = '',
					cwd  = fm.cwd();
				if (cwd) {
					path = fm.path(cwd.hash) || null;
				}
				document.title = path? path + ':' + title : title;
			}).bind('destroy', function() {
				document.title = title;
			});
		}
	);
});
</script>
</body>
</html>