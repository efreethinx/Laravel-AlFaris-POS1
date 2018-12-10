var table;
var tableLov = null;
var dropify;

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

var searchbox = (function() {

    var init = function() {
        //_applyBootstrapSelect();
        //_applyDatePicker();
        _applyLov();
    };
    
    var _applyLov = function() {
        $("#myModal").on("shown.bs.modal", function () {
            datatablesLovOnSearchBox.init();
        });    
    };
    
    var _applyDatePicker = function() {
        
        $("#tanggal").datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true
        });
    };
    
    var _applyBootstrapSelect = function() {
        
        $(".selectpicker").selectpicker({
            //style: "bg-teal",
            size: 5
        });
    };
    
    return {
        init: init
    };

})();

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

var confirmDelete = function(event, id, nama) {
    event.preventDefault();
    
    swal({
        title: "Apakah anda yakin?",
        text: "Data agama dengan nama " + nama + " akan dihapus!",
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
            url: "/kategori/delete/" + id
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

      function formatDate (input) {
      var datePart = input.match(/\d+/g),
      year = datePart[0].substring(2), // get only two digits
      month = datePart[1], day = datePart[2];

      return day+'/'+month+'/'+year;
      }

var datatables = (function() {

    var datatablesURL = 'pembelian/list';

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
                "data": function (d) {
                    d.id = $('#id').val();
                    d.no_faktur = $('#no_faktur').val();
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
                {data: 'tanggal_faktur', name: 'tanggal_faktur'},
                {data: 'no_faktur', name: 'no_faktur'},
                {data: 'no_po', name: 'no_po'},
                {data: 'nama_kontak', name: 'nama_kontak'},
                {data: 'total_setelah_pajak', render: $.fn.dataTable.render.number(',', '.', 2, ''), name: 'total_setelah_pajak', className: "text-right"},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        
    };
    
    return {
        init: init
    };

})();


var datatablesPembayaran = (function() {
    
    //var id = winvar.id;//$("#id").val();
    //var id = 'CST-2'; 
    //var datatablesURL = '/pembelian/list/' + id;
    var datatablesURL = 'pembayaran/list';

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
                {data: 'tanggal', name: 'tanggal'},
                {data: 'no_reff', name: 'no_reff'},
                {data: 'nama_kontak', name: 'nama_kontak'},
                {data: 'nilai', render: $.fn.dataTable.render.number(',', '.', 2, ''), name: 'nilai', className: "text-right"},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        
    };
    
    return {
        init: init
    };

})();


var datatablesHutang = (function() {
    
    var datatablesURL = 'getdataHutang';

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
                "data": function (d) {
                    //d.id = $('#id').val();
                    d.saldohutang = $('#saldohutang').val();
                    d.nama_kontak = $('#nama_kontak').val();
                    /*
                    d.nama_kelompok_pendidikan = $('#nama_kelompok_ endidikan option:selected').val();
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
                {data: 'nama_kontak', name: 'nama_kontak'},
                {data: 'kurs', name: 'kurs', className: "text-center"},
                {data: 'totalhutang', render: $.fn.dataTable.render.number(',', '.', 2, ''), name: 'totalhutang', className: "text-right"},
                {data: 'totalbayar', render: $.fn.dataTable.render.number(',', '.', 2, ''), name: 'totalbayar', className: "text-right"},
                {data: 'saldohutang', render: $.fn.dataTable.render.number(',', '.', 2, ''), name: 'saldohutang', className: "text-right"}

               // {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        
    };
    
    return {
        init: init
    };

})();

var datatablesLov = (function() {

    var datatablesURL = '{{ route("products.lov") }}';

    var init = function() {
        if (tableLov == null) {
            _applyDatatable();    
        }
    };

    var _applyDatatable = function() {

        tableLov = $('#list_santri').DataTable({
            'processing': true,
            'serverSide': true,
            'paging': true,
            'lengthChange': false,
            //'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false,
            'ajax': {
                "url": datatablesURL,
                //"type": "POST"
            },
            'columns': [
                {data: 'nis', name: 'nis'},
                {data: 'nama', name: 'nama'},
                {data: 'nama_kelompok_pendidikan', name: 'nama_kelompok_pendidikan'},
                {data: 'kode_kelas_pendidikan', name: 'kode_kelas_pendidikan'},
                {data: 'nama_program', name: 'nama_program'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        
    };
    
    return {
        init: init
    };

})();

var datatablesLovOnSearchBox = (function() {

    var datatablesURL = 'products/lov';

    var init = function() {
        if (tableLov == null) {
            _applyDatatable();    
        }
    };

    var _applyDatatable = function() {

        tableLov = $('#list_santri').DataTable({
            'processing': true,
            'serverSide': true,
            'paging': true,
            'lengthChange': true,
            //'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false,
            'ajax': {
                "url": datatablesURL,
                //"type": "POST"
            },
            'columns': [
                {data: 'action', name: 'action', orderable: false, searchable: false},
                {data: 'kode_produk', name: 'kode_produk'},
                {data: 'nama_produk', name: 'nama_produk'},
                {data: 'kategori_id', name: 'kategori_id'},
                {data: 'uom_id', name: 'uom_id'},
                {data: 'harga_jual_satuan', name: 'harga_jual_satuan'},
            ]
        });
        
    };
    
    return {
        init: init
    };

})();
