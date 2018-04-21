<?php 

$string = "<div class=\"content-wrapper\">
    <section class=\"content-header\">
      <h1>
        Add ".ucfirst($table_name)."
        <small>Add a new ".ucfirst($table_name)."</small>
        <?php echo anchor(site_url('".$c_url."/create'),'+ Add', 'class=\"btn btn-primary\"'); ?>
      </h1>
      <ol class=\"breadcrumb\">
        <li><a href=\"#\"><i class=\"fa fa-dashboard\"></i> ".ucfirst($table_name)."</a></li>
        <!--<li><a href=\"#\">List</a></li>-->
        <li class=\"active\">Add</li>
      </ol>
      

    <section class=\"content\">
      <div class=\"row\">
        <div class=\"col-xs-12\">
        
    
<div class=\"box\">
        <div class=\"box-header\">
            <h3 class=\"box-title\">".ucfirst($table_name)." <?php echo \$button ?></h3>
        </div>
        <div class=\"box-body\">
    

        <form action=\"<?php echo \$action; ?>\" method=\"post\">";
foreach ($non_pk as $row) {
    if ($row["data_type"] == 'text')
    {
    $string .= "\n\t    <div class=\"form-group\">
            <label for=\"".$row["column_name"]."\">".label($row["column_name"])." <?php echo form_error('".$row["column_name"]."') ?></label>
            <textarea class=\"form-control\" rows=\"3\" name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\" placeholder=\"".label($row["column_name"])."\"><?php echo $".$row["column_name"]."; ?></textarea>
        </div>";
    } else
    {
    $string .= "\n\t    <div class=\"form-group\">
            <label for=\"".$row["data_type"]."\">".label($row["column_name"])." <?php echo form_error('".$row["column_name"]."') ?></label>
            <input type=\"text\" class=\"form-control\" name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\" placeholder=\"".label($row["column_name"])."\" value=\"<?php echo $".$row["column_name"]."; ?>\" />
        </div>";
    }
}
$string .= "\n\t    <input type=\"hidden\" name=\"".$pk."\" value=\"<?php echo $".$pk."; ?>\" /> ";
$string .= "\n\t    <button type=\"submit\" class=\"btn btn-primary\"><?php echo \$button ?></button> ";
$string .= "\n\t    <a href=\"<?php echo site_url('".$c_url."') ?>\" class=\"btn btn-default\">Cancel</a>";
$string .= "\n\t</form>
    </div></div></div></section></div>";

$hasil_view_form = createFile($string, $modules . $c_url. "/views/" . $v_form_file);

?>