# script/after_install.sh
#!/bin/bash
sudo cp -r ../roles-admin/public/ /var/www/html/roles-admin/public
#sudo cp /var/www/html/roles-admin/public/index.bak /var/www/html/roles-admin/public.index.php
