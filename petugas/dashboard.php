<?php
include './auth-header.php';
include '../utils/conn.php';

$res_limit = 5;
$res_page = isset($_GET['res_page']) && is_numeric($_GET['res_page']) ? (int)$_GET['res_page'] : 1;
$res_offset = ($res_page - 1) * $res_limit;

$res_total_stmt = $conn->prepare("SELECT COUNT(*) as total FROM residents");
$res_total_stmt->execute();
$res_total_result = $res_total_stmt->get_result();
$res_total_row = $res_total_result->fetch_assoc();
$res_total_records = $res_total_row['total'];
$res_total_pages = ceil($res_total_records / $res_limit);

$res_stmt = $conn->prepare("SELECT r.*, address 
                            FROM residents r 
                            JOIN family_cards fc ON r.family_card_id=fc.id
                            LIMIT ? OFFSET ?");
$res_stmt->bind_param("ii", $res_limit, $res_offset);
$res_stmt->execute();
$res_result = $res_stmt->get_result();

$fc_limit = 5;
$fc_page = isset($_GET['fc_page']) && is_numeric($_GET['fc_page']) ? (int)$_GET['fc_page'] : 1;
$fc_offset = ($fc_page - 1) * $fc_limit;

$fc_total_stmt = $conn->prepare("SELECT COUNT(*) as total FROM family_cards");
$fc_total_stmt->execute();
$fc_total_result = $fc_total_stmt->get_result();
$fc_total_row = $fc_total_result->fetch_assoc();
$fc_total_records = $fc_total_row['total'];
$fc_total_pages = ceil($fc_total_records / $fc_limit);

$fc_stmt = $conn->prepare("SELECT fc.*, r.full_name AS head_name, 
    (SELECT COUNT(*) FROM residents WHERE family_card_id = fc.id) AS member_count 
    FROM family_cards fc 
    LEFT JOIN residents r ON fc.head_id = r.id 
    LIMIT ? OFFSET ?");
$fc_stmt->bind_param("ii", $fc_limit, $fc_offset);
$fc_stmt->execute();
$fc_result = $fc_stmt->get_result();
?>
<div class="container py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold mb-2">Dashboard Admin</h1>
        <p class="text-muted-foreground">Selamat datang di Sistem Manajemen Kependudukan. Kelola data penduduk dan keluarga.</p>
    </div>
    <div class="grid gap-6 md:grid-cols-2 mb-8">
        <div class="rounded-lg border bg-card text-card-foreground shadow-sm" data-v0-t="card">
            <div class="flex flex-col space-y-1.5 p-6 pb-2">
                <h3 class="tracking-tight text-lg font-medium">Total Penduduk</h3>
                <p class="text-sm text-muted-foreground">Jumlah penduduk terdaftar</p>
            </div>
            <div class="p-6 pt-0">
                <div class="text-3xl font-bold"><?= $res_total_records ?></div>
            </div>
        </div>
        <div class="rounded-lg border bg-card text-card-foreground shadow-sm" data-v0-t="card">
            <div class="flex flex-col space-y-1.5 p-6 pb-2">
                <h3 class="tracking-tight text-lg font-medium">Total Keluarga</h3>
                <p class="text-sm text-muted-foreground">Jumlah KK terdaftar</p>
            </div>
            <div class="p-6 pt-0">
                <div class="text-3xl font-bold"><?= $fc_total_records ?></div>
            </div>
        </div>
    </div>
    <div class="mb-8 space-y-8">
        <div>
            <div class="flex justify-between items-center mb-4">
                <h2>Penduduk</h2>
                <div class="flex items-center gap-2">
                    <a href="./resident-form.php" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 text-primary-foreground h-9 rounded-md px-3 bg-blue-600 hover:bg-blue-700"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus h-4 w-4 mr-1">
                            <path d="M5 12h14"></path>
                            <path d="M12 5v14"></path>
                        </svg> Tambah</a>
                </div>
            </div>
            <div class="mt-2 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2" style="animation-duration: 0s;">
                <div class="rounded-lg border bg-card text-card-foreground shadow-sm" data-v0-t="card">
                    <div class="p-0">
                        <div class="relative w-full overflow-auto">
                            <table class="w-full caption-bottom text-sm">
                                <thead class="[&amp;_tr]:border-b">
                                    <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                                        <th class="h-12 px-4 text-left align-middle font-medium">NIK</th>
                                        <th class="h-12 px-4 text-left align-middle font-medium">Nama</th>
                                        <th class="h-12 px-4 text-left align-middle font-medium">Jenis Kelamin</th>
                                        <th class="h-12 px-4 text-left align-middle font-medium">Tempat/Tgl Lahir</th>
                                        <th class="h-12 px-4 text-left align-middle font-medium">Alamat</th>
                                        <th class="h-12 px-4 text-left align-middle font-medium">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="[&amp;_tr:last-child]:border-0">
                                    <?php
                                    while ($row = $res_result->fetch_assoc()) {
                                    ?>
                                        <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                                            <td class="p-4 align-middle"><?= $row['nik'] ?></td>
                                            <td class="p-4 align-middle"><?= $row['full_name'] ?></td>
                                            <td class="p-4 align-middle"><?= $row['gender'] ?></td>
                                            <td class="p-4 align-middle"><?= $row['birth_place'] . ", " . $row['birth_date'] ?></td>
                                            <td class="p-4 align-middle"><?= $row['address'] ?></td>
                                            <td class="p-4 align-middle">
                                                <div class="flex gap-2">
                                                    <a href="resident-form.php?id=<?= $row['id'] ?>" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-8 w-8">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen h-4 w-4">
                                                            <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                            <path d="M18.375 2.625a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4Z"></path>
                                                        </svg>
                                                    </a>
                                                    <form method="POST" action="resident-delete.php" onsubmit="return confirm('Yakin ingin menghapus data penduduk ini?');" style="display:inline;">
                                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                        <button type="submit" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-8 w-8 text-red-500">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2 h-4 w-4">
                                                                <path d="M3 6h18"></path>
                                                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                                                <line x1="10" x2="10" y1="11" y2="17"></line>
                                                                <line x1="14" x2="14" y1="11" y2="17"></line>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="p-6 pt-0 flex items-center justify-between">
                        <div class="text-sm text-muted-foreground">
                            <?php
                            $start = $res_offset + 1;
                            $end = min($res_offset + $res_limit, $res_total_records);
                            echo "Menampilkan {$start}-{$end} dari {$res_total_records} data";
                            ?>
                        </div>
                        <div class="flex gap-2">
                            <a
                                href="?res_page=<?= max(1, $res_page - 1) ?>"
                                class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3<?= $res_page <= 1 ? ' pointer-events-none opacity-50' : '' ?>"
                                <?= $res_page <= 1 ? 'tabindex="-1" aria-disabled="true"' : '' ?>>Sebelumnya</a>
                            <a
                                href="?res_page=<?= min($res_total_pages, $res_page + 1) ?>"
                                class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3<?= $res_page >= $res_total_pages ? ' pointer-events-none opacity-50' : '' ?>"
                                <?= $res_page >= $res_total_pages ? 'tabindex="-1" aria-disabled="true"' : '' ?>>Selanjutnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-10">
            <div class="flex justify-between items-center mb-4">
                <h2>Kartu Keluarga</h2>
                <div class="flex items-center gap-2">
                    <a href="./fc-form.php" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 text-primary-foreground h-9 rounded-md px-3 bg-blue-600 hover:bg-blue-700">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus h-4 w-4 mr-1">
                            <path d="M5 12h14"></path>
                            <path d="M12 5v14"></path>
                        </svg> Tambah
                    </a>
                </div>
            </div>
            <div class="mt-2 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2" style="animation-duration: 0s;">
                <div class="rounded-lg border bg-card text-card-foreground shadow-sm" data-v0-t="card">
                    <div class="p-0">
                        <div class="relative w-full overflow-auto">
                            <table class="w-full caption-bottom text-sm">
                                <thead class="[&amp;_tr]:border-b">
                                    <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                                        <th class="h-12 px-4 text-left align-middle font-medium">No. KK</th>
                                        <th class="h-12 px-4 text-left align-middle font-medium">Kepala Keluarga</th>
                                        <th class="h-12 px-4 text-left align-middle font-medium">Jumlah Anggota</th>
                                        <th class="h-12 px-4 text-left align-middle font-medium">Alamat</th>
                                        <th class="h-12 px-4 text-left align-middle font-medium">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="[&amp;_tr:last-child]:border-0">
                                    <?php
                                    while ($fc_row = $fc_result->fetch_assoc()) {
                                    ?>
                                        <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                                            <td class="p-4 align-middle"><?= htmlspecialchars($fc_row['kk_number']) ?></td>
                                            <td class="p-4 align-middle"><?= htmlspecialchars($fc_row['head_name']) ?></td>
                                            <td class="p-4 align-middle"><?= $fc_row['member_count'] ?></td>
                                            <td class="p-4 align-middle"><?= htmlspecialchars($fc_row['address']) ?></td>
                                            <td class="p-4 align-middle">
                                                <div class="flex gap-2">
                                                    <a href="fc-form.php?id=<?= $fc_row['id'] ?>" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-8 w-8">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen h-4 w-4">
                                                            <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                            <path d="M18.375 2.625a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4Z"></path>
                                                        </svg>
                                                    </a>
                                                    <form method="POST" action="fc-delete.php" onsubmit="return confirm('Yakin ingin menghapus data KK ini?');" style="display:inline;">
                                                        <input type="hidden" name="id" value="<?= $fc_row['id'] ?>">
                                                        <button type="submit" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-8 w-8 text-red-500">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2 h-4 w-4">
                                                                <path d="M3 6h18"></path>
                                                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                                                <line x1="10" x2="10" y1="11" y2="17"></line>
                                                                <line x1="14" x2="14" y1="11" y2="17"></line>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="p-6 pt-0 flex items-center justify-between">
                        <div class="text-sm text-muted-foreground">
                            <?php
                            $start = $fc_offset + 1;
                            $end = min($fc_offset + $fc_limit, $fc_total_records);
                            echo "Menampilkan {$start}-{$end} dari {$fc_total_records} data";
                            ?>
                        </div>
                        <div class="flex gap-2">
                            <a
                                href="?fc_page=<?= max(1, $fc_page - 1) ?>"
                                class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3<?= $fc_page <= 1 ? ' pointer-events-none opacity-50' : '' ?>"
                                <?= $fc_page <= 1 ? 'tabindex="-1" aria-disabled="true"' : '' ?>>Sebelumnya</a>
                            <a
                                href="?fc_page=<?= min($fc_total_pages, $fc_page + 1) ?>"
                                class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3<?= $fc_page >= $fc_total_pages ? ' pointer-events-none opacity-50' : '' ?>"
                                <?= $fc_page >= $fc_total_pages ? 'tabindex="-1" aria-disabled="true"' : '' ?>>Selanjutnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>