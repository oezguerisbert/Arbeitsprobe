CREATE USER 'jetski'@'%' IDENTIFIED by "jetskipassword";
grant all privileges on modul133.* to 'jetski'@'%';
flush privileges;