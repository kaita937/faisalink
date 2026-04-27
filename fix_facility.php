<?php
$file = 'resources/views/facility.blade.php';
$content = file_get_contents($file);

// Pattern yang salah: item-footer ditutup, lalu langsung closing div untuk facility-item
// tapi item-body tidak ditutup
$wrong = <<<'PATTERN'
                    <div class="item-footer">
                        <span class="badge badge-available">Available</span>
                        <a href="#" class="btn-detail">Detail</a>
                    </div>
PATTERN;

$correct = <<<'PATTERN'
                    <div class="item-footer">
                        <span class="badge badge-available">Available</span>
                        <a href="#" class="btn-detail">Detail</a>
                    </div>
            </div>
PATTERN;

// Replace all occurrences
$content = str_replace($wrong, $correct, $content);

file_put_contents($file, $content);
echo "Fixed! Occurrences replaced: " . substr_count($content, $correct) . "\n";
