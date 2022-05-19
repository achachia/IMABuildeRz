<?php require_once ('functions.php');?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
  <title><?php echo strip_tags($this->base_title) ?> | <?php echo strip_tags($this->page_title) ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"/>
  <link rel="icon" href="<?php echo $this->base_url ?>/templates/default/assets/img/logo.ico" type="image/x-icon" />
  
  <link rel="stylesheet" href="<?php echo $this->base_url; ?>/templates/default/plugins/jQueryUI/jquery-ui.css"/>
  <link rel="stylesheet" href="<?php echo $this->base_url ?>/templates/default/bootstrap/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="<?php echo $this->base_url ?>/templates/default/plugins/datatables/dataTables.bootstrap.css"/> 
  <link rel="stylesheet" href="<?php echo $this->base_url ?>/templates/default/font-awesome/css/font-awesome.min.css"/>
  <link rel="stylesheet" href="<?php echo $this->base_url ?>/templates/default/plugins/pace/pace.min.css"/>
  <link rel="stylesheet" href="<?php echo $this->base_url ?>/templates/default/plugins/iCheck/all.css"/> 
  <link rel="stylesheet" href="<?php echo $this->base_url ?>/templates/default/plugins/select2/select2.css"/> 
  <link rel="stylesheet" href="<?php echo $this->base_url ?>/templates/default/plugins/elfinder/css/elfinder.min.css"/>
  <link rel="stylesheet" href="<?php echo $this->base_url ?>/templates/default/plugins/elfinder/css/theme.css"/>
 
  <link rel="stylesheet" href="<?php echo $this->base_url ?>/templates/default/AdminLTE/css/AdminLTE.min.css"/>
  <link rel="stylesheet" href="<?php echo $this->base_url ?>/templates/default/AdminLTE/css/all-skins.min.css"/>
  <!--link rel="stylesheet" href="<?php echo $this->base_url ?>/templates/default/ionicons/css/ionicons.min.css"/-->
  <link rel="stylesheet" href="<?php echo $this->base_url ?>/templates/default/assets/css/fonts.css"/>
  <link rel="stylesheet" href="<?php echo $this->base_url ?>/templates/default/dashicons/css/dashicons.min.css"/>
  <link rel="stylesheet" href="<?php echo $this->base_url ?>/templates/default/assets/css/imabuilder.css"/>
  
  <link rel="stylesheet" href="<?php echo $this->base_url ?>/templates/default/plugins/codemirror/lib/codemirror.css"/>
  <link rel="stylesheet" href="<?php echo $this->base_url ?>/templates/default/plugins/codemirror/theme/<?php echo JSM_CODEMIRROR_THEME ?>.css"/>   
  <link rel="stylesheet" href="<?php echo $this->base_url ?>/templates/default/plugins/codemirror/addon/display/fullscreen.css"/>   
  <link rel="stylesheet" href="<?php echo $this->base_url ?>/templates/default/plugins/codemirror/addon/hint/show-hint.css"/>   
  <link rel="stylesheet" href="<?php echo $this->base_url ?>/templates/default/plugins/datetimepicker/css/bootstrap-datetimepicker.min.css"/> 
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  
  <style type="text/css"><?php echo $dynamic_css ?></style>
  <script type="text/javascript">
    
    var core_version = '<?php echo trim(strtolower(JSM_CORE_VERSION)) ?>';
    var interface_version = '<?php echo trim(strtolower(JSM_VERSION)) ?>';
    if(interface_version !== core_version){
        alert('A different version has been detected, please reactivate it!');
        window.location.href = './setup.php?p=activation';
    }
    
  <?php echo $path_output; ?>
  <?php echo $code_mirror_theme; ?>
  <?php echo $code_ionic_tags; ?>
  <?php echo $valid_elements;?>
  </script>
