<?php
/**
 * Created by PhpStorm.
 * User: demetrio
 * Date: 18/01/16
 * Time: 21:43
 */

namespace Dem3trio\NetUtilsBundle\Service;


class NetUtils
{
    const MAGIC_PACKET_SENT_OK      = 1;
    const MAGIC_PACKET_SENT_FAIL    = 0;

    const PING_ALIVE                = 1;
    const PING_DEAD                 = 0;

    public function wakeUp($mac, $broadcast, $port = 7)
    {
        $mac_array = explode(':', $mac);

        $hwaddr = '';

        foreach($mac_array AS $octet) {
            $hwaddr .= chr(hexdec($octet));
        }

        // Create Magic Packet

        $packet = str_repeat(chr(255), 6).str_repeat($hwaddr, 16);

        $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
        if ($sock) {
            $options = socket_set_option($sock, 1, 6, true);

            if ($options >=0) {
                $e = socket_sendto($sock, $packet, strlen($packet), 0, $broadcast, $port);
                socket_close($sock);
                return self::MAGIC_PACKET_SENT_OK;
            }
        }
        return self::MAGIC_PACKET_SENT_FAIL;
    }

    function ping ($host, $timeout = 1) {
        $latency = self::PING_DEAD;
        $ttl = escapeshellcmd(1);
        $host = escapeshellcmd($host);
        // Exec string for Windows-based systems.
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            // -n = number of pings; -i = ttl.
            $exec_string = 'ping -n 1 -i ' . $ttl . ' ' . $host;
        }
        // Exec string for UNIX-based systems (Mac, Linux).
        else {
            // -n = numeric output; -c = number of pings; -t = ttl.
            $exec_string = 'ping -n -c 1 -t ' . $ttl . ' ' . $host;
        }
        exec($exec_string, $output, $return);
        // Strip empty lines and reorder the indexes from 0 (to make results more
        // uniform across OS versions).
        $output = array_values(array_filter($output));
        // If the result line in the output is not empty, parse it.
        if (!empty($output[1])) {
            // Search for a 'time' value in the result line.
            $response = preg_match("/time(?:=|<)(?<time>[\.0-9]+)(?:|\s)ms/", $output[1], $matches);
            // If there's a result and it's greater than 0, return the latency.
            if ($response > 0 && isset($matches['time'])) {
                $latency = self::PING_ALIVE;
            }
        }
        return $latency;
    }

    private function calculateChecksum($data) {
        if (strlen($data) % 2) {
            $data .= "\x00";
        }
        $bit = unpack('n*', $data);
        $sum = array_sum($bit);
        while ($sum >> 16) {
            $sum = ($sum >> 16) + ($sum & 0xffff);
        }
        return pack('n*', ~$sum);
    }
}
