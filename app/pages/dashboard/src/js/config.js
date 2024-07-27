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
