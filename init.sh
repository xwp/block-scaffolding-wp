#!/bin/bash
# Usage: ./block-scaffolding/init.sh

# Check for valid plugin name.
function valid_name () {
	valid="^[A-Z][A-Za-z0-9]*( [A-Z][A-Za-z0-9]*)*$"

	if [[ ! "$1" =~ $valid ]]; then
		return 1
	fi

	return 0
}

echo
echo "Hello, "$USER"."
echo
echo "This script will automatically generate a new plugin based on the scaffolding."
echo "The way it works is you enter a plugin name like 'Hello World' and the script "
echo "will create a directory 'hello-world' in the current working directory, while "
echo "performing substitutions on the 'block-scaffolding' scaffolding plugin."
echo

echo -n "Enter your plugin name and press [ENTER]: "
read name

# Validate plugin name.
if ! valid_name "$name"; then
	echo "Malformed name '$name'. Please use title case words separated by spaces. No hyphens. For example, 'Hello World'."
	echo
	echo -n "Enter a valid plugin name and press [ENTER]: "
	read name

	if ! valid_name "$name"; then
		echo
		echo "The name you entered is invalid, rage quitting."
		exit 1
	fi
fi

slug="$( echo "$name" | tr '[:upper:]' '[:lower:]' | sed 's/ /-/g' )"
namespace="$( echo "$name" | sed 's/ //g' )"
repo="$slug"

echo -n "Enter your GitHub organization name. This will be used as the namespace prefix as-is and converted to lowercase for use in the repository path (i.e. XWP -> xwp), and press [ENTER]: "
read org

org_lower="$( echo "$org" | tr '[:upper:]' '[:lower:]' )"

echo -n "Do you want to prepend 'wp-' to your repository name? [Y/N]: "
read prepend

if [[ "$prepend" != Y ]] && [[ "$prepend" != y ]]; then
	echo -n "Do you want to append '-wp' to your repository name? [Y/N]: "
    read append

	if [[ "$append" == Y ]] || [[ "$append" == y ]]; then
		repo="${slug}-wp"
	fi
else
	repo="wp-${slug}"
fi

echo -n "Do you want to push the plugin to your GitHub repository? [Y/N]: "
read push

echo

cwd="$(pwd)"
cd "$(dirname "$0")"
src_repo_path="$(pwd)"
cd "$cwd"

if [[ -e $( basename "$0" ) ]]; then
	echo "Moving up one directory outside of 'block-scaffolding-wp'"
	cd ..
fi

if [[ -e "$slug" ]]; then
	echo "The $slug directory already exists"
	exit 1
fi

echo

git clone "$src_repo_path" "$repo"

cd "$repo"

git mv block-scaffolding.php "$slug.php"

git grep -lz "xwp" | xargs -0 sed -i '' -e "s/xwp/$org_lower/g"
git grep -lz "block-scaffolding-wp" | xargs -0 sed -i '' -e "s/block-scaffolding-wp/$repo/g"

git grep -lz "XWP" | xargs -0 sed -i '' -e "s/XWP/$org/g"
git grep -lz "Block Scaffolding" | xargs -0 sed -i '' -e "s/Block Scaffolding/$name/g"
git grep -lz "BlockScaffolding" | xargs -0 sed -i '' -e "s/BlockScaffolding/$namespace/g"
git grep -lz "block-scaffolding" | xargs -0 sed -i '' -e "s/block-scaffolding/$slug/g"

# Clean slate.
rm -rf .git
rm -rf node_modules
rm -rf vendor
rm -f init.sh
rm -f composer.lock
rm -f package-lock.json

# Install dependencies.
#npm install

# Setup Git.
git init
git add .
git commit -m "Initial commit"
git remote add origin "git@github.com:$org_lower/$repo.git"

if [[ "$push" == Y ]] || [[ "$push" == y ]]; then
    git push -u origin master
else
    echo
    echo "Push changes to GitHub with the following command:"
    echo "cd $(pwd) && git push -u origin master"
fi

echo
echo "Plugin is located at:"
pwd
