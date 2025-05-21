<?php
include './layout/header.php';
?>
<div class="flex min-h-screen flex-col">
    <header class="sticky top-0 z-40 border-b bg-background/95 backdrop-blur supports-[backdrop-filter]:bg-background/60">
        <div class="container flex h-16 items-center justify-between py-4">
            <div class="flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-tree-pine h-6 w-6 text-green-600">
                    <path d="m17 14 3 3.3a1 1 0 0 1-.7 1.7H4.7a1 1 0 0 1-.7-1.7L7 14h-.3a1 1 0 0 1-.7-1.7L9 9h-.2A1 1 0 0 1 8 7.3L12 3l4 4.3a1 1 0 0 1-.8 1.7H15l3 3.3a1 1 0 0 1-.7 1.7H17Z">
                    </path>
                    <path d="M12 22v-3">
                    </path>
                </svg><span class="text-xl font-bold">SistemKependudukan</span>
            </div>
            <div class="flex items-center gap-4">
                <nav class="hidden md:flex items-center gap-6"><a href="#fitur" class="text-sm font-medium hover:text-primary">Fitur</a><a href="#informasi" class="text-sm font-medium hover:text-primary">Informasi</a><a href="#kontak" class="text-sm font-medium hover:text-primary">Kontak</a>
                </nav><a href="/login.php" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2">Login</a><a href="/petugas/login.php" class="items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2 hidden md:inline-flex">Petugas</a>
            </div>
        </div>
    </header>
    <main class="flex-1">
        <section class="w-full py-12 md:py-24 lg:py-32 xl:py-48 bg-gradient-to-b from-green-50 to-white">
            <div class="container px-4 md:px-6">
                <div class="grid gap-6 lg:grid-cols-[1fr_600px] lg:gap-12 xl:grid-cols-[1fr_700px]">
                    <div class="flex flex-col justify-center space-y-4">
                        <div class="space-y-2">
                            <h1 class="text-3xl font-bold tracking-tighter sm:text-5xl xl:text-6xl/none">Sistem Informasi Kependudukan Digital</h1>
                            <p class="max-w-[600px] text-muted-foreground md:text-xl">Akses informasi kependudukan dan visualisasi family tree keluarga Anda dengan mudah menggunakan NIK.</p>
                        </div>
                        <div class="flex flex-col gap-2 min-[400px]:flex-row"><a href="/login.php" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 text-primary-foreground h-11 rounded-md px-8 bg-green-600 hover:bg-green-700">Login dengan NIK</a><button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-11 rounded-md px-8">Pelajari Lebih Lanjut</button>
                        </div>
                    </div>
                    <div class="relative mx-auto aspect-video overflow-hidden rounded-xl border bg-background p-2 md:p-4 lg:p-6"><img alt="Family Tree Preview" loading="lazy" width="1280" height="720" decoding="async" data-nimg="1" class="rounded-md object-cover" style="color: transparent;" src="/assets/fam.jpeg">
                        <div class="absolute inset-0 bg-gradient-to-t from-background/80 to-background/20 flex items-end p-6">
                            <div class="to-background bg-gradient-to-l backdrop-blur-sm p-4 rounded-r-lg max-w-md">
                                <h3 class="text-lg font-medium mb-2">Visualisasi Family Tree</h3>
                                <p class="text-sm text-muted-foreground">Lihat hubungan keluarga dalam tampilan visual yang interaktif dan mudah dipahami</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="fitur" class="w-full py-12 md:py-24 lg:py-32">
            <div class="container px-4 md:px-6">
                <div class="flex flex-col items-center justify-center space-y-4 text-center">
                    <div class="space-y-2">
                        <div class="inline-block rounded-lg bg-green-100 px-3 py-1 text-sm text-green-800">Fitur Unggulan</div>
                        <h2 class="text-3xl font-bold tracking-tighter sm:text-5xl">Akses Data Kependudukan</h2>
                        <p class="max-w-[900px] text-muted-foreground md:text-xl/relaxed lg:text-base/relaxed xl:text-xl/relaxed">Sistem kami menyediakan berbagai fitur untuk memudahkan akses data kependudukan Anda</p>
                    </div>
                </div>
                <div class="mx-auto grid max-w-5xl items-center gap-6 py-12 md:grid-cols-2 lg:grid-cols-3 lg:gap-12">
                    <div class="grid gap-2 text-center">
                        <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-green-100"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-tree-pine h-10 w-10 text-green-600">
                                <path d="m17 14 3 3.3a1 1 0 0 1-.7 1.7H4.7a1 1 0 0 1-.7-1.7L7 14h-.3a1 1 0 0 1-.7-1.7L9 9h-.2A1 1 0 0 1 8 7.3L12 3l4 4.3a1 1 0 0 1-.8 1.7H15l3 3.3a1 1 0 0 1-.7 1.7H17Z">
                                </path>
                                <path d="M12 22v-3">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold">Family Tree</h3>
                        <p class="text-muted-foreground">Visualisasi silsilah keluarga dengan tampilan interaktif yang mudah dipahami</p>
                    </div>
                    <div class="grid gap-2 text-center">
                        <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-green-100"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text h-10 w-10 text-green-600">
                                <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z">
                                </path>
                                <path d="M14 2v4a2 2 0 0 0 2 2h4">
                                </path>
                                <path d="M10 9H8">
                                </path>
                                <path d="M16 13H8">
                                </path>
                                <path d="M16 17H8">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold">Data Kependudukan</h3>
                        <p class="text-muted-foreground">Akses data kependudukan pribadi dan keluarga Anda dengan aman</p>
                    </div>
                    <div class="grid gap-2 text-center">
                        <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-green-100"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield h-10 w-10 text-green-600">
                                <path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold">Keamanan Data</h3>
                        <p class="text-muted-foreground">Data keluarga Anda aman dengan sistem enkripsi dan perlindungan privasi terbaik</p>
                    </div>
                    <div class="grid gap-2 text-center">
                        <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-green-100"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users h-10 w-10 text-green-600">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2">
                                </path>
                                <circle cx="9" cy="7" r="4">
                                </circle>
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87">
                                </path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold">Informasi Keluarga</h3>
                        <p class="text-muted-foreground">Lihat informasi lengkap tentang anggota keluarga dalam satu Kartu Keluarga</p>
                    </div>
                    <div class="grid gap-2 text-center">
                        <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-green-100"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search h-10 w-10 text-green-600">
                                <circle cx="11" cy="11" r="8">
                                </circle>
                                <path d="m21 21-4.3-4.3">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold">Pencarian Cepat</h3>
                        <p class="text-muted-foreground">Temukan informasi anggota keluarga dengan cepat melalui fitur pencarian canggih</p>
                    </div>
                    <div class="grid gap-2 text-center">
                        <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-green-100"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-smartphone h-10 w-10 text-green-600">
                                <rect width="14" height="20" x="5" y="2" rx="2" ry="2">
                                </rect>
                                <path d="M12 18h.01">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold">Akses Mobile</h3>
                        <p class="text-muted-foreground">Akses data keluarga kapan saja dan di mana saja melalui aplikasi mobile</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="w-full py-12 md:py-24 lg:py-32 bg-green-50">
            <div class="container px-4 md:px-6">
                <div class="grid gap-10 lg:grid-cols-2 lg:gap-16 items-center">
                    <div>
                        <div class="space-y-4">
                            <div class="inline-block rounded-lg bg-green-100 px-3 py-1 text-sm text-green-800">Fitur Unggulan</div>
                            <h2 class="text-3xl font-bold tracking-tighter md:text-4xl/tight">Family Tree yang Interaktif</h2>
                            <p class="text-muted-foreground md:text-xl">Visualisasikan silsilah keluarga Anda dengan tampilan yang menarik dan interaktif. Lihat hubungan antar anggota keluarga dengan jelas.</p>
                            <ul class="grid gap-2">
                                <li class="flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right h-4 w-4 text-green-600">
                                        <path d="m9 18 6-6-6-6">
                                        </path>
                                    </svg><span>Tampilan visual yang mudah dipahami</span>
                                </li>
                                <li class="flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right h-4 w-4 text-green-600">
                                        <path d="m9 18 6-6-6-6">
                                        </path>
                                    </svg><span>Navigasi interaktif antar generasi</span>
                                </li>
                                <li class="flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right h-4 w-4 text-green-600">
                                        <path d="m9 18 6-6-6-6">
                                        </path>
                                    </svg><span>Lihat foto untuk setiap anggota</span>
                                </li>
                                <li class="flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right h-4 w-4 text-green-600">
                                        <path d="m9 18 6-6-6-6">
                                        </path>
                                    </svg><span>Cetak dan simpan family tree</span>
                                </li>
                            </ul><a href="/login.php" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 text-primary-foreground h-10 px-4 py-2 bg-green-600 hover:bg-green-700">Lihat Family Tree Anda</a>
                        </div>
                    </div>
                    <div class="relative rounded-xl overflow-hidden border">
                        <img alt="Family Tree Interactive Demo" loading="lazy" width="800" height="600" decoding="async" data-nimg="1" class="object-cover" style="color: transparent;" src="/assets/fam.jpeg">
                    </div>
                </div>
            </div>
        </section>
        <section id="informasi" class="w-full py-12 md:py-24 lg:py-32">
            <div class="container px-4 md:px-6">
                <div class="flex flex-col items-center justify-center space-y-4 text-center">
                    <div class="space-y-2">
                        <h2 class="text-3xl font-bold tracking-tighter sm:text-5xl">Cara Mengakses Sistem</h2>
                        <p class="max-w-[900px] text-muted-foreground md:text-xl/relaxed lg:text-base/relaxed xl:text-xl/relaxed">Akses informasi kependudukan Anda dengan mudah</p>
                    </div>
                </div>
                <div class="mx-auto grid max-w-5xl items-center gap-6 py-12 md:grid-cols-3">
                    <div class="grid gap-2 text-center">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-green-100 text-xl font-bold text-green-800">1</div>
                        <h3 class="text-xl font-bold">Login dengan NIK</h3>
                        <p class="text-muted-foreground">Masukkan NIK dan password Anda untuk mengakses sistem</p>
                    </div>
                    <div class="grid gap-2 text-center">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-green-100 text-xl font-bold text-green-800">2</div>
                        <h3 class="text-xl font-bold">Akses Dashboard</h3>
                        <p class="text-muted-foreground">Lihat ringkasan data kependudukan Anda di dashboard</p>
                    </div>
                    <div class="grid gap-2 text-center">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-green-100 text-xl font-bold text-green-800">3</div>
                        <h3 class="text-xl font-bold">Lihat Family Tree</h3>
                        <p class="text-muted-foreground">Akses visualisasi family tree keluarga Anda</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="w-full py-12 md:py-24 lg:py-32 bg-green-50">
            <div class="container px-4 md:px-6">
                <div class="flex flex-col items-center justify-center space-y-4 text-center">
                    <div class="space-y-2">
                        <h2 class="text-3xl font-bold tracking-tighter sm:text-5xl">Informasi Layanan</h2>
                        <p class="max-w-[900px] text-muted-foreground md:text-xl/relaxed lg:text-base/relaxed xl:text-xl/relaxed">Informasi penting terkait layanan kependudukan</p>
                    </div>
                </div>
                <div class="mx-auto grid max-w-5xl gap-6 py-12 md:grid-cols-3">
                    <div class="rounded-lg border bg-background p-6">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="rounded-full bg-green-100 p-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info h-5 w-5 text-green-600">
                                    <circle cx="12" cy="12" r="10">
                                    </circle>
                                    <path d="M12 16v-4">
                                    </path>
                                    <path d="M12 8h.01">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold">Jam Layanan</h4>
                            </div>
                        </div>
                        <p class="text-muted-foreground">Senin - Jumat: 08.00 - 16.00 WIB<br>Sabtu: 08.00 - 12.00 WIB<br>Minggu &amp; Hari Libur: Tutup</p>
                    </div>
                    <div class="rounded-lg border bg-background p-6">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="rounded-full bg-green-100 p-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info h-5 w-5 text-green-600">
                                    <circle cx="12" cy="12" r="10">
                                    </circle>
                                    <path d="M12 16v-4">
                                    </path>
                                    <path d="M12 8h.01">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold">Layanan Online</h4>
                            </div>
                        </div>
                        <p class="text-muted-foreground">Akses layanan online 24 jam untuk melihat data kependudukan. Untuk perubahan data, silakan kunjungi kantor Disdukcapil terdekat.</p>
                    </div>
                    <div class="rounded-lg border bg-background p-6">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="rounded-full bg-green-100 p-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info h-5 w-5 text-green-600">
                                    <circle cx="12" cy="12" r="10">
                                    </circle>
                                    <path d="M12 16v-4">
                                    </path>
                                    <path d="M12 8h.01">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold">Bantuan</h4>
                            </div>
                        </div>
                        <p class="text-muted-foreground">Hubungi call center kami di 1500-123 untuk bantuan terkait layanan kependudukan atau kirim email ke info@dukcapil.go.id</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="w-full py-12 md:py-24 lg:py-32 bg-green-600 text-white">
            <div class="container px-4 md:px-6">
                <div class="flex flex-col items-center justify-center space-y-4 text-center">
                    <div class="space-y-2">
                        <h2 class="text-3xl font-bold tracking-tighter sm:text-5xl">Akses Informasi Kependudukan Anda</h2>
                        <p class="max-w-[900px] md:text-xl/relaxed lg:text-base/relaxed xl:text-xl/relaxed">Lihat data keluarga dan family tree Anda dengan login menggunakan NIK</p>
                    </div>
                    <div class="flex flex-col gap-2 min-[400px]:flex-row">
                        <a href="/login.php" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 h-11 rounded-md px-8 bg-white text-green-600 hover:bg-green-50">Login dengan NIK</a>
                        <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-primary transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border bg-primary/80 hover:text-primary-foreground h-11 rounded-md px-8 text-white border-primary hover:bg-primary">Hubungi Kami</button>
                    </div>
                </div>
            </div>
        </section>
        <section id="faq" class="w-full py-12 md:py-24 lg:py-32">
            <div class="container px-4 md:px-6">
                <div class="flex flex-col items-center justify-center space-y-4 text-center">
                    <div class="space-y-2">
                        <h2 class="text-3xl font-bold tracking-tighter sm:text-5xl">Pertanyaan Umum</h2>
                        <p class="max-w-[900px] text-muted-foreground md:text-xl/relaxed lg:text-base/relaxed xl:text-xl/relaxed">Jawaban untuk pertanyaan yang sering ditanyakan</p>
                    </div>
                </div>
                <div class="mx-auto grid max-w-5xl gap-6 py-12 lg:grid-cols-2">
                    <div class="rounded-lg border p-6">
                        <h3 class="text-lg font-bold mb-2">Apakah data keluarga saya aman?</h3>
                        <p class="text-muted-foreground">Ya, kami menggunakan enkripsi tingkat tinggi untuk melindungi data Anda. Kami juga tidak akan pernah membagikan data Anda kepada pihak ketiga tanpa izin.</p>
                    </div>
                    <div class="rounded-lg border p-6">
                        <h3 class="text-lg font-bold mb-2">Apakah saya bisa mengakses dari perangkat mobile?</h3>
                        <p class="text-muted-foreground">Ya, aplikasi kami tersedia di web dan juga sebagai aplikasi mobile untuk Android dan iOS.</p>
                    </div>
                    <div class="rounded-lg border p-6">
                        <h3 class="text-lg font-bold mb-2">Bagaimana cara login ke aplikasi?</h3>
                        <p class="text-muted-foreground">Anda dapat login menggunakan Nomor Induk Kependudukan (NIK) yang tertera pada KTP Anda. Sistem akan memverifikasi identitas Anda dan menampilkan data keluarga yang sesuai.</p>
                    </div>
                    <div class="rounded-lg border p-6">
                        <h3 class="text-lg font-bold mb-2">Apakah saya bisa mengubah data keluarga saya?</h3>
                        <p class="text-muted-foreground">Tidak, aplikasi ini hanya bersifat informatif. Untuk perubahan data kependudukan, silakan kunjungi kantor Dinas Kependudukan dan Pencatatan Sipil (Disdukcapil) setempat.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer id="kontak" class="w-full py-6 bg-green-900 text-white">
        <div class="container px-4 md:px-6">
            <div class="grid gap-10 sm:grid-cols-2 md:grid-cols-4">
                <div class="space-y-4">
                    <div class="flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-tree-pine h-6 w-6">
                            <path d="m17 14 3 3.3a1 1 0 0 1-.7 1.7H4.7a1 1 0 0 1-.7-1.7L7 14h-.3a1 1 0 0 1-.7-1.7L9 9h-.2A1 1 0 0 1 8 7.3L12 3l4 4.3a1 1 0 0 1-.8 1.7H15l3 3.3a1 1 0 0 1-.7 1.7H17Z">
                            </path>
                            <path d="M12 22v-3">
                            </path>
                        </svg><span class="text-xl font-bold">SistemKependudukan</span>
                    </div>
                    <p class="text-sm text-green-200">Sistem informasi kependudukan dengan fitur Family Tree</p>
                </div>
                <div class="space-y-4">
                    <h3 class="text-lg font-medium">Layanan</h3>
                    <ul class="space-y-2 text-sm text-green-200">
                        <li><a href="#" class="hover:text-white">Fitur</a>
                        </li>
                        <li><a href="#" class="hover:text-white">FAQ</a>
                        </li>
                    </ul>
                </div>
                <div class="space-y-4">
                    <h3 class="text-lg font-medium">Informasi</h3>
                    <ul class="space-y-2 text-sm text-green-200">
                        <li><a href="#" class="hover:text-white">Tentang Kami</a>
                        </li>
                        <li><a href="#" class="hover:text-white">Kebijakan Privasi</a>
                        </li>
                        <li><a href="#" class="hover:text-white">Syarat &amp; Ketentuan</a>
                        </li>
                    </ul>
                </div>
                <div class="space-y-4">
                    <h3 class="text-lg font-medium">Kontak</h3>
                    <ul class="space-y-2 text-sm text-green-200">
                        <li><a href="mailto:info@dukcapil.go.id" class="hover:text-white">info@dukcapil.go.id</a>
                        </li>
                        <li><a href="tel:+621500123" class="hover:text-white">1500-123</a>
                        </li>
                        <li>
                            <address class="not-italic">Jl. Proklamasi No. 123<br>Jakarta, Indonesia</address>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="mt-10 border-t border-green-800 pt-6 text-center text-sm text-green-200">
                <p>© 2025 Dinas Kependudukan dan Pencatatan Sipil. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>
</div>