<div class="container">
	<h5 class="title">Add new Post</h5>
	<div class="row">
		<div class="col-sm-6">
			<?= $this->Form->create(null, ['url' => ['action' => 'add'], 'enctype' => 'multipart/form-data']) ?>
			<div class="col-sm-12">
				<label for="title" class="col-form-label">Title</label>
            	<?= $this->Form->control('title', ['class'=> 'form-control', 'label' => false, 'required' => true]) ?>
			</div>
			<div class="col-sm-12">
				<label for="content" class="col-form-label">Description</label>
            	<?= $this->Form->control('content', ['class'=> 'form-control', 'label' => false, 'required' => true, 'type' => 'textarea']) ?>
			</div>
			<div class="col-sm-12">
				<label for="price" class="col-form-label">Price</label>
            	<?= $this->Form->control('price', ['class'=> 'form-control', 'label' => false, 'required' => true, 'type' => 'number']) ?>
			</div>
			<div class="col-sm-12 mb-3">
	            <label for="cash_price" class="col-form-label">Images (Max of 5)</label>
	            <div class="custom-file">
	                <input type="file" class="custom-file-input" id="customFile" name="post_images[]" accept="image/*" required multiple>
	                <label class="custom-file-label" for="customFile">Choose file</label>
	            </div>
	        </div>
	        <div class="col-sm-12">
	        	<button class="btn btn-primary" type="submit">Add post</button>
	        </div>
			<?= $this->Form->end() ?>
		</div>
		<div class="col-sm-6">
			<div class="row" id="preview-container">
	            <!-- <?= $this->Html->image('default-image.jpg', ['class' => 'img-fluid preview', 'style' => ['cursor: pointer']]) ?> -->
	        </div>
		</div>
	</div>
</div>

<script type="text/javascript">
    function readURL (input, uploader) {
        const files = input.files;
        if (files) {
            $.each(files, function (i, el) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const markUp = `
                        <div class="col-sm-4 m-3">
                            <img src="${e.target.result}" class="mx-auto img-fluid" width="200" height="200" />
                        </div>
                    `;
                    $('#preview-container').append(markUp);
                }
                reader.readAsDataURL(el);
            });
        }
    }
    $(document).ready(function () {
    	bsCustomFileInput.init();
        $('#customFile').on('change', function () {
            readURL(this, $(this));
        });
    });
</script>
