DROP USER IF EXISTS `kxi_admin`@`%`;
CREATE USER `kxi_admin`@`%` IDENTIFIED WITH mysql_native_password BY 'kxipassword';
GRANT ALL on arbeitsprobe.* to `kxi_admin`@`%`;
FLUSH PRIVILEGES;