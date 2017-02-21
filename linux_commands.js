Linux Commands
=================


Change TimeZone
- dpkg-reconfigure tzdata

To know the server IP Address
- ifconfig

Disk Used and Avalilable Space
-df --total

Remove applications
-sudo apt-get remove <application_name>

Add a Super User
-sudo adduser <usrname>
-usermod -aG sudo <username>

To swith the Super User
-su <username>

List the directory and files with all details
-ls -la

-List of Open Port
netstat -an | grep "LISTEN "
