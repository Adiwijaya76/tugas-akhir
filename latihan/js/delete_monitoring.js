
    function deletedata(id) {
        $.ajax({
            url: url + "api/v1/monitoring/delete",
            method: "POST",
            data: {
                id: id,
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

