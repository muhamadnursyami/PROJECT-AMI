<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FormEDSeeder extends Seeder
{
    public function run()
    {

        $data_form = [
            [
                "uuid" => service('uuid')->uuid4()->toString(),
                "id_indikator" => 1,
                "id_prodi" => 1,
                "standar" => "Kondisi Eksternal",
                "kriteria" => "Konsistensi dengan hasil analisis SWOT dan/atau analisis lain serta rencana",
            ],
            [
                "uuid" => service('uuid')->uuid4()->toString(),
                "id_indikator" => 2,
                "id_prodi" => 1,
                "standar" => "Profil Unit Pengelola Program Studi",
                "kriteria" => "Keserbacakupan informasi dalam profil dan konsistensi antara profil dengan data dan informasi yang disampaikan pada masing-masing kriteria, serta menunjukkan iklim yang kondusif untuk pengembangan dan reputasi sebagai rujukan di bidang keilmuannya",

            ],
            [
                "uuid" => service('uuid')->uuid4()->toString(),
                "id_indikator" => 3,
                "id_prodi" => 1,
                "standar" => "C.1.4. Indikator Kinerja Utama",
                "kriteria" => "Kesesuaian Visi, Misi, Tujuan dan Strategi (VMTS) Unit Pengelola Program Studi (UPPS) terhadap VMTS Perguruan Tinggi (PT) dan visi keilmuan Program Studi (PS) yang dikelolanya.",

            ],
            [
                "uuid" => service('uuid')->uuid4()->toString(),
                "id_indikator" => 4,
                "id_prodi" => 1,
                "standar" => "C.1.4. Indikator Kinerja Utama",
                "kriteria" => "Mekanisme dan keterlibatan pemangku kepentingan dalam penyusunan VMTS UPPS.",

            ],
            [
                "uuid" => service('uuid')->uuid4()->toString(),
                "id_indikator" => 5,
                "id_prodi" => 1,
                "standar" => "C.1.4. Indikator Kinerja Utama",
                "kriteria" => "Strategi pencapaian tujuan disusun berdasarkan analisis yang sistematis, serta pada pelaksanaannya dilakukan pemantauan dan evaluasi yang ditindaklanjuti. ",

            ],
            [
                "uuid" => service('uuid')->uuid4()->toString(),
                "id_indikator" => 6,
                "id_prodi" => 1,
                "standar" => "C.2.4. Indikator Kinerja Utama <br>C.2.4.a) Sistem Tata Pamong",
                "kriteria" => "A. Kelengkapan struktur organisasi dan keefektifan penyelenggaraan organisasi. ",

            ],
            [
                "uuid" => service('uuid')->uuid4()->toString(),
                "id_indikator" => 7,
                "id_prodi" => 1,
                "standar" => "C.2.4. Indikator Kinerja Utama <br>C.2.4.a) Sistem Tata Pamong",
                "kriteria" => "B. Perwujudan good governance dan pemenuhan lima pilar sistem tata pamong, yang mencakup: <br>1) Kredibel, <br> 2) Transparan, <br> 3) Akuntabel, <br> 4) Bertanggung jawab, <br> 5) Adil. <br>Skor = (A + (2 x B)) / 3",

            ],
            [
                "uuid" => service('uuid')->uuid4()->toString(),
                "id_indikator" => 8,
                "id_prodi" => 1,
                "standar" => "C.2.4.b) Kepemimpinan dan Kemampuan Manajerial",
                "kriteria" => "A. Komitmen pimpinan UPPS.",

            ],
            [
                "uuid" => service('uuid')->uuid4()->toString(),
                "id_indikator" => 9,
                "id_prodi" => 1,
                "standar" => "C.2.4.b) Kepemimpinan dan Kemampuan Manajerial",
                "kriteria" => "B. Kapabilitas pimpinan UPPS, mencakup aspek: <br>1) perencanaan, <br>2) pengorganisasian, <br>3) penempatan personel, <br>4) pelaksanaan, <br>5) pengendalian dan pengawasan, dan <br>6) pelaporan yang menjadi dasar tindak lanjut. <br>Skor = (A + (2 x B)) / 3",

            ],
            [
                "uuid" => service('uuid')->uuid4()->toString(),
                "id_indikator" => 10,
                "id_prodi" => 1,
                "standar" => "C.2.4.c) <br>Kerjasama ",
                "kriteria" => "Mutu, manfaat, kepuasan dan keberlanjutan kerjasama pendidikan, penelitian dan PkM yang relevan dengan program studi. UPPS memiliki bukti yang sahih terkait kerjasama yang ada telah memenuhi 3 aspek berikut: <br>1) memberikan manfaat bagi program studi dalam pemenuhan proses pembelajaran, penelitian, PkM. <br>2) memberikan peningkatan kinerja tridharma dan fasilitas pendukung program studi. <br>3) memberikan kepuasan kepada mitra industri dan mitra kerjasama lainnya, serta menjamin keberlanjutan kerjasama dan hasilnya.",
            ],
            [
                "uuid" => service('uuid')->uuid4()->toString(),
                "id_indikator" => 11,
                "id_prodi" => 1,
                "standar" => "C.2.4.c) <br>Kerjasama ",
                "kriteria" => "A. Kerjasama pendidikan, penelitian, dan PkM yang relevan dengan program studi dan dikelola oleh UPPS dalam 3 tahun terakhir. Tabel 1 LKPS",
            ],
            [
                "uuid" => service('uuid')->uuid4()->toString(),
                "id_indikator" => 12,
                "id_prodi" => 1,
                "standar" => "C.2.4.c) <br>Kerjasama ",
                "kriteria" => "B. Kerjasama tingkat internasional, nasional, wilayah/lokal yang relevan dengan program studi dan dikelola oleh UPPS dalam 3 tahun terakhir. Tabel 1 LKPS <br>Skor = ((2 x A) + B) / 3",
            ],
            [
                "uuid" => service('uuid')->uuid4()->toString(),
                "id_indikator" => 13,
                "id_prodi" => 1,
                "standar" => "C.2.5 <br>Indikator Kinerja Tambahan",
                "kriteria" => "Pelampauan SN-DIKTI yang ditetapkan dengan indikator kinerja tambahan yang berlaku di UPPS berdasarkan standar pendidikan tinggi yang ditetapkan perguruan tinggi pada tiap kriteria.",
            ],
            [
                "uuid" => service('uuid')->uuid4()->toString(),
                "id_indikator" => 14,
                "id_prodi" => 1,
                "standar" => "C.2.6 <br>Evaluasi Capaian Kinerja",
                "kriteria" => "Analisis keberhasilan dan/atau ketidakberhasilan pencapaian kinerja UPPS yang telah ditetapkan di tiap kriteria memenuhi 2 aspek sebagai berikut: <br>1) capaian kinerja diukur dengan metoda yang tepat, dan hasilnya dianalisis serta dievaluasi, dan <br>2) analisis terhadap capaian kinerja mencakup identifikasi akar masalah, faktor pendukung keberhasilan dan faktor penghambat ketercapaian standard, dan deskripsi singkat tindak lanjut yang akan dilakukan.",
            ],
            [
                "uuid" => service('uuid')->uuid4()->toString(),
                "id_indikator" => 15,
                "id_prodi" => 1,
                "standar" => "C.2.7. Penjaminan Mutu ",
                "kriteria" => "Keterlaksanaan Sistem Penjaminan Mutu <br>Internal (akademik dan nonakademik) yang dibuktikan dengan keberadaan 5 aspek: <br>1) dokumen legal pembentukan unsur pelaksana penjaminan mutu. <br>2) ketersediaan dokumen mutu: kebijakan SPMI, manual SPMI, standar SPMI, dan formulir SPMI. <br>3) terlaksananya siklus penjaminan mutu (siklus PPEPP) <br>4) bukti sahih efektivitas pelaksanaan penjaminan mutu. <br>5) memiliki external ￼benchmarking dalam peningkatan mutu",
            ],
            [
                "uuid" => service('uuid')->uuid4()->toString(),
                "id_indikator" => 16,
                "id_prodi" => 1,
                "standar" => "C.2.8. Kepuasan Pemangku Kepentingan ",
                "kriteria" => "Pengukuran kepuasan para pemangku kepentingan (mahasiswa, dosen, tenaga kependidikan, lulusan, pengguna, mitra industri, dan mitra lainnya) terhadap layanan manajemen, yang memenuhi aspek- aspek berikut: <br>1) menggunakan instrumen kepuasan yang sahih, andal, mudah digunakan, <br>2) dilaksanakan secara berkala, serta datanya terekam secara komprehensif, <br>3) dianalisis dengan metode yang tepat serta bermanfaat untuk pengambilan keputusan, 4) tingkat kepuasan dan umpan balik ditindaklanjuti untuk perbaikan dan peningkatan mutu luaran secara berkala dan tersistem. <br>5) dilakukan review terhadap pelaksanaan pengukuran kepuasan dosen dan mahasiswa, serta <br>6) hasilnya dipublikasikan dan mudah diakses oleh dosen dan mahasiswa.",
            ],
        ];

        $data_indikator = [
            [
                'uuid' => service('uuid')->uuid4()->toString(),
                'indikator' => 'A. Kondisi Eksternal',
            ],
            [
                'uuid' => service('uuid')->uuid4()->toString(),
                'indikator' => 'B. Profil Unit Pengelola Program Studi',
            ],
            [
                'uuid' => service('uuid')->uuid4()->toString(),
                'indikator' => 'C.1. Visi Misi Tujuan Sasaran',
            ],
            [
                'uuid' => service('uuid')->uuid4()->toString(),
                'indikator' => 'C.1.4.1',
            ],
            [
                'uuid' => service('uuid')->uuid4()->toString(),
                'indikator' => 'C.1.4.2',
            ],
            [
                'uuid' => service('uuid')->uuid4()->toString(),
                'indikator' => 'C.1.4.3',
            ],
            [
                'uuid' => service('uuid')->uuid4()->toString(),
                'indikator' => 'C.2. Tata Pamong, Tata Kelola dan Kerjasama',
            ],
            [
                'uuid' => service('uuid')->uuid4()->toString(),
                'indikator' => 'C.2.4.a.A.',
            ],
            [
                'uuid' => service('uuid')->uuid4()->toString(),
                'indikator' => 'C.2.4.a.B.',
            ],
            [
                'uuid' => service('uuid')->uuid4()->toString(),
                'indikator' => 'C.2.4.c) ',
            ],
            [
                'uuid' => service('uuid')->uuid4()->toString(),
                'indikator' => 'C.2.4.c.A',
            ],
            [
                'uuid' => service('uuid')->uuid4()->toString(),
                'indikator' => 'C.2.4.c.B',
            ],
            [
                'uuid' => service('uuid')->uuid4()->toString(),
                'indikator' => 'C.2.5.',
            ],
            [
                'uuid' => service('uuid')->uuid4()->toString(),
                'indikator' => 'C.2.6.',
            ],
            [
                'uuid' => service('uuid')->uuid4()->toString(),
                'indikator' => 'C.2.7.',
            ],
            [
                'uuid' => service('uuid')->uuid4()->toString(),
                'indikator' => 'C.2.8.',
            ],
        ];

        

        $this->db->table('indikator_ed')->insertBatch($data_indikator);
        $this->db->table('form_ed')->insertBatch($data_form);

    }
}