</head>
<body class="hold-transition skin-<?php echo $rand_color[rand(0,(count($rand_color) - 1))]; ?> sidebar-mini">
<div class="wrapper">
  <header class="main-header">
    <a href="./?p=apps&a=edit" class="logo">
      <span class="logo-mini"><?php echo $this->base_short_title ?></span>
      <span class="logo-lg"><?php echo $this->base_title ?></span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <?php if($app_prefix !== 'Undefined'){ ?> 
          <?php echo $html_lang ?>
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
          <?php }else{ ?>
          <?php echo $html_lang ?>
          <?php } ?>
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">
       <a href="./?p=apps&a=edit"> 
          <div class="user-panel">
            <div class="pull-left image">
              <i class="text-<?php echo $app_color; ?> fa fa-<?php echo $app_icon; ?> fa-3x"></i>
            </div>
            <div class="pull-left info">
              <p><?php echo $app_name; ?></p>
              <i class="fa fa-circle text-success"></i> <?php echo $app_version; ?>
            </div>
          </div>
      </a>
      
    <section class="sidebar">
      <ul class="sidebar-menu">
        <?php echo $this->page_sidebar_menu; ?>
      </ul>
    </section>
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $this->page_title; ?>
        <small><?php echo $this->page_desc; ?></small>
      </h1>
      <?php echo $this->page_breadcrumb; ?>
    </section>
    <!-- Main content -->
    <section class="content">
    <?php echo $this->page_alert; ?>
    <!-- page-content -->
    <?php echo $this->page_content; ?>
    <!-- ./page-content -->
    </section>
  </div>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <?php echo $this->base_title.' '.JSM_VERSION .' <small class="text-red">(core: ' . JSM_CORE_VERSION .')</small>' ?>
    </div>
    <strong>Copyright &copy; <?php echo date("Y"); ?> <a target="_blank" href="http://ihsana.com/">Ihsana IT Solution</a>.</strong> All rights reserved - Translated by: <a target="_blank" href="<?php echo $translator['url']; ?>"><?php echo ucwords($translator['author']); ?></a> 
  </footer>
  
  <?php if ($app_prefix!='Undefined'){ ?>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-emulator-android" data-toggle="tab"><i class="fa fa-android"></i> Android</a></li>
      <li class="active"><a href="#control-sidebar-emulator-ios" data-toggle="tab"><i class="fa fa-apple"></i> iOS</a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane ima-emulator" id="control-sidebar-emulator-android">
        <!--h3 class="control-sidebar-heading">Android</h3-->
        <div class="control-sidebar-menu">
            <iframe allow="geolocation; microphone; camera; midi; encrypted-media"  class="iframe-emulator iframe-emulator-android iframe" src="<?php echo $emulator_link_android ?>" ></iframe>
        </div>
      </div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane active ima-emulator" id="control-sidebar-emulator-ios">
          <!--h3 class="control-sidebar-heading">IOS</h3-->
          <div class="control-sidebar-menu">
             <iframe allow="geolocation; microphone; camera; midi; encrypted-media"  class="iframe-emulator iframe-emulator-ios iframe" src="<?php echo $emulator_link_ios ?>"></iframe> 
          </div>
          <!-- /.form-group -->
      </div>
      
      <p class="text-center">
        <a class="emulator-reload btn btn-danger" href="#"><?php echo __e('Reload') ?></a>
        <a class="btn btn-danger" target="_blank" href="<?php echo $lab_link ?>"><?php echo __e('Ionic Lab') ?></a>
        <a class="btn btn-danger" target="_blank" href="<?php echo $emulator_link ?>"><?php echo __e('Emulator') ?></a>
      </p>
      <p class="text-center"><?php echo __e('Remote Debugging Android Devices') ?><br/><?php echo __e('Chrome Developer Tools') ?></p>
      <pre>chrome://inspect/#devices</pre>
      
      <br/>
	  <?php echo $cmd_run_emulator ?>

      <!-- /.tab-pane -->
    </div>
  </aside>
  <?php } ?>
  
  <div class="control-sidebar-bg" ></div>
</div>


