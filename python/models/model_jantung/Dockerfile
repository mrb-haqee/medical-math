FROM tensorflow/serving:latest

RUN mkdir -p /models

COPY . /models
EXPOSE 8501

ENTRYPOINT ["/usr/bin/tensorflow_model_server","--port=8500", "--rest_api_port=8501", "--model_config_file=/models/models.config"]
