<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Enregistrer une commande">
    <title>Enregistrer une commande</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <main class="page-shell">
        <section class="order-sheet" aria-labelledby="page-title">
            <header class="title-rail">
                <div>
                    <p class="section-kicker">Saisie commande</p>
                    <h1 id="page-title">Enregistrer une commande</h1>
                    <p class="supporting-copy">Saisissez le montant, puis indiquez si la réduction doit être appliquée.</p>
                </div>
                <p class="sheet-reference" aria-hidden="true">Commande / 01</p>
            </header>

            <?php if (isset($feedback['type'])): ?>
                <div
                    class="feedback-strip feedback-strip--<?= htmlspecialchars((string) ($feedback['type'] ?? 'error'), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>"
                    role="<?= ($feedback['type'] ?? 'error') === 'success' ? 'status' : 'alert' ?>"
                    aria-live="polite"
                    tabindex="-1"
                >
                    <strong><?= htmlspecialchars((string) ($feedback['message'] ?? ''), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></strong>
                </div>
            <?php elseif (isset($errors['form'])): ?>
                <div class="feedback-strip feedback-strip--error" role="alert" aria-live="assertive">
                    <strong><?= htmlspecialchars((string) $errors['form'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></strong>
                </div>
            <?php endif; ?>

            <form class="order-grid" method="post" action="">
                <div class="index-rail" aria-hidden="true">01</div>

                <section class="input-region" aria-labelledby="input-heading">
                    <p class="region-label" id="input-heading">Données de commande</p>

                    <div class="field-group">
                        <label class="field-label" for="prixFinal">Prix avant réduction</label>
                        <div class="amount-input-wrap">
                            <input
                                class="amount-input"
                                id="prixFinal"
                                name="prixFinal"
                                type="text"
                                inputmode="decimal"
                                autocomplete="off"
                                placeholder="0,00"
                                value="<?= htmlspecialchars(
                                    (string) ($values['prixFinal'] ?? ''),
                                    ENT_QUOTES | ENT_SUBSTITUTE,
                                    'UTF-8'
                                ) ?>"
                                required
                                aria-describedby="prixFinal-help<?= isset($errors['prixFinal']) ? ' prixFinal-error' : '' ?>"
                                aria-invalid="<?= isset($errors['prixFinal']) ? 'true' : 'false' ?>"
                            >
                            <span class="currency-suffix" aria-hidden="true">cfa</span>
                        </div>
                        <p class="field-help" id="prixFinal-help">Montant supérieur à 0 cfa.</p>
                        <?php if (isset($errors['prixFinal'])): ?>
                            <p class="field-error" id="prixFinal-error" role="alert">
                                <?= htmlspecialchars((string) $errors['prixFinal'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>
                            </p>
                        <?php endif; ?>
                    </div>

                    <label class="reduction-field" for="reductionAppliquee">
                        <input
                            class="reduction-checkbox"
                            id="reductionAppliquee"
                            name="reductionAppliquee"
                            type="checkbox"
                            value="1"
                            <?= !empty($values['reductionAppliquee']) ? 'checked' : '' ?>
                        >
                        <span>
                            <strong>Appliquer la réduction de 10 %</strong>
                            <small>Le montant enregistré sera recalculé avant sauvegarde.</small>
                        </span>
                    </label>
                </section>

              
            </form>
        </section>
    </main>
</body>
</html>
