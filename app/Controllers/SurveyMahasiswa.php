<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class SurveyMahasiswa extends Controller
{
    public function dosen()
    {
        $session = session();
        $username = $session->get('username');
        if (!$session->get('logged_in')) {
            return redirect()->to('/');
        }

        if ($session->get('level') !== "Mahasiswa") {
            return redirect()->to('/dashboard/' . $session->get('level'));
        }

        $db = db_connect();

        $user = $db->table('users')->where('username', $username)->get()->getRow();
        $kdKelas = $user->KdKelas;

        $dosenQuery = $db->query("SELECT DISTINCT d.NID, d.Nama, mk.KdMk, mk.ThnAjaran, m.NmMk
	        FROM matriks mk
            JOIN dosen d ON mk.KdDosen = d.NID
            LEFT JOIN matakuliah m ON m.KdMk = mk.KdMK
            WHERE mk.kdKelas = ?
            AND d.NID NOT IN (
                SELECT hs.NID FROM hasil hs WHERE hs.NIM = ?
                AND hs.NID = mk.KdDosen
                AND hs.KdMatakuliah = mk.KdMk
                AND hs.TahunAkademik = mk.ThnAjaran
            )", [$kdKelas, $username]);

        $dosenList = $dosenQuery->getResult();

        $pertanyaan = $db->query("
            SELECT k.KdKuisioner, k.pertanyaan, kt.Jenis_Kuisioner
            FROM kuisioner k
            JOIN kategori kt ON k.KdKategori = kt.KdKategori
            WHERE kt.Jenis_Kuisioner = 'Kinerja Dosen'
        ")->getResult();

        return view('survey/mahasiswa/dosen', [
            'username' => $session->get('username'),
            'semester' => $session->get('semester'),
            'level'    => $session->get('level'),
            'dosenList'   => $dosenList,
            'pertanyaan'  => $pertanyaan
        ]);
    }

    public function submitDosen()
    {
        $session = session();
        $username = $session->get('username');
        $semester = $session->get('semester');
        $level = $session->get('level');

        $post = $this->request->getPost();

        if (empty($post['dosen_info']) || empty($post['jawaban']) || !is_array($post['jawaban'])) {
            return redirect()->back()->with('error', 'Form tidak lengkap.');
        }

        $parts = explode('|', $post['dosen_info']);
        if (count($parts) !== 3) {
            return redirect()->back()->with('error', 'Data dosen tidak valid.');
        }

        [$nid, $kdMk, $tahunAjaran] = $parts;

        $db = db_connect();
        $existing = $db->table('hasil')
            ->where([
                'NIM'            => $username,
                'NID'            => $nid,
                'KdMatakuliah'   => $kdMk,
                'TahunAkademik'  => $tahunAjaran
            ])
            ->countAllResults();

        if ($existing > 0) {
            return redirect()->to('/dashboard/Mahasiswa/survey-dosen')->with('error', 'Anda sudah mengisi survey untuk dosen ini.');
        }

        $builder = $db->table('hasil');

        foreach ($post['jawaban'] as $idKuisioner => $jawaban) {
            $builder->insert([
                'NIM'           => $username,
                'semester'      => $semester,
                'NID'           => $nid,
                'KdMatakuliah'  => $kdMk,
                'TahunAkademik' => $tahunAjaran,
                'KdKuisioner'   => $idKuisioner,
                'Nilai'         => $jawaban,
            ]);
        }

        return redirect()->to('/dashboard/Mahasiswa/survey-dosen')->with('success', 'Survey berhasil dikirim.');
    }


    public function prasarana()
    {
        $session = session();
        $username = $session->get('username');

        $db = db_connect();

        $kuisioner = $db->query("
            SELECT q.KdKuisioner, q.Pertanyaan
            FROM kuisioner q
            JOIN kategori k ON q.KdKategori = k.KdKategori
            WHERE k.Jenis_Kuisioner = 'Manajemen Prodi'
        ")->getResult();

        $answered = 0;

        if(count($kuisioner) != 0){
            $answered = $db->table('hasil')
                ->where('NIM', $username)
                ->whereIn('KdKuisioner', array_column($kuisioner, 'KdKuisioner'))
                ->countAllResults();
        }

        $sudahIsi = $answered >= count($kuisioner);

        return view('survey/mahasiswa/prasarana', [
            'username' => $session->get('username'),
            'semester' => $session->get('semester'),
            'level'    => $session->get('level'),
            'sudahIsi'   => $sudahIsi,
            'pertanyaan' => $kuisioner
        ]);
    }

    public function submitPrasarana()
    {
        $session = session();
        $username = $session->get('username');
        $semester = $session->get('semester');

        $post = $this->request->getPost();

        if (empty($post['jawaban']) || !is_array($post['jawaban'])) {
            return redirect()->back()->with('error', 'Form tidak lengkap.');
        }

        $builder = db_connect()->table('hasil');

        foreach ($post['jawaban'] as $idKuisioner => $jawaban) {
            $builder->insert([
                'NIM'           => $username,
                'semester'      => $semester,
                'NID'           => "",
                'KdMatakuliah'  => "",
                'TahunAkademik' => "",
                'KdKuisioner'   => $idKuisioner,
                'Nilai'         => $jawaban,
            ]);
        }

        return redirect()->to('/dashboard/Mahasiswa/survey-prasarana')->with('success', 'Survey berhasil dikirim.');
    }

    public function visiMisi()
    {
        $session = session();
        $username = $session->get('username');

        $db = db_connect();

        $kuisioner = $db->query("
            SELECT q.KdKuisioner, q.Pertanyaan
            FROM kuisioner q
            JOIN kategori k ON q.KdKategori = k.KdKategori
            WHERE k.Jenis_Kuisioner = 'Visi Misi'
        ")->getResult();

        $answered = 0;

        if(count($kuisioner) != 0){
            $answered = $db->table('hasil')
                ->where('NIM', $username)
                ->whereIn('KdKuisioner', array_column($kuisioner, 'KdKuisioner'))
                ->countAllResults();
        }

        $sudahIsi = $answered >= count($kuisioner);

        return view('survey/mahasiswa/visi_misi', [
            'username' => $session->get('username'),
            'semester' => $session->get('semester'),
            'level'    => $session->get('level'),
            'sudahIsi'   => $sudahIsi,
            'pertanyaan' => $kuisioner
        ]);
    }

    public function submitVisiMisi()
    {
        $session = session();
        $username = $session->get('username');
        $semester = $session->get('semester');

        $post = $this->request->getPost();

        if (empty($post['jawaban']) || !is_array($post['jawaban'])) {
            return redirect()->back()->with('error', 'Form tidak lengkap.');
        }

        $builder = db_connect()->table('hasil');

        foreach ($post['jawaban'] as $idKuisioner => $jawaban) {
            $builder->insert([
                'NIM'           => $username,
                'semester'      => $semester,
                'NID'           => "",
                'KdMatakuliah'  => "",
                'TahunAkademik' => "",
                'KdKuisioner'   => $idKuisioner,
                'Nilai'         => $jawaban,
            ]);
        }

        return redirect()->to('/dashboard/Mahasiswa/visi-misi')->with('success', 'Survey berhasil dikirim.');
    }
}
