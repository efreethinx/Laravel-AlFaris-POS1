var table;
var tableLov = null;
var dropify;

/*
function chooseArtikel(event, id, articleId, newArticleId, kategori, note) {
    $("#articleId").val(id);
    $("#nama").val(nama);
    $("#lbl_nama").val(nama);
    $("#nama_kelompok_pendidikan").val(pendidikan);
    $("#lbl_nama_kelompok_pendidikan").val(pendidikan);
    $("#kode_kelas_pendidikan").val(kelas);
    $("#lbl_kode_kelas_pendidikan").val(kelas);
    $("#nama_program").val(program);
    $("#lbl_nama_program").val(program);
    $("#articleId").trigger("input");
    $("#myModal").modal("hide");
    event.preventDefault();
}
*/

/*
var validation = (function() {
    
    var init = function() {
        _applyValidation();
    };
    
    var _applyValidation = function() {
        
        $('#frmData').formValidation({
            framework: "bootstrap",
            button: {
              selector: '#btnSubmit',
              disabled: 'disabled'
            },
            icon: null,
            fields: {
              kodeKate: {
                validators: {
                  notEmpty: {
                   message: 'Kode Kategori harus diisi'
                  },
                  stringLength: {
                    max: 3,
                    message: 'Nama tidak boleh lebih dari 40 karakter'
                  }
                }
              }
            }
        });
    
    };
    
    return {
        init: init
    };
    
})();
*/

var confirmDeleteUom = function(event, id, nama) {
    event.preventDefault();
    
    swal({
        title: "Apakah anda yakin?",
        text: "Data Satuan dengan nama " + nama + " akan dihapus!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya, lanjutkan!",
        cancelButtonText: "Tidak, batalkan!",
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
    },
    function() {
        $.ajax({
            beforeSend: function(xhr) { xhr.setRequestHeader("X-CSRF-Token", $("meta[name='csrf_token']").attr("content")); },
            type: "POST",
            url: "/uoms/delete/" + id
        })
        .done(function(data) {
            if (data == "success") {
                // Redraw table
                table.draw();
                swal("", "Data berhasil dihapus.", "success");    
            }
            else {
                swal("", data, "error"); 
            }
        });
    });
    
};

