<?php
/**
 * Plugin Name: Profile Builder - Send Unapproved Email for User Plugin
 * Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
 * Description: A brief description of the Plugin.- Josh Heslin Added Plugin from Profile Builder Cozmolabs
 * Version: The Plugin's Version Number, e.g.: 1.0
 * Author: JH - from cozmolabs, manual plugin
 * Author URI: hello@cozmoslabs.com
 * License: A "Slug" license name e.g. GPL2
 */
 
/*  Copyright YEAR  PLUGIN_AUTHOR_NAME  (email : PLUGIN AUTHOR EMAIL)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Start writing code after this line!
/*
 * Add Unapprove User column regardless of state. This way you can send unapproval emails. 
 */

add_filter('wppb_admin_approval_page_columns', 'wppbc_send_unapproved_email_column');
function wppbc_send_unapproved_email_column($columns) {
    $columns['send-unapproval'] = 'Send Unapproval Email';
    return $columns;
}
add_action('wppb_admin_approval_page_manage_column_data',  'wppbc_send_unapproved_email', 10, 3);
function wppbc_send_unapproved_email($dataArray, $user) {
    global $current_user;
    $wppb_nonce = wp_create_nonce( '_nonce_'.$current_user->ID.$user->ID);
    $actions = array();

    if ($current_user->ID != $user->ID){
            $actions['unapproved'] = sprintf('<a href="javascript:confirmAUAction(\'%s\',\'%s\',\'%s\',\'%s\',\''.__('Unapprove this user?', 'profile-builder').'\')">'. __('Unapprove', 'profile-builder') .'</a>', wppb_curpageurl(), 'unapprove', $user->ID, $wppb_nonce);
    }

    $dataArray['send-unapproval'] = $actions['unapproved'];
    return $dataArray;
}