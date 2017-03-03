#!/bin/bash
mysqldump -u root -p famsys > sql/famsys.sql
rm famsys*.tgz
FILE=famsys-`date +%Y%m%d`.tgz 
tar cfz $FILE *

