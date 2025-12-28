#!/bin/bash

export $(cat .env | sed 's/#.*//g' | xargs)

sshpass -p $password ssh $username@$host -p 4975 -o StrictHostKeyChecking=no "cd $remotePath; git add --all; git commit -am 'Commit'; git push origin master"

echo "Remove local site"

rm -rf ${wwwDir}/${projectname}

git clone git@gitlab.NoName.dk:customer-sites/sofacompany-professional-wp.git ${wwwDir}/${projectname}

echo "Download database..."

sshpass -p $password ssh $username@$host -p 4975 -o StrictHostKeyChecking=no "mysqldump -u $username -p'$password' --default-character-set=utf8 --no-tablespaces sofacompany | gzip -9" > db.sql.gz

gzip -d db.sql.gz

echo "Restoring database..."

docker exec -i mysql mysql -uroot -proot -e "DROP DATABASE ${projectname}"
docker exec -i mysql mysql -uroot -proot -e "CREATE DATABASE ${projectname}"
docker exec -i mysql mysql -uroot -proot -e "CREATE USER '${projectname}'@'%' IDENTIFIED BY '${projectname}'"
docker exec -i mysql mysql -uroot -proot -e "GRANT ALL PRIVILEGES ON ${projectname}.* TO '${projectname}'@'%'"
docker exec -i mysql mysql -uroot -proot --default-character-set=utf8 ${projectname} < db.sql

docker exec -i mysql mysql -uroot -proot -e "use ${projectname}; UPDATE wp_options SET option_value = 'http://${projectname}.local' WHERE option_id = 1";
docker exec -i mysql mysql -uroot -proot -e "use ${projectname}; UPDATE wp_options SET option_value = 'http://${projectname}.local' WHERE option_id = 2";

rm db.sql

echo "Create config file"
cp ${wwwDir}/${projectname}/wp-config-sample.php ${wwwDir}/${projectname}/wp-config.php

echo "Restore Images"
sudo apt-get install nodejs composer sshpass
rsync -rav --rsh="sshpass -p '$password' ssh -p $port -o StrictHostKeyChecking=no" $username@$host:$remotePath/wp-content/uploads ${wwwDir}/${projectname}/wp-content/

# insert/update hosts entry
ip_address="127.0.0.1"
host_name="${projectname}.local"

# find existing instances in the host file and save the line numbers
matches_in_hosts="$(grep -n $host_name /etc/hosts | cut -f1 -d:)"
host_entry="${ip_address} ${host_name}"

if [ ! -z "$matches_in_hosts" ]
then
    echo "Updating existing hosts entry."
    # iterate over the line numbers on which matches were found
    while read -r line_number; do
        # replace the text of each line with the desired host entry
        sudo sed -i '' "${line_number}s/.*/${host_entry} /" /etc/hosts
    done <<< "$matches_in_hosts"
else
    echo "Adding new hosts entry."
    echo "$host_entry" | sudo tee -a /etc/hosts > /dev/null
fi

# Composer
composer install

# Webpack
npm install
npm run watch

echo "Done."





