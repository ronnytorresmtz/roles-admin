# script/after_install.sh
#!/bin/bash
#sudo cp -r ../public/ /var/www/html/roles-admin
sudo rm -f /var/www/html/roles-admin/public/index.php &>> after_install.log
sudo cp -f /var/www/html/roles-admin/public/index_prod.php /var/www/html/roles-admin/public/index.php &>> after_install.log



