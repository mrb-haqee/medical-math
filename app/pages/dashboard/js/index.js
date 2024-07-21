const domain_py = "https://medical-math-py.onrender.com";

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

$(document).ready(function () {
  var g_imageFile;
  let resp_predict;
  get_tabel_predict();

  // ==============Display Image Upload==============
  $("#upload").click(() => $("#fileInput").click());

  $("#fileInput").change(function () {
    g_imageFile = this.files[0];
    if (g_imageFile) {
      const reader = new FileReader();
      reader.onload = (e) =>
        $("#image-display img").attr("src", e.target.result);
      reader.readAsDataURL(g_imageFile);

      showSec("#image-sec", "#upload-sec");
    }
  });

  $(".del-img").click(() => {
    showSec("#upload-sec", "#image-sec");
    $("#image-display img").removeAttr("src");
  });

  // ==============Predict Image Upload==============
  $(".predict-img").click(function () {
    let formData = new FormData();
    formData.append("image", g_imageFile);

    toastr.options.timeOut = false;
    var loadingToast = toastr.info(
      '<div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;Memproses...'
    );

    $.ajax({
      type: "POST",
      url: domain_py + "/predict",
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
          data: { label: predict_label },
          success: function (resp) {
            $("#predict-icd10").html(resp);

            showSec("#predict", "#no-predict");
            showSec("", "#image-sec");

            toastr.clear(loadingToast);
            toastr.options.timeOut = "5000";
            toastr.success("Berhasil Predict");
          },
          error: function (error) {
            let err = error.responseJSON;
            console.error("AJAX Error:", err.error);
            toastr.error("Error");
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

    toastr.options.timeOut = false;
    var loadingToast = toastr.info(
      '<div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;Menyimpan...'
    );

    $.ajax({
      type: "POST",
      url: "/save_predict",
      data: {
        predict_label: predict_label,
        sortedPredict: sortedPredict,
      },
      success: function (resp) {
        showSec("#upload-sec", "#predict");
        showSec("#no-predict", "#image-sec");

        get_tabel_predict();

        toastr.clear(loadingToast);
        toastr.options.timeOut = "5000";
        toastr.success("Berhasil Menyimpan");
      },
      error: function (error) {
        let err = error.responseJSON;
        console.error("AJAX Error:", err.error);
      },
    });
  });
  $("#logout").click(() => {
    $.ajax({
      type: "GET",
      url: "/logout",
      success: function (resp) {},
      error: function (error) {
        let err = error.responseJSON;
        console.error("AJAX Error:", err.error);
      },
    });
  });
});

// ==============Display Image==============
