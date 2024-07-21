FROM tensorflow/serving

# Set environment variables
ENV MODEL_NAME=model_paru
ENV MODEL_BASE_PATH=/models

# Copy the model to the container
COPY /models_paru /models/${MODEL_NAME}

# Expose ports for gRPC and REST API
EXPOSE 8500
EXPOSE 8501

RUN echo '#!/bin/bash \n\n\
tensorflow_model_server --port=8500 --rest_api_port=8501 \
--model_name=${MODEL_NAME} --model_base_path=${MODEL_BASE_PATH}/${MODEL_NAME} \
"$@"' > /usr/bin/tf_serving_entrypoint.sh \
&& chmod +x /usr/bin/tf_serving_entrypoint.sh

ENTRYPOINT ["/usr/bin/tf_serving_entrypoint.sh"]