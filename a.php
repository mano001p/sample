<?php
// CIDR notation
$cidr = "192.168.1.0/24";


$external_ip = file_get_contents('https://api.ipify.org');
echo "Your external IP address is: $external_ip";



// Parse CIDR
list($ip, $subnet_mask) = explode('/', $cidr);

// Calculate network address
$network_address = long2ip(ip2long($ip) & ~((1 << (32 - $subnet_mask)) - 1));

// Calculate broadcast address
$broadcast_address = long2ip(ip2long($network_address) | ((1 << (32 - $subnet_mask)) - 1));

echo "IP range start: $network_address\n";
echo "IP range end: $broadcast_address\n";
?>
