function get_predict(resp) {
  const { class_label, prediction, predict_label } = resp;

  const sortedPredict = class_label
    .map((label, index) => ({
      label,
      prob: prediction[index],
    }))
    .sort((a, b) => parseFloat(b.prob) - parseFloat(a.prob));

  return {
    class_labels: class_label,
    prediction,
    predict_label,
    sortedPredict,
  };
}

function get_chart(
  type,
  ctx,
  class_labels,
  prediction,
  colors = defaultColors,
  options = opsi
) {
  return new Chart(ctx, {
    type: type,
    data: {
      labels: class_labels,
      datasets: [
        {
          label: "Predict",
          data: prediction,
          borderWidth: 1,
          backgroundColor: colors,
        },
      ],
    },
    options: options,
  });
}

function get_tabel_predict() {
  showSec("#spin-laod-tabel", "#tabel-predict");
  $.ajax({
    type: "GET",
    url: "/tabel_predict",
    success: function (resp) {
      showSec("#no-predict", "#predict");
      showSec("", "#image-sec");
      if (resp !== "") {
        showSec("#tabel-predict", "#spin-laod-tabel");
        $("#tbody-predict").html(resp);
      } else {
        showSec("#no-tabel", "#spin-laod-tabel");
        $("#tbody-predict").html(resp);
      }
    },
    error: function (error) {
      let err = error.responseJSON;
      console.error("AJAX Error:", err.error);
    },
  });
}

function showSec(show, hide) {
  $(show).show();
  $(hide).hide();
}

async function convertToBase64(file) {
  return new Promise((resolve, reject) => {
    const reader = new FileReader();

    reader.onloadend = () => {
      resolve(reader.result);
    };

    reader.onerror = (error) => {
      reject(error);
    };

    reader.readAsDataURL(file);
  });
}

async function processImage(g_imageFile) {
  try {
    image_b64 = await convertToBase64(g_imageFile);
    return image_b64;
  } catch (error) {
    console.error("Error:", error);
  }
}

$(document).ready(function () {
  var g_imageFile;
  let img_base64;
  let resp_predict;
  get_tabel_predict();

  // ==============Display Image Upload==============
  $("#upload").click(() => $("#fileInput").click());

  $("#fileInput").change(function () {
    g_imageFile = this.files[0];
    if (g_imageFile) {
      const reader = new FileReader();
      reader.onload = (e) => {
        $("#image-display img").attr("src", e.target.result);
      };
      reader.readAsDataURL(g_imageFile);

      showSec("#image-sec", "#upload-sec");
    }
    let formData = new FormData();
    formData.append("image", g_imageFile);
    $.ajax({
      type: "POST",
      url: "/dashboard/lungs/save_image",
      data: formData,
      processData: false, // Jangan proses data
      contentType: false, // Jangan set contentType
      success: function (resp) {
        console.log(resp);
      },
    });
  });

  $(".del-img").click(() => {
    showSec("#upload-sec", "#image-sec");
    $("#image-display img").removeAttr("src");
  });

  // ==============Predict Image Upload==============
  $(".predict-img").click(function () {
    let formData = new FormData();
    formData.append("image", g_imageFile);

    notif.loading("Predict data", "Loading...");

    $.ajax({
      type: "POST",
      url: domain_py + "/predict_paru",
      data: formData,
      processData: false,
      contentType: false,
      success: function (resp) {
        resp_predict = resp;
        let { class_labels, prediction, predict_label, sortedPredict } =
          get_predict(resp);

        var ctx = $("#myChart")[0].getContext("2d");
        var mychart = get_chart("bar", ctx, class_labels, prediction);

        $.ajax({
          type: "POST",
          url: "/icd10",
          data: { label: predict_label, action: "tabel" },
          success: function (resp) {
            $("#predict-icd10").html(resp);

            showSec("#predict", "#no-predict");
            showSec("", "#image-sec");

            notif.mynotif.close();
            notif.success("Berhasil Predict", "Success");
          },
          error: function (error) {
            let err = error.responseJSON;
            notif.error(err.error, "Error");
          },
        });
      },
      error: function (error) {
        let err = error.responseJSON;
        console.error("AJAX Error:", err.error);
      },
    });
  });

  $(".del-predict").click(() => {
    resp_predict = "";

    showSec("#upload-sec", "#predict");
    showSec("#no-predict", "#predict");

    $("#image-display img").removeAttr("src");
  });

  $(".save-predict").click(() => {
    let { class_labels, prediction, predict_label, sortedPredict } =
      get_predict(resp_predict);

    notif.loading("Menyimpan data", "Loading...");

    let formData = new FormData();
    formData.append("image", g_imageFile);

    $.ajax({
      type: "POST",
      url: "/save_predict",
      data: {
        action: "predict",
        predict_label: predict_label,
        sortedPredict: sortedPredict,
      },
      success: function (resps) {
        console.log(resps);
        $.ajax({
          type: "POST",
          url: "/dashboard/lungs/save_image",
          data: formData,
          processData: false, // Jangan proses data
          contentType: false, // Jangan set contentType
          success: function (resp) {
            console.log(resp);
          },
        });

        showSec("#upload-sec", "#predict");
        showSec("#no-predict", "#image-sec");

        get_tabel_predict();

        notif.mynotif.close();
        notif.success("Berhasil Menyimpan", "Success");
      },
      error: function (error) {
        let err = error.responseJSON;
        console.error("AJAX Error:", err.error);
      },
    });
  });

  $(document).on("click", ".btn-p-view", function (e) {
    e.preventDefault();
    var id = $(this).closest("tr").data("id");
    notif.loading("Get image", "Loading...");

    $.ajax({
      type: "POST",
      url: "/dashboard/lungs/modal",
      data: { action: "image", id: id },
      success: function (resp) {
        console.log(resp);
        $("#p-modal").modal("show");
        $("#p-modal-content").html(resp);
        notif.mynotif.close();
      },
    });
  });
  $(document).on("click", ".btn-p-icd10", function (e) {
    e.preventDefault();
    var label = $(this).data("label");
    notif.loading("Get data", "Loading...");

    $.ajax({
      type: "POST",
      url: "/icd10",
      data: { label: label, action: "modal" },
      success: function (resp) {
        console.log(resp);
        $("#p-modal").modal("show");
        $("#p-modal-content").html(resp);
        notif.mynotif.close();
      },
    });
  });
});

// ==============Display Image==============
