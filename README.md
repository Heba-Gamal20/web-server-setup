

# to access website <http://192.168.56.130/> 


# Web Server Setup with LAMP Stack
1. **Installed LAMP Stack (Linux, Apache, MySQL, PHP)**
# Update the system
sudo dnf update -y


# Install Apache

sudo dnf install httpd -y,

"Start and enable apache:"

sudo systemctl start httpd,

sudo systemctl enable httpd,

sudo systemctl status httpd,

#Make the Website Publicly Accessible

"Allow HTTP (port 80) and optionally HTTPS (port 443):"

sudo firewall-cmd --permanent --add-service=http ,

sudo firewall-cmd --permanent --add-service=https ,

sudo firewall-cmd --reload

# Install MariaDB (MySQL equivalent)
sudo dnf install mariadb-server mariadb -y

"Start and enable mariadb:"

sudo systemctl start mariadb

sudo systemctl enable mariadb

"Secure the installation:"

sudo mysql_secure_installation

# Install PHP and its modules
sudo dnf install php php-mysqlnd -y

sudo systemctl restart httpd

2. **Configured Apache to serve a PHP-based website**

*Verify that Apache is serving files from /var/www/html/:

*echo '<html><body><h1>Apache is Working!</h1></body></html>' | sudo tee /var/www/html/index.html*

http://192.168.56.130/

#Create a Simple Website

echo '<?php echo "Hello World!"; ?>' | sudo tee /var/www/html/index.php

sudo rm /var/www/html/index.html

http://192.168.56.130/

3. **Created a MySQL database and user**

"Log in to MySQL and create a database and user:"


sudo mysql -u root -p

"Inside the MySQL prompt:"

CREATE DATABASE web_db;

CREATE USER 'web_user'@'localhost' IDENTIFIED BY 'Heba2020';


GRANT ALL PRIVILEGES ON web_db.* TO 'web_user'@'localhost';

FLUSH PRIVILEGES;

EXIT;

# Modify the Website to Use the Database
sudo nano /var/www/html/index.php

"Create a PHP script to connect to the database, display the visitor’s IP address, and fetch the current time."

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
"Visit the site again"
http://192.168.56.130/

4.**Pushed the project to GitHub**

cd /var/www/html/


git init

touch .gitignore

nano .gitignore


touch README.md


nano README.md

git add .gitignore README.md

git commit -m "Add .gitignore and README.md with project description"


git branch -M main

git remote add origin https://github.com/Heba-Gamal20/web-server-setup.git

git push -u origin main

/////////////////////////////////////////////////////////////////////////////////////////////


# Networking Basics :
....

# IP Address:

What is an IP Address?

An IP (Internet Protocol) address is a unique identifier assigned to devices on a network. It serves two main purposes:


1-Identification: Identifies a specific device on the network.

2-Location: Provides the location of a device, enabling data exchange within the network.

______________________________________________

Dynamic vs. Static IP Addresses

+Dynamic IP Addresses:
Frequently change and are assigned by ISPs.

**Benefits:

1-Cost-effective.

2-Automatic and maintenance-free.

3-Efficient for users and ISPs.

+Static IP Addresses
Remain constant over time.

**Benefits:

1-More stable, preventing connection lapses.

2-Suitable for hosting servers and remote access.

3-Easier to assign, track, and manage network traffic.

4-Ideal for ensuring accessibility across different systems.

_______________________________________________

Why Unique IP Addresses Matter

1-For Websites:
Shared hosting uses one IP for multiple sites, leading to potential issues if one site is blacklisted.
Dedicated hosting provides a unique IP, ensuring better security and reliability.

2-For Hosting Servers:
Unique IPs enhance access, stability, and prevent interference from other users.
Choosing the right IP type and hosting service impacts reliability, security, and accessibility.


______________________________________________________________________________________________


# MAC Address: What it is, its purpose, and how it differs from an IP address. 

MAC Address (Media Access Control)
Definition: A unique, permanent physical address assigned to the Network Interface Card (NIC) of a device.

**Key Characteristics:

1-Physical Address: Identifies the hardware of the device.

2-Permanent: Cannot be changed, tied to the device's NIC.

3-Local Usage: Used for communication within a Local Area Network (LAN).

4-Layer 2 (Data Link Layer): Operates on the OSI model's second layer.

5-Structure: 48-bit hexadecimal number split into OUI (manufacturer) and serial number.

