let counters = {
  cor: 1,
  pulmo: 1,
  abdomen: 1,
  ext: 1,
  tambahan: 1,
};

function add_keluhan(name) {
  var targetId = "#add_" + name;
  counters[name] += 1;
  let data = counters[name];

  if (data <= 5) {
    $(targetId).append(`
        <div class="col-md-4">
                <div class="form-floating">
                    <input class="form-control" list="datalist${name}" name="${name}${data}">
                    <label for="${name}${data}">${name} ${data}</label>
                </div>
        </div>`);
  }
}

function getDataObj(data) {
  return data.reduce((obj, element) => {
    obj[element.name] = element.value;
    return obj;
  }, {});
}

function parameterConvert(data) {
  const prefixes = ["cor", "abdomen", "ext", "pulmo", "tambahan"];
  const result = {};

  for (const [key, value] of Object.entries(data)) {
    if (value != "") {
      let matched = false;

      for (const prefix of prefixes) {
        if (key.startsWith(prefix)) {
          if (!result[prefix]) {
            result[prefix] = [];
          }
          result[prefix].push(value);
          matched = true;
          break;
        }
      }

      if (!matched) {
        result[key] = value;
      }
    } else {
      continue;
    }
  }

  return result;
}

function get_tabel_predict() {
  $("#j-spin-load-tabel").show();
  $("#j-tabel-predict").hide();

  $.ajax({
    type: "GET",
    url: "/dashboard/heart/tabel_predict",
    success: function (resp) {
      if (resp == "") {
        $("#j-tbody-predict").html(resp);
        $("#j-spin-load-tabel").hide();
        $("#j-no-tabel").show();
      } else {
        $("#j-spin-load-tabel").hide();
        $("#j-tbody-predict").html(resp);
        $("#j-tabel-predict").show();
      }
    },
    error: function (error) {
      let err = error.responseJSON;
      console.error("AJAX Error:", err.error);
    },
  });
}

var formData;
var DataPredcit;

