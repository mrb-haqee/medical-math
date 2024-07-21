toastr.options = {
  closeButton: true,
  debug: true,
  newestOnTop: true,
  progressBar: true,
  positionClass: "toast-top-right",
  preventDuplicates: false,
  onclick: true,
  showDuration: "300",
  hideDuration: "1000",
  timeOut: "5000",
  extendedTimeOut: "1000",
  showEasing: "swing",
  hideEasing: "linear",
  showMethod: "fadeIn",
  hideMethod: "fadeOut",
};

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
          toastr.success(resp.message);
        } else {
          toastr.error(resp.message);
        }
      },
      error: function (xhr, status, error) {
        // console.error(xhr.responseText);
      },
    });
  });
  $("#form-signup").submit(function (e) {
    e.preventDefault();
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
          toastr.success(resp.message);
        } else {
          toastr.error(resp.message);
        }
      },
      error: function (xhr, status, error) {
        // console.error(xhr.responseText);
      },
    });
  });
});
