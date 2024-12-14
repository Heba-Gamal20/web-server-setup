# Web Server Setup with LAMP Stack
1. **Installed LAMP Stack (Linux, Apache, MySQL, PHP)**
# Update the system
sudo dnf update -y

# Install Apache
sudo dnf install httpd -y
sudo systemctl start httpd
sudo systemctl enable httpd
sudo systemctl status httpd
#Make the Website Publicly Accessible
sudo firewall-cmd --permanent --add-service=http
sudo firewall-cmd --permanent --add-service=https
sudo firewall-cmd --reload

# Install MariaDB (MySQL equivalent)
sudo dnf install mariadb-server mariadb -y
sudo systemctl start mariadb
sudo systemctl enable mariadb
sudo mysql_secure_installation
# Install PHP and its modules
sudo dnf install php php-mysqlnd -y
sudo systemctl restart httpd
2. **Configured Apache to serve a PHP-based website**
*Verify that Apache is serving files from /var/www/html/:
echo '<html><body><h1>Apache is Working!</h1></body></html>' | sudo tee /var/www/html/index.html
http://192.168.56.130/
#Create a Simple Website
echo '<?php echo "Hello World!"; ?>' | sudo tee /var/www/html/index.php

sudo rm /var/www/html/index.html

http://192.168.56.130/

3. **Created a MySQL database and user**

sudo mysql -u root -p
CREATE DATABASE web_db;
CREATE USER 'web_user'@'localhost' IDENTIFIED BY 'Heba2020';
GRANT ALL PRIVILEGES ON web_db.* TO 'web_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
#Modify the Website to Use the Database
sudo nano /var/www/html/index.php

<?php
$servername = "localhost";
$username = "web_user";
$password = "Heba2020";
$dbname = "web_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch current time
$current_time = date('Y-m-d H:i:s');

// Display visitor IP and current time
echo "Hello, World!<br>";
echo "Your IP address is: " . $_SERVER['REMOTE_ADDR'] . "<br>";
echo "Current time: " . $current_time;

$conn->close();
?>
http://192.168.56.130/
4. **Pushed the project to GitHub**
cd /var/www/html/
git init
git add .
touch README.md
nano README.md
git commit -m "Initial commit: Add documentation and website files"

