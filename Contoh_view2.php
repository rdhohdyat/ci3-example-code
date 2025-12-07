<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <!-- Header -->
            <div class="panel-heading">
                <div class="pull-left">
                    <h1 class="panel-title txt-dark">Lembar Konsul Antar DPJP</h1>
                </div>
                <div class="clearfix"></div>
            </div>

            <hr>

            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="form-wrap">
                        <!-- Dokter -->
                        <div class="form-group row">
                            <label class="col-md-2 control-label text-left">
                                <strong>Kepada Yth. TS. Dokter:</strong>
                            </label>
                            <div class="col-md-6 has-success">
                                <select class="form-control select2" id="id_dokter" name="id_dokter">
                                    <option value="">PILIH DOKTER</option>
                                    <?php foreach ($dokter as $d): ?>
                                        <option value="<?= $d->id_dokter; ?>" data-spes="<?= $d->dokter_spes; ?>">
                                            <?= $d->nama; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <!-- Poli -->
                        <div class="form-group row">
                            <label class="col-md-2 control-label text-left">
                                <strong>Poli Tujuan:</strong>
                            </label>
                            <div class="col-md-6 has-success">
                                <select class="form-control select2" id="id_list_poli" name="id_list_poli">
                                    <option value="">PILIH POLI</option>
                                    <?php foreach ($list_poli as $p): ?>
                                        <option value="<?= $p->id_list_poli; ?>"
                                            data-spes="<?= htmlspecialchars($p->kdpoli_bpjs); ?>">
                                            <?= $p->nama_panjang; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>


                        <!-- Info Pasien -->
                        <div class="form-group row">
                            <label class="col-md-12 control-label text-left">
                                <strong>Mohon konsultasi pasien berikut:</strong>
                            </label>
                        </div>

                        <input type="hidden" id="inPel" value="<?= $id_pelayanan ?>">
                        <input type="hidden" id="inHis" value="<?= $id_history ?>">
                        <input type="hidden" id="inNoRM" value="<?= $no_rm ?>">
                        <input type="hidden" id="inIdFormRujukan">

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="control-label text-left">Nama</label>
                                <input type="text" disabled class="form-control" value="<?= $nama ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="control-label text-left">Umur</label>
                                <input type="text" disabled class="form-control" value="<?php
                                $tanggal = new DateTime($tgl_lahir);
                                $today = new DateTime();
                                echo $today->diff($tanggal)->y . ' tahun';
                                ?>">
                            </div>
                        </div>

                        <!-- Diagnosis -->
                        <div class="form-group row">
                            <label class="col-md-2 control-label text-left">Diagnosis</label>

                            <div class="col-md-6 has-success">
                                <div class="input-group">
                                    <input type="text" id="diagnosis" class="form-control typeahead"
                                        placeholder="Cari Diagnosa (Kode/Nama Diagnosa)">

                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Keluhan Utama -->
                        <div class="form-group row">
                            <label class="col-md-2 control-label text-left">Keluhan</label>
                            <div class="col-md-6 has-success">
                                <span id="keluhan_error" class="text-danger"></span>
                                <textarea id="keluhan" class="form-control" rows="4"></textarea>
                            </div>
                        </div>

                        <!-- Terapi -->

                        <div class="form-group row">
                            <label class="col-md-2 control-label text-left">Terapi Yang Telah Diberikan</label>
                            <div class="col-md-6 has-success">
                                <span id="terapi_error" class="text-danger"></span>
                                <textarea id="terapi" class="form-control" rows="4"></textarea>
                            </div>
                        </div>

                        <!-- Riwayat Penyakit -->
                        <div class="form-group row">
                            <label class="col-md-2 control-label text-left">Riwayat Penyakit</label>
                            <div class="col-md-6 has-success">
                                <span id="riwayat_penyakit_error" class="text-danger"></span>
                                <textarea id="riwayat_penyakit" class="form-control" rows="4"></textarea>
                            </div>
                        </div>

                        <!-- Penutup -->
                        <div class="form-group row" style="margin-top: 0px;">
                            <label class="col-md-12 control-label text-left">
                                <strong>Mohon konsul dan penanganan selanjutnya. Terima kasih atas bantuan dan kerja
                                    samanya.</strong>
                            </label>
                        </div>

                        <!-- Respon Dokter -->
                        <?php if ($is_dokter): ?>
                            <div class="form-group row" id="respon_wrapper" style="margin-top:15px; display:none;">
                                <label class="col-md-2 control-label text-left">
                                    <strong>Respon Dokter</strong>
                                </label>
                                <div class="col-md-6">

                                    <label class="radio-inline">
                                        <input type="radio" name="respon_dokter" value="terima" id="rd_terima">
                                        Terima
                                    </label>

                                    <label class="radio-inline">
                                        <input type="radio" name="respon_dokter" value="tolak" id="rd_tolak">
                                        Tolak
                                    </label>
                                </div>
                            </div>

                            <!-- Balasan Dokter -->
                            <div class="form-group row" id="balasan_wrapper" style="display:none;">
                                <label class="col-md-2 control-label text-left">
                                    Balasan
                                </label>
                                <div class="col-md-6  has-success">
                                    <textarea id="balasan" name="balasan" class="form-control" rows="4"
                                        placeholder="Masukkan balasan dokter..."></textarea>
                                </div>
                            </div>
                        <?php endif ?>


                        <!-- Tombol -->
                        <div class="form-group row">
                            <div class="col-md-6">
                                <a href="javascript:history.back()" class="btn btn-default btn-anim">
                                    <i class="fa fa-arrow-left"></i>
                                    <span class="btn-text">KEMBALI</span>
                                </a>

                                <?php if (!$is_dokter): ?>
                                    <button style="margin-left: 10px;" type="button" class="btn btn-success btn-anim"
                                        onclick="simpan()">
                                        <i class="icon-rocket"></i>
                                        <span class="btn-text">SIMPAN</span>
                                    </button>
                                <?php else: ?>
                                    <button style="margin-left: 10px;" type="button" class="btn btn-success btn-anim d-none"
                                        onclick="kirim_balasan()" disabled id="btnKirim">
                                        <i class="icon-rocket"></i>
                                        <span class="btn-text">KIRIM BALASAN</span>
                                    </button>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Riwayat -->
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="table-wrap">
                        <div class="table-responsive">
                            <table id="tabel_terapi" class="table table-hover display pb-30">
                                <thead>
                                    <tr class="bg-success">
                                        <?php if ($is_dokter): ?>
                                            <th style="width: 5%;">PILIH</th>
                                        <?php else: ?>
                                            <th style="width: 5%;">HAPUS</th>
                                        <?php endif ?>
                                        <th style="width: 5%;">CETAK</th>
                                        <th style="width: 10%;">PASIEN</th>
                                        <th style="width: 10%;">USIA</th>
                                        <th style="width: 10%;">TANGGAL & JAM</th>
                                        <th style="width: 10%;">DOKTER</th>
                                        <th style="width: 10%;">POLI</th>
                                        <th style="width: 30%;">DIAGNOSA</th>
                                        <th style="width: 30%;">KELUHAN UTAMA</th>
                                        <th style="width: 30%;">STATUS</th>
                                        <th style="width: 30%;">BALASAN</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr class="bg-success">
                                        <?php if ($is_dokter): ?>
                                            <th>PILIH</th>
                                        <?php else: ?>
                                            <th>HAPUS</th>
                                        <?php endif ?>
                                        <th>CETAK</th>
                                        <th>PASIEN</th>
                                        <th>USIA</th>
                                        <th>TANGGAL & JAM</th>
                                        <th>DOKTER</th>
                                        <th>POLI</th>
                                        <th>DIAGNOSA</th>
                                        <th>KELUHAN UTAMA</th>
                                        <th>STATUS</th>
                                        <th>BALASAN</th>
                                    </tr>
                                </tfoot>
                                <tbody style="color: black;"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .ui-autocomplete {
        max-height: 100px;
        overflow-y: auto;
        overflow-x: hidden;
        z-index: 9999 !important;
        background: white;
        border-radius: 6px;
    }

    .d-none {
        display: none;
    }
