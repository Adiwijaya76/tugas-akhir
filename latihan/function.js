function propinsi() {
    app.request.json(url + "api/v1/propinsi", function (data) {
        var propinsi = "";
        var id_propinsi = '#id_propinsi';
        jQuery.each(data.data, function (index, item) {
            propinsi += `
            <li>
                <a href="#" class="item-link item-content popup-close" data-id="`+item.id+`" data-form="`+id_propinsi+`" data-nama="`+item.nama+`" onclick="setnilai(this)">
                    <div class="item-inner"><div class="item-title">`+item.nama+`</div></div>
                </a>
            </li>
            `;
        });

        $('#propinsi').html(propinsi);
    })  
}

function setnilai(el){
    let obyek = $(el).data('form');
    $(obyek).val($(el).data('id') +' '+ $(el).data('nama'));        
    kabupaten($(el).data('id'));
    kecamatan($(el).data('id'));
    desa($(el).data('id',));
    console.log($(el).data('nama'))
}


function kabupaten(id_propinsi) {
    if (id_propinsi== ""){
            app.dialog.alert("Isian harus ada", "Cari Gagal");
            return;
        }
    app.request.json(url + "api/v1/kabupaten", {id_propinsi: id_propinsi}, function (data) {
        var kabupaten = "";
        var id_kabupaten = '#id_kabupaten';
        jQuery.each(data.data, function (index, item) {
            kabupaten += `
            <li>
                <a href="#" class="item-link item-content popup-close" data-id='${id}' data-form='${id_kabupaten}' data-nama="`+item.nama+`" onclick="setnilai(this)">
                    <div class="item-inner"><div class="item-title">`+item.nama+`</div></div>
                </a>
            </li>
            `;


        });
       
        $('#kabupaten').html(kabupaten);
    
    })
}
function kecamatan(id_kabupaten) {
    app.request.json(url + "api/v1/kecamatan", {id_kabupaten: id_kabupaten}, function (data) {
        var  kecamatan= "";
        var id_kecamatan = '#id_kecamatan';
        jQuery.each(data.data, function (index, item) {
            kecamatan += `
            <li>
                <a href="#" class="item-link item-content popup-close" data-id="`+item.id+`" data-form="`+id_kecamatan+`" data-nama="`+item.nama+`" onclick="setnilai(this)">
                    <div class="item-inner"><div class="item-title">`+item.nama+`</div></div>
                </a>
            </li>
            `;
        });
        $('#kecamatan').html(kecamatan);
    })
}

function desa(id_kecamatan) {
    app.request.json(url + "api/v1/desa", {id_kecamatan: id_kecamatan}, function (data) {
        var  desa= "";
        var id_desa = '#id_desa';
        jQuery.each(data.data, function (index, item) {
            desa += `
            <li>
                <a href="#" class="item-link item-content popup-close" data-id="`+item.id+`" data-form="`+id_desa+`" data-nama="`+item.nama+`" onclick="setnilai(this)">
                    <div class="item-inner"><div class="item-title">`+item.nama+`</div></div>
                </a>
            </li>
            `;
        });
        $('#desa').html(desa);
    })
}


function cari(id_desa) {
    let nama = "";
    
    app.request.json(url + "api/v1/cari", {id_desa:id_desa }, function (data) {
    })
}

