<?php 

$string = "<div class=\"content-wrapper\">
    <section class=\"content-header\">
      <h1>
        ".ucfirst($table_name)." View
        <small>View of all ".ucfirst($table_name)."</small>
        <?php echo anchor(site_url('".$c_url."/create'),'+ Add', 'class=\"btn btn-primary\"'); ?>
      </h1>
      <ol class=\"breadcrumb\">
        <li><a href=\"#\"><i class=\"fa fa-dashboard\"></i> ".ucfirst($table_name)."</a></li>
        <!--<li><a href=\"#\">List</a></li>-->
        <li class=\"active\">View</li>
      </ol>
      

    <section class=\"content\">
      <div class=\"row\">
        <div class=\"col-xs-12\">
        
    
<div class=\"box\">
        <div class=\"box-header\">
            <h3 class=\"box-title\">".ucfirst($table_name)." Read</h3>
        </div>
        <div class=\"box-body\">
        
        <table class=\"table\">";
foreach ($non_pk as $row) {
    $string .= "\n\t    <tr><td>".label($row["column_name"])."</td><td><?php echo $".$row["column_name"]."; ?></td></tr>";
}
$string .= "\n\t    <tr><td></td><td><a href=\"<?php echo site_url('".$c_url."') ?>\" class=\"btn btn-default\">Cancel</a></td></tr>";
$string .= "\n\t</table></div></div></div></div></section></div>";



$hasil_view_read = createFile($string, $modules . $c_url. "/views/" . $v_read_file);

?>