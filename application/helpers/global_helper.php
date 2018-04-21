<?php

defined('BASEPATH') OR exit('No direct script access allowed');

function getShortContent($long_text = '', $show = 100) {

    $filtered_text = strip_tags($long_text);
    if ($show < strlen($filtered_text)) {
        return substr($filtered_text, 0, $show) . '...';
    } else {
        return $filtered_text;
    }
}

function globalStatus($selected = 0) {
    $status = [
        '0' => '--Select--',
        'Active' => 'Active',
        'Inactive' => 'Inactive',
        'Pending' => 'Pending'
    ];

    $row = '';
    foreach ($status as $key => $option) {
        $row .= '<option value="' . $key . '"';
        $row .= ($selected === $key) ? ' selected' : '';
        $row .= '>' . $option . '</option>';
    }
    return $row;
}

function getLoginUserData($key = '') {
    //key: user_id, user_mail, role_id, name, photo
    $data = & get_instance();
    $global = json_decode(base64_decode($data->input->cookie('fm_login_data', false)));
    return isset($global->$key) ? $global->$key : null;
}

function numericDropDown($i = 0, $end = 12, $incr = 1, $selected = 0) {
    $option = '';
    for ($i; $i <= $end; $i+=$incr) {
        $option .= '<option value="' . $i . '"';
        $option .= ( $selected == $i) ? ' selected' : '';
        $option .= '>' . sprintf('%02d', $i) . '</option>';
    }
    return $option;
}

function htmlRadio($name = 'input_radio', $selected = '', $array = ['Male' => 'Male', 'Female' => 'Female']) {
    $radio = '';
    $id = 0;

    if (count($array)) {
        foreach ($array as $key => $value) {
            $id++;
            $radio .= '<label>';
            $radio .= '<input type="radio" name="' . $name . '" id="' . $name . '_' . $id . '"';
            $radio .= ( trim($selected) === $key) ? ' checked ' : '';
            $radio .= 'value="' . $key . '" /> ' . $value;
            $radio .= '&nbsp;&nbsp;&nbsp;</label>';
        }
    }
    return $radio;
}

function selectOptions($selected = '', $array = null) {


    $options = '';
    if (count($array)) {
        foreach ($array as $key => $value) {
            $options .= '<option value="' . $key . '" ';
            $options .= ($key == $selected ) ? ' selected="selected"' : '';
            $options .= '>' . $value . '</option>';
        }
    }
    return $options;
}

/*
 * We will use it into header.php or footer.php or any view page
 * to load module wise css or js file
 */

function load_module_asset($module = null, $type = 'css', $script = null) {

    $file = ($type == 'css') ? 'style.css.php' : 'script.js.php';
    if ($script) {
        $file = $script;
    }

    $path = APPPATH . '/modules/' . $module . '/assets/' . $file;
    if ($module && file_exists($path)) {
        include ($path);
    }
}

//$limit    = 2;
//$start    = getPaginatorStart($limit);
//showPaginator($total_rows, 'admin.php?page=list&p', $limit);


function ageCalculator($date = null) {
    if ($date) {
        $tz = new DateTimeZone('Europe/London');
        $age = DateTime::createFromFormat('Y-m-d', $date, $tz)
                        ->diff(new DateTime('now', $tz))
                ->y;
        return $age . ' years';
    } else {
        return 'Unknown';
    }
}

function sinceCalculator($date = null) {

    if ($date) {

        $date = date('Y-m-d', strtotime($date));
        $tz = new DateTimeZone('Europe/London');
        $age = DateTime::createFromFormat('Y-m-d', $date, $tz)
                ->diff(new DateTime('now', $tz));

        $result = '';
        $result .= ($age->y) ? $age->y . 'y ' : '';
        $result .= ($age->m) ? $age->m . 'm ' : '';
        $result .= ($age->d) ? $age->d . 'd ' : '';
        $result .= ($age->h) ? $age->h . 'h ' : '';
        return $result;
    } else {
        return 'Unknown';
    }
}

function password_encription($string = '') {
    return password_hash($string, PASSWORD_BCRYPT);
}


function get_admin_email() {
    return getSettingItem('IncomingEmail');
}

function getSettingItem($setting_key = null) {
    $ci = & get_instance();
    $setting = $ci->db->get_where('settings', ['label' => $setting_key])->row();
    return isset($setting->value) ? $setting->value : false;
}

function userStatus($selected = null) {
    $status = ['Pending', 'Active', 'Inactive'];
    $options = '';
    foreach ($status as $row) {
        $options .= '<option value="' . $row . '" ';
        $options .= ($row == $selected ) ? 'selected="selected"' : '';
        $options .= '>' . $row . '</option>';
    }
    return $options;
}




