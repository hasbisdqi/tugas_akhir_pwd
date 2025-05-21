<?php
session_start();
include '../layout/header.php';
?>
<div class="flex min-h-svh flex-col items-center justify-center bg-muted p-6 md:p-10">
    <div class="w-full max-w-sm">
        <div class="flex flex-col gap-6">
            <div class="rounded-xl border border-border bg-card text-card-foreground shadow overflow-hidden">
                <div class="grid p-0">
                    <form class="p-6 md:p-8" action="login_process.php" method="POST">
                        <div class="flex flex-col gap-6">
                            <div class="flex flex-col items-center text-center">
                                <h1 class="text-2xl font-bold">Login Petugas</h1>
                                <p class="text-balance text-muted-foreground">Akses khusus untuk petugas Disdukcapil</p>
                            </div>
                            <div class="grid gap-2">
                                <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="email">
                                    Email</label>
                                <input type="email" name="email" class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-base shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 md:text-sm" id="email" placeholder="mail@example.com" required="">
                            </div>
                            <div class="grid gap-2">
                                <div class="flex items-center">
                                    <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="password">Password</label>
                                </div>
                                <input type="password" name="password" class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-base shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 md:text-sm" id="password" required="">
                            </div>
                            <input class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 bg-primary text-primary-foreground shadow hover:bg-primary/90 h-9 px-4 py-2 w-full" type="submit" value="Login">
                        </div>
                        <span class="mt-2 text-sm text-destructive"><?= isset($_GET['error']) ? $_GET['error'] : '' ?></span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>