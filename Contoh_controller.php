<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contoh_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('M_Erm_poli');
        $this->load->model('M_Erm_usg_kebidanan');
    }

    public function form($id_pel, $id_his)
    {
        $id_pelayanan = base64_decode(urldecode($id_pel));
        $id_history = base64_decode(urldecode($id_his));

        $pasien = $this->M_Erm_poli->selectDataPasienPoliby_id($id_pelayanan, $id_history);

        if (!$pasien) {
            show_404();
            return;
        }

        $page_data['id_pelayanan'] = $pasien->id_pelayanan;
        $page_data['id_history'] = $pasien->id_history;
        $page_data['no_rm'] = $pasien->no_rm;
        $page_data['nama_pasien'] = $pasien->nama;
        $page_data['no_bpjs'] = $pasien->no_bpjs;
        $page_data['usia'] = $this->hitungUsia($pasien->tgl_lahir ?? null);

        $page_data['dokter'] = $this->db
            ->where('dokter_spes', 'OBG')
            ->where('status', 'AKTIF')
            ->order_by('nama', 'ASC')
            ->get('dokter')
            ->result();

        $this->load->view('assets/_header');
        $page_data['page_content'] = 'erm_form/Poli/hasil_usg_kebidanan';
        $this->load->view('Main', $page_data);
        $this->load->view('assets/_footer');
    }

    public function get_usg_kebidanan()
    {
        $id_pelayanan = $this->input->post('id_pelayanan', true);
        $id_history = $this->input->post('id_history', true);

        $data = $this->M_Erm_usg_kebidanan->get_data_usg($id_pelayanan, $id_history);

        if ($data) {
            echo json_encode([
                'status' => 'found',
                'data' => $data
            ]);
        } else {
            echo json_encode([
                'status' => 'not found'
            ]);
        }
    }

    public function save()
    {
        $id_pelayanan = $this->input->post('id_pelayanan', true);
        $id_history = $this->input->post('id_history', true);

        $data = [
            'id_pelayanan' => $id_pelayanan,
            'id_history' => $id_history,
            'nama_pasien' => $this->input->post('nama_pasien', true),
            'no_bpjs' => $this->input->post('no_bpjs', true),
            'no_rm' => $this->input->post('no_rm', true),
            'usia' => $this->input->post('usia', true),
            'tanggal_pemeriksaan' => $this->input->post('tanggal_pemeriksaan', true),
            'dokter_pemeriksa' => $this->input->post('dokter_pemeriksa', true),
            'jenis_pemeriksaan' => $this->input->post('jenis_pemeriksaan', true),
            'indikasi_pemeriksaan' => $this->input->post('indikasi_pemeriksaan', true),
            'hasil_pemeriksaan' => $this->input->post('hasil_pemeriksaan', true),
            'kesimpulan' => $this->input->post('kesimpulan', true),
        ];

        $usg_kebidanan = $this->M_Erm_usg_kebidanan->get_data_usg($id_pelayanan, $id_history);

        if ($usg_kebidanan) {
            $this->M_Erm_usg_kebidanan->update($id_pelayanan, $id_history, $data);

            echo json_encode([
                'status' => 'success',
                'type' => 'update',
                'message' => 'Data USG berhasil diperbarui'
            ]);
        } else {
            $this->M_Erm_usg_kebidanan->insert($data);

            echo json_encode([
                'status' => 'success',
                'type' => 'insert',
                'message' => 'Data USG berhasil disimpan'
            ]);
        }
    }

    public function print_usg($id_pelayanan, $id_history)
    {
        $data['usg_kebidanan'] = $this->M_Erm_usg_kebidanan
            ->get_data_usg($id_pelayanan, $id_history);

        if (!$data['usg_kebidanan']) {
            show_404();
        }

        $this->load->view('erm_print/hasil_usg_kebidanan', $data);
    }

    private function hitungUsia($tgl_lahir)
    {
        if (!$tgl_lahir)
            return '-';
        $birth = new DateTime($tgl_lahir);
        $now = new DateTime('today');
        return $birth->diff($now)->y . ' tahun';
    }
}
