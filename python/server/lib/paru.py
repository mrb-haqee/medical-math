import numpy as np
from PIL import Image
import cv2, requests, io
from flask import jsonify


def prepare_image(image):
    image = np.array(image)
    img = cv2.cvtColor(image, cv2.COLOR_RGB2BGR)
    img = cv2.resize(img, (224, 224))
    img = img.astype(np.float32) / 255.0
    img = np.expand_dims(img, axis=0)
    return img.tolist()


def predict_handle(image_file, URL_MODEL_PARU):
    try:
        # Open the image file
        image = Image.open(io.BytesIO(image_file.read())).convert("RGB")
        response = requests.post(
            URL_MODEL_PARU + ":predict", json={"instances": prepare_image(image)}
        )

        if response.status_code != 200:
            return jsonify({"error": "Prediction request failed"}), 500

        predict = response.json()
        class_labels = np.array(
            [
                "Atelectasis",
                "Cardiomegaly",
                "Consolidation",
                "Edema",
                "Effusion",
                "Emphysema",
                "Fibrosis",
                "Hernia",
                "Infiltration",
                "Mass",
                "Nodule",
                "Normal",
                "Pleural_Thickening",
                "Pneumonia",
                "Pneumothorax",
            ]
        )
        predicted_label = class_labels[np.argmax(predict["predictions"])]

        # return class_labels.tolist(), 200
        return (
            jsonify(
                {
                    "class_label": class_labels.tolist(),
                    "prediction": predict["predictions"][0],
                    "predict_label": predicted_label,
                }
            ),
            200,
        )

    except Exception as e:
        return jsonify({"error": str(e)}), 500
