$(function () {
    $(".a-confirm").on("click", function (e) {
        e.preventDefault();
        var link = $(this).attr('href');

        Swal.fire({
          title: "Anda Yakin?",
          text: "",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya",
      }).then((result) => {
        if (result.isConfirmed) {
         window.location = link;
         
        }
      });
    });
    $(".form-confirm").on("click", function (e) {
        e.preventDefault();
        var form = $(this).closest("form");
        Swal.fire({
            title: "Anda Yakin?",
            text: "",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya",
        }).then((result) => {
          if (result.isConfirmed) {
           form.submit();
          }
        });
    });
});
