<?php
// Execute the arp command to get the list of connected devices
$arp_output = shell_exec('arp -a');

echo "<pre>";
print_r($arp_output);

// Parse the output to extract IP addresses with static mappings
$ip_addresses = array();
$lines = explode("\n", $arp_output);
foreach ($lines as $line) {
    $cols = preg_split('/\s+/', trim($line));
    if (count($cols) >= 2 && filter_var($cols[0], FILTER_VALIDATE_IP)) {
        // Assuming that static IP addresses have a MAC address associated with them
        if (isset($cols[1]) && !empty($cols[1])) {
            $ip_addresses[] = $cols[0];
        }
    }
}

$count =0;
// Output the list of static IP addresses
echo "List of devices with static IP addresses:\n";
foreach ($ip_addresses as $ip) {
    if($ip == $_SERVER['REMOTE_ADDR']){
        $count++;
    }
}

if($count>0){
    echo 'I am in Office';
}else{
    echo 'I am in Home';
}
?>
