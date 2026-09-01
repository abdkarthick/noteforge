<?php
require 'vendor/autoload.php';
$pdo = new PDO('mysql:host=127.0.0.1;dbname=noteforge', 'root', '');
$notes = $pdo->query("SELECT * FROM notes")->fetchAll();
echo "<h1>NoteForge Connected! Table Ready</h1>";
print_r($notes);
?>