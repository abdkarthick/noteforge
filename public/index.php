<?php
$pdo = new PDO('mysql:host=127.0.0.1;dbname=noteforge', 'root', '');

if(isset($_POST['title'])){
  $stmt = $pdo->prepare("INSERT INTO notes (title, content) VALUES (?, ?)");
  $stmt->execute([$_POST['title'], $_POST['content']]);
  header("Location: index.php");
}

$notes = $pdo->query("SELECT * FROM notes ORDER BY id DESC")->fetchAll();
?>
<h1>NoteForge 📝</h1>
<form method="POST">
  <input name="title" placeholder="Title" required style="padding:8px;width:200px">
  <input name="content" placeholder="Content" required style="padding:8px;width:200px">
  <button type="submit">Add Note</button>
</form>
<hr>
<?php foreach($notes as $n): ?>
  <div style="border:1px solid #ccc;padding:10px;margin:10px 0">
    <b><?= htmlspecialchars($n['title']) ?></b>: <?= htmlspecialchars($n['content']) ?>
  </div>
<?php endforeach; ?>
<?php if(count($notes)==0) echo "No notes yet, add one da!"; ?>