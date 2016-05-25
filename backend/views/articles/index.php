<?
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

use webvimark\extensions\GridBulkActions\GridBulkActions;
use webvimark\extensions\GridPageSize\GridPageSize;
use webvimark\modules\UserManagement\components\GhostHtml;
use webvimark\modules\UserManagement\UserManagementModule;

use common\models\Articles;

	$actionColumn = [
		'class' => 'yii\grid\ActionColumn',
		'contentOptions' => ['style' => 'width:70px; text-align:center;'],
		'template' => '{view}{update}',
	];


$this->title = 'Статьи';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-visit-log-index">

	<div class="panel panel-default">
		<div class="panel-body">
			<div class="row">
				<div class="col-sm-6">
					<p>
		<?= GhostHtml::a(UserManagementModule::t('back', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
			</p>
			</div>
	
			<div class="col-sm-6 text-right">
				<?= GridPageSize::widget(['pjaxId'=>'app-grid-pjax']) ?>
			</div>
		</div>
		<?php Pjax::begin([
				'id'=>'app-grid-pjax',
			]) ?>

<?= GridView::widget([
	'id' => 'app-grid',
    'dataProvider' => $dataProvider,
	'layout' => '{items}<div class="row"><div class="col-sm-8">{pager}</div><div class="col-sm-4 text-right">{summary}</div></div>',
	'filterModel' => $searchModel,
	'pager'=>[
		'options'=>['class'=>'pagination pagination-sm'],
		'hideOnSinglePage'=>true,
		'lastPageLabel'=>'>>',
		'firstPageLabel'=>'<<',
	],
	'rowOptions'=>function($model)
	{
		if($model->status == Articles::STATUS_ACTIVE)
		{
			return ['class' => 'success'];
		}
		
    },
    'columns' => [
       [
			'attribute'=>'id',
			'value'=>function($model){
				return Html::a($model->id, ['view', 'id'=>$model->id], ['data-pjax'=>0]);
			},
			'format'=>'raw',
		],
       
        [
        	'attribute'=>'status',
        	'filter'=>Articles::getStatusList(),
			'value'=>function($model){
				return Articles::getStatusValue($model->status);
			},
		],
        'title',
        [
        	'attribute'=>'descr',
        	'value'=>function($model){
		
				$tmp = [];
				$text = explode(" ", $model->descr);
				foreach ($text as $k => $t)
					if($k < 10)
						$tmp[] = $t;
		
				return implode(" ", $tmp).(count($text) > 10 ? "..." : "");
			},
		],
        'date',
        'created_at',
        
		$actionColumn,
		
    ],
]) ?>

<?php Pjax::end() ?>
</div>
</div>
</div>