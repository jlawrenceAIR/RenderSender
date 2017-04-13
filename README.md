# RenderSender
Generates image/PDF from URL and emails result to list of recipients
 
## Requirements
PHPMailer(included) - https://github.com/PHPMailer
PhantomJS - http://phantomjs.org/download.html
  
## yum commands to install PhantomJS Pre-Requisites:
sudo yum install glibc
sudo yum install zlib
sudo yum install fontconfig
sudo yum install libstdc++

## SELinux httpd/PhantomJS allow:
sudo grep phantomjs /var/log/audit/audit.log  | audit2allow -m httpd_phantomjs > httpd_phantomjs.te
sudo checkmodule -M -m -o httpd_phantomjs.mod httpd_phantomjs.te
sudo semodule_package -o httpd_phantomjs.pp -m httpd_phantomjs.mod
sudo semodule -i httpd_phantomjs.pp
