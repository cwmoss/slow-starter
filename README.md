# dev

adding composer packages to project

    docker compose exec web composer -d site require guzzle/httpd

    # visit localhost:9901 => built site
    # visit localhost:9902/studio => cms

start dev server

    docker compose exec web site/vendor/bin/slowfoot dev -d /app/site
    # visit localhost:9903

hook build

    curl -vv http://localhost:9901/__webdeploy/ -H 'x-slft-deploy: 1234'