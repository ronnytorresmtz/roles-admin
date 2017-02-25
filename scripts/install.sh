# script/after_install.sh
#!/bin/bash
#sudo cp /var/www/html/roles-admin/public/index.php /var/www/html/rolesadmin/public/index.bak
sudo cp /var/repo/public /var/www/html/rolesadmin/public
#sudo rm -f /var/www/html/rolesadmin/public/index.php
#sudo cp /var/www/html/rolesadmin/public/index.bak /var/www/html/rolesadmin/public/index.php
#sudo rm -f /var/www/html/rolesadmin/public/index.bak