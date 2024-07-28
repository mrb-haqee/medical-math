import numpy as np
import requests
from tensorflow.keras.preprocessing.sequence import pad_sequences


def akt(angka):
    angka_dict = {
        0: "nol",
        1: "satu",
        2: "dua",
        3: "tiga",
        4: "empat",
        5: "lima",
        6: "enam",
        7: "tujuh",
        8: "delapan",
        9: "sembilan",
        10: "sepuluh",
        11: "sebelas",
        12: "dua belas",
        13: "tiga belas",
        14: "empat belas",
        15: "lima belas",
        16: "enam belas",
        17: "tujuh belas",
        18: "delapan belas",
        19: "sembilan belas",
        20: "dua puluh",
        30: "tiga puluh",
        40: "empat puluh",
        50: "lima puluh",
        60: "enam puluh",
        70: "tujuh puluh",
        80: "delapan puluh",
        90: "sembilan puluh",
        100: "seratus",
        200: "dua ratus",
        300: "tiga ratus",
        400: "empat ratus",
        500: "lima ratus",
        600: "enam ratus",
        700: "tujuh ratus",
        800: "delapan ratus",
        900: "sembilan ratus",
        1000: "seribu",
    }

    if isinstance(angka, float):
        integer_part, decimal_part = str(angka).split(".")
        integer_part = int(integer_part)
        decimal_part = int(decimal_part)

        return (
            akt(integer_part)
            + " koma "
            + " ".join(angka_dict[int(digit)] for digit in str(decimal_part))
        )

    if "/" in str(angka):
        pembilang, penyebut = str(angka).split("/")
        return akt(int(pembilang)) + " per " + akt(int(penyebut))

    angka = int(angka)  # memastikan angka adalah integer jika bukan float atau fraksi

    if angka in angka_dict:
        return angka_dict[angka]

    if angka < 100:
        puluhan, sisa = divmod(angka, 10)
        return angka_dict[puluhan * 10] + " " + angka_dict[sisa]

    if angka < 1000:
        ratusan, sisa = divmod(angka, 100)
        if sisa == 0:
            return angka_dict[ratusan * 100]
        elif sisa < 10:
            return angka_dict[ratusan * 100] + " dan " + angka_dict[sisa]
        elif sisa < 100:
            return angka_dict[ratusan * 100] + " " + akt(sisa)

    raise ValueError("Angka di luar jangkauan fungsi ini")


def convert_prefix(content):
    return " ".join("positif" if char == "+" else "negatif" for char in content)


def convert_data(input_str):
    prefix_map = {
        "ronkhi": "ronkhi",
        "ves": "ves",
        "wheezing": "wheezing",
        "dingin": "dingin",
        "edema": "edema",
        "hangat": "hangat",
    }
    prefix = next((p for p in prefix_map if input_str.startswith(p)), None)
    if not prefix:
        return "Unknown prefix"

    content = input_str.replace(f"{prefix} ", "").strip("()")
    parts = content.split("/")
    description = f"{prefix} {convert_prefix(parts[0])} per {convert_prefix(parts[1])}"
    return description


def standardize_text(text, replacements):
    text = text.lower().strip()
    for old, new in replacements.items():
        text = text.replace(old, new)
    return text


def for_pulmo(text):
    replacements = {
        "rhonki": "ronkhi",
        " -": " ",
        "i(": "i (",
        "g(": "g (",
        "ves normal": "-",
        "ves/ves": "-",
        "(+)": "(+/+)",
    }
    return standardize_text(text, replacements)


def for_cor(text):
    replacements = {
        "ireguler": "irregular",
        "irreguler": "irregular",
        "s1 dan s2 irregular": "s1 s2 single irregular",
        "s1 dan s2 tunggal irregular": "s1 s2 single irregular",
        "s1 dan s2 tunggal reguler": "s1 s2 single reguler",
        "s1 dan s2 reguler": "s1 s2 single reguler",
        "s1 dan s2 tunggal": "s1 s2 single",
    }
    return standardize_text(text, replacements)


def for_abdomen(text):
    replacements = {"nomal": "normal"}
    return standardize_text(text, replacements)


def for_ext(text):
    replacements = {"odem": "edema", "hagat": "hangat", "(++)": "(+/+)"}
    return standardize_text(text, replacements)


def for_tambahan(text):
    replacements = {}
    return standardize_text(text, replacements)


def paragraph_id(data):
    gender = "Laki-laki" if data["gender"] == "L" else "Perempuan"

    def get_value(key, unit):
        try:
            return f"{akt(float(data[key]))} {unit}"
        except (KeyError, ValueError):
            return "-"

    keluhan = (
        f"Pasien memiliki keluhan: {', '.join(data['keluhan']) if isinstance(data['keluhan'], list) else data['keluhan']}."
        if data["keluhan"] != "Tidak ada keluhan"
        else "Pasien tidak memiliki keluhan."
    )

    kalium = get_value("kalium", "mmol/L")
    natrium = get_value("natrium", "mmol/L")
    kreatinin = get_value("kreatinin", "mg/dL")

    def pemeriksaan(key, func):
        return (
            f"Pemeriksaan {key}: {', '.join([func(d) for d in data[key]])}."
            if key in data
            else ""
        )

    HR = f"{akt(int(data['hr']))} bpm" if data["hr"] != "-" else "-"
    TD = f"{akt(data['td'])} mmHg" if data["td"] != "-" else "-"
    LVEF = f"{akt(float(data['lvef']))} persen" if data["lvef"] != "-" else "-"
    BB = f"{akt(float(data['bb']))}" if data["bb"] != "-" else "-"
    TB = f"{akt(int(data['tb']))}" if data["tb"] != "-" else "-"

    paragraf = [
        f"Seorang pasien {gender} berusia {akt(int(data['usia']))} tahun dengan berat badan {BB} kg dan tinggi badan {TB} cm.",
        keluhan,
        f"Hasil pemeriksaan menunjukkan LVEF sebesar {LVEF}.",
        pemeriksaan("cor", for_cor),
        pemeriksaan("pulmo", lambda d: (for_pulmo(d))),
        pemeriksaan("abdomen", for_abdomen),
        pemeriksaan("ext", lambda d: (for_ext(d))),
        (
            pemeriksaan("tambahan", for_tambahan)
            if data.get("tambahan", ["-"])[0] != "-"
            else ""
        ),
        f"Tekanan darah pasien adalah {TD} dengan denyut jantung {HR}.",
        f"Kadar Kalium {kalium}, Natrium {natrium}, dan Kreatinin {kreatinin}.",
    ]

    return " ".join(filter(None, paragraf)).lower()


def url_and_threshold(key, URL_MODEL_JANTUNG):
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


def predict_text(texts, key, tokenizer, URL_MODEL_JANTUNG, max_len=128):
    # Tokenisasi dan padding teks
    sequences = tokenizer.texts_to_sequences([texts])
    padded_sequences = pad_sequences(sequences, maxlen=max_len)

    url, threshold = url_and_threshold(key, URL_MODEL_JANTUNG)
    response = requests.post(url, json={"instances": padded_sequences.tolist()})
    response.raise_for_status()

    probabilities = response.json()["predictions"][0]
    return ((np.array(probabilities) > threshold).astype(int)).tolist(), probabilities


def transform_label(mlbs, key, label):
    return list(mlbs[key].inverse_transform(np.array([label]))[0])
