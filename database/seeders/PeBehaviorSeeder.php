<?php

namespace Database\Seeders;

use App\Models\PeBehavior;
use App\Models\PeBehaviorPoint;
use Illuminate\Database\Seeder;

class PeBehaviorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $pe1 = PeBehavior::create([
            'objective' => 'Kreatif dan Inovasi',
            'description' => 'Memberikan ide, inovasi terkait lingkup pekerjaan dalam departemen',
            'bobot' => 5,
            'priode' => 'Semester',
            'level' => 's',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PeBehaviorPoint::create([
            'behavior_id' => $pe1->id,
            'point' => 1,
            'keterangan' => 'Tidak pernah memberikan masukan dan inovasi terkait pekerjaan',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PeBehaviorPoint::create([
            'behavior_id' => $pe1->id,
            'point' => 2,
            'keterangan' => 'Bersama-sama dengan rekan yang lain berkontribusi dalam memberikan ide maupun inovasi baru',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PeBehaviorPoint::create([
            'behavior_id' => $pe1->id,
            'point' => 3,
            'keterangan' => 'Memberikan Ide atau inovasi minimal 1 dalam 1 semester',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PeBehaviorPoint::create([
            'behavior_id' => $pe1->id,
            'point' => 4,
            'keterangan' => 'Memberikan Ide atau inovasi minimal 1 dalam 1 semester dan dapat diaplikasikan dalam pekerjaan',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);



        // Behavior 2 

        $pe2 = PeBehavior::create([
            'objective' => 'Kerjasama',
            'description' => 'kemampuan untuk melakukan koordinasi dan komunikasi dengan berbagai pihak yang terkait;  merumuskan tujuan bersama dan berbagi tugas untuk mencapai sasaran kerja yang telah ditetapkan; serta saling menghargai pendapat dan masukan guna peningkatan kinerja tim',
            'bobot' => 5,
            'priode' => 'Semester',
            'level' => 's',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PeBehaviorPoint::create([
            'behavior_id' => $pe2->id,
            'point' => 1,
            'keterangan' => '- Memiliki kemampuan yang sangat rendah untuk melakukan koordinasi dan komunikasi dengan berbagai pihak yang terkait;  
            - Tidak mampu merumuskan tujuan bersama dan berbagi tugas untuk mencapai sasaran kerja yang telah ditetapkan; serta 
            - Tidak bisa menghargai pendapat dan masukan guna peningkatan kinerja tim.',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PeBehaviorPoint::create([
            'behavior_id' => $pe2->id,
            'point' => 2,
            'keterangan' => '- Memiliki kemampuan yang terbatas untuk melakukan koordinasi dan komunikasi dengan berbagai pihak yang terkait;  
            - Kurang mampu merumuskan tujuan bersama dan berbagi tugas untuk mencapai sasaran kerja yang telah ditetapkan; 
            - Kurang bisa  menghargai pendapat dan masukan guna peningkatan kinerja tim.',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PeBehaviorPoint::create([
            'behavior_id' => $pe2->id,
            'point' => 3,
            'keterangan' => '- Memiliki kemampuan yang memadai untuk melakukan koordinasi dan komunikasi dengan berbagai pihak yang terkait;  
            - Mampu merumuskan tujuan bersama dan berbagi tugas untuk mencapai sasaran kerja yang telah ditetapkan; serta 
            - Saling menghargai pendapat dan masukan guna peningkatan kinerja tim',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PeBehaviorPoint::create([
            'behavior_id' => $pe2->id,
            'point' => 4,
            'keterangan' => '- Memiliki kemampuan untuk merencanakan dan mengendalikan proses koordinasi dan komunikasi dengan berbagai pihak yang terkait;  
            - Memiliki kemampuan yang sangat baik dalam merumuskan tujuan bersama dan berbagi tugas untuk mencapai sasaran kerja yang telah ditetapkan; serta 
            - Saling menghargai pendapat dan masukan guna peningkatan kinerja tim',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);


        // Behavior 3

        $pe3 = PeBehavior::create([
            'objective' => 'Inisiatif',
            'description' => 'kemampuan untuk menjalankan inisiatif perbaikan mutu kerja tanpa harus diperintah; bersikap proaktif dan memiliki self-motivation yang tinggi untuk menuntaskan pekerjaan; serta mampu dalam mengajukan usulan/masukan untuk peningkatan mutu kerja',
            'bobot' => 5,
            'priode' => 'Semester',
            'level' => 's',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PeBehaviorPoint::create([
            'behavior_id' => $pe3->id,
            'point' => 1,
            'keterangan' => '- Memiliki kemampuan yang sangat rendah untuk menjalankan inisiatif perbaikan mutu kerja tanpa harus diperintah; 
            - Bersikap pasif dan tidak memiliki self-motivation untuk menuntaskan pekerjaan; 
            - Tidak pernah mengutarakan usulan/masukan untuk peningkatan mutu kerja',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PeBehaviorPoint::create([
            'behavior_id' => $pe3->id,
            'point' => 2,
            'keterangan' => '- Memiliki kemampuan yang terbatas untuk menjalankan inisiatif perbaikan mutu kerja tanpa harus diperintah; 
            - Kadang-kadang bersikap pasif dan kurang memiliki self-motivation untuk menuntaskan pekerjaan; 
            - Terbatas dalam mengutarakan usulan/masukan untuk peningkatan mutu kerja',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PeBehaviorPoint::create([
            'behavior_id' => $pe3->id,
            'point' => 3,
            'keterangan' => '- Memiliki kemampuan yang memadai untuk menjalankan inisiatif perbaikan mutu kerja tanpa harus diperintah; 
            - Bersikap proaktif dan memiliki self-motivation untuk menuntaskan pekerjaan;
            - Mampu dalam mengutarakan usulan/masukan untuk peningkatan mutu kerja',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PeBehaviorPoint::create([
            'behavior_id' => $pe3->id,
            'point' => 4,
            'keterangan' => '- Memiliki kemampuan untuk merencanakan, dan mengimplementasikan inisiatif perbaikan mutu kerja; 
            - Selalu bersikap proaktif dan memiliki self-motivation yang tinggi dan konsisten untuk menuntaskan pekerjaan; 
            - Mampu dalam mengutarakan usulan/masukan untuk peningkatan mutu kerja',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);













        //  Leader










        // Pe Behavior Leader 1
        $pe1 = PeBehavior::create([
            'objective' => 'Leadership',
            'description' => 'Kemampuan untuk menetapkan dan mengkomunikasikan sasaran kerja tim, mengelola dan membagi sumber daya tim secara efektif; serta melakukan monitoring dan mengarahkan agar sasaran kinerja tim dapat tercapai secara optimal',
            'bobot' => 5,
            'priode' => 'Semester',
            'level' => 'l',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PeBehaviorPoint::create([
            'behavior_id' => $pe1->id,
            'point' => 1,
            'keterangan' => '- Memiliki kemampuan yang sangat rendah untuk menetapkan dan mengkomunikasikan sasaran kerja tim, mengelola dan membagi sumber daya tim secara efektif; 
            - Tidak mampu melakukan monitoring dan mengarahkan agar sasaran kinerja tim dapat tercapai secara optimal',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PeBehaviorPoint::create([
            'behavior_id' => $pe1->id,
            'point' => 2,
            'keterangan' => '- Memiliki kemampuan yang terbatas untuk menetapkan dan mengkomunikasikan sasaran kerja tim, mengelola dan membagi sumber daya tim secara efektif; 
            - Kurang mampu melakukan monitoring dan mengarahkan agar sasaran kinerja tim dapat tercapai secara optimal',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PeBehaviorPoint::create([
            'behavior_id' => $pe1->id,
            'point' => 3,
            'keterangan' => '- Memiliki kemampuan yang memadai untuk menetapkan dan mengkomunikasikan sasaran kerja tim, mengelola dan membagi sumber daya tim secara efektif;
            - Memiliki kemampuan yang baik dalam melakukan monitoring dan mengarahkan agar sasaran kinerja tim dapat tercapai secara optimal',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PeBehaviorPoint::create([
            'behavior_id' => $pe1->id,
            'point' => 4,
            'keterangan' => '- Memiliki kemampuan untuk merencanakan, mengawasi dan mengendalikan proses penetapan sasaran kerja tim dan pembagian sumber daya tim secara efektif;
            - Memiliki kemampuan yang sangat baik dalam melakukan monitoring dan mengarahkan agar sasaran kinerja tim dapat tercapai secara optimal',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);



        // PE Behavior Leader 2
        $pe2 = PeBehavior::create([
            'objective' => 'Perencanaan Kerja',
            'description' => 'Kemampuan untuk menyusun rencana kerja secara sistematis dan terjadwal dengan baik; melakukan alokasi sumber daya berdasarkan hasil perencanaan; serta melakukan monitoring untuk memastikan rencana kerja dapat berjalan dengan efektif',
            'bobot' => 5,
            'priode' => 'Semester',
            'level' => 'l',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PeBehaviorPoint::create([
            'behavior_id' => $pe2->id,
            'point' => 1,
            'keterangan' => '- Memiliki kemampuan yang sangat rendah untuk menyusun rencana kerja secara sistematis dan terjadwal dengan baik; 
            - Tidak mampu dalam mengelola sumber daya; 
            - Tidak mampu melakukan monitoring untuk memastikan rencana kerja dapat berjalan dengan efektif. ',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PeBehaviorPoint::create([
            'behavior_id' => $pe2->id,
            'point' => 2,
            'keterangan' => '- Memiliki kemampuan yang terbatas untuk menyusun rencana kerja secara sistematis dan terjadwal dengan baik; 
            - Kurang mampu dalam mengelola sumber daya ; 
            - Kurang dapat melakukan monitoring untuk memastikan rencana kerja dapat berjalan dengan efektif',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PeBehaviorPoint::create([
            'behavior_id' => $pe2->id,
            'point' => 3,
            'keterangan' => '- Memiliki kemampuan yang memadai untuk menyusun rencana kerja secara sistematis dan terjadwal dengan baik; 
            - Mampu mengelola sumber daya ; 
            - Mampu melakukan monitoring untuk memastikan rencana kerja dapat berjalan dengan efektif',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PeBehaviorPoint::create([
            'behavior_id' => $pe2->id,
            'point' => 4,
            'keterangan' => '- Memiliki kemampuan untuk merencanakan, mengawasi dan mengendalikan proses penyusunan rencana kerja secara sistematis dan terjadwal dengan baik;  
            - Mampu dalam melakukan proses monitoring untuk memastikan rencana kerja dapat berjalan dengan efektif',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);


        // PE Behavior Leader 3

        $pe3 = PeBehavior::create([
            'objective' => 'Komunikasi',
            'description' => 'Kemampuan untuk mengutarakan pikirannya (baik secara lisan ataupun tertulis) dalam bahasa yang sistematis, jelas dan mudah dipahami oleh lawan bicara. Mampu menerima dan merespon pembicaraan dari pihak lain dengan baik',
            'bobot' => 5,
            'priode' => 'Semester',
            'level' => 'l',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PeBehaviorPoint::create([
            'behavior_id' => $pe3->id,
            'point' => 1,
            'keterangan' => '- Memiliki kemampuan yang sangat rendah untuk mengutarakan pikirannya (baik secara lisan ataupun tertulis) dalam bahasa yang sistematis, jelas dan mudah dipahami oleh lawan bicara            ',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PeBehaviorPoint::create([
            'behavior_id' => $pe3->id,
            'point' => 2,
            'keterangan' => '- Memiliki kemampuan yang terbatas untuk mengutarakan pikirannya (baik secara lisan ataupun tertulis) dalam bahasa yang sistematis, jelas dan mudah dipahami oleh lawan bicara',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PeBehaviorPoint::create([
            'behavior_id' => $pe3->id,
            'point' => 3,
            'keterangan' => '- Memiliki kemampuan yang memadai untuk mengutarakan pikirannya (baik secara lisan ataupun tertulis) dalam bahasa yang sistematis, jelas dan mudah dipahami oleh lawan bicara. 
            - Mampu menerima dan merespon pembicaraan dari pihak lain dengan baik',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PeBehaviorPoint::create([
            'behavior_id' => $pe3->id,
            'point' => 4,
            'keterangan' => '- Memiliki kemampuan yang sangat baik dalam mengutarakan pikirannya (baik secara lisan ataupu tertulis) dalam bahasa yang sistematis, jelas dan mudah dipahami oleh lawan bicara.
            - Memiliki kemampuan yang sangat bagus dalam merespon pembicaraan dari pihak lain',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);



        // PE Behavior Leader 4

        $pe4 = PeBehavior::create([
            'objective' => 'Kemampuan Memecahkan Masalah',
            'description' => 'Kemampuan untuk menganalisa masalah, mengidentifikasi sumber penyebab masalah dan merumuskan alternatif solusi yang relevan dan aplicable',
            'bobot' => 5,
            'priode' => 'Semester',
            'level' => 'l',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PeBehaviorPoint::create([
            'behavior_id' => $pe4->id,
            'point' => 1,
            'keterangan' => '- Memiliki kemampuan yang rendah untuk dapat menganalisa masalah dan mengidentifikasi sumber penyebab masalah ; 
            - Tidak memiliki kemampuan untuk merumuskan solusi penyelesaian masalah.  ',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PeBehaviorPoint::create([
            'behavior_id' => $pe4->id,
            'point' => 2,
            'keterangan' => '- Memiliki kemampuan yang terbatas untuk menganalisa masalah dan mengidentifikasi sumber penyebab masalah;  
            - Memiliki kemampuan yang kurang memadai dalam hal merumuskan alternatif solusi yang relevan dan aplicable. ',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PeBehaviorPoint::create([
            'behavior_id' => $pe4->id,
            'point' => 3,
            'keterangan' => '- Memiliki kemampuan yang memadai untuk menganalisa masalah dan  mengidentifikasi sumber penyebab masalah ; 
            - Mampu merumuskan alternatif solusi yang relevan dan aplicable',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PeBehaviorPoint::create([
            'behavior_id' => $pe4->id,
            'point' => 4,
            'keterangan' => '- Memiliki kemampuan untuk merencanakan, mengorganisir dan mengendalikan proses analisa masalah  dan mengidentifikasi sumber penyebab masalah ; 
            - Mampu dalam mengelola proses perumusan alternatif solusi yang relevan dan aplicable.',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);
    }
}
