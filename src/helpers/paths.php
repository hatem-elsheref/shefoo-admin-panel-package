<?php

if (!function_exists('shefoo_admin_assets')){
 function shefoo_admin_assets($asset){
     return url('assets/dashboard_assets/'.trim($asset,'/'));
 }
}
