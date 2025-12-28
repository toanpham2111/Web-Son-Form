#!/bin/bash

export $(cat .env | sed 's/#.*//g' | xargs)

sshpass -p $password ssh $username@$host -p 4975 -o StrictHostKeyChecking=no "cd $remotePath; git add --all; git commit -am 'Commit'; git push origin master"

cd ${wwwDir}/${projectname}

git reset --hard
git clean -df
git pull origin master

echo "Download database..."

sshpass -p $password ssh $username@$host -p 4975 -o StrictHostKeyChecking=no "mysqldump -u$username -p'$password' --default-character-set=utf8 --no-tablespaces sofacompany | gzip -9" > db.sql.gz

gzip -d db.sql.gz

echo "Restoring database..."
docker exec -i mysql mysql -uroot -proot -e "DROP DATABASE ${projectname}"
docker exec -i mysql mysql -uroot -proot -e "CREATE DATABASE ${projectname}"
docker exec -i mysql mysql -uroot -proot -e "CREATE USER '${projectname}'@'%' IDENTIFIED BY '${projectname}'"
docker exec -i mysql mysql -uroot -proot -e "GRANT ALL PRIVILEGES ON ${projectname}.* TO '${projectname}'@'%'"
docker exec -i mysql mysql -uroot -proot --default-character-set=utf8 ${projectname} < ${wwwDir}/${projectname}/db.sql

docker exec -i mysql mysql -uroot -proot -e "use ${projectname}; UPDATE wp_options SET option_value = 'http://${projectname}.local' WHERE option_id = 1";
docker exec -i mysql mysql -uroot -proot -e "use ${projectname}; UPDATE wp_options SET option_value = 'http://${projectname}.local' WHERE option_id = 2";

rm db.sql

echo "Restore Images"
rsync -rav --rsh="sshpass -p '$password' ssh -p $port -o StrictHostKeyChecking=no" $username@$host:$remotePath/wp-content/uploads ${wwwDir}/${projectname}/wp-content

echo "Done."


