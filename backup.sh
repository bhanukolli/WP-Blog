#!/bin/bash
NOW=$(date +"%Y-%m-%d-%H%M")
FILE="bhanukolli.com.$NOW.tar"
BACKUP_DIR="/home/bhanukolli/backup"
WWW_DIR="/home/bhanukolli/public_html/blog"

DB_USER="i606234_wp1"
DB_PASS="L])66f1tfO47)*6"
DB_NAME="i606234_wp1"
DB_FILE="bhanukolli.com.$NOW.sql"

WWW_TRANSFORM='s,^home/bhanukolli/public_html/blog,WP-Blog,'
DB_TRANSFORM='s,^home/bhanukolli/backup,database,'


tar -cvf $BACKUP_DIR/$FILE --transform $WWW_TRANSFORM $WWW_DIR --exclude .git --exclude "*.log" --exclude backup
mysqldump -u$DB_USER -p$DB_PASS $DB_NAME > $BACKUP_DIR/$DB_FILE

cp -rfp $BACKUP_DIR/$DB_FILE $WWW_DIR/bhanukolli.com.sql

tar --append --file=$BACKUP_DIR/$FILE --transform $DB_TRANSFORM $BACKUP_DIR/$DB_FILE
rm $BACKUP_DIR/$DB_FILE
gzip -9 $BACKUP_DIR/$FILE

cd /home/bhanukolli/WP-Blog
git add .
git commit -m "WP-Blog Auto Commit"
git push origin master

