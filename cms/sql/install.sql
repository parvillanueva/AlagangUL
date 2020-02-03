
/* Generate Users */
CREATE TABLE cms_users (
		    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		    username VARCHAR(255) NOT NULL,
		    email VARCHAR(255) NOT NULL,
		    name VARCHAR(255) NOT NULL,
		    password VARCHAR(255) NOT NULL,
		    create_date DATETIME NOT NULL,
		    update_date DATETIME NOT NULL,
		    status INT(6) DEFAULT NULL,
		    notif_signup INT(6) DEFAULT NULL,
		    notif_contactus INT(6) DEFAULT NULL,
		    notif_login INT(6) DEFAULT NULL,
		    role INT(6) DEFAULT NULL,
		    user_error_logs INT(6) DEFAULT NULL,
		    user_block_logs INT(6) DEFAULT NULL,
		    user_lock_time DATETIME DEFAULT NULL
		)ENGINE=InnoDB DEFAULT CHARSET=UTF8 AUTO_INCREMENT=1;


CREATE TABLE cms_user_roles (
			id int(11) NOT NULL AUTO_INCREMENT,
		    name varchar(255) NOT NULL,
			status int(6) DEFAULT NULL,
			create_date DATETIME NOT NULL,
		    update_date DATETIME NOT NULL,
			PRIMARY KEY (id)
		)ENGINE=InnoDB DEFAULT CHARSET=UTF8 AUTO_INCREMENT=1;


INSERT INTO cms_users (username, email, name, password, create_date, update_date, status,notif_signup, notif_contactus, notif_login, role) VALUES ('citadmin','php.developer@gmail.com','Administrator','638de582b29b7caedf0ee272f65c713c2de4f806','2020-02-03 11:17:12','2020-02-03 11:17:12',1,1,1,0,7),
 							 ('citqa', 'phpdev.unilab@gmail.com', 'citqa','638de582b29b7caedf0ee272f65c713c2de4f806','2020-02-03 11:17:12','2020-02-03 11:17:12',1,1,1,0,4),
 							 ('citdesigner', 'phpdev.unilab@gmail.com', 'citdesigner','638de582b29b7caedf0ee272f65c713c2de4f806','2020-02-03 11:17:12','2020-02-03 11:17:12',1,0,0,0,5);

