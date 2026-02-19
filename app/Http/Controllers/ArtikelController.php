<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index()
    {
        // Data Dummy untuk Artikel Unggulan (Besar di kiri)
        $unggulan = (object)[
            'title' => 'Exploring Future Renewable Energy Innovations',
            'date' => 'December 11, 2023',
            'excerpt' => 'Embark on a journey with us as we delve into the realms of innovation, share insights, and explore the transformative power of technology...',
            'image' => 'https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?auto=format&fit=crop&w=800&q=80'
        ];

        // Data Dummy untuk Sidebar (Kecil di kanan)
        $sidebar = [
            (object)[
                'title' => 'From Ideas to Impact in a Startups Journey',
                'date' => 'November 20, 2023',
                'image' => 'https://images.unsplash.com/photo-1556761175-b413da4baf72?auto=format&fit=crop&w=200&q=80'
            ],
            (object)[
                'title' => 'Navigating the Tech Landscape with Insights',
                'date' => 'November 20, 2023',
                'image' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=200&q=80'
            ],
            (object)[
                'title' => 'Behind the Scenes of Crafting Our Startup',
                'date' => 'November 20, 2023',
                'image' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=200&q=80'
            ],
        ];

        $semua_artikel = [
            (object)[
                'title' => 'Menghadapi Insecurity: Kamu Lebih Dari Sekadar Angka di Rapor.',
                'penulis' => 'direct by lisa 2025',
                'date' => 'February 19, 2026',
                'image' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=400'
            ],
            (object)[
                'title' => 'Building Resilience: Cara Bangkit Lagi Setelah Mengalami Masa Sulit',
                'penulis' => 'direct by lisa 2025',
                'date' => 'February 18, 2026',
                'image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=400'
            ],
            (object)[
                'title' => 'Menghadapi Cyberbullying: Langkah Taktis Melindungi Jejak Digitalmu',
                'penulis' => 'direct by lisa 2025',
                'date' => 'February 17, 2026',
                'image' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?q=80&w=400'
            ],
            (object)[
                'title' => 'Mengapa Bercerita Bisa Mengurangi Beban Pikiran? (Sains di Balik Curhat)',
                'penulis' => 'direct by lisa 2025',
                'date' => 'February 16, 2026',
                'image' => 'https://images.unsplash.com/photo-1529070538774-1843cb3265df?q=80&w=400'
            ],
            (object)[
                'title' => 'Social Media Detox: Cara Balikin Mood yang Lagi Drop.',
                'penulis' => 'direct by lisa 2025',
                'date' => 'February 15, 2026',
                'image' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=400'
            ],
            (object)[
                'title' => 'Seni Berkata \'Tidak\': Cara Set Boundary Biar Gak Gampang Dimanfaatin',
                'penulis' => 'direct by lisa 2025',
                'date' => 'February 14, 2026',
                'image' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=400'
            ],
        ];

        // Dummy untuk footer agar tidak error
        $locations = (object)[
            'email' => 'info@example.com',
            'phone' => '(+62)-822-4545-2882',
            'address' => 'Jl. Raya Kuta No. 121, Bali, Indonesia'
        ];

        return view('artikel', compact('unggulan', 'sidebar', 'semua_artikel', 'locations'));
    }
}