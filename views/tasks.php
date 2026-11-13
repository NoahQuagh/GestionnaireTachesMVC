<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionnaire de tâches</title>
    <link rel="stylesheet" href="/DemoMVCAlpha/public/css/style.css">
</head>
<body>
<header>
    <nav><a href="/DemoMVCAlpha">Retour</a></nav>
</header>
<h1>Liste des tâches</h1>
<form id="search-form">
    <input type="number" id="search" min="1" required placeholder="Rechercher par id">
    <button type="submit">Valider</button>
</form>
<table>
    <thead>
    <tr>
        <th scope="col">Titre</th>
        <th scope="col">Description</th>
        <th scope="col">Créer le</th>
        <th scope="col">Statut</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($tasks as $task): ?>
        <tr>
            <td><?php echo $task['titre']; ?></td>
            <td><?php echo $task['description']; ?></td>
            <td><?php echo $task['date_creation']; ?></td>
            <td><?php echo $task['statut']; ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<script>
    document.getElementById('search-form').addEventListener('submit', function(e) {
        e.preventDefault();

        const id = document.getElementById('search').value.trim();

        if (id) {
            window.location.href = '/DemoMVCAlpha/tasks/' + encodeURIComponent(id);
        }
    });
</script>
</body>
</html>