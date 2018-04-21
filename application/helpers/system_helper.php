<?php



function buildMenuForMoudle( $menus = null){  
    /* Example Array 
     * only display when developer forgot to assign array;
     * Noted by Kanny 
     * 17th Oct 2016, 3:05am 
    */
    $array = [
        'module'    => 'Menu Title',
        'icon'      => 'fa-users',
        'href'      => 'module',
        'children'  => [
            [ 
                'title' => 'Sub Title 1',
                'icon'  => 'fa fa-circle-o',
                'href'  => 'module/controller/method1'
            ]
        ]
    ];    
    if(!is_null($menus)){ $array = $menus; }         
    $menu = addAdminMenu($array['module'], $array['href'], $array['icon'], @$array['children'] );        
    return $menu;        
}

function addAdminMenu($name, $url = '', $icon = 'fa-envelope-o', $childrens = null){
    $ci =& get_instance();
    
    $active_url     = $ci->uri->segment( 1 );    
    $class_active   = ($active_url ===  $url) ? 'active' : '';
    

    
    $html = '';
    
    if(checkMenuPermission($url, $role_id)){
                  
        $html .= '<li class="'. $class_active .'">
                <a href="'. base_url() .  $url .'">
                    <i class="fa '. $icon .'"></i> <span>'. $name .'</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>';


        if( !empty($childrens)){
            $html .= '<ul class="treeview-menu">';
            foreach( $childrens as $item){                 
                $html .= addAdminChildMenu( $item['title'], $item['href'],  $item['icon']);                                                
            }
            $html .= '</ul>';
        }
        $html   .= '</li>';   
    }
    
    return $html;    
}

function addAdminChildMenu($title = 'Child Item', $childURL = 'admin', $icon = 'fa-circle-o'){
    $ci             =& get_instance();    
    $active_url     = $ci->uri->uri_string();
    $class_active   = ($active_url === ( base_url() . $childURL) ) ? ' class="active"' : '';       
    return '<li'.  $class_active  .'><a href="'. base_url() .  $childURL .'"><i class="fa '.$icon.'"></i>' . $title .'</a></li>';           
}   

function checkMenuPermission($access_key,$role_id){return true; }
function checkPermission($access_key,$role_id){ return true; }

function add_main_menu($title, $url, $access, $icon){
    // $title, $url, $icon, $access.
    $ci          =& get_instance();     
    $active_url  = $ci->uri->uri_string();
    
    
    $menu       = '';     
    $class_active   = ($active_url === $url ) ? ' class="active"' : '';       

    $menu .= '<li '. $class_active.'><a href="'. base_url() . $url .'">';
    $menu .= '<i class="fa '. $icon .'"></i>';
    $menu .= '<span>'.$title .'</span>';
    $menu .= '</a><li>';
    return $menu;

}