<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * This file is part of Auth_Ldap.

    Auth_Ldap is free software: you can redistribute it and/or modify
    it under the terms of the GNU Lesser General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Auth_Ldap is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Auth_Ldap.  If not, see <http://www.gnu.org/licenses/>.
 * 
 */

/**
 * @author      Greg Wojtak <gwojtak@techrockdo.com>
 * @copyright   Copyright © 2010,2011 by Greg Wojtak <gwojtak@techrockdo.com>
 * @package     Auth_Ldap
 * @subpackage  configuration
 * @license     GNU Lesser General Public License
 */

/**
 * Array Index      - Usage
 * hosts            - Array of ldap servers to try to authenticate against
 * ports            - The remote port on the ldap server to connect to
 * basedn           - The base dn of your ldap data store
 * login_attribute  - LDAP attribute used to check usernames against
 * use_ad           - Boolean to tell Auth_Ldap whether you are using AD or not.
 * ad_domain        - If using AD auth, the domain to prepend (in the case of pre-2000 domains) or append.
 * proxy_user       - Distinguised name of a proxy user if your LDAP server does not allow anonymous binds
 * proxy pass       - Password to use with above
 * roles            - An array of role names to use within your app.  The values are arbitrary.  The keys themselves represent the
			"security level," ie
			if( $security_level >= 3 ) {
				// Is a power user
				echo display_info_for_power_users_or_admins();
			}
 * member_attribute - Attribute to search to determine allowance after successful authentication
 * auditlog         - Location to log auditable events.
 */
		
$config['hosts'] = array('192.168.1.251');
$config['ports'] = array(389);
$config['basedn'] = 'CN=Users,DC=cdesignfashion,DC=lan';
$config['login_attribute'] = 'cn';
$config['use_ad'] = true;
$config['ad_domain'] = 'CDESIGNFASHION';
$config['proxy_user'] = '';
$config['proxy_pass'] = '';
$config['roles'] = array(1 => 'Cdesign Staff Group', 
    3 => 'Power User',
    5 => 'Administrator');
$config['member_attribute'] = 'memberUid';
$config['auditlog'] = 'application/logs/audit.log';  // Some place to log attempted logins (separate from message log)
?>
