#!/bin/bash

# Function to check if a command exists
command_exists() {
  command -v "$1" >/dev/null 2>&1
}

# Debugging output
echo "Starting the entrypoint script..."

# Start the PHP-FPM process in the background
php-fpm &

# Debugging output
echo "PHP-FPM started..."

# Wait for PHP-FPM to start
while ! command_exists "php-fpm"; do
  echo "Waiting for PHP-FPM to start..."
  sleep 1
done

# Debugging output
echo "PHP-FPM is running..."

# Keep the container running (you can add other background processes here if needed)
echo "Container is running..."
tail -f /dev/null
