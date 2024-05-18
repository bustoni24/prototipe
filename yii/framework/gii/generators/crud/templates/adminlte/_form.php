<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */
/* @var $form CActiveForm */
?>

<div class="form">

<?php echo "<?php \$form=\$this->beginWidget('CActiveForm', array(
	'id'=>'".$this->class2id($this->modelClass)."-form',
	'htmlOptions'=>array('class' => 'form-horizontal'),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>\n"; ?>

<div class="card-body">
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo "<?php echo \$form->errorSummary(\$model); ?>\n"; ?>

	<?php
	foreach($this->tableSchema->columns as $column)
	{
		if($column->autoIncrement)
			continue;
	?>

		<div class="form-group row">
			<?php echo "<?php echo ".$this->generateActiveLabel($this->modelClass,$column)."; ?>\n"; ?>
			<div class="col-sm-8">
					<?php echo "<?php echo ".$this->generateActiveField($this->modelClass,$column)."; ?>\n"; ?>
					<?php echo "<?php echo \$form->error(\$model,'{$column->name}'); ?>\n"; ?>
			</div>
		</div>
	<?php
	}
	?>
</div>

	<div class="card-footer">
		<button type="submit" class="btn btn-success float-right ml-10"><i class="fa fa-check-square-o"></i> Submit</button>
		<?php echo "<?php if (!isset(\$model->id)): ?>\n"; ?>
			<button type="reset" class="btn btn-outline-success resetBtn float-right"><i class="fa fa-repeat"></i> Reset</button>
			<?php echo "<?php else: ?>\n"; ?>
			<button type="button" onclick="history.back();" class="btn btn-outline-success resetBtn float-right"><i class="fa fa-reply"></i> Kembali</button>
		<?php echo "<?php endif; ?>"; ?>
	</div>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>

</div><!-- form -->