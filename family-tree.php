<?php
include './layout/auth-header.php';
include './utils/conn.php';
$nik = $_SESSION['nik'];
$family_stmt = $conn->prepare("SELECT 
    fc.*, 
    head.full_name AS head_family
    FROM residents r 
    JOIN family_cards fc ON r.family_card_id = fc.id 
    JOIN residents head ON fc.head_id=head.id
    WHERE r.nik = ? LIMIT 1");
$family_stmt->bind_param("s", $nik);
$family_stmt->execute();
$resident_result = $family_stmt->get_result();
if ($resident_result->num_rows === 1) {
    $family = $resident_result->fetch_assoc();
}
$member_stmt = $conn->prepare("SELECT * FROM residents WHERE family_card_id = ?");
$member_stmt->bind_param("i", $family['id']);
$member_stmt->execute();
$member_result = $member_stmt->get_result();
$members = [];
while ($row = $member_result->fetch_assoc()) {
    $members[] = $row;
}
function getPersonById($data, $id)
{
    foreach ($data as $resident) {
        if ($resident['id'] == $id) {
            return $resident;
        }
    }
    return null;
}
$families = [];
foreach ($members as $person) {
    $fatherId = $person['father_id'];
    $motherId = $person['mother_id'];
    if ($fatherId && $motherId) {
        $key = $fatherId . '-' . $motherId;
        if (!isset($families[$key])) {
            $families[$key] = [
                'father' => getPersonById($members, $fatherId),
                'mother' => getPersonById($members, $motherId),
                'children' => []
            ];
        }
        $families[$key]['children'][] = $person;
    }
}
?>
<style>
    .tree ul {
        position: relative;
        padding-top: 20px;
        display: flex;
        justify-content: center;
    }

    .tree ul::before {
        content: "";
        position: absolute;
        top: 0;
        left: 50%;
        border-left: 2px solid #ccc;
        height: 20px;
        transform: translateX(-50%);
    }

    .tree li {
        list-style-type: none;
        text-align: center;
        position: relative;
        padding: 20px 5px 0 5px;
    }

    .tree li::before,
    .tree li::after {
        content: "";
        position: absolute;
        top: 0;
        border-top: 2px solid #ccc;
        width: 50%;
        height: 18px;
    }

    .tree li:first-child::before,
    .tree li:last-child::after,
    .tree li:only-child::before,
    .tree li:only-child::after,
    .tree>ul::before {
        display: none;
    }

    .tree li::before {
        right: 50%;
        border-right: 2px solid #ccc;
        border-radius: 0 10px 0 0;
    }

    .tree li::after {
        left: 50%;
        border-left: 2px solid #ccc;
        border-radius: 10px 0 0 0;
    }

    .tree li:not(:first-child):not(:last-child):before {
        border-radius: 0;
        border-right: 1px solid #ccc;
    }

    .tree li:not(:first-child):not(:last-child):after {
        border-radius: 0;
        border-left: 1px solid #ccc;
    }

    .tree li:only-child {
        padding-top: 0;
    }
</style>
<div class="container py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold mb-2">Family Tree Keluarga</h1>
        <div class="flex items-center text-muted-foreground">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-home h-4 w-4 mr-1">
                <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z">
                </path>
                <polyline points="9 22 9 12 15 12 15 22">
                </polyline>
            </svg>
            <a href="/dashboard" class="hover:text-primary">Beranda</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right h-4 w-4 mx-1">
                <path d="m9 18 6-6-6-6">
                </path>
            </svg>
            <span>Family Tree</span>
        </div>
    </div>
    <div class="grid gap-6 md:grid-cols-[300px_1fr]">
        <div class="space-y-6">
            <div class="rounded-lg border bg-card text-card-foreground shadow-sm flex flex-col">
                <div class="flex flex-col space-y-1.5 p-6">
                    <h3 class="text-2xl font-semibold leading-none tracking-tight">Informasi Keluarga</h3>
                    <p class="text-sm text-muted-foreground">Detail Kartu Keluarga Anda</p>
                </div>
                <div class="p-6 pt-0 space-y-4">
                    <div>
                        <p class="text-sm text-muted-foreground">Nomor KK</p>
                        <p class="font-medium">
                            <?= $family['kk_number'] ?>
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-muted-foreground">Kepala Keluarga</p>
                        <p class="font-medium">
                            <?= $family['head_family'] ?>
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-muted-foreground">Alamat</p>
                        <p class="font-medium">
                            <?= $family['address'] ?>
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-muted-foreground">Kelurahan/Desa</p>
                        <p class="font-medium">
                            <?= $family['subdistrict'] ?>
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-muted-foreground">Kecamatan</p>
                        <p class="font-medium">
                            <?= $family['district'] ?>
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-muted-foreground">Kota/Kabupaten</p>
                        <p class="font-medium">
                            <?= $family['city'] ?>
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-muted-foreground">Provinsi</p>
                        <p class="font-medium">
                            <?= $family['province'] ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="rounded-lg border bg-card text-card-foreground shadow-sm flex flex-col">
                <div class="flex flex-col space-y-1.5 p-6">
                    <h3 class="text-2xl font-semibold leading-none tracking-tight">Anggota Keluarga</h3>
                    <p class="text-sm text-muted-foreground">Daftar anggota dalam KK</p>
                </div>
                <div class="p-6 pt-0 space-y-4">
                    <?php foreach ($members as $a): ?>
                        <div class="flex items-center gap-3 p-2 rounded-lg <?= $nik === $a['nik'] ? 'bg-primary/10 hover:bg-primary/20' : 'hover:bg-muted/50' ?>">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full <?= $nik === $a['nik'] ? 'bg-primary/10' : 'bg-muted' ?> flex items-center justify-center">
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
                                    <?= $a['full_name'] ?>
                                </p>
                                <p class="text-xs text-muted-foreground">
                                    <?= $a['relation'] ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="rounded-lg border bg-card text-card-foreground shadow-sm flex flex-col">
            <div class="flex flex-col space-y-1.5 p-6">
                <h3 class="text-2xl font-semibold leading-none tracking-tight">Visualisasi Family Tree</h3>
                <p class="text-sm text-muted-foreground">Silahkan lihat hubungan kekeluargaan dalam bentuk visual. Data ini bersifat informatif dan tidak dapat diubah.</p>
            </div>
            <div class="p-6 flex-1 flex-col flex">
                <div class="relative rounded-lg border flex-1 flex flex-col items-center justify-center overflow-auto bg-white p-4">
                    <div class="tree">
                        <ul>
                            <li>
                                <?php
                                foreach ($families as $family) {
                                    $father = isset($family['father']['full_name']) ? $family['father']['full_name'] : 'Unknown';
                                    $mother = isset($family['mother']['full_name']) ? $family['mother']['full_name'] : 'Unknown';
                                ?>
                                    <div class="flex justify-center border-2 border-primary w-fit mx-auto divide-x-2 divide-primary bg-primary/10 rounded-lg">
                                        <div class="person inline-block font-bold px-4 py-2">
                                            <?= $father ?>
                                        </div>
                                        <div class="person inline-block font-bold px-4 py-2">
                                            <?= $mother ?>
                                        </div>
                                    </div>
                                    <ul>
                                        <?php
                                        foreach ($family['children'] as $child) {
                                        ?>
                                            <li>
                                                <div class="person inline-block border-2 border-primary bg-primary/10 font-bold px-4 py-2 rounded-lg">
                                                    <?= $child['full_name'] ?>
                                                </div>
                                            </li>
                                    <?php
                                        }
                                    }
                                    ?>
                                    </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="mt-4 p-3 bg-yellow-50 rounded-lg border border-yellow-100 text-sm text-yellow-800 flex items-start gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-alert h-5 w-5 text-yellow-600 flex-shrink-0 mt-0.5">
                        <circle cx="12" cy="12" r="10">
                        </circle>
                        <line x1="12" x2="12" y1="8" y2="12">
                        </line>
                        <line x1="12" x2="12.01" y1="16" y2="16">
                        </line>
                    </svg>
                    <div>
                        <p class="font-medium mb-1">Informasi</p>
                        <p>Data family tree ini bersifat informatif dan diambil dari database kependudukan. Jika terdapat kesalahan data, silakan hubungi Dinas Kependudukan dan Pencatatan Sipil (Disdukcapil) setempat.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>