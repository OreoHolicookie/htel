if [[ -z `which dnf` ]]; then
     echo "Please install dnf package manager and then rerun this script"
fi

cd `dirname $0`
DIR=`pwd`

# update all packages
dnf update -y

# install dependencies: Mysql, Apache, PHP and extentions
dnf install mysql httpd php php-cli php-gd php-curl php-zip php-mbstring php-mysqlnd -y

# Start Mysql
systemctl start mysqld
systemctl enable mysqld

# Start apache
systemctl start httpd
systemctl enable httpd

# Configure DB
echo "Enter your Mysql root password or just press Enter if not configured yet"
mysql -u root -p < $DIR/hotel.sql

# Copy project to /var/www/html
cp -r $DIR /var/www/html/

# restart apache
systemctl restart httpd
