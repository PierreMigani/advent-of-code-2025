<?php $this->layout('template', ['title' => $this->e($title)]) ?>

<h1><?=$this->e($title)?></h1>

<?php if (isset($partOneResult) || isset($partTwoResult)): ?>
    <!-- display results -->
    <?php $this->insert($resultsTemplate, [
        'partOneResult' => $partOneResult,
        'partTwoResult' => $partTwoResult,
    ]) ?>
<?php else: ?>
    <!-- form to submit problem input -->
    <textarea name="input" form="day-form" rows=20></textarea>
    <form
        id="day-form"
        action="<?=$this->e($name)?>"
        method="post"
    >
        <input type="submit" value="Submit" />
    </form>
<?php endif; ?>
