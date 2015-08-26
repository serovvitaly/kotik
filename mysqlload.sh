#!/bin/bash
mysql -u root -p1234 -e 'drop database kotik;' 
mysql -u root -p1234 < /var/www/kotik/database/kotik.sql
