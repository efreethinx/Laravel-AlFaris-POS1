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

    var datatablesURL = '/putramaja/pembelian/list';

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
                //{data: 'proyek', name: 'proyek'},
                {data: 'total_setelah_pajak', render: $.fn.dataTable.render.number(',', '.', 2, ''), name: 'total_setelah_pajak', className: "text-right"},
                //{data: 'action', name: 'action', orderable: false, searchable: false}
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
    var datatablesURL = '/list';

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
                //{data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        
    };
    
    return {
        init: init
    };

})();


var datatablesHutang = (function() {
    
    var datatablesURL = '/getdataHutang';

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


var datatablesPenjualan = (function() {

    var datatablesURL = '/putramaja/penjualan/list';

    var init = function() {
        _applyDatatable();
    };

    var _applyDatatable = function() {

        table = $('#listpenjualan').DataTable({
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
                    d.tanggal_faktur = $('#tanggal_faktur').val();
                    d.no_faktur = $('#no_faktur').val();
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
                //{data: 'proyek', name: 'proyek'},
                {data: 'total_setelah_pajak', render: $.fn.dataTable.render.number(',', '.', 2, ''), name: 'total_setelah_pajak', className: "text-right"},
                //{data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        
    };
    
    return {
        init: init
    };

})();

        /* CHART - MORRIS  */
        
        function init_morris_charts2() {
            
            if( typeof (Morris) === 'undefined'){ return; }
            console.log('init_morris_charts');
            
            if ($('#graph_barn').length){ 
            
                Morris.Bar({
                  element: 'graph_bar',
                  data: [
                    {device: 'iPhone 4', geekbench: 1024},
                    {device: 'iPhone 4S', geekbench: 655},
                    {device: 'iPhone 3GS', geekbench: 750},
                    {device: 'iPhone 5', geekbench: 1571},
                    {device: 'iPhone 5S', geekbench: 1655},
                    {device: 'iPhone 6', geekbench: 2154},
                    {device: 'iPhone 6 Plus', geekbench: 1144},
                    {device: 'iPhone 6S', geekbench: 2371},
                    {device: 'iPhone 6S Plus', geekbench: 1471},
                    {device: 'Other', geekbench: 1371}
                  ],
                  xkey: 'device',
                  ykeys: ['geekbench'],
                  labels: ['Geekbench'],
                  barRatio: 0.4,
                  barColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
                  xLabelAngle: 35,
                  hideHover: 'auto',
                  resize: true
                });

            }   
            
            if ($('#graph_bar_group').length ){
            
                Morris.Bar({
                  element: 'graph_bar_group',
                  data: [
                    {"period": "2016-10-01", "licensed": 807, "sorned": 660},
                    {"period": "2016-09-30", "licensed": 1251, "sorned": 729},
                    {"period": "2016-09-29", "licensed": 1769, "sorned": 1018},
                    {"period": "2016-09-20", "licensed": 2246, "sorned": 1461},
                    {"period": "2016-09-19", "licensed": 2657, "sorned": 1967},
                    {"period": "2016-09-18", "licensed": 3148, "sorned": 2627},
                    {"period": "2016-09-17", "licensed": 3471, "sorned": 3740},
                    {"period": "2016-09-16", "licensed": 2871, "sorned": 2216},
                    {"period": "2016-09-15", "licensed": 2401, "sorned": 1656},
                    {"period": "2016-09-10", "licensed": 2115, "sorned": 1022}
                  ],
                  xkey: 'period',
                  barColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
                  ykeys: ['licensed', 'sorned'],
                  labels: ['Licensed', 'SORN'],
                  hideHover: 'auto',
                  xLabelAngle: 60,
                  resize: true
                });

            }
            
            if ($('#graphx').length ){
            
                Morris.Bar({
                  element: 'graphx',
                  data: [
                    {x: '2015 Q1', y: 2, z: 3, a: 4},
                    {x: '2015 Q2', y: 3, z: 5, a: 6},
                    {x: '2015 Q3', y: 4, z: 3, a: 2},
                    {x: '2015 Q4', y: 2, z: 4, a: 5}
                  ],
                  xkey: 'x',
                  ykeys: ['y', 'z', 'a'],
                  barColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
                  hideHover: 'auto',
                  labels: ['Y', 'Z', 'A'],
                  resize: true
                }).on('click', function (i, row) {
                    console.log(i, row);
                });

            }
            
            if ($('#graph_area').length ){
            
                Morris.Area({
                  element: 'graph_area',
                  data: [
                    {period: '2014 Q1', iphone: 2666, ipad: null, itouch: 2647},
                    {period: '2014 Q2', iphone: 2778, ipad: 2294, itouch: 2441},
                    {period: '2014 Q3', iphone: 4912, ipad: 1969, itouch: 2501},
                    {period: '2014 Q4', iphone: 3767, ipad: 3597, itouch: 5689},
                    {period: '2015 Q1', iphone: 6810, ipad: 1914, itouch: 2293},
                    {period: '2015 Q2', iphone: 5670, ipad: 4293, itouch: 1881},
                    {period: '2015 Q3', iphone: 4820, ipad: 3795, itouch: 1588},
                    {period: '2015 Q4', iphone: 15073, ipad: 5967, itouch: 5175},
                    {period: '2016 Q1', iphone: 10687, ipad: 4460, itouch: 2028},
                    {period: '2016 Q2', iphone: 8432, ipad: 5713, itouch: 1791}
                  ],
                  xkey: 'period',
                  ykeys: ['iphone', 'ipad', 'itouch'],
                  lineColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
                  labels: ['iPhone', 'iPad', 'iPod Touch'],
                  pointSize: 2,
                  hideHover: 'auto',
                  resize: true
                });

            }
            
            if ($('#graph_donut').length ){
            
                Morris.Donut({
                  element: 'graph_donut',
                  data: [
                    {label: 'Jam', value: 25},
                    {label: 'Frosted', value: 40},
                    {label: 'Custard', value: 25},
                    {label: 'Sugar', value: 10}
                  ],
                  colors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
                  formatter: function (y) {
                    return y + "%";
                  },
                  resize: true
                });

            }
            
            if ($('#graph_line').length ){
            
                Morris.Line({
                  element: 'graph_line',
                  xkey: 'year',
                  ykeys: ['value'],
                  labels: ['Value'],
                  hideHover: 'auto',
                  lineColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
                  data: [
                    {year: '2012', value: 20},
                    {year: '2013', value: 10},
                    {year: '2014', value: 5},
                    {year: '2015', value: 5},
                    {year: '2016', value: 20}
                  ],
                  resize: true
                });

                $MENU_TOGGLE.on('click', function() {
                  $(window).resize();
                });
            
            }
            
        };
