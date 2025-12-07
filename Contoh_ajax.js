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
