#!/bin/bash
mysqldump -u root -p1234 --databases kotik > /var/www/kotik/database/kotik.sql
