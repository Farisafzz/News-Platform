<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = \App\Models\User::where('role', 'admin')->first() ?? \App\Models\User::first();

        \App\Models\News::create([
            'title' => 'Berita Pertama: Teknologi AI Berkembang Pesat',
            'content' => '<p>Dalam era digital saat ini, kecerdasan buatan (AI) telah menjadi topik hangat di berbagai industri. AI tidak hanya mengubah cara kita bekerja, tetapi juga mempengaruhi kehidupan sehari-hari.</p><p>Para ahli memperkirakan bahwa AI akan terus berkembang dan memberikan dampak positif bagi masyarakat.</p>',
            'slug' => 'berita-pertama-teknologi-ai-berkembang-pesat',
            'summary' => 'Kecerdasan buatan berkembang pesat dan mempengaruhi berbagai aspek kehidupan.',
            'author_id' => $user->id,
            'status' => 'published',
            'published_at' => now(),
            'tags' => json_encode(['teknologi', 'AI', 'inovasi']),
        ]);

        \App\Models\News::create([
            'title' => 'Olahraga: Timnas Indonesia Siap Hadapi Lawan Tangguh',
            'content' => '<p>Tim nasional Indonesia bersiap menghadapi lawan tangguh di ajang internasional. Para pemain telah menjalani latihan intensif untuk mempersiapkan diri.</p><p>Pelatih menyatakan optimis dengan performa tim saat ini.</p>',
            'slug' => 'olahraga-timnas-indonesia-siap-hadapi-lawan-tangguh',
            'summary' => 'Timnas Indonesia bersiap menghadapi lawan tangguh dengan latihan intensif.',
            'author_id' => $user->id,
            'status' => 'published',
            'published_at' => now()->subDays(1),
            'tags' => json_encode(['olahraga', 'timnas', 'sepakbola']),
        ]);

        \App\Models\News::create([
            'title' => 'Ekonomi: Inflasi Terkendali di Tengah Pandemi',
            'content' => '<p>Pemerintah berhasil menjaga inflasi tetap terkendali meskipun di tengah pandemi. Kebijakan moneter yang tepat sasaran menjadi kunci keberhasilan ini.</p><p>Ekonom memperkirakan pertumbuhan ekonomi akan kembali pulih dalam waktu dekat.</p>',
            'slug' => 'ekonomi-inflasi-terkendali-di-tengah-pandemi',
            'summary' => 'Inflasi berhasil dikendalikan dengan kebijakan moneter yang tepat.',
            'author_id' => $user->id,
            'status' => 'published',
            'published_at' => now()->subDays(2),
            'tags' => json_encode(['ekonomi', 'inflasi', 'pandemi']),
        ]);
    }
}
