<?php
/*
Plugin Name: Production Automation
Plugin URI: https://wordpress.org/plugins/health-check/
Description: Checks the health of your WordPress install
Version: 0.1.0
Author: Mohammad Abdullah-Al-Nazad
Author URI: http://health-check-team.example.com
Text Domain: ghgfjgh
Domain Path: /languages
*/

// when activate the Plugin-------------
register_activation_hook(
    __FILE__,
    'create_table'
);

function create_table(){
    global $wpdb;
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    //require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	//dbDelta( $query );
    //or--below any one use-------
    //$wpdb->query($query);

    // Foysal--------------------------
    $raw_material = $wpdb->prefix . "raw_materials";
    $foquery = "CREATE TABLE IF NOT EXISTS $raw_material(id int AUTO_INCREMENT PRIMARY KEY,name varchar(255), price decimal(10,2))";
    dbDelta($foquery);
    $add_raw = "insert into $raw_material(name,price)values('rice','1000')";
    $wpdb->query($add_raw);

    // Forhad---------------------------
    $suppliers = $wpdb->prefix . "suppliers";
    $fquery = "CREATE TABLE IF NOT EXISTS $suppliers(id int AUTO_INCREMENT PRIMARY KEY,company_name varchar(255),email varchar(50),phone varchar(15),address text,contact_person varchar(50),bank_info varchar(50))";
    dbDelta($fquery);
    $add_sup = "insert into $suppliers(company_name,email,phone,contact_person,bank_info)values('Bitl','bit@gmail.com','015896','helal','Grameen bank')";
    $wpdb->query($add_sup);

    //Rakib----------------------------------
    $startup_buyers = $wpdb->prefix . "secondary_buyers";
    $rakib_query = "CREATE TABLE IF NOT EXISTS $startup_buyers(id int AUTO_INCREMENT PRIMARY KEY,name varchar(100),email varchar(50),phone varchar(50),address text)";
    $wpdb->query($rakib_query);
    $add_buyer = "insert into $startup_buyers(name,email,phone,address)values('Rakib','rakib@gmail.com','01589600','Mohammadpur')";
    $wpdb->query($add_buyer);

    //Badsha--------------------------------
    $purchase_table=$wpdb->prefix ."purchase";
    $bquery="CREATE TABLE IF NOT EXISTS $purchase_table(id int AUTO_INCREMENT PRIMARY KEY,invoice_id int not null, price decimal(10,2) not null, material_id int not null, supplier_id int not null, quantity int not null, date date not null)";
	dbDelta( $bquery );
    $add_pur = "insert into $purchase_table(invoice_id,price,material_id,supplier_id,quantity,date)values(102565,100,1,1,20,'2024-04-22')";
    $wpdb->query($add_pur);

    //sazib --------------------------------
    $stock_return = $wpdb->prefix . "stock_return";
    $sazib_query = "CREATE TABLE IF NOT EXISTS $stock_return(id int AUTO_INCREMENT PRIMARY KEY,invoice_id int not null,quantity int not null,date date not null,material_id int not null,supplier_id int not null)";
    dbDelta($sazib_query);
    $add_return = "insert into $stock_return(invoice_id,quantity,date,material_id,supplier_id)values(102565,5,'2024-04-22',1,1)";
    $wpdb->query($add_return);

    //ruhul--------------------------------
    $material_wastage = $wpdb->prefix . "material_wastage";
    $ruquery = "CREATE TABLE IF NOT EXISTS $material_wastage(id int AUTO_INCREMENT PRIMARY KEY,material_id int not null,quantity varchar(255) not null,date date)";
    dbDelta($ruquery);
    $add_wastage = "insert into $material_wastage(material_id,quantity,date)values(1,10,'2024-04-22')";
    $wpdb->query($add_wastage);

    //zahid--------------------------------
    $material_wastage_dump=$wpdb->prefix ."material_wastage_dump";
    $zquery="CREATE TABLE IF NOT EXISTS $material_wastage_dump(id int AUTO_INCREMENT PRIMARY KEY,material_id int not null,quantity int not null,date date not null)";
    dbDelta( $zquery );
    $add_wastage_d = "insert into $material_wastage_dump(material_id,quantity,date)values(1,1,'2024-04-22')";
    $wpdb->query($add_wastage_d);

    // Minhaj --------------------------------
    $material_wastage_sale=$wpdb->prefix . 'material_wastage_sale';
    $wastage_sale="CREATE TABLE if Not EXISTS $material_wastage_sale(id int PRIMARY KEY AUTO_INCREMENT, invoice_id int(11),material_id varchar(50),buyer_id varchar(100),quantity varchar(10), date date)";
    dbDelta($wastage_sale);
    $add_wastage_s = "insert into $material_wastage_sale(invoice_id,material_id,buyer_id,quantity,date)values(10256,1,1,2,'2024-04-22')";
    $wpdb->query($add_wastage_s);

    //reazul-------------------------------
    $supplier_payment = $wpdb->prefix . "supplier_payment";
    $rquery = "CREATE TABLE IF NOT EXISTS $supplier_payment(id int AUTO_INCREMENT PRIMARY KEY,supplier_id int not null,amount decimal(10,2) not null,method varchar(255) not null,date date)";
    dbDelta($rquery);
    $add_sp = "insert into $supplier_payment(supplier_id,amount,method,date)values(1,1000,'cash on','2024-04-22')";
    $wpdb->query($add_sp);
    
}



// When Deactivate the plugin-----------------
register_deactivation_hook(
    __FILE__,
    'Success'
);
function Success(){
    echo "Successfully Deactivated";
}

add_shortcode('test_code', 'testCode');
function testCode($atts, $content = '', $tag){
    include dirname(__FILE__) . '/page.php';
}
function add_my_menu()
{
    add_menu_page(
        'Stock Report',
        'Garments',
        'manage_options',
        'Dashboard',
        function () {
            include dirname(__FILE__) . '/nazad/dashboard.php';
        }
    );

    // material purchase by badsha--------------
    require_once ("badsha/garment.php");
    // raw-materials by foysal--------------
    require_once ("foysal/foy_raw-material.php");

    //Buyers by Rakib----------------
    require_once ("rakib/buyers.php");

    // suppliers by forhad--------------
    require_once ("forhad/suppliers.php");

    // Stock Return by Sazib------------------
    require_once ("sazib/garments.php");

    // Material Wastage by ruhul--------------
    require_once ("ruhul/material_wastage_one.php");

    // wastage Dump by Zahid--------------
    require_once ("zahid/garment.php");

    // wastage sell by Minhaj--------------
    require_once ("minhaj/wastage_sale.php");

    // supplier_payment by Reazul--------------
    require_once ("reazul/garments.php");
    // Material stock report by Nazad--------------
    require_once ("nazad/sub_menu.php");

    // Material wastage report by Fazle------------
    require_once ("fazle/mwr-fazle.php");
    
}
add_action('admin_menu', 'add_my_menu');


//badsha add action-------------------
require_once("badsha/add_action.php");

//foysal add action-------------------
require_once("foysal/add_action.php");

//forhad add action-------------------
require_once("forhad/add_action.php");

//Sazib add action-------------------
require_once("sazib/add_action.php");

//Ruhul add action-------------------
require_once("ruhul/add_action.php");

//Rakib add action-------------------
require_once("rakib/add_action.php");

//zahid add action-------------------
require_once("zahid/add_action.php");

//minhaj add action-------------------
require_once("minhaj/add_action.php");

//reazul add action-------------------
require_once("reazul/add_action.php");

?>