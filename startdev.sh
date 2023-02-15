#!/bin/bash


if [ "$1" = "selfupdate" ]; then
   git archive --format=tar --remote=ssh://git@bitbucket.org/ohmy_dev/cookiecutter-wordpress.git master \{\{cookiecutter.project_slug\}\}/startdev.sh | tar xv --strip 1
   echo "Done."
   exit 0
fi


# Fix permissions on docker/profiling folder
touch docker/profiling/.test &> /dev/null
if [ "$?" != "0" ]; then
	echo ""
	echo "Fixing permissions on $(pwd)/docker/profiling..."
	docker run --rm -v $(pwd)/docker/profiling:/profiling busybox chown -R 1000:1000 /profiling
fi

# Pull latest base image
echo ""
echo "Pulling latest base image..."
docker pull $(grep FROM Dockerfile.dev | head -1 | sed -E 's/.*FROM[ ]+//')


RUNNING_CONTAINERS=$(docker ps -q)
if [ "$RUNNING_CONTAINERS" != "" ]; then
	echo ""
	echo "You have some running containers already:"
	docker ps

	echo ""
	read -p "Want to kill them? [n]:" killothers

	if [ "$killothers" = "y" ] || [ "$killothers" = "Y" ]; then
		echo ""
		echo "Killing already running containers..."
		docker stop $(docker ps -q)
	fi
fi

echo ""
echo "Starting containers..."

if [[ "$OSTYPE" == "darwin"* ]]; then
  # Mac OS X
  if [ -e "docker-compose.local.yml" ]; then
    echo "Info: Mac OS X detected, activating volume mount caching. Also using overrides from docker-compose.local.yml."
    sed "s/\"\.\/:\/app\"/\".\/:\/app:cached\"/g" docker-compose.yml | docker-compose -f - -f docker-compose.local.yml up --build
  else
    echo "Info: Mac OS X detected, activating volume mount caching."
    sed "s/\"\.\/:\/app\"/\".\/:\/app:cached\"/g" docker-compose.yml | docker-compose -f - up --build
  fi
else
  if [ -e "docker-compose.local.yml" ]; then
    echo "Info: Using overrides from docker-compose.local.yml."
    docker-compose -f docker-compose.yml -f docker-compose.local.yml up --build
  else
    echo "Info: No docker-compose.local.yml is present."
    docker-compose -f docker-compose.yml up --build
  fi
fi
