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

$breadcrumb = $content = null;
$content = '

<div class="error-page">
<h2 class="headline text-yellow"> 404</h2>

<div class="error-content">
  <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>

  <p>
    We could not find the page you were looking for.
    Meanwhile, you may <a href="./">return to dashboard</a> or try using the search form.
  </p>

  <form class="search-form">
    <div class="input-group">
      <input name="search" class="form-control" placeholder="Search" type="text"/>

      <div class="input-group-btn">
        <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i>
        </button>
      </div>
    </div>
    <!-- /.input-group -->
  </form>
</div>
<!-- /.error-content -->
</div>

';

$breadcrumb = '<ol class="breadcrumb"><li><a href="./"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">404</li></ol>';

$template->page_breadcrumb = $breadcrumb;
$template->page_title = '404 Error Page';
$template->page_desc = '';
$template->page_content = $content;

?>