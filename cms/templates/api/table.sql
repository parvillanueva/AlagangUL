CREATE TABLE IF NOT EXISTS pckg_crs_config ( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, host VARCHAR(255) NOT NULL, token VARCHAR(255) NOT NULL, config_create_date DATETIME NOT NULL, config_update_date DATETIME NOT NULL)ENGINE=InnoDB DEFAULT CHARSET=UTF8 AUTO_INCREMENT=1;

INSERT INTO pckg_crs_config (host,token,config_create_date,config_update_date) VALUES ('','',NOW(),NOW());