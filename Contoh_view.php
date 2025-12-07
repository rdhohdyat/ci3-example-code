<style>
  body,
  .form-control,
  label {
    color: #000
  }

  .section {
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    padding: 14px;
    margin: 14px 0;
    background: #fff
  }

  .btn-bar {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    justify-content: center;
    margin-top: 12px
  }

  .form-check-input {
    accent-color: #16a34a;
    margin-right: 6px
  }
</style>

<div class="row">
  <div class="col-sm-12">
    <div class="panel panel-default card-view">
      <div class="panel-heading">
        <h6 class="panel-title txt-dark">FORM HASIL USG KEBIDANAN</h6>
      </div>

      <div class="panel-wrapper collapse in">
        <div class="panel-body">

          <form id="formUsg" method="POST">
            <!-- Hidden relasi -->
            <input type="hidden" id="id_pelayanan" name="id_pelayanan" value="<?= $id_pelayanan ?>">
            <input type="hidden" id="id_history" name="id_history" value="<?= $id_history ?>">
            <input type="hidden" id="no_rm" name="no_rm" value="<?= $no_rm ?>">

            <!-- Header pasien -->
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label" for="nama_pasien">Nama Pasien</label>
                  <input type="text" class="form-control" id="nama_pasien" name="nama_pasien"
                    value="<?= $nama_pasien ?>" placeholder="Nama pasien" readonly>
                </div>
                <div class="form-group">
                  <label class="control-label" for="no_bpjs">No. BPJS</label>
                  <input type="text" class="form-control" id="no_bpjs" name="no_bpjs" value="<?= $no_bpjs ?>"
                    placeholder="No. BPJS (opsional)" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label" for="no_rm">No. Rekam Medis</label>
                  <input type="text" class="form-control" id="no_rm" name="no_rm"
                    value="<?= $no_rm ?>" placeholder="No. RM" readonly>
                </div>
                <div class="form-group">
                  <label class="control-label" for="usia">Usia</label>
                  <input type="text" class="form-control" id="usia" name="usia"
                    value="<?= $usia ?>" placeholder="cth: 28 th" readonly>
                </div>
              </div>
            </div>

            <!-- Bagian utama -->
            <div class="section">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label" for="tanggal_pemeriksaan">Tanggal Pemeriksaan</label>
                    <input type="date" class="form-control" id="tanggal_pemeriksaan" name="tanggal_pemeriksaan"
                      required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label" for="dokter_pemeriksa">Dokter Pemeriksa</label>
                    <select class="form-control select2" id="dokter_pemeriksa" name="dokter_pemeriksa">
                      <option value="">PILIH DOKTER</option>
                      <?php foreach ($dokter as $d): ?>
                        <?php
                        $value = strtolower($d->nama);
                        $selectedValue = strtolower($dokter_pemeriksa ?? '');
                        ?>
                        <option value="<?= $d->nama; ?>" <?= ($value === $selectedValue) ? 'selected' : ''; ?>>
                          <?= $d->nama; ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

            <div class="form-group">
              <label class="control-label d-block">Jenis Pemeriksaan</label>

              <div class="form-check form-check-inline">
                <input class="form-check-input" 
                      type="radio" 
                      name="jenis_pemeriksaan" 
                      id="jp1" 
                      value="Transabdominal">
                <label class="form-check-label" for="jp1">Transabdominal</label>
              </div>

              <div class="form-check form-check-inline">
                <input class="form-check-input" 
                      type="radio" 
                      name="jenis_pemeriksaan" 
                      id="jp2" 
                      value="Transvaginal">
                <label class="form-check-label" for="jp2">Transvaginal</label>
              </div>
            </div>

            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label" for="indikasi_pemeriksaan">Indikasi Pemeriksaan</label>
                  <textarea class="form-control" id="indikasi_pemeriksaan" name="indikasi_pemeriksaan" rows="4"
                    placeholder="Keluhan/indikasi klinis"></textarea>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label" for="hasil_pemeriksaan">Hasil Pemeriksaan</label>
                  <textarea class="form-control" id="hasil_pemeriksaan" name="hasil_pemeriksaan" rows="4"
                    placeholder="Ringkasan temuan USG"></textarea>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label" for="kesimpulan">Kesimpulan</label>
              <textarea class="form-control" id="kesimpulan" name="kesimpulan" rows="4"
                placeholder="Impresi/kesimpulan"></textarea>
            </div>

            <div class="btn-bar">
              <button type="button" onclick="history.back()" class="btn btn-default btn-anim">
                  <i class="fa fa-arrow-left"></i>
                  <span class="btn-text">KEMBALI</span>
              </button>

              <button type="button" onclick="simpan()" class="btn btn-success btn-anim" id="btnSimpan">
                <i class="fa fa-save"></i> <span class="btn-text">SIMPAN DATA</span>
              </button>

              <button type="button" class="btn btn-warning btn-anim btn-print-usg" onclick="print()" id="btnPrint" disabled>PRINT</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function () {
    id_history = $('#id_history').val();
    id_pelayanan = $('#id_pelayanan').val();

    $.ajax({
      url: "<?php echo base_url() ?>Erm_usg_kebidanan/get_usg_kebidanan",
      method: "POST",
      dataType: 'json',
      data: {
        id_pelayanan: id_pelayanan,
        id_history: id_history
      },
     success: function (data) {
        if (data.status == 'found') {
          const {
            tanggal_pemeriksaan,
            dokter_pemeriksa,
            indikasi_pemeriksaan,
            hasil_pemeriksaan,
            kesimpulan,
            jenis_pemeriksaan
          } = data.data;

          $('#tanggal_pemeriksaan').val(tanggal_pemeriksaan);
          $('#dokter_pemeriksa').val(dokter_pemeriksa).trigger('change');

          $('#indikasi_pemeriksaan').val(indikasi_pemeriksaan);
          $('#hasil_pemeriksaan').val(hasil_pemeriksaan);
          $('#kesimpulan').val(kesimpulan);

          $('input[name="jenis_pemeriksaan"]').each(function () {
            if ($(this).val().toLowerCase() === jenis_pemeriksaan.toLowerCase()) {
              $(this).prop('checked', true);
            }
          });

          $('#btnSimpan').html('<i class="fa fa-edit"></i> <span class="btn-text">Update Data</span>')
                        .removeClass('btn-success')
                        .addClass('btn-primary');

          $('#btnPrint').prop('disabled', false);
        }
      }
    });
  })

  function simpan() {
    id_pelayanan = $('#id_pelayanan').val();
    id_history = $('#id_history').val();
    nama_pasien = $('#nama_pasien').val();
    no_rm = $('#no_rm').val();
    no_bpjs = $('#no_bpjs').val();
    usia = $('#usia').val();
    jenis_pemeriksaan = $('input[name="jenis_pemeriksaan"]:checked').val();
    kesimpulan = $('#kesimpulan').val();
    indikasi_pemeriksaan = $('#indikasi_pemeriksaan').val();
    tanggal_pemeriksaan = $('#tanggal_pemeriksaan').val();
    hasil_pemeriksaan = $('#hasil_pemeriksaan').val();
    dokter_pemeriksa = $('#dokter_pemeriksa').val();

    dataString =
      'no_rm=' + no_rm +
      '&nama_pasien=' + nama_pasien +
      '&id_pelayanan=' + id_pelayanan +
      '&id_history=' + id_history +
      '&no_bpjs=' + no_bpjs +
      '&usia=' + usia +
      '&dokter_pemeriksa=' + dokter_pemeriksa +
      '&tanggal_pemeriksaan=' + tanggal_pemeriksaan +
      '&jenis_pemeriksaan=' + jenis_pemeriksaan +
      '&kesimpulan=' + kesimpulan +
      '&indikasi_pemeriksaan=' + indikasi_pemeriksaan +
      '&hasil_pemeriksaan=' + hasil_pemeriksaan;

    swal({
        title: "Simpan Data USG?",
        text: "Apakah kamu yakin ingin menyimpan data ini?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3cb878",
        confirmButtonText: "Ya, Simpan",
        cancelButtonText: "Batal",
        closeOnConfirm: false
    }, function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                url: "<?php echo base_url() ?>Erm_usg_kebidanan/save",
                method: "POST",
                dataType: 'json',
                data: dataString,
                success: function (response) {
                   if(response)
                    swal({
                        title: "Berhasil!",
                        text: response.message,
                        type: "success",
                        confirmButtonColor: "#3cb878"
                    });
                },
                error: function () {
                    swal("Gagal!", "Terjadi kesalahan saat menyimpan data", "error");
                }
            });
        }
    });
  }

  function print() {
      const id_pelayanan = $('#id_pelayanan').val();
      const id_history   = $('#id_history').val();

      swal({
          title: "Cetak Hasil USG Kebidanan?",
          text: "Apakah kamu yakin ingin mencetak?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3cb878",
          confirmButtonText: "Ya, Cetak",
          cancelButtonText: "Batal",
          closeOnConfirm: true
      }, function (isConfirm) {
          if (isConfirm) {
             window.open("<?= base_url('Erm_usg_kebidanan/print_usg/'.$id_pelayanan.'/'.$id_history) ?>", "_blank");
          }
      });
  }

</script>