function bdDateFormat($data = '0000-00-00') {
    return ($data == '0000-00-00') ? 'Unknown' : date('d/m/y', strtotime($data));
}

function isCheck($checked = 0, $match = 1) {
    $checked = ($checked);
    return ($checked == $match) ? 'checked="checked"' : '';
}

function getCurrency($selected = '&pound') {
    $codes = [
        '&pound' => "&pound; GBP",
        '&dollar' => "&dollar; USD",
        '&nira' => "&#x20A6; NGN"
    ];

    $row = '<select name="data[Setting][Currency]" class="form-control">';
    foreach ($codes as $key => $option) {
        $row .= '<option value="' . htmlentities($key) . '"';
        $row .= ($selected == $key) ? ' selected' : '';
        $row .= '>' . $option . '</option>';
    }
    $row .= '</select>';
    return $row;
}


function globalDateTimeFormat($datetime = '0000-00-00 00:00:00') {

    if ($datetime == '0000-00-00 00:00:00' or $datetime == '0000-00-00' or $datetime == '') {
        return 'Unknown';
    }
    return date('h:i A d/m/y', strtotime($datetime));
}

function invoiceDateFormat($datetime = '0000-00-00 00:00:00') {

    if ($datetime == '0000-00-00 00:00:00' or $datetime == '0000-00-00' or $datetime == '') {
        return 'Unknown';
    }
    return date('d M Y h:i A ', strtotime($datetime));
}

function saleDate($datetime = '0000-00-00 00:00:00') {

    if ($datetime == '0000-00-00 00:00:00' or $datetime == '0000-00-00' or $datetime == '') {
        return 'Unknown';
    }

    $date = date('d/m/y', strtotime($datetime));
    $time = date('h:i a', strtotime($datetime));

    return $date . '<br/>' . $time;
}

function globalTimeStamp($datetime = '0000-00-00 00:00:00') {   
    return date('d-M-y - h:i A ', strtotime($datetime));
}

function globalDateFormat($datetime = '0000-00-00 00:00:00') {

    if ($datetime == '0000-00-00 00:00:00' or $datetime == '0000-00-00' or $datetime == null) {
        return 'Unknown';
    }
    return date('d M y', strtotime($datetime));
}

function globalTimeOnly($datetime = '0000-00-00 00:00:00') {

    if ($datetime == '0000-00-00 00:00:00' or $datetime == '0000-00-00' or $datetime == null) {
        return 'Unknown';
    }
    return date('h:i A', strtotime($datetime));
}

function returnJSON($array = []) {
    return json_encode($array);
}

function ajaxRespond($status = 'FAIL', $msg = 'Fail! Something went wrong') {
    return returnJSON([ 'Status' => strtoupper($status), 'Msg' => $msg]);
}

function ajaxAuthorized() {
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        return true;
    } else {
        //die( ajaxRespond('Fail', 'Access Forbidden') ); 

        $html = '';
        $html .= '<center>';
        $html .= '<h1 style="color:red;">Access Denied !</h1>';
        $html .= '<hr>';
        $html .= '<p>It seems that you might come here via an unauthorised way</p>';
        $html .= '</center>';

        die($html);
    }
}

function globalCurrencyFormat($string = 0, $prefix = '৳ ', $sufix = '') {

    if (is_null($string) or empty($string)) {
        return 0 . $sufix;
    } else {
        //return $prefix . number_format($string, 0 ) . $sufix;
        return number_format($string, 2) . $sufix;
    }
}

function bdContactNumber($contact = null) {

    if ($contact && strlen($contact) == 11) {
        return substr($contact, 0, 5) . '-' . substr($contact, 5, 3) . '-' . substr($contact, 8, 3);
    } else {
        return $contact;
    }
}

function getPaginatorLimiter($selected = 100) {
    $range = [100, 500, 1000, 2000, 5000];
    $option = '';
    foreach ($range as $limit) {
        $option .= '<option';
        $option .= ( $selected == $limit) ? ' selected' : '';
        $option .= '>' . $limit . '</option>';
    }
    return $option;
}

function dd($string = 0) {
    echo '<pre>';
    print_r($string);
    echo '</pre>';
    exit;
}

function formatNumberToText($tk = 0, $extension = 'BDT') {
    $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
    return $f->format($tk) . $extension;
}

function convertNumberToWord($num = false) {
    //$price = new NumbersToWords();
    //return  $price->convert( $num );
    return convert_number($num);
}