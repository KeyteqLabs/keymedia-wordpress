all:
	composer install && cd ./web && npm install && bower install
clean:
	rm -rf ./vendor/ ./web/node_modules ./web/app/bower_components