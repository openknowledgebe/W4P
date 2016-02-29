#!/bin/bash

# Colors

RCol='\e[0m'    # Text Reset

# Regular           Bold                Underline           High Intensity      BoldHigh Intens     Background          High Intensity Backgrounds
Bla='\e[0;30m';     BBla='\e[1;30m';    UBla='\e[4;30m';    IBla='\e[0;90m';    BIBla='\e[1;90m';   On_Bla='\e[40m';    On_IBla='\e[0;100m';
Red='\e[0;31m';     BRed='\e[1;31m';    URed='\e[4;31m';    IRed='\e[0;91m';    BIRed='\e[1;91m';   On_Red='\e[41m';    On_IRed='\e[0;101m';
Gre='\e[0;32m';     BGre='\e[1;32m';    UGre='\e[4;32m';    IGre='\e[0;92m';    BIGre='\e[1;92m';   On_Gre='\e[42m';    On_IGre='\e[0;102m';
Yel='\e[0;33m';     BYel='\e[1;33m';    UYel='\e[4;33m';    IYel='\e[0;93m';    BIYel='\e[1;93m';   On_Yel='\e[43m';    On_IYel='\e[0;103m';
Blu='\e[0;34m';     BBlu='\e[1;34m';    UBlu='\e[4;34m';    IBlu='\e[0;94m';    BIBlu='\e[1;94m';   On_Blu='\e[44m';    On_IBlu='\e[0;104m';
Pur='\e[0;35m';     BPur='\e[1;35m';    UPur='\e[4;35m';    IPur='\e[0;95m';    BIPur='\e[1;95m';   On_Pur='\e[45m';    On_IPur='\e[0;105m';
Cya='\e[0;36m';     BCya='\e[1;36m';    UCya='\e[4;36m';    ICya='\e[0;96m';    BICya='\e[1;96m';   On_Cya='\e[46m';    On_ICya='\e[0;106m';
Whi='\e[0;37m';     BWhi='\e[1;37m';    UWhi='\e[4;37m';    IWhi='\e[0;97m';    BIWhi='\e[1;97m';   On_Whi='\e[47m';    On_IWhi='\e[0;107m';

# W4P script

echo ""
echo "==========================="
echo "W4P INSTALLER"
echo "==========================="
echo ""

# Checking existing installation

if [ -d "W4P" ]; then
  # Control will enter here if $DIRECTORY exists.
  echo "The directory W4P already exists..."
  read -p "Do you want to remove your current W4P installation?" -n 1 -r
  echo    # (optional) move to a new line
  if [[ $REPLY =~ ^[Yy]$ ]]
  then
      rm -rf "W4P/"
  else
      echo -e "${On_Red}Folder will not be removed. Aborting.${RCol}"
  fi
else
    echo -e "${Gre}Folder does not exist yet. OK.${RCol}"
fi

echo ""
echo -e "${Gre}CHECKING PREREQUISITES...${RCol}"
echo ""

# Checking prerequisites
hash composer 2>/dev/null || { echo -e >&2 "${On_Red}I require composer but it's not installed. Aborting.${RCol}"; exit 1; }
hash git 2>/dev/null || { echo -e >&2 "${On_Red}I require git but it's not installed. Aborting.${RCol}"; exit 1; }
hash npm 2>/dev/null || { echo -e >&2 "${On_Red}I require npm but it's not installed. Aborting.${RCol}"; exit 1; }
hash sqlite 2>/dev/null || { echo -e >&2 "${On_Red}I require sqlite but it's not installed. Aborting.${RCol}"; exit 1; }

echo -e "${Gre}Prerequisites have been checked. OK.${RCol}"

echo ""
echo "CLONING REPOSITORY..."
echo ""

# Clone repository
git clone -b develop "https://github.com/openknowledgebe/W4P.git"

echo -e "${Gre}Cloned. OK.${RCol}"

# cd into W4P directory
cd W4P

echo ""
echo "CREATING DATABASE..."
echo ""

# Create the database
touch database/database.sqlite

echo -e "${Gre}Database created. OK.${RCol}"

echo ""
echo "COPYING ENV FILE"
echo ""

# Copy the environment file
cp .env.example .env

echo -e "${Gre}Environment file copied. OK.${RCol}"

echo ""
echo "SETTING UP COMPOSER..."
echo ""

# Install dependencies
composer install

echo -e "${Gre}Composer dependencies installed. OK.${RCol}"

echo ""
echo "PERFORMING MIGRATIONS.."
echo ""

# Perform migrations
php artisan migrate

echo -e "${Gre}Migrations performed. OK.${RCol}"

# Install repreqs
sudo npm install
# Install gulp globally so it can be run via cli
sudo npm install -g gulp

echo -e "${Gre}Installed node packages. OK.${RCol}"

hash gulp 2>/dev/null || { echo -e >&2 "${On_Red}I require gulp but it's not installed. npm must have failed the installation... Aborting.${RCol}"; exit 1; }

gulp --production

echo -e "${Gre}Gulp script ran. OK.${RCol}"
