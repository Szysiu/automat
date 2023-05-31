<form method="post" action="/?action=update">
    <?php
    /** @var $params */
    if($params): ?>
    <?php foreach ($params['items'] ?? [] as $item): ?>
        <div class="col-2 border border-2 rounded-1 border-white me-3 d-flex justify-content-center">
            <div class="box text-center">
                <img class="img mt-2" width="32px" height="32px" src="assets/img/<?php echo $item->getImage()?>">
                <h6 class="text-center mt-2"><?php echo $item->getName();?></h6>
                <h6 class="text-center mt-2"><?php echo $item->getCode();?></h6>
                <h6 class="text-center"><?php echo $item->getPrice().' ';?>zł</h6>
                <div class="input-group mb-2">
                    <input type="hidden" name="item_code[]" value="<?php echo $item->getCode();?>">
                    <input class="form-control text-center" name="item_amount[]" min="1" type="number" value="<?php echo $item->getAmount();?>">
                </div>
            </div>
        </div>


    <?php endforeach ?>
    <input type="submit" class="btn btn-outline-info" value="Zapisz">
</form>

<?php endif; ?>

<?php

var_dump($params['data']);