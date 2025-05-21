<?php
include '../utils/conn.php';

// error_reporting(E_ALL);
// ini_set('display_errors', 1);
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $nik = $_POST['nik'];
    $password = $_POST['password'];
    $full_name = $_POST['full_name'];
    $birth_place = $_POST['birth_place'];
    $birth_date = $_POST['birth_date'];
    $family_card_id = $_POST['family_card_id'];
    $relation = $_POST['relation'];
    $gender = $_POST['gender'];
    $father_id = !empty($_POST['father_id']) ? $_POST['father_id'] : null;
    $mother_id = !empty($_POST['mother_id']) ? $_POST['mother_id'] : null;
    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $createstmt = $conn->prepare("UPDATE residents SET nik = ?, password = ?, full_name = ?, birth_place = ?, birth_date = ?, family_card_id = ?, relation = ?, gender = ?, father_id = ?, mother_id = ? WHERE id = ?");
        $createstmt->bind_param(
            "ssssssssiii",
            $nik,
            $password,
            $full_name,
            $birth_place,
            $birth_date,
            $family_card_id,
            $relation,
            $gender,
            $father_id,
            $mother_id,
            $_POST['id']
        );
    } else {
        $createstmt = $conn->prepare("INSERT INTO residents (nik, password, full_name, birth_place, birth_date, family_card_id, relation, gender, father_id, mother_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $createstmt->bind_param(
            "ssssssssss",
            $nik,
            $password,
            $full_name,
            $birth_place,
            $birth_date,
            $family_card_id,
            $relation,
            $gender,
            $father_id,
            $mother_id
        );
    }
    $createstmt->execute();
    header("Location: /petugas/dashboard.php");
    exit;
}
if (isset($_GET['id'])) {
    $stmt = $conn->prepare("SELECT nik, full_name, birth_place, birth_date, family_card_id, relation, gender, father_id, mother_id  FROM residents WHERE id = ? LIMIT 1");
    $stmt->bind_param("s", $_GET['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $resident = $result->fetch_assoc();
}
include '../layout/header.php';
?>
<div class="container py-10">
    <div class="flex items-center mb-8">
        <a href="/petugas/dashboard.php" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 hover:bg-accent hover:text-accent-foreground h-10 w-10 mr-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left h-5 w-5">
                <path d="m15 18-6-6 6-6">
                </path>
            </svg>

        </a>
        <div>
            <h1 class="text-2xl font-bold">Tambah Penduduk Baru</h1>
            <p class="text-muted-foreground">Isi formulir untuk menambahkan data penduduk baru</p>
        </div>
    </div>
    <form class="space-y-8" method="POST">
        <?= isset($_GET['id']) ? "<input type='hidden' name='id' value='" . $_GET['id'] . "'>" : '' ?>
        <div class="rounded-lg border bg-card text-card-foreground shadow-sm" data-v0-t="card">
            <div class="flex flex-col space-y-1.5 p-6 bg-admin-50">
                <h3 class="text-2xl font-semibold leading-none tracking-tight">Data Identitas</h3>
                <p class="text-sm text-muted-foreground">Informasi identitas penduduk sesuai dokumen resmi</p>
            </div>
            <div class="p-6 pt-6">
                <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3">
                    <div class="space-y-2">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">NIK</label>
                        <input type="number" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" placeholder="Masukkan 16 digit NIK" value="<?= $resident['nik'] ?? '' ?>" name="nik">
                        <p class="text-[0.8rem] text-muted-foreground" id="«r0»-form-item-description">Nomor Induk Kependudukan 16 digit</p>
                    </div>
                    <div class="space-y-2 sm:col-span-2">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Nama Lengkap</label>
                        <input class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" placeholder="Masukkan nama lengkap" value="<?= $resident['full_name'] ?? '' ?>" name="full_name">
                        <p class="text-[0.8rem] text-muted-foreground" id="«r1»-form-item-description">Nama lengkap sesuai KTP</p>
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Tempat Lahir</label>
                        <input class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" placeholder="Masukkan tempat lahir" value="<?= $resident['birth_place'] ?? '' ?>" name="birth_place">
                    </div>
                    <div class="space-y-2 flex flex-col">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Tanggal Lahir</label>
                        <input type="date" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" placeholder="Masukkan tempat lahir" value="<?= $resident['birth_date'] ?? '' ?>" name="birth_date">
                    </div>
                    <div class="space-y-3">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Jenis Kelamin</label>
                        <div role="radiogroup" aria-required="false" dir="ltr" class="gap-2 py-2 flex space-x-4" tabindex="0" style="outline: none;">
                            <div class="flex gap-2 items-center">
                                <input type="radio" name="gender" <?= isset($resident['gender']) ? $resident['gender'] === 'L' ? 'checked' : '' : '' ?> class="accent-primary" value="L" id="genderL">
                                <label for="genderL">Laki laki</label>
                            </div>
                            <div class="flex gap-2 items-center">
                                <input type="radio" name="gender" <?= isset($resident['gender']) ? $resident['gender'] === 'P' ? 'checked' : '' : '' ?> class="accent-primary" value="P" id="genderP">
                                <label for="genderP">Perempuan</label>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Password</label>
                        <input class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" placeholder="Masukkan password" type="password" value="" name="password">
                        <p class="text-[0.8rem] text-muted-foreground" id="«ra»-form-item-description">Password untuk login ke sistem (opsional)</p>
                    </div>
                </div>
                <div data-orientation="horizontal" role="none" class="shrink-0 bg-border h-[1px] w-full my-6">
                </div>
                <div class="grid gap-6 sm:grid-cols-2">
                    <div class="space-y-2">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Kartu Keluarga</label>
                        <div class="flex flex-col gap-2">
                            <?php
                            $family_cards_query = "SELECT id, kk_number FROM family_cards";
                            $family_cards_result = $conn->query($family_cards_query);
                            $selected_family_card_id = $resident['family_card_id'] ?? '';
                            ?>
                            <input type="text" id="family_card_search" placeholder="Cari nomor KK..." class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2">
                            <select name="family_card_id" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" id="family_card_select">
                                <option value="">-- Pilih Kartu Keluarga --</option>
                                <?php while ($family_card = $family_cards_result->fetch_assoc()): ?>
                                    <option value="<?= $family_card['id'] ?>" <?= ($selected_family_card_id == $family_card['id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($family_card['kk_number']) ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <p class="text-[0.8rem] text-muted-foreground" id="«rb»-form-item-description">Pilih kartu keluarga yang sesuai</p>
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Hubungan Keluarga</label>
                        <select tabindex="-1" name="relation" class="flex h-10 w-full items-center justify-between rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 [&amp;>span]:line-clamp-1">
                            <option value="Kepala Keluarga">Kepala Keluarga</option>
                            <option value="Istri">Istri</option>
                            <option value="Anak">Anak</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                        <p class="text-[0.8rem] text-muted-foreground" id="«rf»-form-item-description">Hubungan dengan kepala keluarga</p>
                    </div>
                </div>
                <div data-orientation="horizontal" role="none" class="shrink-0 bg-border h-[1px] w-full my-6">
                </div>
                <div class="grid gap-6 sm:grid-cols-2">
                    <div class="space-y-2">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Ayah</label>
                        <div class="flex flex-col gap-2">
                            <?php
                            $father_query = "SELECT id, nik, full_name FROM residents WHERE gender='L'";
                            $fathers_result = $conn->query($father_query);
                            $selected_nik = $father['nik'] ?? '';
                            ?>
                            <input type="text" id="father_search" placeholder="Cari Ayah" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2">
                            <select name="nik" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" id="father_select">
                                <option value="">-- Pilih Ayah --</option>
                                <?php while ($father = $fathers_result->fetch_assoc()): ?>
                                    <option value="<?= $father['id'] ?>" <?= ($selected_nik == $father['id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($father['nik']." - ".$father['full_name']) ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <p class="text-[0.8rem] text-muted-foreground" id="«rg»-form-item-description">Pilih ayah dari penduduk (opsional)</p>
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Ibu</label>
                        <div class="flex flex-col gap-2">
                            <?php
                            $mother_query = "SELECT id, nik, full_name FROM residents WHERE gender='P'";
                            $mothers_result = $conn->query($mother_query);
                            $selected_nik = $mother['nik'] ?? '';
                            ?>
                            <input type="text" id="mother_search" placeholder="Cari Ibu" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2">
                            <select name="nik" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" id="mother_select">
                                <option value="">-- Pilih Ibu --</option>
                                <?php while ($mother = $mothers_result->fetch_assoc()): ?>
                                    <option value="<?= $mother['id'] ?>" <?= ($selected_nik == $mother['id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($mother['nik']." - ".$mother['full_name']) ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <p class="text-[0.8rem] text-muted-foreground" id="«rk»-form-item-description">Pilih ibu dari penduduk (opsional)</p>
                    </div>
                </div>
            </div>
            <div class="items-center p-6 flex justify-between border-t bg-muted/50 px-6 py-4">
                <a href="/petugas/penduduk" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2" type="button">Batal</a>
                <button class="inline-flex items-center bg-primary justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 text-primary-foreground h-10 px-4 py-2 bg-admin hover:bg-admin-600" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save mr-2 h-4 w-4">
                        <path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z">
                        </path>
                        <path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7">
                        </path>
                        <path d="M7 3v4a1 1 0 0 0 1 1h7">
                        </path>
                    </svg>
                    Simpan Data
                </button>
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
        const familyCardSelect = document.getElementById('family_card_select');
        const searchFam = document.getElementById('family_card_search');
        const familyCardOptions = Array.from(familyCardSelect.options);
        const fatherSelect = document.getElementById('father_select');
        const fatherSearch = document.getElementById('father_search');
        const fatherOptions = Array.from(fatherSelect.options);
        const motherSelect = document.getElementById('mother_select');
        const motherSearch = document.getElementById('mother_search');
        const motherOptions = Array.from(motherSelect.options);
        search(familyCardSelect, searchFam, familyCardOptions);
        search(fatherSelect, fatherSearch, fatherOptions);
        search(motherSelect, motherSearch, motherOptions);

    });
</script>