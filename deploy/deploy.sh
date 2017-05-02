#!/bin/bash

lftp -u login,pwd ftpServer << EOF

cd www/pungeot/MailsToSchool
ls -l
echo "Copie"
mirror -R --delete --exclude deploy/ --exclude .git/ /var/www/email-school/ .
echo "Terminé"

bye
EOF
