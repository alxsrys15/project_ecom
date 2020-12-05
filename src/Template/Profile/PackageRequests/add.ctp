<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PackageRequest $packageRequest
 */
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-3">
            <?= $this->element('profile_sidebar') ?>
        </div>
        <div class="col-sm-9">
            <h5 class="title">Buy new package</h5>
            <?= $this->Form->create(null, ['action' => 'add', 'enctype' => 'multipart/form-data', 'id' => 'pr-form']) ?>
            <div class="row">
                <div class="col-sm-6">
                    <div class="col-sm-12 mb-3">
                        <label for="package-id" class="col-form-label">Select Package</label>
                        <select class="custom-select" name="package_id" id="package-id">
                            <?php foreach ($packages as $package): ?>
                            <option value="<?= $package->id ?>" data-description="<?= $package->description ?>" data-price="<?= $package->price ?>"><?= $package->name ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <?= $this->Form->control('payment_price', ['type' => 'hidden', 'value' => $packages->toArray()[0]['price']]) ?>
                    <div class="col-sm-12 mb-3">
                        <label for="payment-type" class="col-form-label">Select Payment Type</label>
                        <select class="custom-select" name="payment_type" id="payment-type">
                            <option value="bank">Bank Transfer</option>
                            <option value="coins">Coins</option>
                        </select>
                    </div>
                    <div id="bt-container">
                        <div class="col-sm-12">
                            <label for="payment-reference" class="col-form-label">Payment Reference Number</label>
                            <?= $this->Form->control('payment_reference', ['label' => false, 'class' => 'form-control', 'required']) ?>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="cash_price" class="col-form-label">Payment Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="payment_image" accept="image/*" required>
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div id="coins-container" style="display: none">
                        <div class="col-sm-12">
                            <h5 class="title">Coins Available: <?= number_format($Auth->User('coins_balance'), 2) ?></h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 offset-sm-2">
                    <p>Description: <span style="font-weight: bold" class="p-desc"><?= $packages->toArray()[0]['description'] ?></span></p>
                    <p>Price: <span style="font-weight: bold" class="p-price">P <?= number_format($packages->toArray()[0]['price'], 2) ?></span></p>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Buy package</button>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        bsCustomFileInput.init();
        $('#package-id').on('change', function () {
            const desc = $('#package-id option:selected').data('description');
            const price = $('#package-id option:selected').data('price');
            $('.p-desc').text(desc);
            $('.p-price').text('P' + price.toFixed(2));
            $('#payment-price').val(price);
        });
        $('#payment-type').on('change', function () {
            const val = $(this).val();
            if (val === "bank") {
                $('#bt-container').show();
                $('#coins-container').hide();
                $('#customFile').attr('required', true);
                $('#payment-reference').attr('required', true);
            } else {
                $('#bt-container').hide();
                $('#coins-container').show();
                $('#customFile').attr('required', false);
                $('#payment-reference').attr('required', false);
            }
        });
        $('#pr-form').on('submit', function () {
            const user_coins = Number('<?= $Auth->User('coins_balance') ?>');
            const payment_type = $('#payment-type').val();
            const selected_package = Number($('#package-id option:selected').data('price'));
            if (payment_type === "coins" && user_coins < selected_package) {
                Swal.fire({
                    icon: 'error',
                    text: 'Insufficient coins'
                });
                return false;
            }
        });
    });
</script>
