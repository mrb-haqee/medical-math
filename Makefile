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
IMAGE_PARU := medical-math-model-paru
IMAGE_JANTUNG := medical-math-model-jantung

# Docker build command
docker-py:
		docker build -t $(REGISTRY_USERNAME)/$(IMAGE_PYTHON) ./python/server/
		docker push $(REGISTRY_USERNAME)/$(IMAGE_PYTHON)
		curl -X GET https://api.render.com/deploy/srv-cqedhvhu0jms7399e80g?key=DK1Eb5MGums
# docker run -p 5000:5000 $(REGISTRY_USERNAME)/$(IMAGE_PYTHON)

docker-paru:
		docker build -t $(REGISTRY_USERNAME)/$(IMAGE_PARU) ./python/models/model_paru
		docker push $(REGISTRY_USERNAME)/$(IMAGE_PARU)
		curl -X GET https://api.render.com/deploy/srv-cqgc95aju9rs73cbcksg?key=Mmn49fPCz5k

docker-jantung:
		docker build -t $(REGISTRY_USERNAME)/$(IMAGE_JANTUNG) ./python/models/model_jantung
		docker push $(REGISTRY_USERNAME)/$(IMAGE_JANTUNG)
		curl -X GET https://api.render.com/deploy/srv-cqgcch5ds78s73ccecjg?key=1ZCBAAzd3oc

docker-php:
		docker build -t $(REGISTRY_USERNAME)/$(IMAGE_PHP) .
		docker push $(REGISTRY_USERNAME)/$(IMAGE_PHP)
		curl -X GET https://api.render.com/deploy/srv-cqfj21lds78s73bv9iog?key=iF697quK5nU

py-run:
		python ./python/server/app.py

php-run:
		php -S 127.0.0.1:8000 -t ./app/

.PHONY: build push build-and-push


# URL_HOOK_RENDER = "https://api.render.com/deploy/srv-cqedebo8fa8c73e4lt1g?key=Ukr_tQChvF0"
# fetch:
# 	curl -X GET $(URL_HOOK_RENDER)