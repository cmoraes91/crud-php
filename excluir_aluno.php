<?php
include 'db.php';

$alunos = $pdo->query("SELECT * FROM alunos")->fetchAll(PDO::FETCH_ASSOC);
$disciplinas = $pdo->query("SELECT * FROM disciplinas")->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['delete_avaliacao'])) {
    $avaliacao_id = $_POST['avaliacao_id'];

    $stmt = $pdo->prepare("DELETE FROM avaliacoes WHERE id = :id");
    $stmt->execute(['id' => $avaliacao_id]);

    header('Location: listar_avaliacoes.php');
    exit;
}

if (isset($_POST['delete_aluno'])) {
    $aluno_id = $_POST['aluno_id'];

    $stmt = $pdo->prepare("DELETE FROM alunos WHERE id = :id");
    $stmt->execute(['id' => $aluno_id]);

    header('Location: listar_alunos.php');
    exit;
}
?>

<h2>Excluir Avaliação</h2>
<form method="POST" action="">
    <label>ID da Avaliação:</label>
    <input type="number" name="avaliacao_id" required>
    <input type="hidden" name="delete_avaliacao" value="1">
    <input type="submit" value="Excluir Avaliação">
</form>

<h2>Excluir Aluno</h2>
<form method="POST" action="">
    <label>Aluno:</label>
    <select name="aluno_id" required>
        <?php foreach ($alunos as $aluno) : ?>
            <option value="<?php echo $aluno['id']; ?>"><?php echo $aluno['nome']; ?></option>
        <?php endforeach; ?>
    </select>
    <input type="hidden" name="delete_aluno" value="1">
    <input type="submit" value="Excluir Aluno">
</form>
