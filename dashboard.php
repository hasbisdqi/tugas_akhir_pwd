<?php
include './layout/auth-header.php';
include './utils/conn.php';
$nik = $_SESSION['nik'];
$resident_stmt = $conn->prepare("SELECT 
    r.*, fc.kk_number, 
    head.full_name AS head_family,
    (
        SELECT COUNT(*) 
        FROM residents 
        WHERE family_card_id = r.family_card_id
    ) AS number_family,
    fc.address
    FROM residents r 
    JOIN family_cards fc ON r.family_card_id = fc.id 
    JOIN residents head ON fc.head_id=head.id
    WHERE r.nik = ? LIMIT 1");
$resident_stmt->bind_param("s", $nik);
$resident_stmt->execute();
$resident_result = $resident_stmt->get_result();
if ($resident_result->num_rows === 1) {
    $user = $resident_result->fetch_assoc();
}
$member_stmt = $conn->prepare("SELECT * FROM residents WHERE family_card_id = ?");
$member_stmt->bind_param("i", $user['family_card_id']);
$member_stmt->execute();
$member_result = $member_stmt->get_result();
$members = [];
while ($row = $member_result->fetch_assoc()) {
    $members[] = $row;
}
?>
<div class="container py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold mb-2">Dashboard Kependudukan</h1>
        <p class="text-muted-foreground">Selamat datang di Sistem Informasi Kependudukan. Lihat informasi data kependudukan Anda.</p>
    </div>
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 mb-8">
        <div class="rounded-lg border bg-card text-card-foreground shadow-sm" data-v0-t="card">
            <div class="flex flex-col space-y-1.5 p-6 pb-2">
                <h3 class="tracking-tight text-lg font-medium">Data Pribadi</h3>
                <p class="text-sm text-muted-foreground">Informasi identitas pribadi Anda</p>
            </div>
            <div class="p-6 pt-0">
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user h-5 w-5 text-muted-foreground">
                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2">
                            </path>
                            <circle cx="12" cy="7" r="4">
                            </circle>
                        </svg>
                        <div>
                            <p class="text-sm text-muted-foreground">Nama Lengkap</p>
                            <p class="font-medium">
                                <?= $user['full_name'] ?>
                        </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text h-5 w-5 text-muted-foreground">
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
                        <div>
                            <p class="text-sm text-muted-foreground">NIK</p>
                            <p class="font-medium">
                                <?= $user['nik'] ?>
                        </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar h-5 w-5 text-muted-foreground">
                            <path d="M8 2v4">
                            </path>
                            <path d="M16 2v4">
                            </path>
                            <rect width="18" height="18" x="3" y="4" rx="2">
                            </rect>
                            <path d="M3 10h18">
                            </path>
                        </svg>
                        <div>
                            <p class="text-sm text-muted-foreground">Tanggal Lahir</p>
                            <p class="font-medium">
                                <?= $user['birth_date'] ?>
                        </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin h-5 w-5 text-muted-foreground">
                            <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z">
                            </path>
                            <circle cx="12" cy="10" r="3">
                            </circle>
                        </svg>
                        <div>
                            <p class="text-sm text-muted-foreground">Tempat Lahir</p>
                            <p class="font-medium">
                                <?= $user['birth_place'] ?>
                        </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center p-6 pt-0">
            </div>
        </div>
        <div class="rounded-lg border bg-card text-card-foreground shadow-sm" data-v0-t="card">
            <div class="flex flex-col space-y-1.5 p-6 pb-2">
                <h3 class="tracking-tight text-lg font-medium">Kartu Keluarga</h3>
                <p class="text-sm text-muted-foreground">Informasi Kartu Keluarga Anda</p>
            </div>
            <div class="p-6 pt-0">
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text h-5 w-5 text-muted-foreground">
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
                        <div>
                            <p class="text-sm text-muted-foreground">Nomor KK</p>
                            <p class="font-medium">
                                <?= $user['kk_number'] ?>
                        </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users h-5 w-5 text-muted-foreground">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2">
                            </path>
                            <circle cx="9" cy="7" r="4">
                            </circle>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87">
                            </path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75">
                            </path>
                        </svg>
                        <div>
                            <p class="font-medium">
                                <?= $user['head_family'] ?>
                        </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users h-5 w-5 text-muted-foreground">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2">
                            </path>
                            <circle cx="9" cy="7" r="4">
                            </circle>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87">
                            </path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75">
                            </path>
                        </svg>
                        <div>
                            <p class="text-sm text-muted-foreground">Jumlah Anggota</p>
                            <p class="font-medium">
                                <?= $user['number_family'] ?> Orang</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin h-5 w-5 text-muted-foreground">
                            <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z">
                            </path>
                            <circle cx="12" cy="10" r="3">
                            </circle>
                        </svg>
                        <div>
                            <p class="text-sm text-muted-foreground">Alamat</p>
                            <p class="font-medium">
                                <?= $user['address'] ?>
                        </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center p-6 pt-0">
        </div>
        </div>
        <div class="rounded-lg border bg-card text-card-foreground shadow-sm" data-v0-t="card">
            <div class="flex flex-col space-y-1.5 p-6 pb-2">
                <h3 class="tracking-tight text-lg font-medium">Family Tree</h3>
                <p class="text-sm text-muted-foreground">Visualisasi silsilah keluarga Anda</p>
            </div>
            <div class="p-6 flex flex-col items-center justify-center py-6">
                <div class="mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-tree-pine h-16 w-16 text-green-600">
                        <path d="m17 14 3 3.3a1 1 0 0 1-.7 1.7H4.7a1 1 0 0 1-.7-1.7L7 14h-.3a1 1 0 0 1-.7-1.7L9 9h-.2A1 1 0 0 1 8 7.3L12 3l4 4.3a1 1 0 0 1-.8 1.7H15l3 3.3a1 1 0 0 1-.7 1.7H17Z">
                        </path>
                        <path d="M12 22v-3">
                        </path>
                    </svg>
                </div>
                <p class="text-center text-sm text-muted-foreground mb-4">Lihat hubungan kekeluargaan Anda dalam bentuk visual yang interaktif</p>
            </div>
            <div class="flex items-center p-6 pt-0">
                <a href="/family-tree.php" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 text-primary-foreground h-10 px-4 py-2 w-full bg-green-600 hover:bg-green-700">Lihat Family Tree</a>
        </div>
        </div>
    </div>
    <div class="grid gap-6 md:grid-cols-2">
        <div class="rounded-lg border bg-card text-card-foreground shadow-sm" data-v0-t="card">
            <div class="flex flex-col space-y-1.5 p-6">
                <h3 class="text-2xl font-semibold leading-none tracking-tight">Anggota Keluarga</h3>
                <p class="text-sm text-muted-foreground">Daftar anggota dalam Kartu Keluarga Anda</p>
            </div>
            <div class="p-6 pt-0">
                <div class="space-y-4">
                    <?php foreach ($members as $a): ?>
                        <div class="flex items-center gap-3 p-2 rounded-lg <?= $nik === $a['nik'] ? 'bg-primary/10 hover:bg-primary/20' : 'hover:bg-muted/50'?>">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full <?= $nik === $a['nik'] ? 'bg-primary/10' : 'bg-muted'?> flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users h-5 w-5 text-green-600">
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
                            <div>
                                <p class="font-medium">
                                    <?=$a['full_name']?>
                            </p>
                                <p class="text-xs text-muted-foreground">
                                    <?=$a['relation']?>
                            </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="rounded-lg border bg-card text-card-foreground shadow-sm" data-v0-t="card">
            <div class="flex flex-col space-y-1.5 p-6">
                <h3 class="text-2xl font-semibold leading-none tracking-tight">Informasi Penting</h3>
                <p class="text-sm text-muted-foreground">Pengumuman dan informasi terkait kependudukan</p>
            </div>
            <div class="p-6 pt-0">
                <div class="space-y-4">
                    <div class="p-3 rounded-lg border">
                        <div class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info h-5 w-5 text-blue-600 flex-shrink-0 mt-0.5">
                                <circle cx="12" cy="12" r="10">
                                </circle>
                                <path d="M12 16v-4">
                                </path>
                                <path d="M12 8h.01">
                                </path>
                            </svg>
                            <div>
                                <p class="font-medium mb-1">Pemutakhiran Data Kependudukan</p>
                                <p class="text-sm text-muted-foreground">Pemutakhiran data kependudukan akan dilakukan pada tanggal 1-30 Juni 2025. Pastikan data Anda sudah benar.</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 rounded-lg border">
                        <div class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info h-5 w-5 text-blue-600 flex-shrink-0 mt-0.5">
                                <circle cx="12" cy="12" r="10">
                                </circle>
                                <path d="M12 16v-4">
                                </path>
                                <path d="M12 8h.01">
                                </path>
                            </svg>
                            <div>
                                <p class="font-medium mb-1">Layanan Online Disdukcapil</p>
                                <p class="text-sm text-muted-foreground">Layanan online Disdukcapil kini tersedia untuk pembuatan KTP, KK, dan Akta Kelahiran. Kunjungi website resmi untuk informasi lebih lanjut.</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 rounded-lg border">
                        <div class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info h-5 w-5 text-blue-600 flex-shrink-0 mt-0.5">
                                <circle cx="12" cy="12" r="10">
                                </circle>
                                <path d="M12 16v-4">
                                </path>
                                <path d="M12 8h.01">
                                </path>
                            </svg>
                            <div>
                                <p class="font-medium mb-1">Jadwal Pelayanan Disdukcapil</p>
                                <p class="text-sm text-muted-foreground">Senin-Jumat: 08.00-16.00 WIB<br>Sabtu-Minggu: Tutup</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>