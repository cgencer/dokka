#!/usr/bin/env bash
mariadb -u root -p -D default_db < /home/restore/8.bodrum-1-with-modules.sql
