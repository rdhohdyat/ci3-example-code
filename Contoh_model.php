<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Erm_usg_kebidanan extends CI_Model
{
    private $table = 'hasil_usg_kebidanan';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_data_usg($id_pelayanan, $id_history)
    {
        $this->db->select("
        usg.*, 
        p.nama AS nama_pasien, 
        p.no_rm, 
        p.tgl_lahir, 
        p.no_bpjs,
        d.nama AS dokter_dpjp,
        d.foto
    ");
        $this->db->from("hasil_usg_kebidanan usg");
        $this->db->join("history_pelayanan h", "usg.id_history = h.id_history", "left");
        $this->db->join("pasien p", "usg.no_rm = p.no_rm", "left");
        $this->db->join("dokter d", "h.dpjp = d.id_dokter", "left");

        $this->db->where("usg.id_history", $id_history);
        $this->db->where("usg.id_pelayanan", $id_pelayanan);

        return $this->db->get()->row();
    }

    public function insert($data)
    {
        if (empty($data)) {
            return false;
        }

        $this->db->insert($this->table, $data);

        if ($this->db->affected_rows() > 0) {
            $this->db->trans_commit();
            return $data['id']; // kembalikan id usg123
        }
    }


    public function update($id_pelayanan, $id_history, $data)
    {
        if (empty($data)) {
            return false;
        }

        $this->db->where('id_pelayanan', $id_pelayanan);
        $this->db->where('id_history', $id_history);

        $this->db->update($this->table, $data);

        if ($this->db->affected_rows() >= 0) {
            return true;
        }

        return false;
    }
}
