<?php
require_once 'auth.php';
require_once '../config.php';

$empresaId = $_SESSION['empresa_id'];

$stmt = $pdo->prepare("SELECT * FROM processos WHERE empresa_id = ? ORDER BY STR_TO_DATE(data_lista, '%d/%m/%Y') ASC, id ASC");
$stmt->execute([$empresaId]);
$processos = $stmt->fetchAll();

$processoSelecionado = null;
$orgaos = [];

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM processos WHERE id = ? AND empresa_id = ? LIMIT 1");
    $stmt->execute([$_GET['id'], $empresaId]);
    $processoSelecionado = $stmt->fetch();

    if ($processoSelecionado) {
        $stmt = $pdo->prepare("SELECT * FROM orgaos WHERE processo_id = ? ORDER BY ordem ASC, id ASC");
        $stmt->execute([$processoSelecionado['id']]);
        $orgaos = $stmt->fetchAll();
    }
}

$orgaosPadrao = ['Boa Vista', 'Cenprot Nacional', 'Cenprot SP', 'Serasa', 'SPC', 'Status Geral'];

$orgaosPorNome = [];
foreach ($orgaos as $orgao) {
    $orgaosPorNome[$orgao['nome']] = $orgao;
}

function campo_orgao($orgaosPorNome, $nome, $campo) {
    return htmlspecialchars($orgaosPorNome[$nome][$campo] ?? '');
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<main class="admin-shell">

    <header class="admin-header">
        <div>
            <h1>Painel Administrativo</h1>
            <p>Empresa: <strong><?= htmlspecialchars($_SESSION['empresa_nome']) ?></strong></p>
        </div>

        <div class="admin-actions">
            <a href="../index.php?empresa=<?= htmlspecialchars($_SESSION['empresa_slug']) ?>" target="_blank">Ver página pública</a>
            <a href="dashboard.php">Novo processo</a>
            <a href="logout.php" class="dark-btn">Sair</a>
        </div>
    </header>

    <section class="admin-grid">

        <aside class="admin-list-area">
            <div class="admin-box-title">
                <h2>Processos cadastrados</h2>
            </div>

            <div class="admin-process-list">
                <?php foreach ($processos as $processo): ?>
                    <a class="admin-process-item <?= $processoSelecionado && $processoSelecionado['id'] == $processo['id'] ? 'active' : '' ?>" href="dashboard.php?id=<?= $processo['id'] ?>">
                        <strong><?= htmlspecialchars($processo['data_lista']) ?></strong>
                        <p><?= htmlspecialchars($processo['nome']) ?></p>
                        <span class="badge <?= str_replace([' ', '%'], ['-', ''], $processo['status']) ?>">
                            <?= htmlspecialchars($processo['status']) ?>
                        </span>
                    </a>
                <?php endforeach; ?>
            </div>
        </aside>

        <section class="form-area">
            <form method="POST" action="salvar-processo.php">

                <input type="hidden" name="id" value="<?= htmlspecialchars($processoSelecionado['id'] ?? '') ?>">

                <div class="form-title">
                    <h2><?= $processoSelecionado ? 'Editando lista ' . htmlspecialchars($processoSelecionado['data_lista']) : 'Novo processo' ?></h2>
                    <p>Preencha as informações que o cliente visualizará.</p>
                </div>

                <div class="form-row">
                    <label>
                        Data da lista
                        <input type="text" name="data_lista" placeholder="Ex: 08/05/2026" value="<?= htmlspecialchars($processoSelecionado['data_lista'] ?? '') ?>" required>
                    </label>

                    <label>
                        Status
                        <select name="status" required>
                            <option value="em andamento" <?= ($processoSelecionado['status'] ?? '') === 'em andamento' ? 'selected' : '' ?>>Em andamento</option>
                            <option value="100% baixado" <?= ($processoSelecionado['status'] ?? '') === '100% baixado' ? 'selected' : '' ?>>100% baixado</option>
                            <option value="reprotocolo" <?= ($processoSelecionado['status'] ?? '') === 'reprotocolo' ? 'selected' : '' ?>>Reprotocolo</option>
                        </select>
                    </label>
                </div>

                <label>
                    Título interno
                    <input type="text" name="nome" placeholder="Ex: Processo coletivo" value="<?= htmlspecialchars($processoSelecionado['nome'] ?? 'Processo coletivo') ?>" required>
                </label>

                <label>
                    Resumo geral
                    <textarea name="resumo" rows="4" placeholder="Texto que aparecerá no resumo da lista"><?= htmlspecialchars($processoSelecionado['resumo'] ?? '') ?></textarea>
                </label>

                <h3 class="org-form-title">Informações por órgão</h3>

                <div class="admin-org-fields">
                    <?php foreach ($orgaosPadrao as $index => $nomeOrgao): ?>
                        <div class="admin-org-box">
                            <h4><?= htmlspecialchars($nomeOrgao) ?></h4>

                            <input type="hidden" name="orgaos[<?= $index ?>][nome]" value="<?= htmlspecialchars($nomeOrgao) ?>">
                            <input type="hidden" name="orgaos[<?= $index ?>][ordem]" value="<?= $index + 1 ?>">

                            <label>
                                Status do órgão
                                <input type="text" name="orgaos[<?= $index ?>][status]" value="<?= campo_orgao($orgaosPorNome, $nomeOrgao, 'status') ?>" placeholder="Ex: Aguardando início das baixas">
                            </label>

                            <label>
                                Descrição
                                <textarea name="orgaos[<?= $index ?>][descricao]" rows="4" placeholder="Descrição do órgão"><?= campo_orgao($orgaosPorNome, $nomeOrgao, 'descricao') ?></textarea>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="form-buttons">
                    <button type="submit">Salvar processo</button>

                    <?php if ($processoSelecionado): ?>
                        <a class="danger-link" href="excluir-processo.php?id=<?= $processoSelecionado['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir este processo?')">Excluir</a>
                    <?php endif; ?>
                </div>

            </form>
        </section>

    </section>

</main>

</body>
</html>
