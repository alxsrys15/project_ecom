<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EBook $eBook
 */
?>
<?= $this->Form->create(null,['url' => ['action' => 'add'], 'enctype' => 'multipart/form-data', 'id' => 'ebook-form']) ?>
<div class="row">
    <div class="col-sm-6">
        <div class="col-sm-12">
            <label for="title" class="col-form-label">Title</label>
            <?= $this->Form->control('title', ['class'=> 'form-control', 'label' => false, 'required' => true]) ?>
        </div>
        <div class="col-sm-12">
            <label for="author" class="col-form-label">Author</label>
            <?= $this->Form->control('author', ['class'=> 'form-control', 'label' => false, 'required' => true]) ?>
        </div>
        <div class="col-sm-12">
            <label for="year_published" class="col-form-label">Year Published</label>
            <?= $this->Form->control('year_published', ['class'=> 'form-control', 'label' => false ,'type' => 'select', 'options' => $years_option, 'default' => date('Y'), 'required' => true]) ?>
        </div>
        <div class="col-sm-12">
            <label for="description" class="col-form-label">Description</label>
            <?= $this->Form->control('description', ['class'=> 'form-control', 'label' => false ,'type' => 'textarea']) ?>
        </div>
        <div class="col-sm-12 mb-3">
            <label for="cash_price" class="col-form-label">PDF File</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile" name="pdf_file" accept=".pdf">
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
        </div>
        <div class="col-sm-12">
            <button class="btn btn-primary" type="submit">Add E-Book</button>
        </div>
        
    </div>
    <div class="col-sm-6">
        <h4>Cover Image</h4>
        <div class="col-sm-12">
            <?= $this->Html->image('default-image.jpg', ['class' => 'img-fluid preview', 'style' => ['cursor: pointer']]) ?>
        </div>
        <?= $this->Form->control('cover_image', ['type' => 'file', 'class' => 'd-none uploader', 'label' => false, 'accept' => 'image/*']) ?>
    </div>
    
</div>
<?= $this->Form->end(); ?>

<script type="text/javascript">
    function readURL (input, uploader) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
              $('.preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
         }
    }
    $(document).ready(function () {
        bsCustomFileInput.init();
        $('.preview').on('click', function () {
            $('.uploader').trigger('click');
        });

        $('.uploader').on('change', function () {
            readURL(this, $(this));
        });

        $('#ebook-form').on('submit', function () {
            const img_val = $('#cover-image').val();
            if (img_val === "") {
                alert('Please select a cover image');
                return false;
            }
        });
    });
</script>
