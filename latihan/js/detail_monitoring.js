function detail_monitoring(el) {
    app.views.main.router.navigate('/edmntr/');
    var id = $(el).data('id');
    app.request.json(url + "api/v1/monitoring/detail", {id : id}, function (data) {
        var detail = `
            <div class="card card-outline radius10" style="margin-left: 10px; margin-right: 10px; margin-bottom: 100px;">
                <div class="card-content card-padding" style="background-color: #fff;">
                    <div class="row">
                        <div class="col-100">
                            <font style="font-size: 10px; margin-left: 10px;"><b>Edit Data Monitoring Unsur Hara</b></font> <br />
                            <div class="list">
                                <div class="item-content item-input">
                                    <div class="col-15">
                                        <div class="item-media"><i class="icon f7-icons" style="color:#3367EC;">chart_bar_square_fill</i>
                                        </div>
                                    </div>
                                    <div class="item-inner">
                                        <div class="item-title item-label">Nama :</div>
                                        <div class="item-input-wrap">`+data.data.nama+`</div>
                                    </div>
                                </div>
                                <div class="item-content item-input">
                                    <div class="col-15">
                                        <div class="item-media"><i class="icon f7-icons" style="color:#3367EC;">chart_bar_square_fill</i>
                                        </div>
                                    </div>
                                    <div class="item-inner">
                                        <div class="item-title item-label">Alamat :</div>
                                        <div class="item-input-wrap"> `+data.data.alamat+` </div>
                                    </div>
                                </div>
                                <div class="item-content item-input">
                                    <div class="col-15">
                                        <div class="item-media"><i class="icon f7-icons" style="color:#3367EC;">chart_bar_square_fill</i>
                                        </div>
                                    </div>
                                    <div class="item-inner">
                                        <div class="item-title item-label">Nilai :</div>
                                        <div class="item-input-wrap"><input type="number" id="edit_txtnle" value="`+data.data.nilai+`" /></div>
                                    </div>
                                </div>
                                <div class="item-content item-input-row">
                                    <button type="button" onclick="updatedata(`+data.data.id+`)" class="col button button-fill color-green" style="margin-left:10px ; margin-right: 10px;">update</button>
                                    <button type="button" onclick="deletedata(`+data.data.id+`)" class="col button button-fill color-red" style="margin-left:10px ; margin-right: 10px;">hapus</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        $('#detail_monitoring').html(detail);
    })
}
