# dev

adding composer packages to project

    docker compose exec web composer -d site require guzzle/httpd

start dev server

    docker compose exec web site/vendor/bin/slowfoot dev -d /app/site
    # visit localhost:9903
    