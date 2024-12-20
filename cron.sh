#!/bin/bash

# Dead link checker cron script. Use with a crontab line such as:
# 0 4 * * * /srv/iabot/cron.sh --cron

JOBS=(
	applewiki,2306,Dev
	applewiki,2308,Filesystem
	applewiki,0,main
)

set -e
cd "$(dirname "$0")"

quiet=1
[[ $1 == --cron ]] && quiet=/dev/null

function cleanup {
	printf "\e[31mPlease wait for cleanup…\e[0m\n" >&$quiet
	docker compose restart iabot availability >&$quiet
}

trap cleanup EXIT
sleep 5

for i in "${JOBS[@]}"; do
	IFS=, read -r wiki ns name <<<"$i"
	docker compose exec -T iabot \
		nice php deadlink.php $wiki:$ns $name >&$quiet
done
