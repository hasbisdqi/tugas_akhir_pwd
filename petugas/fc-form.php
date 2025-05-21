<?php
include '../utils/conn.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $kk_number = $_POST['kk_number'];
    $head_id = $_POST['head_id'];
    $address = $_POST['address'];
    $subdistrict = $_POST['subdistrict'];
    $district = $_POST['district'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        echo "UPDATE";
        $createstmt = $conn->prepare("UPDATE family_cards SET kk_number = ?, head_id = ?, address = ?, subdistrict = ?, district = ?, city = ?, province = ? WHERE id = ?");
        $createstmt->bind_param(
            "ssssssss",
            $kk_number,
            $head_id,
            $address,
            $subdistrict,
            $district,
            $city,
            $province,
            $_POST['id']
        );
    } else {
        echo "CREATE";
        $createstmt = $conn->prepare("INSERT INTO family_cards (kk_number, head_id, address, subdistrict, district, city, province) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $createstmt->bind_param(
            "sssssss",
            $kk_number,
            $head_id,
            $address,
            $subdistrict,
            $district,
            $city,
            $province,
        );
    }
    $createstmt->execute();
    header("Location: /petugas/dashboard.php");
    exit;
}
if (isset($_GET['id'])) {
    $stmt = $conn->prepare("SELECT kk_number, head_id, address, subdistrict, district, city, province  FROM family_cards WHERE id = ? LIMIT 1");
    $stmt->bind_param("s", $_GET['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
}
include '../layout/header.php';
?>
<div class="container py-10">
    <div class="flex items-center mb-8">
        <a href="/petugas/keluarga" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 hover:bg-accent hover:text-accent-foreground h-10 w-10 mr-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left h-5 w-5">
                <path d="m15 18-6-6 6-6">
                </path>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold">Tambah Kartu Keluarga Baru</h1>
            <p class="text-muted-foreground">Isi formulir untuk menambahkan Kartu Keluarga baru</p>
        </div>
    </div>
    <form class="space-y-8" method="post">
        <?= isset($_GET['id']) ? "<input type='hidden' name='id' value='" . $_GET['id'] . "'>" : '' ?>
        <div class="rounded-lg border bg-card text-card-foreground shadow-sm" data-v0-t="card">
            <div class="flex flex-col space-y-1.5 p-6 bg-admin-50">
                <h3 class="text-2xl font-semibold leading-none tracking-tight">Data Kartu Keluarga</h3>
                <p class="text-sm text-muted-foreground">Informasi Kartu Keluarga</p>
            </div>
            <div class="p-6 pt-6">
                <div class="grid gap-6 sm:grid-cols-2">
                    <div class="space-y-2">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="«r3»-form-item">Nomor KK</label>
                        <input value="<?=$data['kk_number'] ?? ''?>"
                        class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" placeholder="Masukkan 16 digit Nomor KK" aria-describedby="«r3»-form-item-description" aria-invalid="false" id="«r3»-form-item" name="kk_number">
                        <p class="text-[0.8rem] text-muted-foreground" id="«r3»-form-item-description">Nomor Kartu Keluarga 16 digit</p>
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="«r4»-form-item">Kepala Keluarga</label>
                        <div class="flex flex-col gap-2">
                            <?php
                            $head_query = "SELECT id, nik, full_name FROM residents WHERE relation='Kepala Keluarga'";
                            $heads_result = $conn->query($head_query);
                            $selected_id = $data['head_id'] ?? '';
                            ?>
                            <input type="text" id="head_search" placeholder="Cari Kepala Keluarga" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2">
                            <select name="head_id" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" id="head_select">
                                <option value="">-- Pilih Kepala Keluarga --</option>
                                <?php while ($head = $heads_result->fetch_assoc()): ?>
                                    <option value="<?= $head['id'] ?>" <?= ($selected_id == $head['id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($head['nik'] . " - " . $head['full_name']) ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <p class="text-[0.8rem] text-muted-foreground" id="«r4»-form-item-description">Pilih penduduk sebagai kepala keluarga (penduduk harus ber relasi sebagai Kepala Keluarga)</p>
                    </div>
                </div>
                <div data-orientation="horizontal" role="none" class="shrink-0 bg-border h-[1px] w-full my-6">
                </div>
                <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3">
                    <div class="space-y-2 sm:col-span-2 md:col-span-3">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="«r8»-form-item">Alamat</label>
                        <input class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" placeholder="Masukkan alamat lengkap" aria-describedby="«r8»-form-item-description" aria-invalid="false" id="«r8»-form-item" value="<?=$data['address'] ?? ''?>" name="address">
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="«r9»-form-item">Kelurahan/Desa</label>
                        <input class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" placeholder="Masukkan kelurahan/desa" aria-describedby="«r9»-form-item-description" aria-invalid="false" id="«r9»-form-item" value="<?=$data['subdistrict'] ?? ''?>" name="subdistrict">
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="«ra»-form-item">Kecamatan</label>
                        <input class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" placeholder="Masukkan kecamatan" aria-describedby="«ra»-form-item-description" aria-invalid="false" id="«ra»-form-item" value="<?=$data['district'] ?? ''?>" name="district">
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="«rb»-form-item">Kabupaten/Kota</label>
                        <input class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" placeholder="Masukkan kabupaten/kota" aria-describedby="«rb»-form-item-description" aria-invalid="false" id="«rb»-form-item" value="<?=$data['city'] ?? ''?>" name="city">
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="«rc»-form-item">Provinsi</label>
                        <input class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" placeholder="Masukkan provinsi" aria-describedby="«rc»-form-item-description" aria-invalid="false" id="«rc»-form-item" value="<?=$data['province'] ?? ''?>" name="province">
                    </div>
                </div>
            </div>

            <div class="items-center p-6 flex justify-between border-t bg-muted/50 px-6 py-4">
                <a href="/petugas/keluarga" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2" type="button">Batal</a>
                <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 bg-primary text-primary-foreground h-10 px-4 py-2 bg-admin hover:bg-admin-600" type="submit" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save mr-2 h-4 w-4">
                        <path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z">
                        </path>
                        <path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7">
                        </path>
                        <path d="M7 3v4a1 1 0 0 0 1 1h7">
                        </path>
                    </svg>Simpan Data</button>
            </div>
        </div>
    </form>
</div>
<script>
    function search(select, input, options) {
        input.addEventListener('input', function() {
            const searchTerm = input.value.toLowerCase();
            select.innerHTML = '';
            if (searchTerm === '') {
                const placeholderOption = document.createElement('option');
                placeholderOption.value = '';
                placeholderOption.text = '-- Pilih Kartu Keluarga --';
                select.add(placeholderOption);
            }
            let matchFound = false;
            options.forEach(option => {
                if (option.value === '') return;
                if (option.text.toLowerCase().includes(searchTerm)) {
                    select.add(option.cloneNode(true));
                    matchFound = true;
                }
            });
            if (!matchFound) {
                const noMatchOption = document.createElement('option');
                noMatchOption.text = 'Tidak ada hasil yang cocok';
                noMatchOption.disabled = true;
                select.add(noMatchOption);
            }
        });
    }
    document.addEventListener('DOMContentLoaded', function() {
        const headCardSelect = document.getElementById('head_card_select');
        const headSearch = document.getElementById('head_card_search');
        const headCardOptions = Array.from(headCardSelect.options);
        search(headSelect, headSearch, headOptions);
    });
</script>