<script src="<?php echo $this->base_url; ?>/templates/default/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?php echo $this->base_url; ?>/templates/default/plugins/jQueryUI/jquery-ui.min.js"></script>
<script src="<?php echo $this->base_url; ?>/templates/default/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo $this->base_url; ?>/templates/default/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo $this->base_url; ?>/templates/default/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo $this->base_url; ?>/templates/default/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="<?php echo $this->base_url; ?>/templates/default/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo $this->base_url; ?>/templates/default/plugins/tinymce/tinymce.min.js"></script>
<script src="<?php echo $this->base_url; ?>/templates/default/plugins/iCheck/icheck.min.js"></script>
<script src="<?php echo $this->base_url; ?>/templates/default/plugins/codemirror/lib/codemirror.js"></script>
<script src="<?php echo $this->base_url; ?>/templates/default/plugins/codemirror/addon/display/autorefresh.js"></script>
<script src="<?php echo $this->base_url; ?>/templates/default/plugins/codemirror/mode/clike/clike.js"></script>
<script src="<?php echo $this->base_url; ?>/templates/default/plugins/codemirror/mode/xml/xml.js"></script>
<script src="<?php echo $this->base_url; ?>/templates/default/plugins/codemirror/mode/javascript/javascript.js"></script>
<script src="<?php echo $this->base_url; ?>/templates/default/plugins/codemirror/mode/css/css.js"></script>
<script src="<?php echo $this->base_url; ?>/templates/default/plugins/codemirror/mode/vbscript/vbscript.js"></script>
<script src="<?php echo $this->base_url; ?>/templates/default/plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>
<script src="<?php echo $this->base_url; ?>/templates/default/plugins/codemirror/mode/sql/sql.js"></script>
<script src="<?php echo $this->base_url; ?>/templates/default/plugins/codemirror/mode/php/php.js"></script>
<script src="<?php echo $this->base_url; ?>/templates/default/plugins/codemirror/addon/display/fullscreen.js"></script>

<script src="<?php echo $this->base_url; ?>/templates/default/plugins/codemirror/addon/hint/show-hint.js"></script>
<script src="<?php echo $this->base_url; ?>/templates/default/plugins/codemirror/addon/hint/xml-hint.js"></script>
<script src="<?php echo $this->base_url; ?>/templates/default/plugins/codemirror/addon/hint/javascript-hint.js"></script>
<script src="<?php echo $this->base_url; ?>/templates/default/plugins/codemirror/addon/hint/css-hint.js"></script>

<script src="<?php echo $this->base_url; ?>/templates/default/plugins/moment/moment.min.js"></script>
<script src="<?php echo $this->base_url; ?>/templates/default/plugins/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

<script src="<?php echo $this->base_url; ?>/templates/default/plugins/nestable/jquery.nestable.js"></script>
<script src="<?php echo $this->base_url; ?>/templates/default/plugins/elfinder/js/elfinder.min.js"></script>

<script src="<?php echo $this->base_url; ?>/templates/default/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo $this->base_url; ?>/templates/default/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script src="<?php echo $this->base_url; ?>/templates/default/AdminLTE/js/app.min.js"></script>
<script src="<?php echo $this->base_url; ?>/templates/default/assets/js/imabuilder.js"></script>
<script type="text/javascript">
<?php echo $this->page_js; ?>
</script>

<script src="<?php echo $this->base_url; ?>/templates/default/ionicons/ionicons.js"></script>
<?php if(JSM_FASTER != true){ ?>
<script src="<?php echo $this->base_url; ?>/templates/default/plugins/pace/pace.min.js"></script>
<script type="text/javascript">
<?php if(JSM_FIX_EMULATOR==true){ ?>
$(document).ready(function(){
    setTimeout(function(){ 
        $("[data-toggle='control-sidebar']").trigger("click");
    }, 3000);
    
    setTimeout(function(){ 
        $("[data-toggle='control-sidebar']").trigger("click");
    }, 5000);   
}); 
<?php } ?>
$(document).ajaxStart(function() {
	Pace.restart();
});
</script>
<?php } ?>

</body>
</html>