$(document).ready(function () {
  get_tabel_predict();
  const notif = new NotifMRB();

  $("#btn-add-data").click(() => {
    $("#btn-add-data").hide();
    $("#card-biodata").show();
    $("#ccard-summary").show();
    $("#j-card-predict").show();
  });

  $("#btn-j-next").click((e) => {
    e.preventDefault();
    let biodata = $("#form-biodata").serializeArray();

    // Cek data kosong
    let isEmpty = false;
    biodata.forEach((item) => {
      if (!item.value.trim()) {
        isEmpty = true;
      }
    });

    if (isEmpty) {
      notif.error("Semua data harus diisi.", "Data Kosong");
    } else {
      $("#card-biodata").hide();
      $("#card-parameter").show();
    }
  });

  $("#btn-j-back-biodata").click(() => {
    $("#card-biodata").show();
    $("#card-parameter").hide();
  });

  $(document).on("click", "#btn-j-back-parameter", function () {
    formdata = "";
    $("#card-parameter").show();
    $("#card-summary").hide();
    $("#nodata-summary").show();
  });

  $(document).on("click", "#btn-j-delete", function () {
    $("#j-no-predict-result").show();
    $("#j-predict-result").hide();
    $("#form-biodata")[0].reset();
    $("#form-parameter")[0].reset();
    $("#card-biodata").show();
    $("#card-parameter").hide();
    $("#card-summary").hide();
    $("#nodata-summary").show();
  });

  $(document).on("click", ".btn-j-detail", function (e) {
    e.preventDefault();
    var id = $(this).closest("tr").data("id");
    notif.loading("Get data", "Loading...");
    $.ajax({
      type: "POST",
      url: "/dashboard/heart/modal",
      data: { action: "detail", id: id },
      success: function (resp) {
        $("#j-modal-content").html(resp);
        notif.mynotif.close();
        $("#j-modal").modal("show");
      },
    });
  });

  $(document).on("click", ".btn-j-icd10", function (e) {
    e.preventDefault();
    var id = $(this).closest("tr").data("id");
    notif.loading("Get data", "Loading...");
    $.ajax({
      type: "POST",
      url: "/dashboard/heart/modal",
      data: { action: "icd10", id: id },
      success: function (resp) {
        $("#j-modal-content").html(resp);
        notif.mynotif.close();
        $("#j-modal").modal("show");
      },
    });
  });

  $("#btn-j-summary").click(function (e) {
    e.preventDefault();
    notif.loading("Mendapatkan Summary", "Loading...");
    let biodata = $("#form-biodata").serializeArray();
    let parameter = $("#form-parameter").serializeArray();
    let data = { ...getDataObj(biodata), ...getDataObj(parameter) };
    formData = parameterConvert(data);

    $.ajax({
      type: "POST",
      url: "/dashboard/heart/summary",
      data: formData,
      success: function (resp) {
        $("#card-summary").html(resp);
        $("#card-summary").show();
        $("#card-parameter").hide();
        $("#nodata-summary").hide();
        notif.mynotif.close();
        notif.success("Mendapatkan Summary!", "Success");
      },
      error: function (error) {
        let err = error.responseJSON;
        console.error("AJAX Error:", err.error);
      },
    });
  });

  $(document).on("click", "#btn-j-predict", function () {
    notif.loading("Predict Data", "Loading...");
    $.ajax({
      type: "POST",
      url: domain_py + "/predict_jantung",
      data: JSON.stringify(formData),
      contentType: "application/json",
      success: function (resp) {
        DataPredcit = resp;
        $.ajax({
          type: "POST",
          url: "/dashboard/heart/predict",
          data: { DU: resp.DU.label, DS: resp.DS.label, OB: resp.OB.label },
          success: function (resp_php) {
            notif.mynotif.close();
            notif.success("Predict sukses!", "Success");
            $("#j-no-predict-result").hide();
            $("#j-predict-result").html(resp_php);
            $("#card-summary").hide();
            $("#nodata-summary").show();
            $("#j-predict-result").show();
          },
          error: function (error) {
            console.log(error);
          },
        });
      },
      error: function (error) {
        console.log(error);
      },
    });
  });

  $(document).on("click", "#btn-j-save-predict", function () {
    notif.loading("Save data", "Loading...");

    const { nama, domisili, usia, gender, ...rest } = formData;

    let data_req = {
      biodata: {
        nama,
        gender,
        usia,
        domisili,
      },
      input: {
        ...rest,
      },
      labels: {
        DU: DataPredcit.DU.label,
        DS: DataPredcit.DS.label,
        OB: DataPredcit.OB.label,
      },
      predict: DataPredcit,
    };

    $.ajax({
      type: "POST",
      url: "/dashboard/heart/save_predict",
      data: data_req,
      success: function (resp) {
        get_tabel_predict();
        formData = "";
        DataPredcit = "";
        $("#j-predict-result").hide();
        $("#j-no-predict-result").show();

        $("#btn-add-data").show();
        $("#card-biodata").hide();
        $("#ccard-summary").hide();
        $("#j-card-predict").hide();
        notif.mynotif.close();
        notif.success("Data berhasil disimpan!", "Success");
      },
      error: function (error) {
        console.log(error);
      },
    });
  });
  // $(document).on("click", "#btn-test", function () {
  //   let data = {
  //     biodata: {
  //       nama: "123",
  //       gender: "L",
  //       usia: "123",
  //       domisili: "123",
  //     },
  //     input: {
  //       bb: "123",
  //       tb: "123",
  //       lvef: "123",
  //       keluhan: "awdawd",
  //       td: "123",
  //       hr: "123",
  //       kalium: "123",
  //       natrium: "123",
  //       kreatinin: "123",
  //       cor: ["123"],
  //       pulmo: ["123"],
  //       abdomen: ["123"],
  //       ext: ["123"],
  //       tambahan: ["123"],
  //     },
  //     labels: {
  //       DU: ["ADHF Profile B", "Congestive heart failure"],
  //       DS: [
  //         "Atherosklerosis heart disease",
  //         "Non-insulin-dependent diabetes mellitus without complications",
  //       ],
  //       OB: [
  //         "Allopurinol 1 x 100 mg",
  //         "Asetosal 1 x 80 mg",
  //         "Clopidogrel 1 x 75 mg",
  //         "Furosemide tab 1 x 40 mg",
  //         "Lansoprazole 1 x 30 mg",
  //         "Simvastatin 1 x 20 mg",
  //         "Simvastatin 1 x 40 mg",
  //         "Spironolakton 1 x 25 mg",
  //       ],
  //     },
  //     predict: {
  //       DS: {
  //         label: [
  //           "Atherosklerosis heart disease",
  //           "Non-insulin-dependent diabetes mellitus without complications",
  //         ],
  //         pred: [
  //           0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
  //           0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0,
  //           0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
  //         ],
  //         prob: [
  //           0.00621133391, 0.0753029361, 0.0950183123, 0.0197180528,
  //           0.000593170291, 0.00911011547, 0.193688124, 0.00167365232,
  //           0.0142846005, 0.00440185238, 0.00799278729, 0.0000164269932,
  //           0.0373120084, 0.0019184869, 0.00148168905, 0.0021934777,
  //           0.00943359826, 0.0323045, 0.00108346378, 0.0611587763,
  //           0.00871000532, 0.0122093959, 0.000599508465, 0.000561891356,
  //           0.00762297027, 0.0200676154, 0.0237738, 0.0214101952, 0.00402354822,
  //           0.0210185666, 0.00720543228, 0.000415048708, 0.000679906574,
  //           0.0697519556, 0.0335735716, 0.00251043285, 0.0266670901,
  //           0.00273842807, 0.00931655522, 0.00269629154, 0.00952069182,
  //           0.0535983332, 0.0138351554, 0.146048, 0.000495037879, 0.00616047066,
  //           0.00864315126, 0.001779021, 0.00133053202, 0.00320249959,
  //           0.00940304529, 0.00184974296, 0.00429394096, 0.0241464805,
  //           0.000500886, 0.00102479453, 0.00354445772, 0.0314801335,
  //           0.00139818341,
  //         ],
  //       },
  //       DU: {
  //         label: ["ADHF Profile B", "Congestive heart failure"],
  //         pred: [1, 0, 0, 0, 1, 0],
  //         prob: [
  //           0.999247909, 0.00230535911, 0.00000891159, 1.08905046e-11, 1,
  //           7.30653732e-11,
  //         ],
  //       },
  //       OB: {
  //         label: [
  //           "Allopurinol 1 x 100 mg",
  //           "Asetosal 1 x 80 mg",
  //           "Clopidogrel 1 x 75 mg",
  //           "Furosemide tab 1 x 40 mg",
  //           "Lansoprazole 1 x 30 mg",
  //           "Simvastatin 1 x 20 mg",
  //           "Simvastatin 1 x 40 mg",
  //           "Spironolakton 1 x 25 mg",
  //         ],
  //         pred: [
  //           1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
  //           0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
  //           0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0,
  //           0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
  //           0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
  //           0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 1, 0, 0, 0, 0,
  //           0, 0, 0, 0, 0,
  //         ],
  //         prob: [
  //           0.382108688, 0.00484242244, 0.0300144535, 0.0252167638,
  //           0.0219181441, 0.00188758911, 0.000013738033, 0.00199076673,
  //           0.0772077888, 0.520530105, 0.00174746511, 0.0690823272, 0.00896944,
  //           0.000145957456, 0.0105575183, 0.151596621, 0.00429879362,
  //           0.189264074, 0.0112875672, 0.0537174605, 0.00479997974,
  //           0.0213321634, 0.0060282005, 0.0210433416, 0.00762552442,
  //           0.0173359942, 0.00163762795, 0.0219072606, 0.00256076246,
  //           0.00711118104, 0.0651267, 0.0131183611, 0.0467949547, 0.00428162934,
  //           0.530031621, 0.00172525912, 0.0513749048, 0.00220336416,
  //           0.00191777362, 0.0472680815, 0.00801754091, 0.00184345595,
  //           0.0263273884, 0.000176630536, 0.00268810894, 0.0000411112342,
  //           0.00201636087, 0.00363005255, 0.00493099587, 0.0551813543,
  //           0.00198576972, 0.0171297919, 0.00228115357, 0.00160033279,
  //           0.00238873158, 0.139931768, 0.0356325544, 0.0803298429,
  //           0.0147033706, 0.0124412253, 0.00250830711, 0.000100563717,
  //           0.014112439, 0.299213141, 0.00147630286, 0.00514663244, 0.001515946,
  //           0.0016321023, 0.0000226273369, 0.00523583451, 0.00166333863,
  //           0.111485749, 0.014224004, 0.000132906032, 0.00321692391,
  //           0.00201186677, 0.0250822585, 0.000469120947, 0.00874238927,
  //           0.00204584026, 0.00862515066, 0.00171952893, 0.00629508123,
  //           0.00182665593, 0.0131359864, 0.00515894732, 0.00197109347,
  //           0.00196618936, 0.0046513, 0.0141250417, 0.00990300812, 0.0172329638,
  //           0.00598150445, 0.000119587632, 0.00266491249, 0.00253198156,
  //           0.014486135, 0.0320843682, 0.494159758, 0.0820241794, 0.00528834434,
  //           0.00630471483, 0.0351462327, 0.00737976469, 0.0113377199,
  //           0.00160628429, 0.0018992119, 0.0131317768, 0.00189290324,
  //           0.0219202526, 0.0000233309456, 0.00742872432, 0.050710123,
  //           0.00814651512, 0.000732609, 0.00382094458, 0.0107857147,
  //           0.0107363416, 0.0093779834, 0.118378691, 0.12627016, 0.0163943805,
  //           0.00196919451, 0.00222372566, 0.00236123381, 0.00535011245,
  //           0.0128756976, 0.132838935, 0.00131683797, 0.242912844, 0.243716121,
  //           0.00876418501, 0.0201027, 0.636624455, 0.0776799694, 0.00170079386,
  //           0.0696315, 0.00197295332, 0.000157459217, 0.00211848295,
  //           0.00669829361, 0.00654722843, 0.00164780451,
  //         ],
  //       },
  //     },
  //   };
  //   $.ajax({
  //     type: "POST",
  //     url: "/dashboard/heart/save_predict",
  //     data: data,
  //     success: function (resp) {
  //       console.log(resp);
  //     },
  //     error: function (error) {
  //       console.log(error);
  //     },
  //   });
  // });
});
