<?php 

function asset( $asset_url )
{
    echo base_url('assets/' . $asset_url );
}
function url( $asset_url = "" )
{
    echo base_url( $asset_url );
}

function get_app_config($data = 'app_name')
{
    $CI =& get_instance();
    return $CI->config->item($data);
}

function get_option($key = 'app_name')
{
    $CI =& get_instance();
    return $CI->option_model->get_value($key);
}

function array_input_filter( $data, $allowed )
{
    foreach ($data as $key => $value) 
        if( !in_array($key, $allowed) ) 
            unset($data[$key]);

    return $data;
}
function filter_no_empty( $data )
{
    foreach ($data as $key => $value) 
        if( $value == "" ) unset($data[$key]);

    return $data;
}

function isAssoc($array)
{
    return array_keys($array) !== range(0, count($array) - 1);
}

function array_set_key($args, $key){
    $data = array();
    foreach ($args as $value) {
        $data[$value->$key] = $value;
    }
    return $data;
}

function set_message_flash($content, $type = "danger"){
    $CI =& get_instance();
    $data = array('type' => $type,'content' => $content, );
    $CI->session->set_flashdata('message', $data);
}

function get_message_flash(){
    $CI =& get_instance();
    $session_flash = $CI->session->flashdata('message');
    if (isset($session_flash)){
        $CI->session->unset_userdata('message');
        $message = $session_flash;
        ?>
            <div class="alert alert-<?php echo $message['type']; ?>">
                <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <?php echo $message['content']; ?>
            </div>
        <?php
    }
}

function money_formating($data)
{
    return "Rp ". number_format($data,0,',','.').",- ";
}