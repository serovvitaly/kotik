#!/bin/bash
mysql -u root -p123456 -e 'drop database kotik;'
mysql -u root -p123456 < /var/www/dev.smag24.ru/database/kotik.sql
