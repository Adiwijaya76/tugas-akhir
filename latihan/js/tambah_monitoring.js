
function list_nop() {
    app.request.json(url + "api/v1/lahan/list", function (data) {
        var nop = "";
        jQuery.each(data.data, function (index, item) {

            nop += "<option value=" + item.nop + ">" + item.luas_ha + "</option>";

        });

        $('#nop').append(nop);
    })

}

function polaTanam() {
    //app.dialog.preloader("Akses data.......");
    app.request.json(url + "api/v1/polatanam/list", function (data) {
        app.dialog.close();
        var pola_tanam = "";
        jQuery.each(data.data, function (index, item) {

            pola_tanam += `<option value=`+item.id+`>`+item.masa_tanam+`</option>"`;
        }); 
        $('#pola_tanam').append(pola_tanam);
    })
}

function unsurHara() {
    //app.dialog.preloader("Akses data.......");  
    app.request.json(url + "api/v1/unsurhara/list", function (data) {
        app.dialog.close();
        var unsur_hara = "";

        jQuery.each(data.data, function (index, item) {

            unsur_hara += `<option value=`+ item.id +`>` +item.nama+`</option>`;

        });

        $('#unsur_hara').append(unsur_hara);
    })

}


function monitoring() {
    app.dialog.preloader("Akses data.......");  
    app.request.json(url + "api/v1/monitoring", function (data) {
        app.dialog.close();
        var monitoring = "";
        jQuery.each(data.data, function (index, item) {
            monitoring += `
            <a href="javascript:void(0)" data-id="`+ item.id +`" onclick="detail_monitoring(this)">
            <div class="card card-outline radius10" style="margin-left: 10px; margin-right: 10px; margin-bottom:70px;" >
                <div class="card-content card-padding" style="background-color: #fff;">
                    <div class="row" >
                        <div class="col-100">
                            <font style="font-size: 10px; margin-left: 10px;"><b> Data Monitoring Unsur Hara</b></font>
                            <br />
                            <div class="list">
                                <div class="item-content item-input">
                                    <div class="col-15">                
                                        <div class="item-media"><i class="icon f7-icons" style="color:#3367EC;">doc_plaintext</i></div></div>
                                    <div class="item-inner">
                                        <div class="item-title item-label">id :</div>
                                        <div class="item-input-wrap">` + item.id + `</div>
                                    </div>
                                </div>
                                <div class="item-content item-input">
                                    <div class="col-15">                
                                        <div class="item-media"><i class="icon f7-icons" style="color:#3367EC;">book</i></div></div>
                                    <div class="item-inner">
                                        <div class="item-title item-label">Luas Lahan :</div>
                                        <div class="item-input-wrap"  id="">` + item.luas_ha +`</div>
                                    </div>
                                </div>
                            <div class="item-content item-input">
                                <div class="col-15">                
                                    <div class="item-media"><i class="icon f7-icons" style="color:#3367EC;">book</i></div></div>
                                <div class="item-inner">
                                    <div class="item-title item-label">Nama Petani:</div>
                                    <div class="item-input-wrap"  id="">` + item.nama +`</div>
                                </div>
                            </div>
                            <div class="item-content item-input">
                            <div class="col-15">                
                                <div class="item-media"><i class="icon f7-icons" style="color:#3367EC;">doc_plaintext</i></div></div>
                            <div class="item-inner">
                                <div class="item-title item-label">alamat :</div>
                                <div class="item-input-wrap">` + item.alamat + `</div>
                            </div>
                        </div>
                                <div class="item-content item-input">
                                    <div class="col-15">
                                        <div class="item-media"><i class="icon f7-icons" style="color:#3367EC;">chart_bar_square_fill</i>
                                        </div>
                                    </div>
                                    <div class="item-inner">
                                        <div class="item-title item-label">Nilai :</div>
                                        <div class="item-input-wrap" id="">` + item.nilai + `</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
            </a>
            `;
        });

        $("#monitoring").html(monitoring);
    });
}

function monitoring_tambah() {
    var pola_tanam = $("#pola_tanam").val();
    var unsur_hara = $("#unsur_hara").val();
    var nop = $("#nop").val();
    var txtnl = $("#txtnl").val();
    $.ajax({
        url: url + "api/v1/monitoring/tambah",
        method: "POST",
        data: {
            nop: nop,
            id_rencana_pola_tanam: pola_tanam,
            id_unsur_hara: unsur_hara,
            nilai: txtnl,
            id_buat: localStorage.getItem("id"),
            id_update: localStorage.getItem("id")
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

