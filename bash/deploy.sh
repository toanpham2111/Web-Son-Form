#!/bin/bash
export $(cat .env | sed 's/#.*//g' | xargs)

echo -e "\033[32mStart Deployment ...\033[0m";
npm run release

echo -e "\033[32mPassword: Ask Toan\033[0m";
rsync -a --delete --progress --rsh='ssh -p22' dist/wp-content/themes/creative-design-lab/ lab84cddemo@server.ithelpdesksaigon.com:/home/lab84cddemo/public_html/wp-content/themes/creative-design-lab