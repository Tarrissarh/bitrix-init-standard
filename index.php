<?php

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

$APPLICATION->SetTitle('Главная');

?>

<?php

$APPLICATION->IncludeComponent(
	'standard:homepage',
	'.default',
	[],
	false
);

?>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'; ?>