// const domain_py = "https://medical-math-py.onrender.com";
const domain_py = "http://127.0.0.1:5000";

var opsi = {
  scales: {
    y: {
      beginAtZero: true,
    },
  },
};

var defaultColors = [
  "rgba(255, 99, 132, 0.8)",
  "rgba(54, 162, 235, 0.8)",
  "rgba(255, 206, 86, 0.8)",
  "rgba(75, 192, 192, 0.8)",
  "rgba(153, 102, 255, 0.8)",
  "rgba(255, 159, 64, 0.8)",
  "rgba(255, 99, 132, 0.8)",
  "rgba(54, 162, 235, 0.8)",
  "rgba(255, 206, 86, 0.8)",
  "rgba(75, 192, 192, 0.8)",
  "rgba(153, 102, 255, 0.8)",
  "rgba(255, 159, 64, 0.8)",
  "rgba(255, 99, 132, 0.8)",
  "rgba(54, 162, 235, 0.8)",
  "rgba(255, 206, 86, 0.8)",
];
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
  if ($("#sidebarToggle").length) {
    $("#sidebarToggle").on("click", function (event) {
      event.preventDefault();
      $("body").toggleClass("sb-sidenav-toggled");
      localStorage.setItem(
        "sb|sidebar-toggle",
        $("body").hasClass("sb-sidenav-toggled")
      );
    });
  }
});
