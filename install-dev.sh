#!/bin/sh
git clone https://github.com/cwmoss/pickel
git clone git@git.20sec.de:/opt/git/slowhand.git 
cd slowhand/backend
composer install
cd ..
ln -s ../pickel studio

# docker compose exec web slowhand/backend/bin/slowhand setup

# sed s/\\r//g < usedom.csv > u.csv
# mlr --icsv --ifs ';' --ojsonl put '$_id="b.".$id;$_type="booking";$house="usedom";$address2="".$address2;' ../lodge/usedom.csv > bookings.jsonl

# time curl 'http://localhost:9902/data/mutate/push/booking'  -H 'Content-Type: application/json' --data-binary @bookings.jsonl