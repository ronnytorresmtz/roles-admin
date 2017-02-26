# script/after_install.sh
#!/bin/bash
sudo rm -r /var/www/html/roles-admin/public/index.php
sudo cp -rf /var/www/html/roles-admin/public/index_prod.php /var/www/html/roles-admin/public/index.php

sudo service apache2 restart