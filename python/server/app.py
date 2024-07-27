import os

os.environ["TF_ENABLE_ONEDNN_OPTS"] = "0"

import numpy as np
from PIL import Image
from flask_cors import CORS
import cv2, requests, io, json
from flask import Flask, request, jsonify
from tensorflow.keras.preprocessing.text import Tokenizer
from tensorflow.keras.preprocessing.sequence import pad_sequences
from sklearn.preprocessing import MultiLabelBinarizer

app = Flask(__name__)
CORS(app)

URL_MODEL_PARU = "https://medical-math-model-paru.onrender.com/v1/models/paru"
URL_MODEL_JANTUNG = "https://medical-math-model-jantung.onrender.com/v1/models"

# Load the tokenizer word index from the JSON file
with open("./tokenizer.json", "r") as f:
    word_index = json.load(f)

# Create a new tokenizer and set the word index
tokenizer = Tokenizer(num_words=20000, oov_token="x")
tokenizer.word_index = word_index

# Load the classes from JSON files and reconstruct the MultiLabelBinarizer instances
mlbs_loaded = {}

for key in ["DU", "DS", "OB"]:
    with open(f"labels/classes_{key}.json", "r") as f:
        classes = json.load(f)

    # Create a new MultiLabelBinarizer and fit it with the loaded classes
    mlb = MultiLabelBinarizer()
    mlb.fit([classes])
    mlbs_loaded[key] = mlb


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


@app.route("/predict_paru", methods=["POST"])
def predict_paru():
    if "image" not in request.files:
        return jsonify({"error": "No image file in request"}), 400

    image_file = request.files["image"]
    if image_file.filename == "":
        return jsonify({"error": "No selected file"}), 400

    return predict_handle(image_file)


def paragraph_id(data):
    gender = "Laki-laki" if data["gender"] == "L" else "Perempuan"

    def get_value(key, unit):
        try:
            return f"{float(data[key])} {unit}"
        except (KeyError, ValueError):
            return "-"

    kalium = get_value("kalium", "mmol/L")
    natrium = get_value("natrium", "mmol/L")
    kreatinin = get_value("kreatinin", "mg/dL")
    pemeriksaan = lambda key: (
        f"Pemeriksaan {key}: {', '.join(data[key])}." if key in data else ""
    )
    HR = f"-" if data["hr"] == "-" else f"{int(data['hr'])} bpm"
    LVEF = f"-" if data["lvef"] == "-" else f"{float(data['lvef'])}%"
    paragraf = [
        f"Seorang pasien {gender} berusia {int(data['usia'])} tahun dengan berat badan {int(data['bb'])} kg dan tinggi badan {int(data['tb'])} cm.",
        (
            f"Pasien memiliki keluhan: {data['keluhan']}."
            if data["keluhan"] != "Tidak ada keluhan"
            else "Pasien tidak memiliki keluhan."
        ),
        f"Hasil pemeriksaan menunjukkan LVEF sebesar {LVEF}.",
        pemeriksaan("cor"),
        pemeriksaan("pulmo"),
        pemeriksaan("abdomen"),
        pemeriksaan("ext"),
        pemeriksaan("tambahan") if data.get("tambahan", ["-"])[0] != "-" else "",
        f"Tekanan darah (TD) pasien adalah {data['td']} mmHg dengan denyut jantung (HR) {HR}.",
        f"Kadar Kalium {kalium}, Natrium {natrium}, dan Kreatinin {kreatinin}.",
    ]
    return " ".join(filter(None, paragraf))


def url_and_threshold(key):
    return {
        "DU": (
            URL_MODEL_JANTUNG + "/du:predict",
            0.2,
        ),
        "DS": (
            URL_MODEL_JANTUNG + "/ds:predict",
            0.1,
        ),
        "OB": (
            URL_MODEL_JANTUNG + "/ob:predict",
            0.2,
        ),
    }.get(key)


def predict_text(texts, key, tokenizer, max_len=128):
    # Tokenisasi dan padding teks
    sequences = tokenizer.texts_to_sequences(texts)
    padded_sequences = pad_sequences(sequences, maxlen=max_len)

    url, threshold = url_and_threshold(key)
    response = requests.post(url, json={"instances": padded_sequences.tolist()})
    response.raise_for_status()

    probabilities = response.json()["predictions"][0]
    return ((np.array(probabilities) > threshold).astype(int)).tolist(), probabilities


def transform_label(mlbs, key, label):
    return list(mlbs[key].inverse_transform(np.array([label]))[0])


@app.route("/predict_jantung", methods=["POST"])
def predict_jantung():
    data = request.get_json()

    data_paragraph = paragraph_id(data)
    keys = ["DU", "DS", "OB"]

    data_resp = {}
    for key in keys:
        pred, prob = predict_text(data_paragraph, key, tokenizer)
        label = transform_label(mlbs_loaded, key, pred)
        data_resp[key] = {"prob":prob, "pred": pred, "label": label}

    return jsonify(data_resp), 200


@app.route("/", methods=["GET"])
def home():
    return jsonify({"status": "server runing at /predict_\{}"}), 200


if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5000, debug=True)
