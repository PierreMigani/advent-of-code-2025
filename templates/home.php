<?php $this->layout('template', ['title' => $this->e('Advent Of Code 2025')]) ?>

<h1>Advent Of Code 2025</h1>

<!-- list of links to day forms -->
<div>
    <?php for ($i = 1; $i <= $nbDays; $i++): ?>
        <a href="/day<?=$i?>">Day <?=$i?></a>
    <?php endfor; ?>
</div>
