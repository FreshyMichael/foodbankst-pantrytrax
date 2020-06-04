<?php
/**
* Plugin Name: FoodbankST PantryTrax
* Plugin URI: https://github.com/FreshyMichael/foodbankst-pantrytrax
* Description: Integrating PantryTrax with foodbankst.org
* Version: 1.0.0
* Author: FreshySites
* Author URI: https://freshysites.com/
* License: GNU v3.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

/* FoodbankST PantryTrax Start */
//______________________________________________________________________________

function cfd_reg_function(){
	echo '<div class="cfd-registrations">';
	date_default_timezone_set("America/New_York");
	echo 'CFD Registrations' . " " . 'as of' . " " . date("h:ia") . " EST " . date("m/d/y") . '<br><br>';
	echo '<table class="cfd-entries" style="overflow: auto; text-align:center; ">';
	echo '<thead>';
	echo '<tr>';
	echo '<th>Name</th>';
	echo '<th>Check-In Number</th>';
	echo '<th style="min-width:200px;">Phone Number</th>';
	echo '<th>Age</th>';
	echo '<th>Address</th>';
	echo '<th>Search</th>';
	echo '<th>Add New</th>';
	echo '</tr>';
	echo '</thead>';
	echo '<tbody>';
	//Form Query
 	$form_id = '4';
	$search_criteria = array();
	$sorting = array();
	$paging = array( 'offset' => 0, 'page_size' => 500 );
	$total_count = 0;
	$entry = GFAPI::get_entries( $form_id, $search_criteria, $sorting, $paging, $total_count );
	foreach ($entry as $key ) {
		                       $entry_id = $key[id];
							   $entry_first_name = $key['3.3'];
							   $entry_last_name = $key['3.6'];
							   $entry_phone = $key[4];
							   $entry_email = $key[5];
							   $entry_vehicle = $key[44];
							   $entry_address = $key[14];
							   $entry_zipcode = $key[15];

		//URL encode strings
							  $address = urlencode($entry_address);
		//Search Strings
	$lastname = $entry_last_name;
    $search_value_1 = $lastname ;
    $firstname = $entry_first_name;
    $search_value_2 = $firstname ;
    $search_type = "name" ;
    $search_icon = "<img src=\"https://images.pantrytrak.com/ft_images/glyphicon_green_primary/glyphicons-basic-532-user-family.svg\" height=\"25\" >" ;


		//calc age from DOB
								$entry_dob = $key[11];
								$entry_age = (date('Y') - date('Y',strtotime($entry_dob)));
		//Entry Rows and Cells
								echo '<tr>';
								echo '<td class="first-name">';
								echo $entry_first_name . " " . $entry_last_name ;
								echo '</td>';
								echo '<td class="vehicle">';
								echo $entry_id;
								echo '</td>';
								echo '<td class="phone">';
 								echo $entry_phone;
								echo '</td>';
								echo '<td class="age">';
 								echo $entry_age;
								echo '</td>';
								echo '<td class="address">';
 								echo $entry_address;
								echo '</td>';
							    echo '<td class="search">';
 								echo "<a href='https://secure.pantrytrak.com/mobile/search.php?type=name&lastname=" . "$lastname&firstname=$firstname' target='_blank' method='post'>Search</a>";
							   //https://secure.pantrytrak.com/mobile/search.php?type=name&lastname=mollenkopf&firstname=mark&address1=3825%20Richland%20Rd%20NE&hh_age=52&
								echo '</td>';
		echo '<td class="search">';
 								echo "<a href='https://secure.pantrytrak.com/mobile/family_add1.php?lastname=$entry_last_name&firstname=$entry_first_name&address1=$address&zip=$entry_zipcode&' target='_blank'>Add</a>";

								echo '</td>';
								echo '</tr>';
							}
	echo '</tbody>';
	echo '<tfoot style="font-weight:700; text-align:center;">';
	echo '<tr>';
	echo '<td>Pantry Trak?</th>';
	echo '<td>Check-In Number</th>';
	echo '<td>Last Name</th>';
	echo '<td>Age</th>';
	echo '<td>Address</th>';
	echo '<td>Search</th>';
	echo '<td>Add New</th>';
	echo '</tr>';
	echo '</tfoot>';
	echo '</div>';



}

add_shortcode('cfd_reg', 'cfd_reg_function');


//______________________________________________________________________________
// All About Updates

//  Begin Version Control | Auto Update Checker
require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
// ***IMPORTANT*** Update this path to New Github Repository Master Branch Path
	'https://github.com/FreshyMichael/foodbankst-pantrytrax',
	__FILE__,
// ***IMPORTANT*** Update this to New Repository Master Branch Path
	'foodbankst-pantrytrax'
);
//Enable Releases
$myUpdateChecker->getVcsApi()->enableReleaseAssets();
//Optional: If you're using a private repository, specify the access token like this:
//
//
//Future Update Note: Comment in these sections and add token and branch information once private git established
//
//
//$myUpdateChecker->setAuthentication('your-token-here');
//Optional: Set the branch that contains the stable release.
//$myUpdateChecker->setBranch('stable-branch-name');

//______________________________________________________________________________
/* PluginName End */
?>
