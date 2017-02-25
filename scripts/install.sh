# script/after_install.sh
#!/bin/bash
#sudo cp /var/www/html/roles-admin/public/index.php /var/www/html/roles-admin/public/index.bak
sudno install -D repo/roles-admin/public www/html/roles-admin/public
#sudo rm -f /var/www/html/roles-admin/public/index.php
#sudo cp /var/www/html/roles-admin/public/index.bak /var/www/html/roles-admin/public/index.php
#sudo rm -f /var/www/html/roles-admin/public/index.bak
