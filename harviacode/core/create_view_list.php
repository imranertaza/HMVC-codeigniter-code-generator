<?php 

$string = "<div class=\"content-wrapper\">
    <section class=\"content-header\">
      <h1>
        ".ucfirst($table_name)." List
        <small>List of all ".ucfirst($table_name)."</small>
        <?php echo anchor(site_url('".$c_url."/create'),'+ Add', 'class=\"btn btn-primary\"'); ?>
      </h1>
      <ol class=\"breadcrumb\">
        <li><a href=\"#\"><i class=\"fa fa-dashboard\"></i> ".ucfirst($table_name)."</a></li>
        <!--<li><a href=\"#\">List</a></li>-->
        <li class=\"active\">List</li>
      </ol>
      
      <div class=\"text-right\">
            <form action=\"<?php echo site_url('$c_url/index'); ?>\" class=\"form-inline\" method=\"get\">
                <div class=\"input-group\">
                    <input type=\"text\" class=\"form-control\" name=\"q\" value=\"<?php echo \$q; ?>\">
                    <span class=\"input-group-btn\">
                        <?php 
                            if (\$q <> '')
                            {
                                ?>
                                <a href=\"<?php echo site_url('$c_url'); ?>\" class=\"btn btn-default\">Reset</a>
                                <?php
                            }
                        ?>
                      <button class=\"btn btn-primary\" type=\"submit\">Search</button>
                    </span>
                </div>
            </form>
        </div>
    </section>

    
    <section class=\"content\">
      <div class=\"row\">
        <div class=\"col-xs-12\">
        
    
<div class=\"box\">
        <div class=\"box-header\">
            <h3 class=\"box-title\">".ucfirst($table_name)." List</h3>
        </div>
        <div class=\"box-body\">
            
            <div class=\"col-md-8 text-center\">
                <div style=\"margin-top: 12px\" id=\"message\">
                    <?php echo \$this->session->userdata('message') <> '' ? \$this->session->userdata('message') : ''; ?>
                </div>
            </div>
        <div class=\"row\"/>
        <div class=\"col-md-12\">
        <table class=\"table table-bordered table-striped\">
        <thead>
            <tr>
                <th>No</th>";
foreach ($non_pk as $row) {
    $string .= "\n\t\t<th>" . label($row['column_name']) . "</th>";
}
$string .= "\n\t\t<th>Action</th>
            </tr></thead>";
$string .= "<tbody><?php
            foreach ($" . $c_url . "_data as \$$c_url)
            {
                ?>
               <tr>";

$string .= "\n\t\t\t<td width=\"80px\"><?php echo ++\$start ?></td>";
foreach ($non_pk as $row) {
    $string .= "\n\t\t\t<td><?php echo $" . $c_url ."->". $row['column_name'] . " ?></td>";
}


$string .= "\n\t\t\t<td width=\"180px\">"
        . "\n\t\t\t\t<?php "
        . "\n\t\t\t\techo anchor(site_url('".$c_url."/read/'.$".$c_url."->".$pk."),'View', 'class=\"btn btn-xs btn-info\"'); "
        . "\n\t\t\t\techo ' '; "
        . "\n\t\t\t\techo anchor(site_url('".$c_url."/update/'.$".$c_url."->".$pk."),'Update', 'class=\"btn btn-xs btn-warning\"'); "
        . "\n\t\t\t\techo ' '; "
        . "\n\t\t\t\techo anchor(site_url('".$c_url."/delete/'.$".$c_url."->".$pk."),'Delete', 'class=\"btn btn-xs btn-danger\"', 'onclick=\"javasciprt: return confirm(\\'Are You Sure ?\\')\"'); "
        . "\n\t\t\t\t?>"
        . "\n\t\t\t</td>";

$string .=  "\n\t\t</tr>
                <?php
            }
            ?>
            </tbody>
            
            <tfoot>
            <tr>
                <th>No</th>";
foreach ($non_pk as $row) {
    $string .= "\n\t\t<th>" . label($row['column_name']) . "</th>";
}
$string .= "\n\t\t<th>Action</th>
            </tr></tfoot>
            
        </table>
        </div>
        </div>
        <div class=\"row\">
            <div class=\"col-md-6\">
                <a href=\"#\" class=\"btn btn-primary\">Total Record : <?php echo \$total_rows ?></a>";
if ($export_excel == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/excel'), 'Excel', 'class=\"btn btn-primary\"'); ?>";
}
if ($export_word == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/word'), 'Word', 'class=\"btn btn-primary\"'); ?>";
}
if ($export_pdf == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/pdf'), 'PDF', 'class=\"btn btn-primary\"'); ?>";
}
$string .= "\n\t    </div>
            <div class=\"col-md-6 text-right\">
                <?php echo \$pagination ?>
            </div>
        </div>
</div>
</div>
</div>
</section>
</div>";


$hasil_view_list = createFile($string, $modules . $c_url . "/views/" . $v_list_file);

?>