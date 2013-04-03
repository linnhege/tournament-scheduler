<h2>Edit Tournament Responsible</h2>

<?php echo $this->form->create($model->name); ?>
<?php echo $this->form->input('name'); ?>
<?php echo $this->form->input('phone'); ?>
<?php echo $this->form->input('mail'); ?>
<?php echo $this->form->input('url_to_picture'); ?>
<?php echo $this->form->end('Update'); ?>