</style>

<link rel="stylesheet" href="<?php echo base_url('assets/dist/jquery-ui.css'); ?>">
<script src="<?php echo base_url('assets/dist/jquery-ui.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/dist/jquery-ui.js'); ?>"></script>
<script>
    $(document).ready(function () {
        $('#id_list_poli').prop('disabled', true).trigger('change');

        function normalize(text) {
            return text
                .toString()
                .toLowerCase()
                .replace(/\s+/g, '') 
                .trim();
        }


        $('#id_dokter').on('change', function () {

            const selectedDokter = $(this).find(':selected');
            let spesDokter = selectedDokter.data('spes');

            $('#id_list_poli').val('').prop('disabled', true).trigger('change');

            if (!spesDokter) return;

            spesDokter = normalize(spesDokter);

            console.log('SPES DOKTER:', spesDokter);

            let found = false;

            $('#id_list_poli option').each(function () {

                let spesPoli = $(this).data('spes');
                if (!spesPoli) return;

                spesPoli = normalize(spesPoli);

                if (spesPoli.includes(spesDokter) || spesDokter.includes(spesPoli)) {

                    $('#id_list_poli')
                        .prop('disabled', false)
                        .val($(this).val())
                        .trigger('change');

                    found = true;
                    return false;
                }
            });

            if (!found) {
                console.warn('Poli TIDAK DITEMUKAN untuk:', spesDokter);
                $('#id_list_poli').prop('disabled', false).trigger('change');
            }

        });

    });
