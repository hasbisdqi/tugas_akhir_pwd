<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include './utils/session.php';
include 'header.php';

?>
<header class="sticky top-0 z-40 border-b bg-background/95 backdrop-blur supports-[backdrop-filter]:bg-background/60">
    <div class="container flex h-16 items-center justify-between py-4">
        <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-tree-pine h-6 w-6 text-green-600">
                <path d="m17 14 3 3.3a1 1 0 0 1-.7 1.7H4.7a1 1 0 0 1-.7-1.7L7 14h-.3a1 1 0 0 1-.7-1.7L9 9h-.2A1 1 0 0 1 8 7.3L12 3l4 4.3a1 1 0 0 1-.8 1.7H15l3 3.3a1 1 0 0 1-.7 1.7H17Z">
                </path>
                <path d="M12 22v-3">
                </path>
            </svg>
            <span class="text-xl font-bold">KATEPE</span>
        </div>
        <nav class="hidden md:flex items-center gap-6">
            <a href="/dashboard.php" class="text-sm font-medium hover:text-primary flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-home h-4 w-4">
                    <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z">
                    </path>
                    <polyline points="9 22 9 12 15 12 15 22">
                    </polyline>
                </svg>
                <span>Beranda</span>
            </a>
            <a href="/family-tree.php" class="text-sm font-medium hover:text-primary flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-tree-pine h-4 w-4">
                    <path d="m17 14 3 3.3a1 1 0 0 1-.7 1.7H4.7a1 1 0 0 1-.7-1.7L7 14h-.3a1 1 0 0 1-.7-1.7L9 9h-.2A1 1 0 0 1 8 7.3L12 3l4 4.3a1 1 0 0 1-.8 1.7H15l3 3.3a1 1 0 0 1-.7 1.7H17Z">
                    </path>
                    <path d="M12 22v-3">
                    </path>
                </svg>
                <span>Family Tree</span>
            </a>
        </nav>
        <div class="flex items-center gap-4">
            <div class="hidden md:flex items-center gap-2 text-sm">
                <span class="text-muted-foreground">Selamat datang,</span>
                <span class="font-medium"><?=htmlspecialchars($_SESSION['nama'])?></span>
            </div>
            <a href="/logout.php" class="justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3 flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out h-4 w-4">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4">
                    </path>
                    <polyline points="16 17 21 12 16 7">
                    </polyline>
                    <line x1="21" x2="9" y1="12" y2="12">
                    </line>
                </svg>
                <span>Logout</span>
            </a>
        </div>
    </div>
</header>