Example Usage:
MAC addresses route data from an access point to the intended device within a LAN.

_________________________________________________________________________________________________

IP Address (Internet Protocol)
Definition: A software-assigned address used to identify devices on different networks.

**Key Characteristics:

1-Logical Address: Not tied to hardware, assigned at the software level.

2-Temporary: Can change, especially dynamic IPs from ISPs.

3-Global Usage: Facilitates communication between devices across different networks.

4-Layer 3 (Network Layer): Operates on the OSI model's third layer.

5-Structure: IPv4 (32-bit decimal) or IPv6 (128-bit hexadecimal).

Example Usage:
IP addresses help devices find each other across networks using routers and the Internet.

_______________________________________________________________________________________________

How They Work Together
Within a LAN, devices use MAC addresses for communication.
To communicate outside the LAN, devices use IP addresses through routers.
Example Scenario:
Device A sends data to Device B in another LAN.
Device A's router sends the data to Device B's router using IP addresses.
Device B's router identifies Device B using its MAC address and delivers the data.
_____________________________________________________________________________________________

# Switches, Routers, and Routing Protocols: Basic definitions and their roles in a network. 

Switches

A switch is a device that operates primarily at Layer 2 (the Data Link Layer) of the OSI model.
 Its primary role is to connect devices within a Local Area Network (LAN) and facilitate communication between them.
 Switches use MAC addresses to forward data frames to the correct destination within the same network.
 Advanced switches can also support Layer 3 (Network Layer) functionality,
 allowing limited routing between VLANs (Virtual LANs)​


Key Features:

1-Directs traffic within a LAN using MAC addresses.

2-Reduces network congestion by creating a collision-free environment.

3-Supports VLANs to segregate network traffic for improved security and efficiency.


_______________________________________________________________________________________________


Routers
Routers operate at Layer 3 (the Network Layer) of the OSI model and are responsible for directing
data packets between different networks. Unlike switches, routers use IP addresses to determine the
best path for data to travel across interconnected networks, such as the internet. They also provide
functions like Network Address Translation (NAT) and firewall protection

Key Features:

1-Connects multiple networks and routes data between them.

2-Uses routing protocols to determine the optimal path for data transfer.

3-Provides a gateway to the internet for LANs.

**Routing Protocols:
Routing protocols are sets of rules used by routers to dynamically determine the best routes for data packets across a network.
 These protocols enable routers to exchange routing information and update their routing tables
. Examples include:

1-Static Routing: Manually configured routes, best for smaller, predictable networks.

2-Dynamic Routing Protocols: Automatically adjust routes based on network changes, such as:

   1-OSPF (Open Shortest Path First): A link-state protocol that finds the shortest path using Dijkstra's algorithm.
   2-EIGRP (Enhanced Interior Gateway Routing Protocol): A hybrid protocol that combines the features of
   distance-vector and link-state protocols.
   3-BGP (Border Gateway Protocol): Used for routing between autonomous systems on the internet

**Roles:

1-Ensure efficient, dynamic, and secure communication between different networks.

2-Adapt to changes in network topology, such as device failures or increased traffic.


_______________________________________________________________________________________


# Remote Connection to Cloud Instance: Steps you would take to connect to your cloud-based 

Linux instance from a remote machine (e.g., using SSH).


1-Obtain the Server Details:
Retrieve the public IP address or hostname of your cloud instance from your cloud service provider's dashboard.

2-Access the SSH Key:
Use the private SSH key that corresponds to the public key uploaded to the instance during its creation.
Ensure it is saved locally and has appropriate permissions (chmod 600 to restrict access).

3-Install SSH Client:
Ensure an SSH client is installed on your machine. Linux and macOS typically include SSH by default.
 
4-Initiate the SSH Connection:

Use the command:

**ssh -i /path/to/private-key username@server-ip**

5-Verify SSH Configuration:

If using a configuration file (~/.ssh/config), ensure proper entries like:
  Host my-instance
  HostName server-ip
  User username
  IdentityFile /path/to/private-key
Then connect using ssh my-instance.

6-Confirm Security Group Rules:
Ensure the instance’s firewall (security group) allows incoming SSH connections on port 22 from your IP address.

7-Test and Troubleshoot:
If the connection fails, verify your IP is allowed, check the private key’s permissions,
 and confirm the instance is running.
_________________________________________________________________________
