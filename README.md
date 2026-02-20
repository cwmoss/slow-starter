# slowfoot dev

update site

    docker compose exec web composer -d site/ update

adding composer packages to project

    docker compose exec web composer -d site/ require guzzle/httpd

    # visit localhost:9901 => built site
    # visit localhost:9902/studio/ => cms

start dev server

    docker compose exec web site/vendor/bin/slowfoot dev -d /app/site
    # visit localhost:9903

build via cli

    docker compose exec web site/vendor/bin/slowfoot build -d /app/site

build via webhook

    curl -vv http://localhost:9901/__webdeploy/ -H 'x-slft-deploy: 1234'

roadmap

    - OK new: 1 schema per website/bookings
    - OK auth
    - ui fixes for slug, refs, md text...
    - ui, list of uploads
    - OK link type
    - OK deploy button
    - OK structure editor
    - backend: why slow w/ franken? check run from cli. remove frameworkx? add php-di
    - website: start template w/ navigation and images 

create user

    curl -vv http://localhost:9902/auth/register -H 'x-slowhand-admin-secret: 123456' -H 'Content-type: application/json' --data '{"email":"rw@20sec.net","password":"xyz123456","name":"rw", "password_confirmation":"xyz123456"}'

    curl -vv http://localhost:9902/auth/login -H 'Content-type: application/json' --data '{"email":"rw@20sec.net","password":"xyz123456"}'

# slowhand dev

    git clone https://github.com/cwmoss/pickel
    git clone git@git.20sec.de:/opt/git/slowhand.git
    docker compose exec web composer -d slowhand/backend install
    docker compose exec web slowhand/backend/bin/slowhand setup


# all dev

    git pull
    cd pickel; git pull; cd ..;
    cd slowhand; git pull; cd ..;