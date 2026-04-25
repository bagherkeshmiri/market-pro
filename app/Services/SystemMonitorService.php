<?php

namespace App\Services;

class SystemMonitorService
{
    /**
     * Get memory usage in MB.
     *
     * @return float
     */
    public function getMemoryUsage(): float
    {
        // Returns in KB, convert to MB
        return round(memory_get_usage(true) / 1024 / 1024, 2);
    }

    /**
     * Get disk usage for the root directory in MB.
     * Designed for Linux/Unix-like systems.
     *
     * @return array ['total' => float, 'used' => float, 'free' => float, 'percentage' => float]
     */
    public function getDiskUsage(): array
    {
        // Use df -P to ensure consistent output format across systems
        // 'P' option uses POSIX standard output format
        // We are checking the root directory '/'
        $disk_total = 0;
        $disk_used = 0;
        $disk_free = 0;
        $disk_percentage = 0;

        // Check if running on a Unix-like system before executing shell command
        if (PHP_OS_FAMILY === 'Linux' || PHP_OS_FAMILY === 'Darwin') {
            $disk_info = shell_exec('df -P /');
            if (!empty($disk_info)) {
                $disk_lines = explode("\n", $disk_info);
                // Skip the header line
                if (count($disk_lines) > 1) {
                    $disk_data = preg_split('/\s+/', $disk_lines[1]); // Split by whitespace

                    if (isset($disk_data[1]) && isset($disk_data[2]) && isset($disk_data[3]) && isset($disk_data[4])) {
                        // 1K-blocks, Used, Available, Use%
                        $total_blocks = (int) $disk_data[1];
                        $used_blocks = (int) $disk_data[2];
                        $free_blocks = (int) $disk_data[3];

                        // Convert KB to MB
                        $disk_total = round($total_blocks / 1024, 2);
                        $disk_used = round($used_blocks / 1024, 2);
                        $disk_free = round($disk_free / 1024, 2);
                        $disk_percentage = (int) trim($disk_data[4], '%');
                    }
                }
            }
        } else {
            // Placeholder for Windows or other OS - adjust if needed
            // For Windows, you might use PowerShell commands or WMI
            // Example placeholder values:
            $disk_total = 100000; // Example total in MB
            $disk_used = 50000;   // Example used in MB
            $disk_free = 50000;   // Example free in MB
            $disk_percentage = 50; // Example percentage
        }

        return [
            'total' => $disk_total,
            'used' => $disk_used,
            'free' => $disk_free,
            'percentage' => $disk_percentage,
        ];
    }

    /**
     * Get CPU usage percentage.
     * Designed for Linux/Unix-like systems using 'top'.
     *
     * @return float
     */
    public function getCpuUsage(): float
    {
        $cpu_percentage = 0.0;

        // Check if running on a Unix-like system before executing shell command
        if (PHP_OS_FAMILY === 'Linux' || PHP_OS_FAMILY === 'Darwin') {
            // Execute 'top -bn1' to get a single snapshot of system stats
            // Then grep for the line containing CPU usage
            // 'top -bn1' runs top in batch mode, non-interactively, once (-n1)
            // 'grep "Cpu(s)"' filters for the CPU line
            // 'awk' can be used for more precise parsing, but preg_match is also an option
            // Example output of 'top -bn1 | grep "Cpu(s)"':
            // %Cpu(s):  1.5 us,  0.5 sy,  0.0 ni, 97.9 id,  0.1 wa,  0.0 hi,  0.0 si,  0.0 st
            // We want the 'id' (idle) percentage and calculate used from it.
            $top_output = shell_exec('top -bn1 | grep "Cpu(s)"');

            if (!empty($top_output)) {
                // Use regex to find the idle percentage
                if (preg_match('/(\d+\.\d+)\s+id/', $top_output, $matches)) {
                    $idle_percentage = (float) $matches[1];
                    // CPU Usage = 100 - Idle Percentage
                    $cpu_percentage = round(100.0 - $idle_percentage, 2);
                } else {
                    // Fallback or error handling if regex fails
                    // For example, try parsing differently or return a default/error value
                }
            }
        } else {
            // Placeholder for Windows or other OS
            // On Windows, you might use Performance Monitor counters or other methods.
            // Example placeholder value:
            $cpu_percentage = 10.5; // Example CPU usage percentage
        }

        // Warning about performance impact of frequent shell_exec calls for CPU usage
        // In a high-traffic production environment, consider alternative methods if this becomes a bottleneck.

        return $cpu_percentage;
    }

    /**
     * Fetches all system monitor data.
     *
     * @return array
     */
    public function getAllData(): array
    {
        return [
            'memory' => $this->getMemoryUsage(),
            'disk' => $this->getDiskUsage(),
            'cpu' => $this->getCpuUsage(),
        ];
    }
}