INSERT INTO cms_user_roles  VALUES ('1', 'Web User', '1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
								   ('2', 'Web Approver', '1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
								   ('3', 'Content Manager', '1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
								   ('4', 'Quality Assurance', '1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
								   ('5', 'Designer', '1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
								   ('6', 'Admin', '1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
								   ('7', 'Super Admin', '1','2020-02-03 11:17:12','2020-02-03 11:17:12');


CREATE TABLE cms_preference (
		    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		    cms_title VARCHAR(255) NOT NULL,
		    cms_logo VARCHAR(255) NOT NULL,
		    cms_skin VARCHAR(255) NOT NULL,
		    cms_edit_label INT(6) NOT NULL,
		    ad_authentication INT(6) NOT NULL
		)ENGINE=InnoDB DEFAULT CHARSET=UTF8 AUTO_INCREMENT=1;

INSERT INTO cms_preference (cms_title, cms_logo, cms_skin, cms_edit_label, ad_authentication) VALUES ('Alagang Unilab', 'CMS', 'skin-blue', '1', '0');

CREATE TABLE cms_menu (
			id int(11) NOT NULL AUTO_INCREMENT,
			menu_url varchar(255) DEFAULT NULL,
			menu_name varchar(255) DEFAULT NULL,
			menu_icon varchar(255) DEFAULT NULL,
			menu_type int(1) DEFAULT NULL,
			menu_parent_id int(11) DEFAULT '0',
			menu_level int(11) DEFAULT NULL,
			menu_orders int(6) DEFAULT NULL,
			menu_status int(6) DEFAULT NULL,
			menu_updated_date datetime DEFAULT NULL,
			menu_created_date datetime DEFAULT NULL,
			menu_package varchar(255) DEFAULT NULL,
			PRIMARY KEY (id)
		) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;	

CREATE TABLE cms_menu_roles (
			id int(11) NOT NULL AUTO_INCREMENT,
			role_id int(11) DEFAULT NULL,
			menu_id int(11) DEFAULT NULL,
			menu_role_read int (11) DEFAULT NULL,
			menu_role_write int(11) DEFAULT NULL,
			menu_role_delete int(11) DEFAULT NULL,
			menu_role_updated_date datetime DEFAULT NULL,
			menu_role_created_date datetime DEFAULT NULL,
			PRIMARY KEY (id)
		) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

INSERT INTO cms_menu VALUES ('1', '#', 'Users', 'fa fa-users', '1', '0', '1', '1', '1','2020-02-03 11:17:12','2020-02-03 11:17:12', null),
							('2', 'content_management/users', 'List', '', '2', '1', '2', '1', '1','2020-02-03 11:17:12','2020-02-03 11:17:12', null),
							('3', 'content_management/user_role', 'Roles', '', '2', '1', '2', '2', '1','2020-02-03 11:17:12','2020-02-03 11:17:12', null),
							('4', 'content_management/file_manager', 'File Manager', 'fa fa-folder', '2', '0', '1', '3', '1','2020-02-03 11:17:12','2020-02-03 11:17:12', null),
							('5', 'content_management/audit_trail', 'Audit Trail', 'fa fa-flag', '2', '0', '1', '4', '1','2020-02-03 11:17:12','2020-02-03 11:17:12', null),
							('6', '#', 'Menus', 'fa fa-th-list', '1', '0', '1', '6', '1','2020-02-03 11:17:12','2020-02-03 11:17:12', null),
							('7', '#', 'Preferences', 'fa fa-cog', '1', '0', '1', '7', '1','2020-02-03 11:17:12','2020-02-03 11:17:12', null),
							('8', '#', 'Documentation', 'fa fa-code', '1', '0', '1', '8', '1','2020-02-03 11:17:12','2020-02-03 11:17:12', null),
							('9', 'content_management/site_meta', 'SEO - ASC', 'fa fa-tags', '2', '0', '1', '2', '1','2020-02-03 11:17:12','2020-02-03 11:17:12', null),
							('10', 'content_management/cms_menu/menu', 'CMS Menu', '', '2', '6', '2', '1', '1','2020-02-03 11:17:12','2020-02-03 11:17:12', null),
							('11', 'content_management/site_menu/menu', 'Site Menu', '', '2', '6', '2', '2', '1','2020-02-03 11:17:12','2020-02-03 11:17:12', null),
							('12', 'content_management/preference/cms', 'Content Management', '', '2', '7', '2', '1', '1','2020-02-03 11:17:12','2020-02-03 11:17:12', null),
							('13', 'content_management/preference/site', 'Site Information', '', '2', '7', '2', '2', '1','2020-02-03 11:17:12','2020-02-03 11:17:12', null),
							('14', 'content_management/preference/database_table', 'dbTable Generator', '', '2', '7', '2', '3', '1','2020-02-03 11:17:12','2020-02-03 11:17:12', null),
							('15', 'content_management/preference/editor', 'Editor', '', '2', '7', '2', '4', '1','2020-02-03 11:17:12','2020-02-03 11:17:12', null),
							('16', 'content_management/documentation/template', 'Template', '', '2', '8', '2', '1', '1','2020-02-03 11:17:12','2020-02-03 11:17:12', null),
							('17', 'content_management/documentation/helper', 'Helper', '', '2', '8', '2', '2', '1','2020-02-03 11:17:12','2020-02-03 11:17:12', null),
							('18', 'content_management/documentation/global_use', 'Global', '', '2', '8', '2', '3', '1','2020-02-03 11:17:12','2020-02-03 11:17:12', null),
							('19', 'content_management/documentation/site_loader', 'Standards', '', '2', '8', '2', '4', '1','2020-02-03 11:17:12','2020-02-03 11:17:12', null),
							('20', 'content_management/documentation/package', 'Package', '', '2', '8', '2', '5', '1','2020-02-03 11:17:12','2020-02-03 11:17:12', null),
							('21', '#', 'CRS', 'fa fa-th', '1', '0', '1', '9', '1','2020-02-03 11:17:12','2020-02-03 11:17:12', null),
							('22', 'content_management/crs_configuration', 'configuration', '', '2', '21', '2', '1', '1','2020-02-03 11:17:12','2020-02-03 11:17:12', null),
							('23', 'content_management/crs_users', 'user', '', '2', '21', '2', '2', '1','2020-02-03 11:17:12','2020-02-03 11:17:12', null),
							('24', 'content_management/site_promo_campaign', 'promo campaign', 'glyphicon glyphicon-tag', '2', '0', '1', '4', '1','2020-02-03 11:17:12','2020-02-03 11:17:12', null);								
/**User Role**/
/**Web User**/	
INSERT INTO cms_menu_roles (role_id, menu_id, menu_role_read, menu_role_write, menu_role_delete, menu_role_updated_date, menu_role_created_date) 
					VALUES ('1','1','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('1','2','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('1','3','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('1','4','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('1','5','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('1','6','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('1','7','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('1','8','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('1','9','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('1','10','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('1','11','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('1','12','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('1','13','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('1','14','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('1','15','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('1','16','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('1','17','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('1','18','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('1','19','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('1','20','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('1','21','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('1','22','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('1','23','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('1','24','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12');
/**Web Approver**/	
INSERT INTO cms_menu_roles (role_id, menu_id, menu_role_read, menu_role_write, menu_role_delete, menu_role_updated_date, menu_role_created_date) 
					VALUES ('2','1','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('2','2','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('2','3','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('2','4','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('2','5','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('2','6','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('2','7','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('2','8','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('2','9','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('2','10','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('2','11','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('2','12','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('2','13','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('2','14','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('2','15','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('2','16','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('2','17','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('2','18','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('2','19','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('2','20','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('2','21','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('2','22','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('2','23','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('2','24','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12');

/**Content Manager**/
INSERT INTO cms_menu_roles (role_id, menu_id, menu_role_read, menu_role_write, menu_role_delete, menu_role_updated_date, menu_role_created_date) 
					VALUES ('3','1','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('3','2','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('3','3','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('3','4','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('3','5','1','1','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('3','6','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('3','7','1','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('3','8','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('3','9','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('3','10','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('3','11','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('3','12','1','1','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('3','13','1','1','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('3','14','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('3','15','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('3','16','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('3','17','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('3','18','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('3','19','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('3','20','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('3','21','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('3','22','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('3','23','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('3','24','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12');
/**Quality Assurance**/
INSERT INTO cms_menu_roles (role_id, menu_id, menu_role_read, menu_role_write, menu_role_delete, menu_role_updated_date, menu_role_created_date) 
					VALUES ('4','1','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('4','2','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('4','3','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('4','4','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('4','5','1','1','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('4','6','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('4','7','1','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('4','8','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('4','9','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('4','10','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('4','11','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('4','12','1','1','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('4','13','1','1','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('4','14','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('4','15','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('4','16','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('4','17','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('4','18','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('4','19','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('4','20','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('4','21','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('4','22','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('4','23','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('4','24','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12');

/**Designer**/
INSERT INTO cms_menu_roles (role_id, menu_id, menu_role_read, menu_role_write, menu_role_delete, menu_role_updated_date, menu_role_created_date) 
					VALUES ('5','1','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('5','2','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('5','3','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('5','4','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('5','5','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('5','6','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('5','7','1','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('5','8','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('5','9','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('5','10','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('5','11','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('5','12','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('5','13','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('5','14','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('5','15','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('5','16','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('5','17','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('5','18','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('5','19','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('5','20','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('5','21','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('5','22','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('5','23','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('5','24','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12');

/**Admin**/
INSERT INTO cms_menu_roles (role_id, menu_id, menu_role_read, menu_role_write, menu_role_delete, menu_role_updated_date, menu_role_created_date) 
					VALUES ('6','1','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('6','2','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('6','3','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('6','4','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('6','5','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('6','6','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('6','7','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('6','8','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('6','9','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('6','10','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('6','11','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('6','12','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('6','13','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('6','14','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('6','15','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('6','16','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('6','17','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('6','18','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('6','19','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('6','20','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('6','21','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('6','22','0','0','0','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('6','23','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('6','24','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12');

/**Super Admin**/
INSERT INTO cms_menu_roles (role_id, menu_id, menu_role_read, menu_role_write, menu_role_delete, menu_role_updated_date, menu_role_created_date) 
					VALUES ('7','1','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('7','2','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
						   ('7','3','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
					       ('7','4','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
					       ('7','5','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
					       ('7','6','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
					       ('7','7','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
					       ('7','8','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
					       ('7','9','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
					       ('7','10','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
					       ('7','11','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
					       ('7','12','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
					       ('7','13','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
					       ('7','14','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
					       ('7','15','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
					       ('7','16','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
					       ('7','17','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
					       ('7','18','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
					       ('7','19','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
					       ('7','20','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
					       ('7','21','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
					       ('7','22','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
					       ('7','23','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12'),
					       ('7','24','1','1','1','2020-02-03 11:17:12','2020-02-03 11:17:12');


CREATE TABLE cms_audit_trail (
		    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		    user_id VARCHAR(255) NOT NULL,
		    url VARCHAR(255) NOT NULL,
		    action VARCHAR(255) NOT NULL,
		    old_data TEXT NOT NULL,
		    new_data TEXT NOT NULL,
		    create_date DATETIME NOT NULL
		)ENGINE=InnoDB DEFAULT CHARSET=UTF8 AUTO_INCREMENT=1;

INSERT INTO cms_audit_trail (user_id, url, action, create_date) 
	   VALUES (1,'Setup','Install Content Management','2020-02-03 11:17:12');


CREATE TABLE site_information (
		    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		    title VARCHAR(255) NOT NULL,
		    description TEXT NOT NULL,
		    keyword TEXT NOT NULL,
		    ga_id TEXT DEFAULT NULL,
		    shop_url TEXT NOT NULL,
		    favicon TEXT NOT NULL,
		    logo TEXT NOT NULL,
		    facebook TEXT  DEFAULT NULL,
		    twitter TEXT  DEFAULT NULL,
		    instagram TEXT  DEFAULT NULL,
		    pinterest TEXT  DEFAULT NULL,
		    linkedin TEXT  DEFAULT NULL,
		    tumblr TEXT  DEFAULT NULL,
		    youtube TEXT  DEFAULT NULL,
		    ga_status INT(6) DEFAULT NULL,
		    create_date DATETIME NOT NULL,
		    update_date DATETIME NOT NULL,
		    notif_status INT(11) NOT NULL, 
		    notif_position VARCHAR(100) DEFAULT NULL, 
		    notif_browser TEXT  DEFAULT NULL, 
		    notif_message TEXT  DEFAULT NULL,
		   	google_tag_manager_header TEXT  DEFAULT NULL,
		    google_tag_manager_body TEXT  DEFAULT NULL
	)ENGINE=InnoDB DEFAULT CHARSET=UTF8 AUTO_INCREMENT=1;

INSERT INTO site_information (title, description, keyword, ga_status, create_date, update_date,shop_url,favicon,logo,notif_status) 
	VALUES ('Site Title','Meta Description','Meta Keyword',0,'2020-02-03 11:17:12','2020-02-03 11:17:12','','','uploads/validator.png',0);

CREATE TABLE site_menu (
			id int(11) NOT NULL AUTO_INCREMENT,
			menu_url varchar(255) DEFAULT NULL,
			menu_name varchar(255) DEFAULT NULL,
			default_menu int(1) DEFAULT NULL,
			menu_type varchar(255) DEFAULT NULL,
			menu_parent_id int(11) DEFAULT '0',
			menu_level int(11) DEFAULT NULL,
			menu_orders int(6) DEFAULT NULL,
			menu_status int(6) DEFAULT NULL,
			menu_updated_date datetime DEFAULT NULL,
			menu_created_date datetime DEFAULT NULL,
			modified_by int(11) DEFAULT NULL,
			PRIMARY KEY (id)
		) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;


CREATE TABLE site_analytics (
		    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		    unid VARCHAR(255) NOT NULL,
		    url TEXT NOT NULL,
		    datetime DATETIME NOT NULL,
		    browser VARCHAR(255) DEFAULT NULL,
		    type VARCHAR(255) DEFAULT NULL
		)ENGINE=InnoDB DEFAULT CHARSET=UTF8 AUTO_INCREMENT=1;

CREATE TABLE cms_site_token (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            token VARCHAR(255) NOT NULL,
            redirect TEXT NOT NULL,
            user_id INT(6) DEFAULT NULL,
            create_date DATETIME NOT NULL,
            expire_date DATETIME NOT NULL,
            status INT(6) DEFAULT NULL
        )ENGINE=InnoDB DEFAULT CHARSET=UTF8 AUTO_INCREMENT=1;

CREATE TABLE cms_metatags (
			id int(11) NOT NULL AUTO_INCREMENT,
			meta_url varchar(255) DEFAULT NULL,
			meta_title varchar(255) DEFAULT NULL,
			meta_keyword varchar(255) DEFAULT NULL,
			meta_description text,
			meta_image varchar(255) DEFAULT NULL,
			meta_status int(2) DEFAULT NULL,
			meta_created_date datetime DEFAULT NULL,
			meta_updated_date datetime DEFAULT NULL,
			meta_parent_id varchar(255) DEFAULT NULL,
			meta_type int(11) DEFAULT NULL,
			meta_level int(11) DEFAULT NULL,
			og_type varchar(255) DEFAULT NULL,
			asc_ref_code text DEFAULT NULL,
			PRIMARY KEY (id)
		) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

CREATE TABLE cms_standard_config (
			id int(11) NOT NULL AUTO_INCREMENT,
		    standard_name varchar(255) NOT NULL,
			created_date DATETIME NOT NULL,
			PRIMARY KEY (id)
		)ENGINE=InnoDB DEFAULT CHARSET=UTF8 AUTO_INCREMENT=1;

CREATE TABLE cms_historical_passwords (
  id int(11) NOT NULL AUTO_INCREMENT,
  user_id int(11) NOT NULL,
  password varchar(255) NOT NULL,
  create_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
  )ENGINE=InnoDB DEFAULT CHARSET=UTF8 AUTO_INCREMENT=1;

INSERT INTO cms_historical_passwords (user_id, password, create_date) VALUES
	('1', '638de582b29b7caedf0ee272f65c713c2de4f806', '2020-02-03 11:17:12'),
	('2', '638de582b29b7caedf0ee272f65c713c2de4f806', '2020-02-03 11:17:12'),
	('3', '638de582b29b7caedf0ee272f65c713c2de4f806', '2020-02-03 11:17:12');


CREATE TABLE pckg_crs_config (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
		host VARCHAR(255) NOT NULL, 
		token VARCHAR(255) NOT NULL, 
		create_date DATETIME NOT NULL, 
		update_date DATETIME NOT NULL
	)ENGINE=InnoDB DEFAULT CHARSET=UTF8 AUTO_INCREMENT=1;

INSERT INTO pckg_crs_config (host,token,create_date,update_date) VALUES ('','',NOW(),NOW());

CREATE TABLE pckg_crs_users ( 
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
		firstname VARCHAR(255) NOT NULL, 
		lastname VARCHAR(255) NOT NULL, 
		email VARCHAR(100) NOT NULL, 
		civil_status VARCHAR(255) NOT NULL, 
		gender INT(6) NOT NULL, 
		dob DATE NOT NULL, 
		mobile VARCHAR(255) NOT NULL, 
		status INT(6) NOT NULL, 
		orders INT(6) NOT NULL, 
		registration_date DATETIME NOT NULL, 
		create_date DATETIME NOT NULL, 
		update_date DATETIME NOT NULL
	)ENGINE=InnoDB DEFAULT CHARSET=UTF8 AUTO_INCREMENT=1;



CREATE TABLE site_promo_campaign (
		    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		    redirect_url TEXT DEFAULT NULL,
		    img_banner TEXT DEFAULT NULL,
		    start_date DATETIME DEFAULT NULL,
		    end_date DATETIME DEFAULT NULL,
		    status INT(6) NOT NULL, 
			create_date DATETIME NOT NULL, 
			update_date DATETIME NOT NULL
	)ENGINE=InnoDB DEFAULT CHARSET=UTF8 AUTO_INCREMENT=1;


CREATE TABLE site_shop_now (
		    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		    url TEXT DEFAULT NULL,
		    img_banner TEXT DEFAULT NULL,
		   	status INT(6) NOT NULL, 
			create_date DATETIME NOT NULL, 
			update_date DATETIME NOT NULL
	)ENGINE=InnoDB DEFAULT CHARSET=UTF8 AUTO_INCREMENT=1;
