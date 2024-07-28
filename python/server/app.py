import os

os.environ["TF_ENABLE_ONEDNN_OPTS"] = "0"

from flask_cors import CORS
import json
from flask import Flask, request, jsonify
from tensorflow.keras.preprocessing.text import Tokenizer
from sklearn.preprocessing import MultiLabelBinarizer

from lib.paru import *
from lib.jantung import *

app = Flask(__name__)
CORS(app)

URL_MODEL_PARU = "https://medical-math-model-paru.onrender.com/v1/models/paru"
URL_MODEL_JANTUNG = "https://medical-math-model-jantung.onrender.com/v1/models"

# =========================== PARU ===========================


@app.route("/predict_paru", methods=["POST"])
def predict_paru():
    if "image" not in request.files:
        return jsonify({"error": "No image file in request"}), 400

    image_file = request.files["image"]
    if image_file.filename == "":
        return jsonify({"error": "No selected file"}), 400

    return predict_handle(image_file, URL_MODEL_PARU)


# =========================== JANTUNG ===========================

with open("./tokenizer.json", "r") as f:
    word_index = json.load(f)

tokenizer = Tokenizer(
    num_words=20000, oov_token="x", filters='!"#$%&*.,:;<=>?@[\\]^_`{|}~\t\n'
)
tokenizer.word_index = word_index

mlbs_loaded = {}

for key in ["DU", "DS", "OB"]:
    with open(f"labels/classes_{key}.json", "r") as f:
        classes = json.load(f)

    # Create a new MultiLabelBinarizer and fit it with the loaded classes
    mlb = MultiLabelBinarizer()
    mlb.fit([classes])
    mlbs_loaded[key] = mlb


@app.route("/predict_jantung", methods=["POST"])
def predict_jantung():
    data = request.get_json()

    data_paragraph = paragraph_id(data)
    keys = ["DU", "DS", "OB"]

    data_resp = {}
    for key in keys:
        pred, prob = predict_text(data_paragraph, key, tokenizer, URL_MODEL_JANTUNG)
        label = transform_label(mlbs_loaded, key, pred)
        data_resp[key] = {"prob": prob, "pred": pred, "label": label}

    return jsonify(data_resp), 200


@app.route("/", methods=["GET"])
def home():
    return jsonify({"status": "server runing at /predict_\{}"}), 200


if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5000, debug=True)
