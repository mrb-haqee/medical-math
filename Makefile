# # Variabel untuk nama image dan tag
# IMAGE_NAME = mrbhaqee/testdocker
# IMAGE_TAG = latest
# URL_HOOK_RENDER = "https://api.render.com/deploy/srv-cqebc6hu0jms739836tg?key=Knyr5MXjeQg"

# build:
# 	docker build -t $(IMAGE_NAME):$(IMAGE_TAG) .

# run:
# 	docker run -d -p 8000:8000 $(IMAGE_NAME):$(IMAGE_TAG)

# push: 
# 	docker push $(IMAGE_NAME):$(IMAGE_TAG)

# fetch:
# 	curl -X GET $(URL_HOOK_RENDER)

# php:
# 	php -S 127.0.0.1:8000 -t ./app

# docker-br: build run
# docker: build push fetch




REGISTRY_USERNAME := mrbhaqee
IMAGE_PYTHON := medical-math-py
IMAGE_PHP := medical-math-php
IMAGE_ML := medical-math-models

# Docker build command
docker-py:
		docker build -t $(REGISTRY_USERNAME)/$(IMAGE_PYTHON) ./python/server/
		docker push $(REGISTRY_USERNAME)/$(IMAGE_PYTHON)
		curl -X GET https://api.render.com/deploy/srv-cqedhvhu0jms7399e80g?key=DK1Eb5MGums
# docker run -p 5000:5000 mrbhaqee/server-py

docker-ml:
		docker build -t $(REGISTRY_USERNAME)/$(IMAGE_ML) ./python/model/
		docker push $(REGISTRY_USERNAME)/$(IMAGE_ML)
		curl -X GET https://api.render.com/deploy/srv-cqedlc8gph6c73amod7g?key=0j7SbTpUXJs

docker-php:
		docker build -t $(REGISTRY_USERNAME)/$(IMAGE_PHP) .
		docker push $(REGISTRY_USERNAME)/$(IMAGE_PHP)
		curl -X GET https://api.render.com/deploy/srv-cqedebo8fa8c73e4lt1g?key=Ukr_tQChvF0

py-run:
		python C:\Users\Lenovo\Desktop\devops\python\server\app.py

php-run:
		php -S 127.0.0.1:8000 -t ./app/

.PHONY: build push build-and-push


# URL_HOOK_RENDER = "https://api.render.com/deploy/srv-cqedebo8fa8c73e4lt1g?key=Ukr_tQChvF0"
# fetch:
# 	curl -X GET $(URL_HOOK_RENDER)