</script>


<script type="text/javascript">
    $(document).ready(function () {
        $('#balasan').on('input', function () {
            if ($(this).val().trim().length > 0) {
                $('#btnKirim').prop('disabled', false);
            } else {
                $('#btnKirim').prop('disabled', true);
            }
        });

        $('input[name="respon_dokter"]').on('change', function () {
            $('#balasan_wrapper').fadeIn();
        });

        id = $('#inHis').val();
        id_pelayanan = $('#inPel').val();

        reload_data_id_pel(id_pelayanan);

        $.ajax({
            url: "<?php echo base_url() ?>Erm_dpjp/get_data_awal",
            method: "POST",
            dataType: 'json',
            data: {
                id: id
            },
            success: function (data) {
                if (data.status == 'found') {
                    $('#terapi').val(data.terapi);
                    $('#riwayat_penyakit').val(data.riwayat);
                    $('#keluhan').val(data.keluhan);
                }
            }
        });

        $.ajax({
            url: "<?php echo base_url() ?>Erm_dpjp/get_all_diagnosa",
            method: "GET",
            dataType: 'json',
            success: function (data) {
                let diagnosaList = [];

                $.each(data, function (i, val) {
                    diagnosaList.push({
                        label: val.id_diagnosa + ' | ' + val.nama_diagnosa,
                        value: val.id_diagnosa + ' | ' + val.nama_diagnosa
                    });
                });

                $("#diagnosis").autocomplete({
                    source: diagnosaList,
                    minLength: 2,
                    autoFocus: true,
                    select: function (event, ui) {
                        $("#diagnosis").val(ui.item.value);
                        return false;
                    }
                });
            }
        });
    });

    function select_konsul(id_lembar_konsul) {
        $.ajax({
            url: "<?= base_url() ?>Erm_dpjp/get_lembar_konsul",
            method: "POST",
            dataType: "json",
            data: { id: id_lembar_konsul },
            success: function (data) {
                $('#respon_wrapper').fadeIn();
                $('#balasan_wrapper').fadeIn();
                $('#btnKirim').removeClass('d-none');

                const {
                    id_form_lembar_rujukan,
                    terapi,
                    riwayat_penyakit,
                    keluhan,
                    diagnosis,
                    verifikasi,
                    balasan,
                    id_dokter,
                    id_list_poli
                } = data.lembar_konsul;

                $('#terapi').val(terapi).prop('readonly', true);
                $('#riwayat_penyakit').val(riwayat_penyakit).prop('readonly', true);
                $('#keluhan').val(keluhan).prop('readonly', true);
                $('#diagnosis').val(diagnosis).prop('readonly', true);
                $('#balasan').val(balasan);

                $('input[name="respon_dokter"]').prop('checked', false);

                if (verifikasi === 'terima' || verifikasi === '1' || verifikasi === 1) {
                    $('input[name="respon_dokter"][value="terima"]').prop('checked', true);
                }
                else if (verifikasi === 'tolak' || verifikasi === '0' || verifikasi === 0) {
                    $('input[name="respon_dokter"][value="tolak"]').prop('checked', true);
                }

                $('#inIdFormRujukan').val(id_form_lembar_rujukan);

                $('#id_dokter').val(id_dokter).trigger('change').prop('disabled', true);

                $('#id_list_poli').val(id_list_poli).trigger('change').prop('disabled', true);

                // Biar tetap terkirim saat submit
                if (!$('#hidden_id_dokter').length) {
                    $('<input>').attr({
                        type: 'hidden',
                        id: 'hidden_id_dokter',
                        name: 'id_dokter',
                        value: id_dokter
                    }).appendTo('form');
                } else {
                    $('#hidden_id_dokter').val(id_dokter);
                }

                if (!$('#hidden_id_list_poli').length) {
                    $('<input>').attr({
                        type: 'hidden',
                        id: 'hidden_id_list_poli',
                        name: 'id_list_poli',
                        value: id_list_poli
                    }).appendTo('form');
                } else {
                    $('#hidden_id_list_poli').val(id_list_poli);
                }
            }
        });
    }

    function kirim_balasan() {
        const balasan = $('#balasan').val().trim();
        const respon = $('input[name="respon_dokter"]:checked').val();
        const id_history = $('#inHis').val();
        const id_pelayanan = $('#inPel').val();
        const no_rm = $('#inNoRM').val();
        const id_form_lembar_rujukan = $('#inIdFormRujukan').val();

        const id_dokter = $('#hidden_id_dokter').val() || $('#id_dokter').val();
        const id_list_poli = $('#hidden_id_list_poli').val() || $('#id_list_poli').val();

        if (!respon) {
            alert("Pilih respon dokter (Terima / Tidak)");
            return;
        }

        if (balasan.length === 0) {
            alert("Balasan wajib diisi.");
            return;
        }

        $('#btnKirim')
            .prop('disabled', true)

        swal({
            title: "Apakah kamu yakin?",
            text: "Kirim balasan konsultasi",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3cb878",
            confirmButtonText: "Yakin",
            cancelButtonText: "Batal",
            showLoaderOnConfirm: true,
            closeOnConfirm: false
        }, function (isConfirm) {

            if (!isConfirm) {
                $('#btnKirim').prop('disabled', false).html(`
                <i class="icon-rocket"></i>
                <span class="btn-text">KIRIM BALASAN</span>
            `);
                return;
            }

            $.ajax({
                url: "<?= base_url() ?>Erm_dpjp/kirim_balasan",
                method: "POST",
                dataType: "json",
                data: {
                    id_form_lembar_rujukan: id_form_lembar_rujukan,
                    id_history: id_history,
                    id_pelayanan: id_pelayanan,
                    id_dokter: id_dokter,
                    id_list_poli: id_list_poli,
                    no_rm: no_rm,
                    respon_dokter: respon,
                    balasan: balasan
                },
                success: function (res) {

                    if (res.status === "success") {
                        swal("Sukses", "Balasan berhasil dikirim", "success");

                        reload_data_id_pel(id_pelayanan);

                        // reset form
                        $('#balasan').val('');
                        $('input[name="respon_dokter"]').prop('checked', false);

                        // button dikunci lagi
                        $('#btnKirim')
                            .prop('disabled', true)
                            .html(`
                            <i class="icon-rocket"></i>
                            <span class="btn-text">KIRIM BALASAN</span>
                        `);

                        $('#balasan_wrapper').hide();
                        $('#respon_wrapper').hide();

                    } else {
                        swal("Gagal", res.message || "Gagal mengirim balasan", "error");

                        $('#btnKirim')
                            .prop('disabled', false)
                            .html(`
                            <i class="icon-rocket"></i>
                            <span class="btn-text">KIRIM BALASAN</span>
                        `);
                    }
                },
                error: function () {
                    swal("Error", "Terjadi kesalahan server", "error");

                    $('#btnKirim')
                        .prop('disabled', false)
                        .html(`
                        <i class="icon-rocket"></i>
                        <span class="btn-text">KIRIM BALASAN</span>
                    `);
                }
            });
        });
    }

    function reload_data_id_pel(id_pelayanan) {
        $('#tabel_terapi').dataTable().fnClearTable();
        $('#tabel_terapi').dataTable().fnDestroy();

        $('#tabel_terapi').DataTable({
            "language": {
                "sEmptyTable": "Tidak ada data yang tersedia pada tabel ini",
                "sProcessing": "Sedang memproses...",
                "sLengthMenu": "Tampilkan _MENU_ entri",
                "sZeroRecords": "Tidak ditemukan data yang sesuai",
                "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                "sSearch": "Cari:",
                "oPaginate": {
                    "sFirst": "Pertama",
                    "sPrevious": "Sebelumnya",
                    "sNext": "Selanjutnya",
                    "sLast": "Terakhir"
                }
            },
            "ajax": {
                "url": "<?php echo base_url('Erm_dpjp/tampil_list'); ?>",
                "type": "POST",
                "data": {
                    id_pelayanan: id_pelayanan
                },
                "dataSrc": function (json) {
                    if (!json || !json.data) {
                        console.warn('DataTables: tidak ada data yang dikembalikan.');
                        return [];
                    }
                    return json.data;
                },
                "error": function (xhr, error, thrown) {
                    $('#tabel_terapi').html(
                        '<tr><td colspan="10" class="text-center text-danger">Gagal memuat data. Silakan coba lagi.</td></tr>'
                    );
                }
            },
            "deferRender": true,
            "processing": true,
            "order": [4],
            "columnDefs": [
                {
                    "targets": [0, 1],
                    "orderable": false
                }
            ],
        });
    }

    function hapus_lembar_konsul(id_lembar_konsul) {
        swal({
            title: "Keterangan Penghapusan",
            text: "Silakan isi alasan penghapusan lembar konsul:",
            type: "input",
            input: "textarea",
            showCancelButton: true,
            confirmButtonColor: "#3cb878",
            confirmButtonText: "Hapus",
            cancelButtonText: "Batal",
            showLoaderOnConfirm: true,
            closeOnConfirm: false
        }, function (keterangan) {

            if (keterangan === false) return false;

            if (!keterangan || keterangan.trim() === "") {
                swal.showInputError("Keterangan wajib diisi!");
                return false;
            }

            $.ajax({
                url: "<?php echo base_url() ?>Erm_dpjp/hapus_lembar_konsul/" + id_lembar_konsul,
                method: "POST",
                dataType: "json",
                data: {
                    id_lembar_konsul: id_lembar_konsul,
                    keterangan: keterangan
                },

                success: function (data) {
                    if (data.status === "success") {
                        swal({
                            title: "Berhasil!",
                            type: "success",
                            text: "Data berhasil dihapus",
                            confirmButtonColor: "#3cb878"
                        });
                        $('#tabel_terapi').DataTable().ajax.reload();
                    } else {
                        swal({
                            title: "Gagal!",
                            type: "warning",
                            text: data.message,
                            confirmButtonColor: "#3cb878"
                        });
                    }
                },

                error: function () {
                    swal({
                        title: "Error!",
                        type: "error",
                        text: "Tidak dapat menghapus data",
                        confirmButtonColor: "#3cb878"
                    });
                }
            });

        });

        return false;
    }

    function print_lembar_konsul(id_lembar_konsul) {
        swal({
            title: "Cetak Lembar Konsul?",
            text: "Apakah kamu yakin ingin mencetak?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3cb878",
            confirmButtonText: "Ya, Cetak",
            cancelButtonText: "Batal",
            closeOnConfirm: true
        }, function (isConfirm) {
            if (isConfirm) {
                window.open("<?php echo base_url('Erm_dpjp/print_lembar_konsul/'); ?>" + id_lembar_konsul, "_blank");
            }
        });
    }

    function simpan() {
        id_pelayanan = $('#inPel').val();
        id_history = $('#inHis').val();
        no_rm = $('#inNoRM').val();
        id_dokter = $('#id_dokter').val();
        id_list_poli = $('#id_list_poli').val();

        diagnosis = $('#diagnosis').val();
        terapi = $('#terapi').val();
        keluhan = $('#keluhan').val();
        riwayat_penyakit = $('#riwayat_penyakit').val();

        dataString =
            'no_rm=' + no_rm +
            '&id_pelayanan=' + id_pelayanan +
            '&id_dokter=' + id_dokter +
            '&id_list_poli=' + id_list_poli +
            '&id_history=' + id_history +
            '&diagnosis=' + diagnosis +
            '&terapi=' + terapi +
            '&riwayat_penyakit=' + riwayat_penyakit +
            '&keluhan=' + keluhan;

        swal({
            title: "Apakah kamu yakin?",
            text: "Menambahkan lembar konsul baru",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3cb878",
            confirmButtonText: "Yakin",
            cancelButtonText: "Batal",
            showLoaderOnConfirm: true,
            closeOnConfirm: false
        }, function (isConfirm) {

            if (!isConfirm) return false;

            $.ajax({
                url: "<?php echo base_url() ?>Erm_dpjp/insert_lembar_rujukan",
                method: "POST",
                dataType: 'json',
                data: dataString,

                success: function (data) {
                    if (data.status === "success") {

                        reload_data_id_pel(id_pelayanan);

                        swal({
                            title: "Berhasil!",
                            text: "Data berhasil disimpan. Apakah ingin kembali ke halaman sebelumnya?",
                            type: "success",
                            showCancelButton: true,
                            confirmButtonColor: "#3cb878",
                            confirmButtonText: "Ya, pindah halaman",
                            cancelButtonText: "Tetap di sini",
                            closeOnConfirm: false
                        }, function (isConfirm) {
                            if (isConfirm) {
                                window.location.href = "<?= $url ?>";
                            } else {
                                swal.close();
                            }
                        });

                    } else if (data.error) {

                        $('#tempat_error').html(data.tempat || '');
                        $('#riwayat_penyakit_error').html(data.riwayat_penyakit || '');
                        $('#diagnosis_error').html(data.diagnosis || '');
                        $('#terapi_error').html(data.terapi || '');
                        $('#tempat1_error').html(data.tempat1 || '');
                        $('#hasil_periksa_error').html(data.hasil_periksa || '');
                        $('#terapi1_error').html(data.terapi1 || '');
                        $('#saran_error').html(data.saran || '');

                        swal.close();

                    } else {

                        swal({
                            title: "Gagal!",
                            type: "warning",
                            text: data.status,
                            confirmButtonColor: "#3cb878"
                        });
                    }
                },

                error: function () {
                    swal({
                        title: "Error!",
                        text: "Tidak dapat terhubung ke server.",
                        type: "error",
                        confirmButtonColor: "#3cb878"
                    });
                }
            });
        });

        return false;
    }
</script>
