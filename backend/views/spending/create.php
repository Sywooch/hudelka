<?php

use webvimark\modules\UserManagement\UserManagementModule;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\User $model
 */

$this->title = 'Расход/Приход';
$this->params['breadcrumbs'][] = ['label' => 'Расход/Приход', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

	<div class="panel panel-default">
		<div class="panel-body">
			<?= $this->render('_form', compact('model')) ?>
		</div>
	</div>

</div>
