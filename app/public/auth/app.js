class NotifMRB {
  constructor(options) {
    this.mynotif;
  }

  notify(status, text, title = "", load = false) {
    this.mynotif = load
      ? new Notify({
          status: status,
          title: title,
          text: text,
          showCloseButton: false,
          customIcon:
            "<i class='fa-regular fa-sun fa-spin' style='font-size: 2rem'></i>",
          autoclose: false,
        })
      : new Notify({
          status: status,
          title: title,
          text: text,
        });
  }

  success(text, title) {
    this.notify("success", text, title);
  }

  error(text, title) {
    this.notify("error", text, title);
  }

  // Tambahkan metode lainnya jika diperlukan
  info(text, title) {
    this.notify("info", text, title);
  }

  warning(text, title) {
    this.notify("warning", text, title);
  }

  loading(text, title) {
    this.notify("info", text, title, true);
  }

  close() {
    this.mynotif.close();
  }
}

const notif = new NotifMRB();

$(document).ready(function () {
  // Menambahkan event listener untuk sign up button
  $("#sign-up-btn").on("click", function () {
    $(".container").addClass("sign-up-mode");
  });

  // Menambahkan event listener untuk sign in button
  $("#sign-in-btn").on("click", function () {
    $(".container").removeClass("sign-up-mode");
  });

  $("#form-signin").submit(function (e) {
    e.preventDefault();
    notif.loading("Proses authentication", "Loading...");
    let data = $(this).serialize();
    $.ajax({
      url: "/auth_process",
      method: "POST",
      data: { action: "singin", data: data },
      success: function (resp) {
        console.log(resp);
        resp = JSON.parse(resp);
        if (resp.status === "sukses") {
          window.location.href = "/dashboard";
        } else {
          notif.error(resp.message, "Error");
        }
      },
      error: function (xhr, status, error) {
        // console.error(xhr.responseText);
      },
    });
  });
  $("#form-signup").submit(function (e) {
    e.preventDefault();
    notif.loading("Proses authentication", "Loading...");
    let data = $(this).serialize();
    $.ajax({
      url: "/auth_process",
      method: "POST",
      data: { action: "signup", data: data },
      success: function (resp) {
        console.log(resp);
        resp = JSON.parse(resp);
        if (resp.status === "sukses") {
          window.location.href = "/dashboard";
        } else {
          notif.error(resp.message, "Error");
        }
      },
      error: function (xhr, status, error) {
        // console.error(xhr.responseText);
      },
    });
  });
});
