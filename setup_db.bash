#!/usr/bin/env bash
#
# Recreate and reset the database to be as after part I.
#
echo ">>> Creating the database"
mysql -uroot -p < setup.sql > /dev/null

file="ddl.sql"
echo ">>> Create tables ($file)"
mysql -uuser mvc < $file > /dev/null

file="dml.sql"
echo ">>> Insert data ($file)"
mysql -uuser mvc < $file > /dev/null
