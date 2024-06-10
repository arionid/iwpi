#!/bin/sh
set -e

# Start supervisord
exec supervisord -c /etc/supervisord.conf
