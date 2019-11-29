<?php

include __DIR__ . '/../app/getClient.php';
/** @var SpinitronApiClient $client */
$result = $client->search('spins', ['count' => 10 , 'start' => '2018-11-15' , 'end' => '2018-11-16'] );

?>

<?php foreach ($result['items'] as $spin): ?>

<?php print_r($spin); ?>

    <p><?= (new DateTime($spin['start']))
            ->setTimezone(new DateTimeZone($spin['timezone'] ?? 'America/New_York'))
            ->format('g:ia') ?>
        <b><?= htmlspecialchars($spin['artist'], ENT_NOQUOTES) ?></b>
        <em>“<?= htmlspecialchars($spin['song'], ENT_NOQUOTES) ?>”</em>
        from <?= htmlspecialchars($spin['release'], ENT_NOQUOTES) ?></p>
<?php endforeach ?>

<p>
    <small>(Updated <?= gmdate('H:i:s') ?> UTC)</small>
</p>
