<?php

/**
 * @author Jasman <jasman@ihsana.com>
 * @copyright Ihsana IT Solution 2018
 * @license Commercial License
 * 
 * @package Ihsana Mobile App Builder
 * 
 */

defined("JSM_EXEC") or die("Silence is golden");

if (!isset($_SESSION['CURRENT_APP']['apps']['app-prefix']))
{
    header('Location: ?');
}

rebuild();

$breadcrumb = $content = null;
$breadcrumb .= '<ol class="breadcrumb">';
$breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> '.__e('Home').'</a></li>';
$breadcrumb .= '<li class="active">'.__e('Filemanager').'</li>';
$breadcrumb .= '</ol>';


$content .= '<div class="box box-info">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-th"></i> '.__e('New Ionic Project').'</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body well">';
$content .= '<div id="elfinder" style="height: 100%; width: 100%;z-index:999"></div>';
$content .= '</div>';
$content .= '</div>';

$page_js = "
 
			$(document).ready(function() {
				$('#elfinder').elfinder({
						cssAutoLoad : false, 
						baseUrl : './',  
						url : './system/plugin/elfinder/browse.php'  
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
            
";


$template->page_js = $page_js;
$template->page_breadcrumb = $breadcrumb;
$template->page_title = __e('(IMAB) File Manager');
$template->page_desc = '';
$template->page_content = $content;

?>