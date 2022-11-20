function updatedata(id) {
    $.ajax({
        url: url + "api/v1/monitoring/update",
        method: "POST",
        data: {
            id: id,
            nilai : $('#edit_txtnle').val(),
            id_update : localStorage.getItem("id"),
        },
        cache: false,
        success: function (data) {
            if (data.status == 'success') {
                app.dialog.alert(data.message, "Sukses", function () {
                    location.reload(true);
                    app.views.main.router.navigate('/mntr/');
                });
            } else {
                app.dialog.alert(data.message, "Peringatan");
            }
        }
    });
}
