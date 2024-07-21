from flask import Flask, request, jsonify
import cv2, requests, io
from flask_cors import CORS
from PIL import Image
import numpy as np

app = Flask(__name__)
CORS(app)


def prepare_image(image):
    image = np.array(image)
    img = cv2.cvtColor(image, cv2.COLOR_RGB2BGR)
    img = cv2.resize(img, (224, 224))
    img = img.astype(np.float32) / 255.0
    img = np.expand_dims(img, axis=0)
    return img.tolist()


def predict_handle(image_file):
    try:
        # Open the image file
        image = Image.open(io.BytesIO(image_file.read())).convert("RGB")
        image_pre = prepare_image(image)
        data = {"instances": image_pre}
        url = "https://medical-math-models.onrender.com/v1/models/model_paru:predict"
        response = requests.post(url, json=data)

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


@app.route("/predict", methods=["POST"])
def predict():
    if "image" not in request.files:
        return jsonify({"error": "No image file in request"}), 400

    image_file = request.files["image"]
    if image_file.filename == "":
        return jsonify({"error": "No selected file"}), 400

    return predict_handle(image_file)


@app.route("/", methods=["GET"])
def home():
    return jsonify({"status": "server runing at /predict"}), 200


if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5000, debug=True)