var datatablesuom = (function() {

    var datatablesURL = 'uoms/list';

    var init = function() {
        _applyDatatable();
    };

    var _applyDatatable = function() {

        table = $('#list').DataTable({
            'processing': true,
            'serverSide': true,
            'paging': true,
            //'lengthChange': false,
            //'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false,
            'ajax': {
                "url": datatablesURL,
                "data": function (d) {
                    d.id = $('#id').val();
                    d.kode_kontak = $('#kode_kontak').val();
                    d.nama_kontak = $('#nama_kontak').val();
                    /*
                    d.nama_kelompok_pendidikan = $('#nama_kelompok_pendidikan option:selected').val();
                    d.nama_program = $('#nama_program option:selected').val();
                    d.kode_biaya_syahriah = $('#kode_biaya_syahriah option:selected').val();
                    d.kode_biaya_infaq = $('#kode_biaya_infaq option:selected').val();
                    d.kode_biaya_kesekretariatan = $('#kode_biaya_kesekretariatan option:selected').val();
                    d.status_santri = $('#status_santri option:selected').val();
                    */
                }
                //"type": "POST"
            },
            'columns': [
                {data: 'kode_uom', name: 'kode_uom'},
                {data: 'nama_uom', name: 'nama_uom'},
                {data: 'deskripsi', name: 'deskripsi'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        
    };
    
    return {
        init: init
    };

})();


var datatableskategori = (function() {
    
    //var id = winvar.id;//$("#id").val();
    //var id = 'CST-2'; 
    //var datatablesURL = '/kontak/hargajual/list/' + id;
    var datatablesURL = 'categorys/list';

    var init = function() {
        _applyDatatable();
    };

    var _applyDatatable = function() {

        table = $('#list').DataTable({
            'processing': true,
            'serverSide': true,
            'paging': true,
            //'lengthChange': false,
            //'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false,
            'ajax': {
                "url": datatablesURL,
                //"type": "POST"
            },
            'columns': [
                {data: 'kode_kategori', name: 'kode_kategori'},
                {data: 'nama_kategori', name: 'nama_kategori'},
                {data: 'departement_id', name: 'departement_id'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        
    };
    
    return {
        init: init
    };

})();


var datatablesproduk = (function() {
    
    //var id = winvar.id;//$("#id").val();
    //var id = 'CST-2'; 
    //var datatablesURL = '/kontak/hargajual/list/' + id;
    var datatablesURL = 'products/list';

    var init = function() {
        _applyDatatable();
    };

    var _applyDatatable = function() {

        table = $('#list').DataTable({
            'processing': true,
            'serverSide': true,
            'paging': true,
            //'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false,
            'ajax': {
                "url": datatablesURL,
                //"type": "POST"
            },
            'columns': [
                {data: 'kode_produk', name: 'kode_produk'},
                {data: 'nama_produk', name: 'nama_produk'},
                {data: 'kategori_id', name: 'kategori_id'},
                {data: 'stok', render: $.fn.dataTable.render.number(',', '.', 2, ''), name: 'stok', className: "text-right"},
                {data: 'uom_id', name: 'uom_id', className: "text-center"},
                {data: 'harga_jual_satuan', render: $.fn.dataTable.render.number(',', '.', 2, ''), name: 'harga_jual_satuan', className: "text-right"},
                {data: 'nilai_total', render: $.fn.dataTable.render.number(',', '.', 2, ''), name: 'nilai_total', className: "text-right"},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        
    };
    
    return {
        init: init
    };

})();

var datatablesprodukuoms = (function() {
    
    var id = winvar.id;//$("#id").val();
    //var id = '5'; 
    var datatablesURL = 'list/' + id;
    //var datatablesURL = '/products/list';

    var init = function() {
        _applyDatatable();
    };

    var _applyDatatable = function() {

        table = $('#list').DataTable({
            'processing': true,
            'serverSide': true,
            'paging': true,
            //'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false,
            'ajax': {
                "url": datatablesURL,
                //"type": "POST"
            },
            'columns': [
                //{data: 'kode_produk', name: 'kode_produk'},
                {data: 'nama_produk', name: 'nama_produk'},
                {data: 'uom_id', name: 'uom_id', className: "text-center"},
                {data: 'isi_pcs', name: 'isi_pcs', className: "text-center"},
                {data: 'pcs', name: 'pcs', className: "text-center"},
                //{data: 'harga_jual_satuan', render: $.fn.dataTable.render.number(',', '.', 2, ''), name: 'harga_jual_satuan', className: "text-right"},
                //{data: 'nilai_total', render: $.fn.dataTable.render.number(',', '.', 2, ''), name: 'nilai_total', className: "text-right"},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        
    };
    
    return {
        init: init
    };

})();

var datatablesProd = (function() {

    var datatablesURL = '{{ url("products/list")  }}';

    var init = function() {
        _applyDatatable();
    };

    var _applyDatatable = function() {

        table = $('#list').DataTable({
            'processing': true,
            'serverSide': true,
            'paging': true,
            //'lengthChange': false,
            //'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false,
            'filter': false,
            'ajax': {
                "url": datatablesURL,
                "data": function (d) {
                    d.nama_produk = $('input[name=nama_produk]').val();
                    d.kode_produk = $('input[name=kode_produk]').val();
                    d.kategori_id = $('input[name=kategori_id]').val(); 
                    //d.nama_produk = $('#nama_produk').val();
                    //d.kode_produk = $('#kode_produk').val();
                    //d.kategori_id = $('#kategori_id option:selected').val();
                    d.is_active = $('#is_active option:selected').val();
                    //d.nama_program = $('#nama_program option:selected').val();
                    //d.kode_biaya_syahriah = $('#kode_biaya_syahriah option:selected').val();
                    //d.kode_biaya_infaq = $('#kode_biaya_infaq option:selected').val();
                    //d.kode_biaya_kesekretariatan = $('#kode_biaya_kesekretariatan option:selected').val();
                    //d.status_santri = $('#status_santri option:selected').val();
                }
                //"type": "POST"
            },
            'columns': [
                {data: 'kode_produk', name: 'kode_produk'},
                {data: 'nama_produk', name: 'nama_produk'},
                {data: 'kategori_id', name: 'kategori_id'},
                {data: 'stok', render: $.fn.dataTable.render.number(',', '.', 2, ''), name: 'stok', className: "text-right"},
                {data: 'uom_id', name: 'uom_id', className: "text-center"},
                {data: 'harga_jual_satuan', render: $.fn.dataTable.render.number(',', '.', 2, ''), name: 'harga_jual_satuan', className: "text-right"},
                {data: 'nilai_total', render: $.fn.dataTable.render.number(',', '.', 2, ''), name: 'nilai_total', className: "text-right"},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        
        $('#search-form').on('submit', function(e) {
            table.draw();
            e.preventDefault();
        });
        
        $("#btnReset").on("click", function() {
            $("#search-form").trigger("reset");
            //$(".selectpicker").selectpicker("val", "");
            table.draw();
        });
        
    };
    
    return {
        init: init
    };

})();